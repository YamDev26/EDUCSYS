@extends('app')
@section('title', 'Payement')
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
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed pb-0">
                   <div class="d-flex justify-content-between">
                        <div class="card-title pb-0" style="font-size: 19px;">Gestion Payements</div>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a  href="javascript:void(0);" class="btn btn-outline-dark">View</a>
                            <a href="{{ route('dashboard') }}" type="button" class="btn btn-outline-dark">Back</a>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped table-bordered border-dark dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Matricule</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center">Prenoms</th>
                                <th class="text-center">Genre</th>
                                <th class="text-center">Niveau</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1;  @endphp
                            @foreach ($students as $student)
                            <tr>
                                <td class="text-center">{{ $i <= 9 ? '0'.$i++:$i++ }}</td>
                                <td class="text-center">{{ strtoupper($student['matricule']) }}</td>
                                <td>{{ strtoupper($student['first_name']) }}</td>
                                <td>{{ ucwords($student['last_name']) }}</td>
                                <td class="text-center">{{ $student['sexe'] == 'F' ? 'Feminin':'Masculin' }}</td>
                                <th class="text-center">{{ $student['code'] }}</th>
                                <td class="text-center">
                                    <div class="hstack gap-1 justify-content-center">
                                        <a href="{{ route('payement.show', $student['id']) }}" class="btn btn-soft-warning btn-icon btn-sm rounded-circle" title="Voir detail"> <i class="ti ti-eye"></i></a>
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