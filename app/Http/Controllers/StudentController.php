<?php

namespace App\Http\Controllers;
use App\Models\Level;
use App\Models\Student;
use App\Models\Section;
use App\Models\Payement;
use App\Models\Parametre;
use App\Models\SchoolYear;
use App\Models\DayPayement;
use App\Models\Nationality;
use App\Models\OriginSchool;
use App\Models\StudentParent;
use App\Models\CentreStudent;
use Illuminate\Http\Request;
use App\Imports\StudentExcelImport;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\EditStudentRequest;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         try{
            $centre = auth()->user()->centre_id ?? 1;
            $students = $this->getStudent($centre);
            return view('pages.students.index',[
                'students' => $students
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $levels = Level::get();
            $dts = Parametre::orderBy('libelle')->get();
            return view('pages.students.create',[
                'levels' => $levels,
                'dts' => $dts,
                'data' => []
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        try{
            $val = $request->validated();
            $parent = $this->parent($val['civility'], $val['name1'], $val['name2'], $val['fonction'], $val['phon1'], $val['phon2']);
            $nationality = $this->nationality($val['nation']);
            $student = $this->student($val['matricul'], $val['nom'], $val['prenom'], $val['genre'], $val['date'], 
            $val['lieu'], $val['residence'], $nationality, $parent);
            $verify = $this->verify($student);
            if(!$verify){
               $dts =  CentreStudent::create([
                    'classe' => $val['classe'],
                    'doublant' => getStrtolower($val['doublant']),
                    'level_id' => $val['level'],
                    'centre_id' => auth()->user()->centre_id ?? 1,
                    'student_id' => $student,
                    'school_year_id' => $this->year(),
                    'origin_school_id' => $this->school($val['school'])
                ]);

                return match(true) {
                    ($val['service'] == 1) => $this->formulePleine($val, $dts['id']),
                    ($val['service'] == 2) => $this->formulePartial($val['service'], $val['day'], $dts['id']),
                    ($val['service'] == 3) => $this->coursAnglais($val['service'], $val['section'], $dts['id']),
                    default => back()->with([
                        'str' => 'danger',
                        'msg' => 'Une erreur est survenue !'
                    ])
                };
            }
            else{
                return back()->with([
                    'str' => 'warning',
                    'msg' => 'Elève déjà inscrit pour cette année scolaire.'
                ]); 
            }

        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function import(Request $request){
        try{
            $request->validate(['files' => 'required|file|mimes:xlsx,csv,xls']);
            $centre = auth()->user()->centre_id ?? 1;
            Excel::import(new StudentExcelImport($centre, $this->year()), $request->file('files'));
            return to_route('student.index')->with([
                'str' => 'info',
                'msg' => 'Importation réussie.'
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function export(){
        try{
            $filename = 'apprenant_nex.xlsx';
            return response()->download(storage_path('app/public/file/'.$filename));
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $data = CentreStudent::find($id);
            return view('pages.students.detail',[
                'data' => $data
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $data = CentreStudent::find($id);
            $levels = Level::get();
            return view('pages.students.edit',[
                'levels' => $levels,
                'data' => $data
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditStudentRequest $request, string $id)
    {
        try{
            $data = $request->validated();
            $val = CentreStudent::find($id);
            if($val){
                $this->studentUpdate($val['student_id'], $data);
                $this->parentUpdate($val['student']['student_parent_id'], $data);
                $val->update([
                    'classe' => $val['classe'],
                    'doublant' => getStrtolower($data['doublant']),
                    'level_id' => $data['level'],
                    'origin_school_id' => $this->school($data['school']),
                    'status' => $request['status'] ? '1':'0'
                ]);
                return to_route('student.index')->with([
                    'str' => 'info',
                    'msg' => 'Modification prise en compte.'
                ]);
            }
            else{
                return back()->with([
                    'str' => 'danger',
                    'msg' => 'Une erreur est survenue !'
                ]);
            }
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function service(Request $request){
        try{
            $tarif = Parametre::find($request['id']);
            $sections = Section::where('school_year_id', $this->year())
            ->where('parametre_id', $request['id'])->orderBy('order')->get();
            return response()->json(['tarif' => $tarif, 'infos' => $sections]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    private function getStudent($centre){
        $data = CentreStudent::join('students', 'students.id', '=', 'centre_students.student_id')
        ->where('centre_id', $centre)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }

    // Search parent for phon ---------
    public function search1(Request $request){
        $data = StudentParent::where('phon1', $request['phon'])->orWhere('phon2', $request['phon'])->first();
        return response()->json($data);
    }


    // Vérifiction du matricule Eleve
    public function matricul(Request $request){
        $data = Student::where('matricule', $request['mat'])->count();
        return response()->json($data);
    }

    
    private function parent($civility, $non, $prenom, $fonction, $phon1, $phon2 = null){
        $val = StudentParent::where('phon1', $phon1)->orwhere('phon2', $phon1)->first();
        if(!$val){
            $exist = $phon2 ? StudentParent::where('phon1', $phon2)->orwhere('phon2', $phon2)->first():null;
            $val = $exist ? $exist:StudentParent::create([
                'civility' => getStrtolower($civility),
                'first_name' => getStrtolower($non),
                'last_name' => getStrtolower($prenom),
                'fonction' => getStrtolower($fonction),
                'phon1' => $phon1,
                'phon2' => $phon2
            ]);
        }
        return $val ? $val['id']:null;
    }


    private function parentUpdate($id, $data){
        $val = StudentParent::find($id);
        if($val){
            $val->update([
                'civility' => getStrtolower($data['civility']),
                'first_name' => getStrtolower($data['name1']),
                'last_name' => getStrtolower($data['name2']),
                'fonction' => $data['fonction'] ? getStrtolower($data['fonction']) : $val['fonction'],
                'phon1' => $data['phon1'],
                'phon2' => $data['phon2'] ?? null
            ]);
        }
    }

    private function nationality($libelle){
        $search = getStrtolower($libelle);
        $val = Nationality::where('libelle', 'like', "%$search%")->first();
        if(!$val){
            $val = Nationality::create(['libelle' => $search]);
        }
        return $val ? $val['id']:null;
    }


    private function school($libelle){
        $search = getStrtolower($libelle);
        $val = OriginSchool::where('libelle', 'like', "%$search%")->first();
        if(!$val){
            $val = OriginSchool::create(['libelle' => $search]);
        }
        return $val ? $val['id']:null;
    }


    private function student($matricule, $nom, $prenom, $sexe, $date, $lieu, $residence,  $nation, $parent){
        $val = Student::where('matricule', $matricule)->first();
        if(!$val){
            $val = Student::create([
                'matricule' => $matricule,
                'first_name' => getStrtolower($nom),
                'last_name' => getStrtolower($prenom),
                'sexe' => $sexe,
                'date_birth' => $date,
                'birth' => getStrtolower($lieu),
                'residence' => getStrtolower($residence),
                'school_year_id' => $this->year(),
                'nationalitie_id' => $nation,
                'student_parent_id' => $parent,
            ]);
        }
        return $val ? $val['id']:null;
    }


    private function studentUpdate($id, $data){
        $val = Student::find($id);
        if($val){
            $val->update([
                'matricule' => $data['matricul'],
                'first_name' => getStrtolower($data['nom']),
                'last_name' => getStrtolower($data['prenom']),
                'sexe' => $data['genre'],
                'date_birth' => $data['date'],
                'birth' => getStrtolower($data['lieu']),
                'residence' => getStrtolower($data['residence']),
                'nationalitie_id' => $this->nationality($data['nation'])
            ]);
        }
    }


    private function verify($student){
        $count = CentreStudent::where('student_id', $student)->where('school_year_id', $this->year())->count();
        return $count ?? null;
    }



    private function formulePleine($data, $student){
        $curent = Carbon::today();
        $create = Payement::create([
            'debut' => $curent->format('Y-m-d'),
            'fin' => $this->getDateFin($curent),
            'number' => $data['number'],
            'school_year_id' => $this->year(),
            'parametre_id' => $data['service'],
            'centre_student_id' => $student
        ]);
        $route = route('payement.pdf', $student.'_'.$create['id']);
        return to_route('payement.show', $student)->with([
            'str' => 'success',
            'msg' => 'Enregistrement effectué.',
            'route' => $route
        ]);
    }


    private function formulePartial($data, $student){
        if(count($data['day']) == 2){
            $curent = Carbon::today();
            $create = Payement::create([
                'debut' => $curent->format('Y-m-d'),
                'fin' => $this->getDateFin($curent),
                'number' => $data['number'],
                'parametre_id' => $data['service'],
                'school_year_id' => $this->year(),
                'centre_student_id' => $student
            ]);
            $create ? $this->saveDayStudent($data['day'], $create['id']):null;
            $route = route('payement.pdf', $student.'_'.$create['id']);
            return to_route('payement.show', $student)->with([
                'str' => 'success',
                'msg' => 'Paiement efféctué avec success.',
                'route' => $route
            ]);
        }
        else{
            return to_route('payement.show', $student)->with([
                'str' => 'warning',
                'msg' => 'Paiement non conclu.',
            ]);
        }
    }


    private function coursAnglais($service, $data, $student){
        if(count($data)){
            $i = 0;
            while($i < sizeof($data)){
                $exist = Payement::where('section_id', $data[$i])->where('centre_student_id', $student)->first();
                if(!$exist){
                    Payement::create([
                        'status' => $this->statusSection($data[$i]),
                        'number' => '3',
                        'school_year_id' => $this->year(),
                        'section_id' => $data[$i],
                        'parametre_id' => $service,
                        'centre_student_id' => $student,
                    ]);
                }
                $i++;
            }
            $route = route('payement.pdf', $student);
            return to_route('payement.show', $student)->with([
                'str' => 'success',
                'msg' => 'Paiement efféctué avec success.',
                'route' => $route
            ]);
        }
        else{
            return to_route('payement.show', $student)->with([
                'str' => 'warning',
                'msg' => 'Paiement non conclu.',
            ]);
        }
    }


    private function year(){
        $year = SchoolYear::where('status', '1')->first();
        return $year ? $year['id']:1;
    }

    private function saveDayStudent($dts, $paye){
        $i = 0;
        while($i < 2){
            DayPayement::create([
                'day_id' => $dts[$i],
                'payement_id' => $paye,
            ]);
            $i++;
        }
    }


    private function statusSection($id){
        $val = Section::find($id);
        return $val['status'];
    }


    private function getDateFin($dates){
        $nbJours = 30; // Nombre de jours à ajouter
        $end = $dates->addDays($nbJours);
        return $end->format('Y-m-d');
    }
}
