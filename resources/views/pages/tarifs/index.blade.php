@extends('app')
@section('title', 'Parametre')
@section('link')
<link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
<style>
    .dt-search label, .dt-length, .dt-column-order{
        display: none;
    }
    .dt-search input{
        padding: .4rem .77rem;
        border: 1px solid rgb(98, 98, 98);
        border-radius: 5px
    }
</style>
@endsection
@section('content')
<div class="page-container">
    <div class="row">
        @include('partials._alert')
        <div class="col-xl-10 offset-xl-1 col-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed pb-0">
                   <div class="d-flex justify-content-between">
                        <div class="card-title pb-0" style="font-size: 19px;">Gestion Tarifs</div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#centermodal">Add</button>
                            <a href="{{ route('dashboard') }}" type="button" class="btn btn-outline-dark">Back</a>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    {{-- <div class="form-group d-flex justify-content-between mb-2">
                        <span></span>
                        <input type="text" class="form-control w-25" placeholder="Search ..." style="position: relative; border:1px solid rgb(212, 211, 211);">
                    </div> --}}
                    <table id="basic-datatable" class="table table-bordered border-dark mb-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Libelle</th>
                                <th class="text-center">Montant</th>
                                <th class="text-center">Etat</th>
                                <th class="text-center">Statut</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @forelse ($tarifs as $item)
                            <tr>
                                <th class="text-center">{{ $i <= 9 ? '0'.$i++:$i++ }}</th>
                                <td>{{ ucwords($item['libelle']) }}</td>
                                <td class="text-center">{{ formatMontant($item['montant']).' FR CFA' }}</td>
                                <td class="text-center">{{ getEtatServie($item['etat']) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $item['status'] ? 'success':'danger' }}-subtle text-{{ $item['status'] ? 'success':'danger' }} fs-12 p-1">{{ $item['status'] ? 'Actif':'Inactif' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="hstack gap-1 justify-content-center">
                                        <button data-id="{{ $item['id'] }}" class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i class="ti ti-edit fs-16"></i></button>
                                        <button data-id="{{ $item['id'] }}" data-lib="{{ ucwords($item['libelle']) }}" data-mont="{{ formatMontant($item['montant']).' FR CFA' }}" class="btn btn-soft-danger btn-icon btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#danger-alert-modal"> <i class="ti ti-trash"></i></button>
                                        @if($item['etat'] == 3)
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle text-muted drop-arrow-none card-drop p-0" title="Section" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a  href="#showModal" data-id="{{ $item['id'] }}" data-lib="show"  data-bs-toggle="modal" class="dropdown-item showModal">Show</a>
                                                <a href="#createModal" data-id="{{ $item['id'] }}" data-lib="add" data-bs-toggle="modal" class="dropdown-item addModels">Add</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune donnée trouvée</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add Tarif -->
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('tarif.store') }}" method="post">
                @csrf
                <div class="modal-header py-2">
                    <h4 class="modal-title" id="myCenterModalLabel">Add New Service</h4>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="libelle" class="form-label">Libelle Service<span class="text-danger">*</span> :</label>
                        <input type="text" name="libelle" id="libelle" class="form-control @error('libelle') is-invalid @enderror" placeholder="Entrez le libelle ici ...">
                    </div>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant Service (Facultatif) :</label>
                        <input type="text" name="montant" id="montant" class="form-control number" placeholder="Entrez le montant ici ...">
                    </div>

                    <div class="mb-1">
                        <label for="montant" class="form-label">Etat Service<span class="text-danger">*</span> :</label>
                        <div class="mt-0">
                            <div class="form-check form-check-inline">
                                <input type="radio" id="plein" name="etat" value="1" class="form-check-input" checked>
                                <label class="form-check-label" for="plein">Plein (mois)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="partiel" name="etat" value="2" class="form-check-input">
                                <label class="form-check-label" for="partiel">Partiel (mois)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="trimestre" name="etat" value="3" class="form-check-input">
                                <label class="form-check-label" for="trimestre">Trimestre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="autres" name="etat" value="4" class="form-check-input">
                                <label class="form-check-label" for="autres">Autres</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light py-1" data-bs-dismiss="modal" style="width: 100px">Annuler</button>
                    <button type="submit" class="btn btn-light py-1" style="width: 100px">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Tarif -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('tarif.update') }}" method="post">
                @csrf
                <div class="modal-header py-2">
                    <h4 class="modal-title" id="myEditModalLabel">Edit Service</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="lib" id="id">
                    <div class="mb-3">
                        <label for="libEdit" class="form-label">Libelle Service<span class="text-danger">*</span> :</label>
                        <input type="text" name="libelle" id="libEdit" class="form-control" placeholder="Entrez le libelle ici ...">
                    </div>

                    <div class="mb-3">
                        <label for="montEdit" class="form-label">Montant Service (Facultatif) :</label>
                        <input type="text" name="montant" id="montEdit" class="form-control number" placeholder="Entrez le montant ici ...">
                    </div>

                    <div class="mb-3">
                        <label for="montant" class="form-label">Etat Service<span class="text-danger">*</span> :</label>
                        <div class="mt-0">
                            <div class="form-check form-check-inline">
                                <input type="radio" id="pleinEdit" name="etat" value="1" class="form-check-input">
                                <label class="form-check-label" for="pleinEdit">Plein (mois)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="partEdit" name="etat" value="2" class="form-check-input">
                                <label class="form-check-label" for="partEdit">Partiel (mois)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="trimEdit" name="etat" value="3" class="form-check-input">
                                <label class="form-check-label" for="trimEdit">Trimestre</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="autreEdit" name="etat" value="4" class="form-check-input">
                                <label class="form-check-label" for="autreEdit">Autres</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-check form-checkbox-success mb-0">
                        <input type="checkbox" name="status" class="form-check-input" id="customCheckcolor2">
                        <label class="form-check-label" for="customCheckcolor2">Status</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light py-1" data-bs-dismiss="modal" style="width: 100px">Annuler</button>
                    <button type="submit" class="btn btn-light py-1" style="width: 100px">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Tarif -->
<div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <form action="{{ route('tarif.destroy') }}" method="post">
                @csrf
                <input type="hidden" name="ids" id="idDelete">
                <div class="modal-header py-2">
                    <h4 class="modal-title" id="myEditModalLabel">Delete Service</h4>
                </div>
                <div class="modal-body pb-0 mb-0">
                    <div class="text-center">
                        <i class="ti ti-circle-x h1"></i>
                        <h4 class="mt-0">Oh snap!</h4>
                        <hr class="my-0&">
                        <strong id="lib" style="font-size: 17px"></strong>
                        <p class="mB-0" id="mont" style="font-size: 14px"></p>
                        <p class="mt-0">Confirmez la suppression !</p>
                    </div>
                </div>
                <hr class="my-1">
                <div class="modal-footer mt-0">
                    <button type="button" class="btn btn-light py-1" data-bs-dismiss="modal" style="width: 100px">Annuler</button>
                    <button type="submit" class="btn btn-light py-1" style="width: 100px">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="showModal" aria-labelledby="exampleModalToggleLabel" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h4 class="modal-title" id="exampleModalToggleLabel">Détail Section</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered border-dark mb-0" id="showTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Sections</th>
                            <th>Date debut</th>
                            <th>Date Fin</th>
                            <th class="text-center">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="5" class="text-center" id="defaultdata">Recherche En Cours ...</th>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer py-1">
                <button class="btn btn-light py-1" style="width: 100px" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createModal" aria-labelledby="exampleModalToggleLabel" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('tarif.create') }}" method="post">
            @csrf
            <div class="modal-header py-2">
                <h4 class="modal-title" id="exampleModalToggleLabel">Create section</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="createId">
                <table class="table table-bordered border-dark mb-0">
                    <tbody>
                        <tr>
                            <th class="text-center py-0">01</th>
                            <td class="py-0">Section 1</td>
                            <td class="py-1">
                                <div class="form-group my-0">
                                    <label for="debut1" class="form-label mb-0">Date debut :</label>
                                    <input type="text" name="debut[]" id="debut1" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                                </div>
                            </td>
                            <td class="py-1">
                                <div class="form-group my-0">
                                    <label for="fin1" class="form-label mb-0">Date fin :</label>
                                    <input type="text" name="fin[]" id="fin1" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center py-0">02</th>
                            <td class="py-0">Section 2</td>
                            <td class="py-1">
                                <div class="form-group my-0">
                                    <label for="debut2" class="form-label mb-0">Date debut :</label>
                                    <input type="text" name="debut[]" id="debut2" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                                </div>
                            </td>
                            <td class="py-1">
                                <div class="form-group my-0">
                                    <label for="fin2" class="form-label mb-0">Date fin :</label>
                                    <input type="text" name="fin[]" id="fin2" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center py-0">03</th>
                            <td class="py-0">Section 3</td>
                            <td class="py-1">
                                <div class="form-group my-0">
                                    <label for="debut3" class="form-label mb-0">Date debut :</label>
                                    <input type="text" name="debut[]" id="debut3" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                                </div>
                            </td>
                            <td class="py-1">
                                <div class="form-group my-0">
                                    <label for="fin3" class="form-label mb-0">Date fin :</label>
                                    <input type="text" name="fin[]" id="fin3" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="d-m-Y" readonly="readonly">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-light py-1" style="width: 100px" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-light py-1" style="width: 100px">Valider</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/datatables.net/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/components/table-datatable.js') }}"></script>
    <script>
        $(document).ready(function() {
            // ----------------------------------
            $('.dt-search input').attr('placeholder', 'Search...');

            $('.btn-soft-success').on('click', function() {
                if($(this).data('id')){
                    $.ajax({
                        url: '{{ route('tarif.edit') }}',
                        method: 'GET',
                        data: {
                            id: $(this).data('id')
                        },
                        success: function(data){
                            $('#id').val(data['id']);
                            $('#libEdit').val(data['libelle']);
                            $('#montEdit').val(data['montant']);
                            chechedEtat(data['etat']); // ----- Function Get
                            data['status'] == 1 ? 
                            $('#customCheckcolor2').prop('checked', true):
                            $('#customCheckcolor2').prop('checked', false);

                            // Affichage du modal -------------------------
                            var modal = new bootstrap.Modal($('#editModal'));
                            modal.show();
                        }
                    }); 
                }
            });


            $('.addModels, .showModal').on('click', function() {
                $id = $(this).data('id');
                $lib = $(this).data('lib');
                $lib == 'add' ? $('#createId').val($id):null;

                $.ajax({
                    url: '{{ route('tarif.search1') }}',
                    method: 'GET',
                    data: { id:  $id },
                    success: function(data){
                        ($lib == 'add') ? addmodals(data):showModals(data);
                    }
                }); 
            });


            $('.btn-soft-danger').on('click', function() {
                $('#lib').text($(this).data('lib'));
                $('#mont').text($(this).data('mont'));
                $('#idDelete').val($(this).data('id'));
            });

            $('.number').on('keypress', function(e) {
                var charCode = e.which ? e.which : e.keyCode;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                }
            });


            // ---------------------------------
            function addmodals($data){
                $i = 0;
                while($i < $data.length){
                    $('#debut'+($i+1)).val($data[$i]['debut']);
                    $('#fin'+($i+1)).val($data[$i]['fin']);
                    $i++;
                }
            }


            function showModals($data){
                if($data.length){
                    $('#defaultdata,#addRow').remove();
                    $i = 0;
                    while($i < $data.length){
                        $row = "<tr id='addRow'>"+
                            "<th class='text-center'>0"+($i+1)+"</td>"+
                            "<td>Section "+($i+1)+"</td>"+
                            "<td class='text-center'>"+$data[$i]['debut']+"</td>"+
                            "<td class='text-center'>"+$data[$i]['fin']+"</td>"+
                            "<td class='text-center'>"+
                            "<h5 class='fs-14 mt-1 fw-normal'><i class='ti ti-circle-filled fs-12 text-"+
                            getColor($data[$i]['status'])+
                            "'></i> "+getLib($data[$i]['status'])+"</h5>"+
                            "</td>"+
                        "</tr>";
                        $('#showTable tbody').append($row);
                        $i++;
                    }
                }
            }


            function getColor($val){
                switch ($val) {
                    case '0':
                        return 'warning';
                        break;
                    case '1':
                        return 'success';
                        break;
                    case '2':
                        return 'danger';
                        break;
                }
            }

            function getLib($val){
                switch ($val) {
                    case '0':
                        return 'En att...';
                        break;
                    case '1':
                        return 'En cou...';
                        break;
                    case '2':
                        return 'Termin...';
                        break;
                }
            }

            function chechedEtat($val){
                switch ($val) {
                    case '1':
                        return $('#pleinEdit').prop('checked', true);
                        break;
                    case '2':
                        return $('#partEdit').prop('checked', true);
                        break;
                    case '3':
                        return $('#trimEdit').prop('checked', true);
                        break;
                    default:
                       return $('#autreEdit').prop('checked', true);
                }
            }
        })
    </script>
@endsection