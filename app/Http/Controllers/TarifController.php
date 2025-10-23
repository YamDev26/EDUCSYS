<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use App\Models\Section;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $centre = auth()->user()->centre_id ?? 1;
            $tarifs = Tarif::where('centre_id', $centre)->orderBy('created_at')->get();
            return view('pages.tarifs.index',[
                'tarifs' => $tarifs
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
            $center = auth()->user()->centre_id ?? 1;
            $i = 0;
            while($i < sizeof($val['debut'])){
                if($val['debut'][$i] && $val['fin'][$i]){
                    $exist = Section::where('tarif_id', $val['id'])->where('order', $i+1)->where('centre_id', $center)->where('school_year_id', $this->year())->first();
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
                            'tarif_id' => $val['id'],
                            'centre_id' => $center,
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
            // if (now()->isSameDay($user->birth_date)) {
            //     echo "C’est son anniversaire !";
            // }

            // if (now()->gt($user->subscription_end)) {
            //     echo "L’abonnement est expiré.";
            // }
        }
        catch (\Exception $e) {
            return back()->with([
                'str' => 'danger',
                'msg' => 'Une erreur est survenue !'.$e->getMessage()
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
                'nombre' => 'required|integer',
                'montant' => 'required|numeric',
                'payement' => 'required|integer',
            ]);

            $centre = auth()->user()->centre_id ?? 1;
            Tarif::create([
                'libelle' => $val['libelle'],
                'jours' => $val['nombre'],
                'montant' => $val['montant'],
                'payement' => $val['payement'],
                'centre_id' => $centre,
                'school_year_id' => $this->year()
            ]);
            return to_route('tarif.index')->with([
                'str' => 'success',
                'msg' => 'Tarif ajouté avec success.'
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try{
            $data = Tarif::find($request['id']);
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
                'nombre' => 'required|integer',
                'montant' => 'required|numeric',
                'payement' => 'required|integer',
                'lib' => 'required|integer',
            ]);
            $data = Tarif::find($val['lib']);
            if($data){
                $data->update([
                    'libelle' => $val['libelle'],
                    'jours' => $val['nombre'],
                    'montant' => $val['montant'],
                    'payement' => $val['payement'],
                    'status' => $request['status'] ? '1':'0'
                ]);
                return to_route('tarif.index')->with([
                    'str' => 'primary',
                    'msg' => 'Tarif mis à jour avec success.'
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


    public function search1(Request $val){
        $centre = auth()->user()->centre_id ?? 1;
        $year = $this->year();
        $data = Section::where('tarif_id', $val['id'])->where('school_year_id', $year)->orderBy('order')->get();
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $data = Tarif::find($request['ids']);
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
