<?php

namespace App\Http\Controllers;

use App\Models\Appel;
use App\Models\Hourly;
use App\Models\SchoolYear;
use App\Models\CentreStudent;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            $data = $this->getStudent(auth()->user()->centre_id ?? 1, $this->year(), $date, (int)$val['period']);
            if(count($data)){
                $hourlies = Hourly::where('period', ($val['period'] == 12 ? '1':'2'))->orderBy('id')->get();         
                return view('pages.appels.create',[
                    'data' => $data,
                    'group' => $period,
                    'hourly' => $hourlies,
                    'created' => $val['date'],
                    'date' => $date->isoFormat('D MMMM YYYY'),
                ]);
            }
            else{
                return back()->with([
                    'str' => 'warning',
                    'msg' => 'Pas de formations disponible à cette date.'
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
                $val = Appel::create([
                    'centre_student_id' => $request['student'],
                    'hourlie_id' => $request['hourl'],
                    'created' => $request['created'],
                    'period' => $request['period']
                ]);
            }
            else{
                $val = Appel::where('centre_student_id', $request['student'])->where('hourlie_id', $request['hourl'])->first();
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
            $gets = Appel::where('centre_student_id', $id)->orderBy('created')->get();
            return view('pages.appels.detail',[
                'datas' => $gets,
                'student' => CentreStudent::find($id)
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


    private function year(){
        $year = SchoolYear::where('status', '1')->first();
        return $year ? $year['id']:1;
    }
}
