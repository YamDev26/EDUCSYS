<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Section;
use App\Models\Payement;
use App\Models\Parametre;
use App\Models\SchoolYear;
use App\Models\DayPayement;
use App\Models\CentreStudent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PayementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $students = $this->getStudent(auth()->user()->centre_id ?? 1, $this->year());
            return view('pages.payements.index',[
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


    public function filePdf($id){
        try{
            $str = explode('_', $id);
            if(sizeof($str) == 2){
                $student = CentreStudent::find($str[0]);
                $dts = Payement::where('id', $str[1])->orderBy('created_at', 'desc')->get();
            }
            else{
                $student = CentreStudent::find($id);
                $dts = Payement::where('centre_student_id', $id)->where('status', '!=', '2')->orderBy('created_at')->get();
            }
            $pdf = PDF::loadView('pdf.payement',[
                'datas' => $dts,
                'student' => $student,
            ]);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream('reçu_de_payement.pdf');
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'.$e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $val = $request->validate([
                'student' => 'required|integer',
                'service' => 'required|numeric',
                'number' => 'nullable|integer',
            ]);

            $service = Parametre::find($val['service']);
            return match(true) {
                ($service['etat'] == 1) => $this->formulePleine($request),
                ($service['etat'] == 2) => $this->formulePartial($request),
                ($service['etat'] == 3) => $this->coursAnglais($request),
                default => back()->with([
                    'str' => 'danger',
                    'msg' => 'Une erreur est survenue !'
                ])
            };
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
            $tarif = Parametre::orderBy('libelle')->get();
            $dts = Payement::where('centre_student_id', $id)->orderBy('created_at', 'desc')->paginate(3);
            return view('pages.payements.detail',[
                'data' => $data,
                'tarif' => $tarif,
                'dts' => $dts
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
    public function listView()
    {
        try{
            $datas = Payement::where('school_year_id', $this->year())->orderBy('created_at', 'desc')->paginate(10);
            return view('pages.payements.list', [
                'datas' => $datas
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
    public function update(Request $request)
    {
        try{
            $val = $request->validate([
                'paie' => 'required|integer',
                'debut' => 'required|date',
                'fin' => 'required|date'
            ]);

            Payement::where('id', $val['paie'])->update([
                'debut' => date('d-m-Y', strtotime($val['debut'])),
                'fin' => date('d-m-Y', strtotime($val['fin'])),
            ]);
            return back()->with([
                'str' => 'info',
                'msg' => 'Modification prise en compte.'
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
    public function edit(Request $request)
    {
        try{
            $data = Payement::find($request['id']);
            return response()->json([
                'id' => $data['id'],
                'debut' => date('d-m-Y', strtotime($data['debut'])),
                'fin' => date('d-m-Y', strtotime($data['fin'])),
                'libelle' => ucwords($data['parametre']['libelle']),
                'number' => (int)$data['number']
            ]);
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'
            ]);
        }
    }


    private function getStudent($centre, $year){
        $data = CentreStudent::join('students', 'students.id', '=', 'centre_students.student_id')
        ->join('levels', 'levels.id', '=', 'centre_students.level_id')
        ->select('students.matricule' ,'students.first_name', 'students.last_name', 'students.sexe',
        'centre_students.id', 'levels.code')
        ->where('centre_students.centre_id', $centre)
        ->where('centre_students.school_year_id', $year)
        ->orderBy('students.first_name')
        ->orderBy('students.last_name')
        ->get();
        return $data;
    }


    private function formulePleine($data){
        $verify = $this->verify($data['student'], $data['service']);
        if(!$verify){
            $curent = Carbon::today();
            $create = Payement::create([
                'debut' => $curent->format('Y-m-d'),
                'fin' => $this->getDateFin($curent, $data['number']),
                'number' => $data['number'],
                'parametre_id' => $data['service'],
                'school_year_id' => $this->year(),
                'centre_student_id' => $data['student']
            ]);
            $route = route('payement.pdf', $data['student'].'_'.$create['id']);
            return back()->with([
                'str' => 'success',
                'msg' => 'Paiement efféctué avec success.',
                'route' => $route
            ]);
        }
        else{
            $route = route('payement.pdf', $data['student'].'_'.$verify);
            return back()->with([
                'str' => 'info',
                'msg' => 'Elève déjà inscrit pour cette période.',
                'route' => $route
            ]);
        }
    }


    private function formulePartial($data){
        $val = $data->validate([
            'day' => 'required|array',
            'day*' => 'required|integer',
        ]);
        $verify = $this->verify($data['student'], $data['service']);
        if(!$verify){
            $curent = Carbon::today();
            $create = Payement::create([
                'debut' => $curent->format('Y-m-d'),
                'fin' => $this->getDateFin($curent, $data['number']),
                'number' => $data['number'],
                'parametre_id' => $data['service'],
                'school_year_id' => $this->year(),
                'centre_student_id' => $data['student']
            ]);
            $create ? $this->saveDayStudent($val['day'], $create['id']):null;
            $route = route('payement.pdf', $data['student'].'_'.$create['id']);
            return back()->with([
                'str' => 'success',
                'msg' => 'Paiement efféctué avec success.',
                'route' => $route
            ]);
        }
        else{
            $route = route('payement.pdf', $data['student'].'_'.$verify);
            return back()->with([
                'str' => 'info',
                'msg' => 'Elève déjà inscrit pour cette période.',
                'route' => $route
            ]);
        }
    }

    private function coursAnglais($data){
        $val = $data->validate([
            'section' => 'required|array',
            'section*' => 'required|integer',
        ]);

        $i = 0;
        while($i < sizeof($val['section'])){
            $exist = Payement::where('section_id', $val['section'][$i])->where('centre_student_id', $data['student'])->first();
            if(!$exist){
                Payement::create([
                    'status' => $this->statusSection($val['section'][$i]),
                    'number' => '3',
                    'school_year_id' => $this->year(),
                    'section_id' => $val['section'][$i],
                    'parametre_id' => $data['service'],
                    'centre_student_id' => $data['student'],
                ]);
            }
            $i++;
        }
        $route = route('payement.pdf', $data['student']);
        return back()->with([
            'str' => 'success',
            'msg' => 'Paiement efféctué avec success.',
            'route' => $route
        ]);
    }


    private function getDateFin($dates, $nombre){
        $nbJours = (30 * $nombre); // Nombre de jours à ajouter
        $end = $dates->addDays($nbJours);
        return $end->format('Y-m-d');
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

    private function verify($student, $service){
        $exist = Payement::where('centre_student_id', $student)->where('parametre_id', $service)->where('status', '!=', '2')->first();
        return $exist ? $exist['id']:null; 
    }

    private function statusSection($id){
        $val = Section::find($id);
        return $val['status'];
    }

    private function year(){
        $year = SchoolYear::where('status', '1')->first();
        return $year ? $year['id']:1;
    }
}
