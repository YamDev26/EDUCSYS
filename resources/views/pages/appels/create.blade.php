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
                   <div class="d-flex justify-content-between mb-0 pb-0">
                      <div class="card-title pb-0" style="font-size: 19px;">Appel du {{ $date }}</div>
                      <div class="card-title pb-0" style="font-size: 19px;">Groupe {{ ucfirst($group) }}</div>
                      <div class="group-btn py-0" role="group" aria-label="Basic example">
                          {{-- <a  href="{{ route('appel.create') }}" class="btn btn-soft-dark bg-gradient py-0">Add</a> --}}
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
        ajax: '{{ route('appel.data1') }}',
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

    $(document).on('click', '.checkbox', function() {
      if ($(this).is(':checked')) {
        alert('La checkbox est cochée');
      } else {
        alert('La checkbox n’est pas cochée');
      }
    })

  })
</script>
@endsection