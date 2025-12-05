@extends('app')
@section('title', 'Appel')
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
                   <div class="d-flex justify-content-between mb-0 pb-0">
                      <div class="card-title pb-0" style="font-size: 19px;">Gestion Appels</div>
                      <div class="card-title pb-0" style="font-size: 19px;">Groupe {{ ucfirst($group) }}</div>
                      <div class="group-btn py-0" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-soft-dark bg-gradient py-0" id="addBtn">Add</button>
                          <a href="{{ route('dashboard') }}" type="button" class="btn btn-soft-dark bg-gradient py-0">Back</a>
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
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('appel.create') }}" method="get">
                @csrf
                <div class="modal-header py-1">
                    <h4 class="modal-title" id="addModalLongTitle">Add Appel</h4>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date pour l'appel<span class="text-danger">*</span> :</label>
                        <input type="date" name="date" id="date" id="simpleinput" class="form-control" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                    </div>
                    <div class="mb-0">
                        <label for="date" class="form-label">Période<span class="text-danger">*</span> :</label> <br>
                        <span class="form-checks">
                            <input type="radio" id="monning" name="period" class="form-check-input" value="12">
                            <label class="form-check-label" for="monning">Matin</label>
                        </span>
                        <span class="form-checks mx-2">
                            <input type="radio" id="afternoom" name="period" class="form-check-input" value="13">
                            <label class="form-check-label" for="afternoom">Après midi</label>
                        </span>
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('.form-control').attr('placeholder', 'Search...');
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('appel.data') }}',
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
        });



        $('#addBtn').on('click', function() {

            $now = new Date();
            $heures = $now.getHours();

            $heures <= 12 ? 
            $('#monning').prop('checked', true):
            $('#afternoom').prop('checked', true);
            // Affichage du modal -------------------------
            var modal = new bootstrap.Modal($('#addModal'));
            modal.show();
        });
    })
</script>
@endsection