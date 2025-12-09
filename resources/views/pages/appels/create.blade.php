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
                      <div class="card-title pb-0" style="font-size: 19px;">Appel Du <strong style="text-decoration: underline">{{ ucwords($date) }}</strong></div>
                      <div class="card-title pb-0" style="font-size: 19px;">Groupe {{ ucfirst($group) }}</div>
                      <div class="group-btn py-0" role="group" aria-label="Basic example">
                          <a href="{{ route('appel.index') }}" type="button" class="btn btn-soft-dark bg-gradient py-0">Back</a>
                          <input type="hidden" id="created" value="{{ $created }}">
                          <input type="hidden" id="period" value="{{ $group }}">
                      </div>
                   </div>
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped table-bordered border-dark dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th class="text-center" style="width: 10%">Matricule</th>
                                <th class="text-center" style="width: 20%">Nom & Prenoms</th>
                                <th class="text-center" style="width: 10%">Genre</th>
                                <th class="text-center" style="width: 10%">Niveau</th>
                                @foreach ($hourly as $item)
                                    <th class="text-center" style="width: 10%">{{ $item->hourly }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center pt-2">{{ $i <= 9 ? '0'.++$i : ++$i }}</td>
                                    <td class="text-center pt-2">{{ $item->matricule }}</td>
                                    <td title="{{ strtoupper($item->first_name).' '.ucwords($item->last_name) }}">
                                        {{ strtoupper($item->first_name).' '.Str::limit(ucwords($item->last_name), '25', '...') }}
                                    </td>
                                    <td class="text-center pt-2">{{ ucwords($item->sexe == 'F' ? 'Feminin':'Masculin') }}</td>
                                    <td class="text-center pt-2">{{ $item->code }}</td>
                                    @foreach ($hourly as $str)
                                        <td class="text-center">
                                            <div class="hstack gap-1 justify-content-center">
                                                <input type="checkbox" class="checkbox" data-id={{ $item->id }} value="{{ $str->id }}" {{ $str->hasAppel($item->id, $str->id, $created) ? 'checked':'' }}>
                                            </div>
                                        </td>
                                    @endforeach
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


    // On click Input Checkbox
    $(document).on('click', '.checkbox', function() {
        $checked = $(this).is(':checked') ? 1:0;
        $.ajax({
            url: "{{ route('appel.store') }}",
            type: "GET",
            data: {
                hourl: $(this).val(),
                student: $(this).data('id'),
                created: $('#created').val(),
                period: $('#period').val(),
                val: $checked
            },
            success: function (data) {
                console.log(data);
                if(data == 200){
                    alertify.set('notifier','position', 'top-right');
                    $checked ? 
                    alertify.success('<i class="ri-calendar-check-line mr2"></i> Absence pointée.'):
                    alertify.success('<i class="ri-calendar-close-fill mr-2"></i> Absence annulée.');
                }
                else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.error('Une erreur est survenue.');
                }
            }
        });
    });

})
</script>
@endsection