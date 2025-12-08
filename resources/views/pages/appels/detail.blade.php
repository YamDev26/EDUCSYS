@extends('app')
@section('title', 'Appel')
@section('link')
<link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<style>
    .dt-length{
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
                   <div class="d-flex justify-content-between mb-0 pb-0">
                      <div class="card-title pb-0" title="Groupe : {{ $student->group }}" style="font-size: 19px;">Detail Appel - {{ $student->group }}</div>
                      <h2 class="header-title" title="{{ strtoupper($student->student->first_name).' '.ucwords($student->student->last_name) }}" style="font-size: 19px">
                        {{ strtoupper($student->student->first_name).' '.Str::limit(ucwords($student->student->last_name), '15', '...') }}
                      </h2>
                      <div class="group-btn py-0" role="group" aria-label="Basic example">
                        <a href="{{ route('appel.index') }}" type="button" class="btn btn-soft-dark bg-gradient py-0">Back</a>
                      </div>
                   </div>
                </div>
                <div class="card-body">

                    <table id="basic-datatable" class="table table-striped table-bordered border-dark dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th class="text-center" style="width: 10%">Date Absentée</th>
                                <th class="text-center" style="width: 10%">Matin</th>
                                <th class="text-center" style="width: 10%">Après Midi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($datas as $item)
                                <tr>
                                    <td class="text-center pt-2">{{ $i <= 9 ? '0'.++$i : ++$i }}</td>
                                    <td class="text-center pt-2">{{ date('d/m/Y', strtotime($item->created)) }}</td>
                                    <td title="{{ strtoupper($item->first_name).' '.ucwords($item->last_name) }}">
                                        {{ strtoupper($item->first_name).' '.Str::limit(ucwords($item->last_name), '25', '...') }}
                                    <td class="text-center pt-2">{{ $item->code }}</td>
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
<script src="{{ asset('assets/js/components/table-datatable.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
  $(document).ready(function() {
    $('.form-control').attr('placeholder', 'Search...');

  })
</script>
@endsection