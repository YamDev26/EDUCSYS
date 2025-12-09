@extends('app')
@section('title', 'Payement')
@section('link')
<link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
<style>
    .dataTables_length{
        display: none;
    }
    .form-control{
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
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed pb-0">
                   <div class="d-flex justify-content-between">
                        <div class="card-title pb-0" style="font-size: 19px;">Gestion Payements</div>
                        <div class="group-btn py-0 d-flex" role="group">
                            <div class="dropdown mx-1">
                                <button class="btn btn-soft-dark bg-gradient py-0" data-bs-toggle="dropdown" aria-expanded="false">PDF</button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <button class="dropdown-item btnItem" data-value="1">Mensuel</button>
                                    <button class="dropdown-item btnItem" data-value="2">Section</button>
                                </div>
                            </div>
                            <div class="py-0">
                                <a  href="#" class="btn btn-soft-dark bg-gradient py-0">View</a>
                                <a href="{{ route('dashboard') }}" class="btn btn-soft-dark bg-gradient py-0">Back</a>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered border-dark dt-responsive nowrap w-100" id="myTable">
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th class="text-center" style="width: 10%">Matricule</th>
                                <th class="text-center" style="width: 15%">Nom</th>
                                <th class="text-center">Prenoms</th>
                                <th class="text-center" style="width: 15%">Genre</th>
                                <th class="text-center" style="width: 15%">Niveau</th>
                                <th class="text-center" style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- CONTENT -->
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Imprim -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('payement.imprim') }}" method="post" target="_blank">
                @csrf
                @method('get')
                <div class="modal-header py-2">
                    <h3 class="modal-title" id="myCenterModalLabel">Imprim Reçu</h3>
                </div>
                <div class="modal-body mb-0 pb-0">
                    <input type="hidden" name="integer" id="integer">
                    <div class="my-3">
                        <div class="form-group my-2" id="divPeriod" style="display: none">
                            <label for="periode">Sélectionnez un mois :</label>
                            <input type="month" class="form-control" id="periode">
                        </div>

                        <div class="form-group" id="divSection" style="display: none">
                            <label class="col-form-label" for="services">Service<span class="text-danger">*</span> :</label>
                            <select  id="services" class="form-control select2" data-toggle="select2">
                                <!-- Content Select -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-0">
                    <button type="button" class="btn btn-sm btn-light py-1" data-bs-dismiss="modal" style="width: 100px">Annuler</button>
                    <button type="submit" class="btn btn-sm btn-light py-1" id="mySubmit" style="width: 100px">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('.form-control').attr('placeholder', 'Search...');
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('payement.data') }}',
            columns: [
                {data: 'counter', className: "text-center pt-2", orderable: false, searchable: false},
                {data: 'matricule', className: "text-center pt-2"},
                {data: 'firstName'},
                {data: 'lastName'},
                {data: 'genre', className: "text-center pt-2"},
                {data: 'level', className: "text-center pt-2"},
                {data: 'action', className: "text-center", orderable: false, searchable: false},
            ],
            pageLength: 10,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });

        $(".btnItem").on('click', function() {
            if($(this).data('value') == '1'){
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                document.getElementById('periode').value = `${year}-${month}`;

                $('#divSection, #services').hide(300);
                $("input#periode").attr("name", "value");
                $('#divPeriod, #periode').show(300);
                $('#integer').val(1);
            }
            else if($(this).data('value') == '2'){
                $.ajax({
                    url: '{{ route('payement.create') }}',
                    method: 'GET',
                    data: {
                        id: 3
                    },
                    success: function(data){
                       getSection(data['infos']);
                    }
                }); 

                $('#divPeriod, #periode').hide(300);
                $("select#services").attr("name", "value");
                $('#divSection,  #services').show(300);
                $('#integer').val(2);
            }

            // Affichage du modal -------------------------
            var modal = new bootstrap.Modal($('#myModal'));
            modal.show();
        });

        // Function 
        function getSection($data){
            $i = 0;
            while($i < $data.length){
                $('#services').append('<option value="'+$data[$i].id+'">Section '+$data[$i].order+'</option>');
                $i++;
            }
        }
    })
</script>
@endsection