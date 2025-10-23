@extends('app')
@section('title', 'students')
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
    <div class="row gx-3">
        @include('partials._alert')
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header border-bottom border-dashed pb-0">
                   <div class="d-flex justify-content-between">
                        <div class="card-title pb-0" style="font-size: 19px;">Gestion Des Apprenants</div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('student.create') }}" type="button" class="btn btn-outline-dark">Add</a>
                            <a href="{{ route('dashboard') }}" type="button" class="btn btn-outline-dark">Back</a>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table id="basic-datatable" class="table table-bordered border-dark mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Prenoms</th>
                                    <th>Genre</th>
                                    <th>Date de nais...</th>
                                    <th>Lieu de nais...</th>
                                    <th>Résidence</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1;  @endphp
                                @foreach ($students as $student)
                                <tr>
                                    <td class="text-center">{{ $i <= 9 ? '0'.$i++:$i++ }}</td>
                                    <td>{{ $student['matricule'] }}</td>
                                    <td>{{ strtoupper($student['first_name']) }}</td>
                                    <td>{{ ucwords($student['last_name']) }}</td>
                                    <td>{{ $student['sexe'] == 'F' ? 'Feminin':'Masculin' }}</td>
                                    <td>{{ $student['date_birth'] ? date('d/m/Y', strtotime($student['date_birth'])):'A definir' }}</td>
                                    <td>{{ ucwords($student['birth']) ?? 'A definr' }}</td>
                                    <td>{{ ucwords($student['residence']) ?? 'A definir' }}</td>
                                    <td class="text-muted text-center">
                                        <div class="hstack gap-1 justify-content-center">
                                            <a href="{{ route('student.show', $student['id']) }}" class="btn btn-soft-primary btn-icon btn-sm rounded-circle"> <i class="ti ti-eye"></i></a>
                                            <a href="{{ route('student.edit', $student['id']) }}" class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i class="ti ti-edit fs-16"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i class="ti ti-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/vendor/datatables.net/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<!-- Datatable Demo js -->
<script src="{{ asset('assets/js/components/table-datatable.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.dt-search input').attr('placeholder', 'Search...');
    })
</script>
@endsection