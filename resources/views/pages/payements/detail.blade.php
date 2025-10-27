@extends('app')
@section('title', 'detail payemnt')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12 col-12">
            @include('partials._alert')
            <div class="card">
                <div class="card-header border-bottom border-dashed pb-0">
                   <div class="d-flex justify-content-between">
                        <div class="card-title pb-0" style="font-size: 19px;">Detail Payements</div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <div class="dropdown">
                                <button class="btn btn-outline-dark dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown" aria-expanded="false">Add</button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    @foreach ($tarif as $item)
                                    <button data-val="{{ $item['id'] }}" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#centermodal">{{ ucwords($item['libelle']) }}</button>
                                    @endforeach
                                </div>
                            </div>
                            <a href="{{ route('payement.index') }}" type="button" class="btn btn-outline-dark">Back</a>
                        </div>
                   </div>
                </div>
                <div class="card-body px-3 pb-0 mt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-h-100">
                                <div class="card-body p-3">
                                    <div class="text-center py-3">
                                        <table class="w-100">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 40%">
                                                        <strong class="my-1" style="font-size: 17px">{{ $data->student->matricule }}</strong> <br>
                                                        <img src="{{ asset('assets/images/users/utilisateur.png') }}" alt="image student" class="img-fluid" width="150" style="margin: 0px auto">
                                                    </td>
                                                    <td style="width: 60%">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <th style="text-align: left; padding: 5px;">
                                                                        <h3>{{ strtoupper($data->student->first_name) .' '. ucwords($data->student->last_name) }}</h3>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left; padding: 5px; width: 80%">
                                                                        <h5 class="text-muted">Date et lieu de naissance</h5>
                                                                        <b style="margin: 0px; font-size: 15px">{{ $data->student->date_birth ? date('d/m/Y', strtotime($data->student->date_birth)).' '.($data->student->birth ? 'à '.ucwords($data->student->birth):'A definir'):'A definir' }}</b>
                                                                    </th>
                                                                    <th style="text-align: left; padding: 5px; width: 20%">
                                                                        <h5 class="text-muted">Genre</h5>
                                                                        <b style="margin: 0px; font-size: 14px">{{ $data->student->sexe == 'F' ? 'Feminin':'Masculin' }}</b>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left; padding: 5px;">
                                                                        <h5 class="text-muted">Niveau d'étude</h5>
                                                                        <b style="margin: 0px; font-size: 14px">{{ ucwords($data->level->level) }} - {{ ucwords($data->originSchool->libelle) }}</b>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="text-align: left; padding: 5px;">
                                                                        <h5 class="text-muted">Parent</h5>
                                                                        <b style="margin: 0px; font-size: 14px">{{ ($data->student->studentParent->civility == 'm' ? 'M. ':'Mde ').strtoupper($data->student->studentParent->first_name) .' '. ucwords($data->student->studentParent->last_name) }}</b>
                                                                    </th>
                                                                </tr>
                                                                <th style="text-align: left; padding: 5px;">
                                                                    <h5 class="text-muted">Téléphone</h5>
                                                                    <b style="margin: 0px; font-size: 14px">{{ $data->student->studentParent->phon1 }} {{$data->student->studentParent->phon ? ' - '.$data->student->studentParent->phon2:null}}</b>
                                                                </th>
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

                        <div class="col-lg-6">
                            <div class="card card-h-100">
                                <div class="card-header d-flex flex-wrap align-items-center gap-2 border-bottom border-dashed">
                                    <h4 class="header-title me-auto">Liste Paie</h4>

                                    <div class="d-flex gap-2 justify-content-end text-end">
                                        @if (count($dts))
                                            <a href="{{ route('payement.pdf',$data['id']) }}" target="_blank" class="btn btn-sm btn-light"><i class="ti ti-download"></i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-custom align-middle table-nowrap mb-0">
                                            <tbody>
                                                @php $i = 1 @endphp
                                                @forelse ($dts as $param)
                                                <tr>
                                                    <th style="width: 85px;">{{ $i <= 9 ? '0'.$i++:$i++ }}</th>
                                                    <td class="ps-2">
                                                        <h5 class="fs-14"><a href="#!" class="link-reset">{{ ucwords($param->parametre->libelle) }}</a></h5>
                                                        <span class="text-muted fs-12">{{ $param['section_id'] ? 'Section '.$param->section->order.' - 3 mois':'1 mois' }}</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14">Debut</h5>
                                                        <span class="text-muted fs-12">{{ $param['section_id'] ? $param->section->debut:date('d-m-Y', strtotime($param->debut)) }}</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14">Fin</h5>
                                                        <span class="text-muted fs-12">{{ $param['section_id'] ? $param->section->fin:date('d-m-Y', strtotime($param->fin)) }}</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14">Status</h5>
                                                        <span class="badge bg-{{ getStatus($param->status)[0] }}-subtle text-{{ getStatus($param->status)[0] }} fs-12 p-1">{{ getStatus($param->status)[1] }}</span>
                                                    </td>
                                                    <td style="width: 30px;">
                                                        <h5 class="fs-14"></h5>
                                                        <div class="dropdown mt-3">
                                                            <a href="#" class="dropdown-toggle text-muted drop-arrow-none card-drop p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end" style="width: 70px">
                                                                <button type="button" data-id="{{ $param['id'] }}" {{ $param['section_id'] ? 'disabled':null }}  class="dropdown-item myEdit">Edit</button>
                                                                <a href="{{ route('payement.pdf',$data['id'].'_'.$param['id']) }}" target="_blank" class="dropdown-item">Imprim</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <th colspan="6" class="text-center my2">Aucune donnée trouvée</th>
                                                </tr>
                                                @endforelse 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{ $dts->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add Tarif -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('payement.store') }}" method="post">
                @csrf
                <div class="modal-header py-2">
                    <h3 class="modal-title" id="myCenterModalLabel">Payement</h3>
                </div>
                <div class="modal-body mb-0 pb-0">
                    <input type="hidden" name="student" value="{{ $data['id'] }}">
                    <input type="hidden" name="service" id="tarifs">
                    <div class="text-center mb-1">
                        <i class="ti ti-info-square-rounded h1 text-info"></i>
                        <h3 class="mt-3" id="libModals">Heads up!</h3>
                    </div>

                    <div class="my-3">
                        <div class="d-flex justify-content-between mt-1" id="sectionGroup">
                            <!-- !!! -->
                        </div>
                    </div>

                    <hr class="mx-3">
                    <div class="mb-3">
                        <input type="hidden" id="input">
                        <label style="font-size: 17px">Net à payer :</label>
                        <strong id="montant" class="mx-2" style="font-size: 17px; border-bottom: 2px solid rgb(200, 108, 108)">---</strong>
                    </div>

                    <div class="form-check form-checkbox-success mb-0">
                        <input type="checkbox" class="form-check-input" id="acceptTo">
                        <label class="form-check-label" for="acceptTo">Acceptez la validalition du payement !</label>
                    </div>
                </div>
                <div class="modal-footer mt-0">
                    <button type="button" class="btn btn-light py-1" data-bs-dismiss="modal" style="width: 100px">Annuler</button>
                    <button type="submit" class="btn btn-light py-1" id="submit" style="width: 100px">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Date End -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('payement.update') }}" method="post">
                @csrf
                <div class="modal-header py-2">
                    <h3 class="modal-title" id="myCenterModalLabel">Edit Paie</h3>
                </div>
                <div class="modal-body mb-0 pb-0">
                    <input type="hidden" name="paie" id="paieId">
                    <p class="text-center my-0">
                        <strong id="libEdit" style="font-size: 17px"></strong>
                    </p>
                    <div class="my-3">
                        <div class="form-group my-2">
                            <label for="debutEdit" class="form-label mb-0">Date debut :</label>
                            <input type="text" name="debut" id="debutEdit" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                        </div>

                        <div class="form-group my-2">
                            <label for="finEdit" class="form-label mb-0">Date Fin :</label>
                            <input type="text" name="fin" id="finEdit" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-0">
                    <button type="button" class="btn btn-light py-1" data-bs-dismiss="modal" style="width: 100px">Annuler</button>
                    <button type="submit" class="btn btn-light py-1" id="mySubmit" style="width: 100px">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.dropdown-item').on('click', function() {
            $('#tarifs').val($(this).data('val'));
            $('.checkbox-day, .form-checkbox-danger').remove();
            if($(this).data('val')){
                $.ajax({
                    url: '{{ route('payement.create') }}',
                    method: 'GET',
                    data: {
                        id: $(this).data('val')
                    },
                    success: function(data){
                        if(data){
                            $('#libModals').text(data['tarif']['libelle']);
                            $('#montant').text(parseFloat(data['tarif']['montant']).toLocaleString('fr-FR')+' FR CFA');
                            $('#input').val(data['tarif']['montant']);
                            data['tarif']['etat'] == 2 ? getDay():(data['tarif']['etat'] == 3 ?  getSection(data['infos']) : null);
                        }
                        // Affichage du modal -------------------------
                        var modal = new bootstrap.Modal($('#myModal'));
                        modal.show();
                    }
                }); 
            }
        });


        // Gérer le clic sur un input ajouté dynamiquement
        $(document).on('click', '.checkbox-danger', function() {
            $compte = $('.checkbox-danger:checked').length;            
            $val = $('#input').val() ? parseInt($('#input').val()):null;
            $result = $val ? ($val * $compte):null;
            $('#montant').text(parseFloat($result).toLocaleString('fr-FR')+' FR CFA');
        });


        // Griser le reste des checkebox 
        $(document).on('click', '.days', function() {
            $compte = $('.days:checked').length;
            $compte >= 2 ? 
            $('.days:not(:checked)').prop('disabled', true):
            $('.days').prop('disabled', false);
        });


        $('#acceptTo').on('click', function() {
            if($(this).is(':checked')){
                $('#apayer').val() != '0' ? $('#submit').prop('disabled', false):$('#submit').prop('disabled', true);
            }
            else{
                $('#submit').prop('disabled', true);
            }
        });


        $('.myEdit').on('click', function() {
            if($(this).data('id')){
                $.ajax({
                    url: '{{ route('payement.edit') }}',
                    method: 'GET',
                    data: {
                        id: $(this).data('id')
                    },
                    success: function(data){
                       console.log(data);
                        $('#debutEdit').val(data['debut']);
                        $('#finEdit').val(data['fin']);
                        $('#paieId').val(data['id']);
                        $('#libEdit').text(data['libelle']);
                        // Affichage du modal -------------------------
                        var modal = new bootstrap.Modal($('#editModal'));
                        modal.show();
                    }
                }); 
            }
        });


        // -------- Function ---------
        function getSection($data){
            if($data){
                $i = 0;
                while($i < $data.length){
                    $div = "<div class='form-check form-checkbox-danger'>"+
                        "<input type='checkbox' name='section[]' value='"+$data[$i]['id']+"' class='form-check-input checkbox-danger' id='section"+($i+1)+"' "+getColor($data[$i]['status'])+">"+
                        "<label class='form-check-label' for='section"+($i+1)+"'>Section "+($i+1)+"</label>"+
                    "</div>";
                    $('#sectionGroup').append($div);
                    $i++;
                }
            }
        }


        function getColor($val){
            switch ($val) {
                case '0':
                    return null;
                    break;
                case '1':
                    return 'checked';
                    break;
                case '2':
                    return 'disabled';
                    break;
            }
        }


        function getDay(){
            $div = (`
                <div class="form-check checkbox-day">
                    <input type="checkbox" name="day[]" class="form-check-input days" id="lundi" value="1">
                    <label class="form-check-label" for="lundi">Lundi</label>
                </div>
                <div class="form-check checkbox-day">
                    <input type="checkbox" name="day[]" class="form-check-input days" id="mardi" value="2">
                    <label class="form-check-label" for="mardi">Mardi</label>
                </div>
                <div class="form-check checkbox-day">
                    <input type="checkbox" name="day[]" class="form-check-input days" id="jeudi" value="4">
                    <label class="form-check-label" for="jeudi">Jeudi</label>
                </div>
                <div class="form-check checkbox-day">
                    <input type="checkbox" name="day[]" class="form-check-input days" id="vendredi" value="5">
                    <label class="form-check-label" for="vendredi">Vendredi</label>
                </div>
                <div class="form-check checkbox-day">
                    <input type="checkbox" name="day[]" class="form-check-input days" id="samedi" value="6">
                    <label class="form-check-label" for="samedi">Samedi</label>
                </div>
            `);
            $('#sectionGroup').append($div)
        }
    })
</script>
@endsection