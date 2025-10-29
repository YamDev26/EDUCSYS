@extends('app')
@section('title', 'New Student')
@section('link')
<style>
  .form-control {
    border: 1px solid rgb(143, 143, 143);
  }
</style>
@endsection
@section('content')
<div class="page-container">
  <div class="row">
    @include('partials._alert')
    <div class="col-lg-12">
      <div class="card" style="height: 100%">
        <div class="row">
          <div class="col-12 col-lg-10 offset-lg-1">
            <div class="card-header border-bottom border-dashed pb-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title pb-0">Create New Student</h3>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button class="btn btn-outline-dark py-0" data-bs-toggle="modal" data-bs-target="#centermodal">File</button>
                  <a href="{{ route('student.index') }}" class="btn btn-outline-dark py-0">Back</a>
                </div>
              </div>  
            </div>
            <div class="card-body py-3">
              <form action="{{ route($data ? 'student.update':'student.store', $data ? $data['id']:'') }}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                @method($data ? 'put':'post')
                <div id="basicwizard" class="px-3">
                    <ul class="nav nav-pills nav-justified form-wizard-header mb-1">
                      <li class="nav-item py-0">
                          <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab" data-int="1" class="nav-link links rounded-0 py-2">
                          <i class="bi bi-person-circle fs-18 align-middle me-1"></i>
                          <span class="d-none d-sm-inline">1 - PARENT</span>
                          </a>
                      </li>
                      <li class="nav-item py-0">
                          <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab" data-int="2" class="nav-link links rounded-0 py-2">
                          <i class="bi bi-emoji-smile fs-18 align-middle me-1"></i>
                          <span class="d-none d-sm-inline">2 - STUDENT</span>
                          </a>
                      </li>
                      <li class="nav-item py-0">
                          <a href="#basictab3" data-bs-toggle="tab" data-toggle="tab" data-int="3" class="nav-link links rounded-0 py-2">
                          <i class="bi bi-check2-circle fs-18 align-middle me-1"></i>
                          <span class="d-none d-sm-inline">3 - SCHOOL</span>
                          </a>
                      </li>
                       <li class="nav-item py-0">
                          <a href="#basictab4" data-bs-toggle="tab" data-toggle="tab" data-int="4" class="nav-link links rounded-0 py-2">
                          <i class="bi bi-check2-circle fs-18 align-middle me-1"></i>
                          <span class="d-none d-sm-inline">4 - PAIEMENT</span>
                          </a>
                      </li>
                    </ul>

                    <div class="tab-content b-0 mb-0" style="height: 100%">
                    <div class="tab-pane" id="basictab1">
                      <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-1">
                              <div class="mb-0 mt-2">
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="mde" name="civility" class="form-check-input" value="mde" {{ (old('civility') ? (old('civility') == 'mde' ? 'checked':'') :'') }} {{ $data ? ($data->student->studentParent->civility == 'mde' ? 'checked':''):'' }}>
                                    <label class="form-check-label" for="mde">Madame</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="mr" name="civility" class="form-check-input" value="m" {{ (old('civility') ? (old('civility') == 'm' ? 'checked':'') :'checked') }} {{ $data ? ($data->student->studentParent->civility == 'm' ? 'checked':''):'' }}>
                                    <label class="form-check-label" for="mr">Monsieur</label>
                                </div>
                              </div>
                            </div>

                            <div class="form-group mb-1">
                              <label class="col-form-label" for="name1">Nom du parent<span class="text-danger">*</span> :</label>
                              <input type="text" name="name1" id="name1" class="form-control @error('name1') is-invalid @enderror" value="{{ old('name1', $data ? ucwords($data->student->studentParent->first_name):'') }}" placeholder="Entrez le nom du parent ...">
                              @error('name1')
                                  <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                  </span>
                              @enderror
                            </div>

                            <div class="form-group mb-1">
                              <label class="col-form-label" for="name2">Prenoms du parent<span class="text-danger">*</span> :</label>
                              <input type="text" name="name2" id="name2" class="form-control @error('name2') is-invalid @enderror" value="{{ old('name2', $data ? ucwords($data->student->studentParent->last_name):'') }}" placeholder="Entrez le prénoms du parent ...">
                              @error('name2')
                                <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                </span>
                              @enderror
                            </div>

                            <div class="form-group mb-1">
                              <label class="col-form-label" for="phon1">Numéro de téléphone 1<span class="text-danger">*</span> :</label>
                              <input type="text" name="phon1" id="phon1" class="form-control number @error('phon1') is-invalid @enderror" value="{{ old('phon1', $data ? $data->student->studentParent->phon1:'') }}" placeholder="Entrez le numéro de téléphone 1 ...">
                              @error('phon1')
                                <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                </span>
                              @enderror
                            </div>

                            <div class="form-group mb-1">
                              <label class="col-form-label" for="phon2">Numéro de téléphone 2 (Facultatif) :</label>
                              <input type="text" name="phon2" id="phon2" class="form-control number @error('phon2') is-invalid @enderror" value="{{ old('phon2', $data ? $data->student->studentParent->phon2:'') }}" placeholder="Entrez le numéro de téléphone 2 ...">
                              @error('phon2')
                                <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                </span>
                              @enderror
                            </div>

                            <div class="form-group mb-1">
                              <label class="col-form-label" for="fonction">Profession du parent<span class="text-danger">*</span> :</label>
                              <input type="text" name="fonction" id="fonction" class="form-control @error('fonction') is-invalid @enderror" value="{{ old('fonction', $data ? ucwords($data->student->studentParent->fonction):'') }}" placeholder="Entrez la profession du parent ...">
                              @error('fonction')
                                  <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                  </span>
                              @enderror
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="basictab2">
                      <div class="row">
                          <div class="col-12">
                              
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group mb-1">
                                  <label class="col-form-label" for="matricul">Matricule<span class="text-danger">*</span> :</label>
                                  <input type="text" name="matricul" id="matricul" class="form-control @error('matricul') is-invalid @enderror" value="{{ old('matricul', $data ? $data->student->matricule:'') }}" placeholder="Entrez le matricule de l'élève ...">
                                  @error('matricul')
                                      <span class="form-bar text-danger" role="alert">
                                      {{$message}}
                                      </span>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group mb-1">
                                  <label class="col-form-label">Genre<span class="text-danger">*</span> :</label>
                                  <div class="my-0">
                                      <div class="form-check form-check-inline">
                                          <input type="radio" id="f" name="genre" class="form-check-input" value="F" {{ (old('genre') ? (old('genre') == 'F' ? 'checked':'') :'') }} {{ $data ? ($data->student->sexe == 'F' ? 'checked':''):'' }}>
                                          <label class="form-check-label" for="f">Feminin</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                          <input type="radio" id="m" name="genre" class="form-check-input" value="M" {{ (old('genre') ? (old('genre') == 'M' ? 'checked':'') :'checked') }} {{ $data ? ($data->student->sexe == 'M' ? 'checked':''):'' }}>
                                          <label class="form-check-label" for="m">Masculin</label>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="form-group mb-1">
                              <label class="col-form-label" for="nom">Nom<span class="text-danger">*</span> :</label>
                              <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $data ? ucwords($data->student->first_name):'') }}" placeholder="Entrez le nom de l'élève ...">
                              @error('nom')
                                  <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                  </span>
                              @enderror
                              </div>

                              <div class="form-group mb-1">
                              <label class="col-form-label" for="prenom">Prénoms<span class="text-danger">*</span> :</label>
                              <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $data ? ucwords($data->student->last_name):'') }}" placeholder="Entrez le prénoms de l'élève ...">
                              @error('prenom')
                                  <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                  </span>
                              @enderror
                              </div>

                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group mb-2">
                                    <label class="col-form-label" for="date">Date de naissance<span class="text-danger">*</span> :</label>
                                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $data ? $data->student->date_birth:'') }}">
                                    @error('date')
                                        <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                        </span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group mb-2">
                                    <label class="col-form-label" for="lieu">Lieu de naissance<span class="text-danger">*</span> :</label>
                                    <input type="text" name="lieu" id="lieu" class="form-control @error('lieu') is-invalid @enderror" value="{{ old('lieu', $data ? ucwords($data->student->birth):'') }}" placeholder="Entrez la lieu de naissance de l'élève ...">
                                    @error('lieu')
                                        <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                        </span>
                                    @enderror
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group mb-2">
                                    <label class="col-form-label" for="nation">Nationalité<span class="text-danger">*</span> :</label>
                                    <input type="text" name="nation" id="nation" class="form-control @error('nation') is-invalid @enderror" value="{{ old('nation', $data ? ucwords($data->student->nationalitie->libelle):'') }}" placeholder="Entrez la lieu la notionalité de l'élève ...">
                                    @error('nation')
                                      <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                      </span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group mb-1">
                                    <label class="col-form-label" for="residence">Résidence<span class="text-danger">*</span> :</label>
                                    <input type="text" name="residence" id="residence" class="form-control @error('residence') is-invalid @enderror" value="{{ old('residence', $data ? ucwords($data->student->residence):'') }}" placeholder="Entrez la résidence ...">
                                    @error('residence')
                                      <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                      </span>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="tab-pane" id="basictab3">
                      <div class="row">
                        <div class="col-12">
                            <div class="form-group my-2">
                              <label class="col-form-label" for="school">Etablissement d'origine<span class="text-danger">*</span> :</label>
                              <input type="text" name="school" id="school" class="form-control @error('school') is-invalid @enderror" value="{{ old('school', $data ? ucwords($data->originSchool->libelle):'') }}" placeholder="Entrez le nom de son établissment ...">
                              @error('school')
                                  <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                  </span>
                              @enderror
                            </div>

                            <div class="form-group mb-2">
                            <label class="col-form-label" for="level">Niveau actuel<span class="text-danger">*</span> :</label>
                            <select name="level" class="form-control select2 @error('level') is-invalid @enderror" data-toggle="select2">
                              <option value="">Select ...</option>
                              @foreach ($levels as $level)
                              <option value="{{ $level['id'] }}" {{ old('level') == $level['id'] ? 'selected':''  }} {{ $data ? ($data->level_id == $level['id'] ? 'selected':''):'' }}>{{ $level['code'] }}</option>
                              @endforeach
                            </select>
                            @error('level')
                                <span class="form-bar text-danger" role="alert">
                                {{$message}}
                                </span>
                            @enderror
                            </div>

                            <div class="form-group mb-2">
                            <label class="col-form-label" for="classe">Classe actuelle<span class="text-danger">*</span> :</label>
                            <input type="text" name="classe" id="classe" class="form-control @error('classe') is-invalid @enderror" value="{{ old('classe', $data ? $data->classe:'') }}" placeholder="Entrez la classe actuelle ...">
                            @error('classe')
                                <span class="form-bar text-danger" role="alert">
                                {{$message}}
                                </span>
                            @enderror
                            </div>
                            
                            <div class="row">
                              <div class="col-4">
                                <div class="form-group mb-2">
                                    <label class="col-form-label">Redoublant<span class="text-danger">*</span> :</label>
                                    <div class="my-0">
                                      <div class="form-check form-check-inline">
                                      <input type="radio" id="non" name="doublant" class="form-check-input" value="non" {{ (old('doublant') ? (old('doublant') == 'non' ? 'checked':'') :'checked') }} {{ $data ? ($data->doublant == 'non' ? 'checked':''):'' }}>
                                      <label class="form-check-label" for="non">Non</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                      <input type="radio" id="oui" name="doublant" class="form-check-input" value="oui" {{ (old('doublant') ? (old('doublant') == 'oui' ? 'checked':'') :'') }} {{ $data ? ($data->doublant == 'oui' ? 'checked':''):'' }}>
                                      <label class="form-check-label" for="oui">Oui</label>
                                      </div>
                                    </div>
                                    @error('doublant')
                                        <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                        </span>
                                    @enderror
                                  </div>
                              </div>
                              <div class="col-8">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="services">Service<span class="text-danger">*</span> :</label>
                                    <select  name="service" id="services" class="form-control select2 @error('services') is-invalid @enderror" data-toggle="select2">
                                      <option value="">Select ...</option>
                                      @foreach ($dts as $item)
                                        <option value="{{ $item['id'] }}">{{ ucfirst($item['libelle']) }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane p-3" id="basictab4">
                      <div class="row">
                          <div class="col-6 offset-3">
                            <div class="card">
                              <div class="card-body bg-dark p-3">
                                <div class="modal-body mb-0 pb-0">
                                    <div class="text-center mb-1">
                                        <i class="ti ti-info-square-rounded h1 text-info"></i>
                                        <h3 class="mt-3" id="libModals">Heads up!</h3>
                                    </div>

                                    <div class="my-3">
                                        <div class="d-flex justify-content-between mt-1" id="sectionGroup">
                                            <!-- !!! -->
                                        </div>
                                        <div class="mt-3 mb-0" id="divNumber" style="display: none">
                                            <label for="number" class="form-label">Nombre de mois à payer<span class="text-danger">*</span> :</label>
                                            <input type="text" name="number" id="number" class="form-control w-50" value="1" minlength="1" maxlength="2">
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
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <hr>
                    <div class="d-flex wizard justify-content-center flex-wrap gap-2 mt-3">
                      <div class="previous">
                          <a href="javascript:void(0);" class="btn btn-info previous links" style="width: 130px;">
                          <i class="bx bx-left-arrow-alt me-2"></i>Previous
                          </a>
                      </div>
                      <div class="next">
                          <a href="javascript:void(0);" class="btn btn-info mt-3 mt-md-0 links" style="width: 130px;">
                              Next Step<i class="bx bx-right-arrow-alt ms-2"></i>
                          </a>
                      </div>
                      <button type="submit" class="btn btn-info py-0" id="submit" style="width: 130px;display: none">Valider</button>

                      <div class="first" style="display: none">
                          <a href="javascript:void(0);" class="btn">First</a>
                      </div>
                      <div class="last" style="display: none">
                          <a href="javascript:void(0);" class="btn mt-3 mt-md-0">Finish</a>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="centermodal" tabindex="-1" role="dialog" aria-modal="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('student.import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-header py-2">
            <h4 class="modal-title" id="myCenterModalLabel">Import File</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>  
        <div class="modal-body">
          <div class="mb-2">
            <span class="d-flex justify-content-between mb-2">
               <label for="file" class="form-label">Select File<span class="text-danger">*</span> :</label>
                <a href="{{route('student.export')}}" class="btn btn-soft-dark btn-icon btn-sm rounded-circle btn-sm px-1 py-0 my-0" title="File example"><i class="ti ti-file-export mx-0"></i></a>
            </span>
            <input type="file" name="files" id="file" class="form-control" style="border: 1px solid rgb(194, 193, 193)">
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
@endsection
@section('script')
<script src="{{ asset('assets/vendor/vanilla-wizard/js/wizard.min.js') }}"></script>
<script src="{{ asset('assets/js/components/form-wizard.js') }}"></script>

<script>
  $(document).ready(function() {

    $('.number, #number').on('keypress', function(e) {
      var charCode = e.which ? e.which : e.keyCode;
      if (charCode < 48 || charCode > 57) {
        e.preventDefault();
      }
    });

    $('.links, .nav-link').on('click', function() {
      $('#acceptTo').prop('checked', false);
      $('#submit').hide();
    });

    // Verification des numero de téléphone
    $('#phon1, #phon2').change(function() {
      $val = $(this).val();
      if($val){
        $.ajax({
          url: '{{ route('student.search1') }}',
          method: 'GET',
          data: {
            phon: $val
          },
          success: function(response){
            if(response['id']){
              $('#phon1').val(response['phon1']);
              $('#phon2').val(response['phon2']);
              $('#name1').val(response['first_name']);
              $('#name2').val(response['last_name']);
              $('#fonction').val(response['fonction']);
              response['civility'] == 'm' ? $('#mr').attr('checked','checked'):$('#mde').attr('checked','checked')
            }
            else{
              $('#blinks, #btnActual').slideUp();
            }
          },
        });
      }
    });


    // Verification des numero de téléphone
    $('#matricul').on('change', function() {
      $val = $(this).val();
      if($val){
        $.ajax({
          url: '{{ route('student.matricul') }}',
          method: 'GET',
          data: {
            mat: $val
          },
          success: function(response){
            console.log(response);
            if(response){
              $('#matricul').css('border', '2px solid red');
            }
            else{
              $('#matricul').css('border', '1px solid rgb(212, 211, 211)');
            }
          },
        });
      }
    });



    // -------------- Zone DE Paiement -------------------

    $('#services').on('change', function() {
      $('.checkbox-day, .form-checkbox-danger').remove();
      $('#number').val(1);
      if($(this).val()){
        $.ajax({
          url: '{{ route('student.service') }}',
          method: 'GET',
          data: {  id: $(this).val() },
          success: function(data){
            console.log(data);
            $('#libModals').text(data['tarif']['libelle']);
            $('#montant').text(parseFloat(data['tarif']['montant']).toLocaleString('fr-FR')+' FR CFA');
            $('#input').val(data['tarif']['montant']);
            data['tarif']['etat'] == 2 ? getDay():(data['tarif']['etat'] == 3 ?  getSection(data['infos']) : null);
            data['tarif']['etat'] == 3 ? $('#divNumber').hide():$('#divNumber').show();
          },
        });
      }
    });

    // Griser le reste des checkebox 
    $(document).on('click', '.days', function() {
      $compte = $('.days:checked').length;
      $compte >= 2 ? 
      $('.days:not(:checked)').prop('disabled', true):
      $('.days').prop('disabled', false);
    });

    // Gérer le clic sur un input ajouté dynamiquement
    $(document).on('click', '.checkbox-danger', function() {
      $compte = $('.checkbox-danger:checked').length;            
      $val = $('#input').val() ? parseInt($('#input').val()):null;
      $result = $val ? ($val * $compte):null;
      $('#montant').text(parseFloat($result).toLocaleString('fr-FR')+' FR CFA');
    });


    $('#acceptTo').on('click', function() {
      $(this).is(':checked') ? $('#submit').show():$('#submit').hide(); 
    });


    $('#number').on('keyup', function() {
      $tarif = $('#input').val() ? parseInt($('#input').val()):null;
      if($(this).val()){
          $result = $tarif ? ($tarif * parseInt($(this).val())):null;
          $('#montant').text(parseFloat($result).toLocaleString('fr-FR')+' FR CFA');
      }
      else{
          $('#montant').text('00 FR CFA');
      }
    });


  // Function
  function getSection($data){
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

  });
</script>
@endsection