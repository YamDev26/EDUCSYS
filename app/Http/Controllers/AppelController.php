<?php

namespace App\Http\Controllers;

use App\Models\Appel;
use App\Models\SchoolYear;
use App\Models\AppelStudent;
use App\Models\CentreStudent;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AppelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return view('pages.appels.index',[
                'group' => $this->getGroup()
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    public function dataTable(){
        
        $query = $this->getStudent(auth()->user()->centre_id ?? 1, $this->year());
        return DataTables::of($query)
        ->addColumn('firstName', function ($row) {
            return strtoupper($row->first_name);
        })
        ->addColumn('lastName', function ($row) {
            return ucwords($row->last_name);
        })
        ->addColumn('genre', function ($row) {
            return ucwords($row->sexe == 'F' ? 'Feminin':'Masculin');
        })
        ->addColumn('level', function ($row) {
            return $row->code;
        })
        ->addColumn('action', function ($row) {
            $url = route('appel.show', $row->id);
            return ('<div class="hstack gap-1 justify-content-center">
                <a href="'.$url.'" class="btn btn-soft-info btn-icon btn-sm rounded-circle" title="View"> <i class="ti ti-eye"></i></a>
            </div>');
        })
        ->addColumn('counter', function() use (&$counter) {
            return $counter <= 9 ? '0'.++$counter : ++$counter;
        })
        ->rawColumns(['firstName', 'lastName', 'genre', 'level', 'action', 'counter'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try{
            $val = $request->validate([
                'date' => 'required|date',
                'period' => 'required|integer',
            ]);
            Carbon::setLocale('fr');
            $date = Carbon::parse($val['date']);
            $period = $this->getGroup($date, (int)$val['period']);
            $appel = $this->getAppel($val['date'], $period);
            if(!($appel == 'oui')){
                $data = $this->getStudent(auth()->user()->centre_id ?? 1, $this->year(), $date, (int)$val['period']);            
                return view('pages.appels.create',[
                    'data' => $data,
                    'appel' => $appel,
                    'group' => $period,
                    'date' => $date->isoFormat('D MMMM YYYY'),
                ]);
            }
            else{
                return back()->with([
                    'str' => 'warning',
                    'msg' => 'Appel éffectué.'
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            if($request['val']){
                $val = AppelStudent::create([
                    'student_id' => $request['student'],
                    'appel_id' => $request['appel'],
                    'school_year_id' => $this->year(),
                    'centre_id' => auth()->user()->centre_id ?? 1
                ]);
            }
            else{
                $val = AppelStudent::where('student_id', $request['student'])->where('appel_id', $request['appel'])->first();
                $val->delete();
            }
            return ($val ? 200:201);
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
            return view('pages.appels.detail');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    private function getStudent($centre, $year, $date = null, $period = null){
        $data = CentreStudent::join('students', 'students.id', '=', 'centre_students.student_id')
        ->join('levels', 'levels.id', '=', 'centre_students.level_id')
        ->select('students.matricule' ,'students.first_name', 'students.last_name', 'students.sexe','centre_students.id', 'levels.code')
        ->where('centre_students.group', $this->getGroup($date, $period))
        ->where('centre_students.centre_id', $centre)
        ->where('centre_students.school_year_id', $year)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }


    private function getGroup($day1 = null, $hour1 = null){

        $date = Carbon::now();
        Carbon::setLocale('fr');
        $day = $day1 ? $day1->isoFormat('dddd'):$date->isoFormat('dddd');
        $hour = $hour1 ? $hour1:$date->hour;
        return match(true){
            ((in_array($day, ['lundi', 'mardi']) && ($hour <= 12)) || (in_array($day, ['jeudi', 'vendredi']) && ($hour > 12))) => 'A',
            ((in_array($day, ['jeudi', 'vendredi']) && ($hour <= 12)) ||  (in_array($day, ['lundi', 'mardi']) && ($hour > 12))) => 'B'
        };
    }


    private function getAppel($date, $period){
        $centre = auth()->user()->centre_id ?? 1;
        $appel = Appel::where('created', $date)->where('period', $period)->where('centre_id', $centre)->where('school_year_id', $this->year())->count();
        if(!$appel){
            $data = Appel::create([
                'created' => $date,
                'period' => $period,
                'centre_id' => $centre,
                'school_year_id' => $this->year(),
            ]);
        }
        return $appel ? 'oui':$data;
    }


    private function year(){
        $year = SchoolYear::where('status', '1')->first();
        return $year ? $year['id']:1;
    }
}
