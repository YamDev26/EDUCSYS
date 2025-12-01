@extends('app')
@section('title', 'students')
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
    <div class="row gx-3">
        @include('partials._alert')
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header border-bottom border-dashed pb-0">
                   <div class="d-flex justify-content-between">
                        <div class="card-title pb-0" style="font-size: 19px;">Gestion Des Apprenants</div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('student.create') }}" type="button" class="btn btn-outline-dark py-0">Add</a>
                            <a href="{{ route('dashboard') }}" type="button" class="btn btn-outline-dark py-0">Back</a>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table id="myTable"  class="table table-bordered border-dark mb-0"> <!-- id="basic-datatable" -->
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%"></th>
                                    <th class="text-center" style="width: 10%">Matricule</th>
                                    <th class="text-center" style="width: 10%">Nom</th>
                                    <th class="text-center" style="width: 25%">Prenoms</th>
                                    <th class="text-center" style="width: 10%">Genre</th>
                                    <th class="text-center" style="width: 15%">Date de nais...</th>
                                    <th class="text-center" style="width: 15%">Lieu de nais...</th>
                                    <th class="text-center" style="width: 10%">Actions</th>
                                </tr>
                            </thead>
                            <!--  -->
                        </table>
                    </div>
                </div>
            </div>
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

        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('student.data') }}',
            columns: [
                {data: 'counter', className: "text-center pt-2", orderable: false, searchable: false},
                {data: 'matricule', className: "text-center pt-2"},
                {data: 'firstName'},
                {data: 'lastName'},
                {data: 'genre', className: "text-center pt-2"},
                {data: 'dateBirth', className: "text-center pt-2"},
                {data: 'birth', className: "text-center pt-2"},
                {data: 'action', className: "text-center", orderable: false, searchable: false},
            ],
            pageLength: 10,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    })
</script>
@endsection