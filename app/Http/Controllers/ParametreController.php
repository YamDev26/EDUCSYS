<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Parametre;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ParametreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $params = Parametre::orderBy('created_at')->get();
            return view('pages.tarifs.index',[
                'tarifs' => $params
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
    public function create(Request $request)
    {
        try{
            $val = $request->validate([
                'id' => 'required|integer',
                'debut' => 'required|array',
                'fin' => 'required|array'
            ]);
            $curent = Carbon::now()->format('d-m-Y');
            $i = 0;
            while($i < sizeof($val['debut'])){
                if($val['debut'][$i] && $val['fin'][$i]){
                    $exist = Section::where('parametre_id', $val['id'])->where('order', $i+1)->where('school_year_id', $this->year())->first();
                    if($exist){
                        $exist->update([
                            'debut' => $val['debut'][$i],
                            'fin' => $val['fin'][$i],
                            'status' => compareToDate($curent, $val['debut'][$i], $val['fin'][$i]),
                        ]);
                    }
                    else{
                        Section::create([
                            'debut' => $val['debut'][$i],
                            'fin' => $val['fin'][$i],
                            'status' => compareToDate($curent, $val['debut'][$i], $val['fin'][$i]),
                            'order' => $i+1,
                            'parametre_id' => $val['id'],
                            'school_year_id' => $this->year(),
                        ]);
                    }
                }
                $i++;
            }
            return to_route('tarif.index')->with([
                'str' => 'success',
                'msg' => 'Section ajoutée avec success.'
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
    public function store(Request $request)
    {
        try{
            $val = $request->validate([
                'libelle' => 'required|string',
                'montant' => 'nullable|numeric',
                'etat' => 'required|integer',
            ]);

            Parametre::create([
                'libelle' => getStrtolower($val['libelle']),
                'montant' => $request['montant'] ?? null,
                'etat' => $val['etat'],
            ]);
            return to_route('tarif.index')->with([
                'str' => 'success',
                'msg' => 'Servie ajouté avec success.'
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
     * Display the specified resource.
     */
    public function search1(Request $val){
        try{
            $year = $this->year();
            $data = Section::where('parametre_id', $val['id'])->where('school_year_id', $year)->orderBy('order')->get();
            return response()->json($data);
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
    public function edit(Request $request)
    {
        try{
            $data = Parametre::find($request['id']);
            return response()->json($data);
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
                'libelle' => 'required|string',
                'montant' => 'nullable|numeric',
                'etat' => 'required|integer',
                'lib' => 'required|integer',
            ]);
            $data = Parametre::find($val['lib']);
            if($data){
                $data->update([
                    'libelle' => getStrtolower($val['libelle']),
                    'montant' => $request['montant'] ?? null,
                    'etat' => $val['etat'],
                    'status' => $request['status'] ? '1':'0'
                ]);
                return to_route('tarif.index')->with([
                    'str' => 'primary',
                    'msg' => 'Modification prise en compte avec success.'
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
    public function destroy(Request $request)
    {
        try{
            $data = Parametre::find($request['ids']);
            if($data){
                $data->delete();
                return to_route('tarif.index')->with([
                    'str' => 'info',
                    'msg' => 'Suppression effectuée avec success.'
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


    private function year(){
        $year = SchoolYear::where('status', '1')->first();
        return $year ? $year['id']:1;
    }
}
