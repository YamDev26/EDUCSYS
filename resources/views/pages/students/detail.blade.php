@extends('app')
@section('title', 'detail student')
@section('link')

@endsection
@section('content')
<div class="page-container">
    <div class="row gx-3">
        @include('partials._alert')
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header border-bottom border-dashed pb-0">
                   <div class="d-flex justify-content-between">
                        <div class="card-title pb-0" style="font-size: 19px;">Detail Apprenant</div>
                        <div class="group-btn py-0" role="group">
                            <a href="{{ route('student.edit', $data['id']) }}" class="btn btn-soft-dark bg-gradient py-0">Edit</a>
                            <a href="{{ route('student.index') }}" class="btn btn-soft-dark bg-gradient py-0">Back</a>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="card-body px-3 pb-0">
                    <div class="row">
                        <div class="col-xxl-10 offset-xxl-1">
                            <div class="card card-h-100">
                                <div class="card-body p-3">
                                    <div class="text-center py-3">
                                        <table style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 30%">
                                                        <strong class="my-1" style="font-size: 19px">{{ $data->student->matricule }}</strong><br>
                                                        <img src="http://127.0.0.1:8000/assets/images/users/utilisateur.png" alt="image student" class="img-fluid" width="150" style="margin: 0px auto">
                                                    </td>
                                                    <td style="width: 70%">
                                                        <table style="width: 100%">
                                                            <tbody>
                                                                <tr>
                                                                    <th style="text-align: center; padding: 5px;">
                                                                        <h3>{{ strtoupper($data->student->first_name) .' '. ucwords($data->student->last_name) }}</h3>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="pb-2" style="text-align: left; padding: 5px; width: 70%">
                                                                        <h5 class="text-muted">Date et lieu de naissance</h5>
                                                                        <b style="margin: 0px; font-size: 15px">{{ $data->student->date_birth ? date('d/m/Y', strtotime($data->student->date_birth)).' '.($data->student->birth ? 'à '.ucwords($data->student->birth):'A definir'):'A definir' }}</b>
                                                                    </th>
                                                                    <th style="text-align: left; padding: 5px; width: 30%">
                                                                        <h5 class="text-muted">Genre</h5>
                                                                        <b style="margin: 0px; font-size: 15px">{{ $data->student->sexe == 'F' ? 'Feminin':'Masculin' }}</b>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="pb-2" style="text-align: left; padding: 5px; width: 30%">
                                                                        <h5 class="text-muted">Notionalité</h5>
                                                                        <b style="margin: 0px; font-size: 15px">{{ ucwords($data->student->nationalitie->libelle) }}</b>
                                                                    </th>
                                                                    <th style="text-align: left; padding: 5px; width: 30%">
                                                                        <h5 class="text-muted">Résidence</h5>
                                                                        <b style="margin: 0px; font-size: 15px">{{ ucwords($data->student->residence) ?? 'A definir' }}</b>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="pb-2" style="text-align: left; padding: 5px;">
                                                                        <h5 class="text-muted">Etablissement</h5>
                                                                        <b style="margin: 0px; font-size: 15px">{{ ucwords($data->originSchool->libelle) }}</b>
                                                                    </th>
                                                                    <th style="text-align: left; padding: 5px;">
                                                                        <h5 class="text-muted">Niveau d'étude</h5>
                                                                        <b style="margin: 0px; font-size: 14px">{{ ucwords($data->level->code) }} - {{ $data->classe }}</b>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="pb-2" class="pb-2" style="text-align: left; padding: 5px;">
                                                                        <h5 class="text-muted">Parent</h5>
                                                                        <b style="margin: 0px; font-size: 17px">
                                                                            {{ ucwords($data->student->studentParent->civility) }}. {{ strtoupper($data->student->studentParent->first_name).' '.ucwords($data->student->studentParent->last_name) }}
                                                                        </b>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left; padding: 5px;">
                                                                        <h5 class="text-muted">Téléphone</h5>
                                                                        <b style="margin: 0px; font-size: 15px">{{ $data->student->studentParent->phon1 }} {{ $data->student->studentParent->phon2 ? ' / '.$data->student->studentParent->phon2:null }}</b>
                                                                    </th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
       
    })
</script>
@endsection