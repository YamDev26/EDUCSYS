<?php

namespace App\Imports;

use App\Models\Level;
use App\Models\Student;
use App\Models\CentreStudent;
use App\Models\StudentParent;
use App\Models\OriginSchool;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentExcelImport implements ToCollection, WithHeadingRow
{
    protected $school, $year;
    public function __construct($school, $year)
    {
        $this->school = $school;
        $this->year = $year;
    }


    public function collection(Collection $collection)
    {
        foreach($collection as $item){
            if(isset($item['matricule']) && isset($item['nom']) && isset($item['prenoms']) && isset($item['genre']) && isset($item['niveau_etude']) && isset($item['nom_parent']) && isset($item['contact1'])){
                $parent = $this->getParent($item['parent'], $item['nom_parent'], $item['prenom_parent'], $item['contact1'], $item['contact2']);
                $student = $this->getStudent($item['matricule'], $item['nom'], $item['prenoms'], $item['genre'], $parent);
                if(!$this->verify($student)){
                    CentreStudent::create([
                        'classe' => $item['classe_actuelle'] ?? 'a definir',
                        'doublant' => 'non',
                        'level_id' => $item['niveau_etude'] ? $this->level($item['niveau_etude']): 1,
                        'centre_id' => $this->school ?? 1,
                        'student_id' => $student,
                        'school_year_id' => $this->year,
                        'origin_school_id' => $item['etablissement'] ? $this->etablis($item['etablissement']):1
                    ]);
                }
            }
        }
    }


    private function getParent($sexe = 'm', $non, $prenom, $phon1, $phon2 = null){
        $phon1 = $this->contactCorrect($phon1);
        $val = StudentParent::where('phon1', $phon1)->orWhere('phon2', $phon1)->first();
        if(!$val){
            $phon2 = $phon2 ? $this->contactCorrect($phon2):null;
            $exist = $phon2 ? StudentParent::where('phon1', $phon2)->orwhere('phon2', $phon2)->first():null;
            $val = $exist ? $exist:StudentParent::create([
                'civility' => $sexe ? $this->sexeParent($sexe):'m',
                'first_name' => getStrtolower($non),
                'last_name' => getStrtolower($prenom),
                'fonction' => 'a definir',
                'phon1' => $this->contactCorrect($phon1),
                'phon2' => $phon2 ? $this->contactCorrect($phon2):null
            ]);
        }
        return $val ? $val['id']:null;
    }



    private function getStudent($matricule, $nom, $prenom, $sexe, $parent){
        $val = Student::where('matricule', $matricule)->first();
        if(!$val){
            $val = Student::create([
                'matricule' => $matricule,
                'first_name' => getStrtolower($nom),
                'last_name' => getStrtolower($prenom),
                'sexe' => $this->genreStudent($sexe),
                'birth' => 'a definir',
                'residence' => 'a definir',
                'school_year_id' => $this->year,
                'nationalitie_id' => 1,
                'student_parent_id' => $parent,
            ]);
        }
        return $val ? $val['id']:null;
    }


    private function verify($student){
        $count = CentreStudent::where('student_id', $student)->where('school_year_id', $this->year)->count();
        return $count ?? null;
    }


    // Verification du sexe de parent en charge des etudes .........
    private function sexeParent($val){
        if(in_array(getStrtolower($val),['mère', 'tutrice'])){
            $genre = 'mde';
        }
        return $genre ?? 'm';
    }

    private function genreStudent($genre)
    {
        return match(true){
            (in_array(getStrtolower($genre),['F', 'Fille', 'feminin'])) => 'F',
            default => 'M'
        };
    }

    private function contactCorrect($contact){
        $val = strlen((string)$contact);

        return $val == 10 ? $contact :'0'.(string)$contact;
    }


    private function etablis($libelle){
        $lib = OriginSchool::where('libelle', getStrtolower($libelle))->first();
        if(!$lib){
            $lib = OriginSchool::create(['libelle' => getStrtolower($libelle)]);
        }
        return  $lib ?  $lib['id']:1;
    }


    private function level($level){
        $result = Level::where('code', $level)->first();
        return $result ? $result['id']:1;
    }
}
