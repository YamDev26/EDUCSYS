@extends('app')
@section('title', 'Edit Student')
@section('link')
<style>
  .form-control {
    border: 1px solid rgb(212, 211, 211);
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
                <h3 class="card-title pb-0">Edit Student</h3>
                <div class="group-btn" role="group" aria-label="Basic example">
                  <a href="{{ route('student.show', $data['id']) }}" class="btn btn-soft-dark bg-gradient py-0">View</a>
                  <a href="{{ route('student.index') }}" class="btn btn-soft-dark bg-gradient py-0">Back</a>
                </div>
              </div>  
            </div>
            <div class="card-body py-3">
              <form action="{{ route('student.update', $data['id']) }}" method="post" id="myForm" enctype="multipart/form-data">
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
                          <span class="d-none d-sm-inline">2 - STUDENT 1</span>
                          </a>
                      </li>
                      <li class="nav-item py-0">
                          <a href="#basictab3" data-bs-toggle="tab" data-toggle="tab" data-int="3" class="nav-link links rounded-0 py-2">
                          <i class="bi bi-check2-circle fs-18 align-middle me-1"></i>
                          <span class="d-none d-sm-inline">3 - SCHOOL</span>
                          </a>
                      </li>
                    </ul>

                    <div class="tab-content b-0 mb-0" style="height: 100%">
                    <div class="tab-pane" id="basictab1">
                      <div class="row">
                        <div class="col-12">
                            <div class="form-group my-2">
                              <div class="my-0">
                                <div class="form-check form-check-inline">
                                  <input type="radio" id="mde" name="civility" class="form-check-input" value="mde" {{ (old('civility') ? (old('civility') == 'mde' ? 'checked':'') :'') }} {{ $data ? ($data->student->studentParent->civility == 'mde' ? 'checked':''):'' }}>
                                  <label class="form-check-label" for="mde">Madame</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input type="radio" id="mr" name="civility" class="form-check-input" value="m" {{ (old('civility') ? (old('civility') == 'm' ? 'checked':'') :'checked') }} {{ $data ? ($data->student->studentParent->civility == 'm' ? 'checked':''):'' }}>
                                  <label class="form-check-label" for="mr">Monsieur</label>
                                </div>
                              </div>
                              @error('civility')
                                <span class="form-bar text-danger" role="alert">
                                  {{$message}}
                                </span>
                              @enderror
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
                          <div class="form-group mb-2">
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
                            <div class="col-6">
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
                            <div class="col-6">
                              <div class="form-group mb-2">
                                <label class="col-form-label">Status :</label><br>
                                <input type="checkbox" name="status" class="form-check-input" id="customCheck2" {{ $data->status ? 'checked':'' }}>
                                <label class="form-check-label" for="customCheck2">{{ $data->status ? 'Actif':'Inactif' }}</label>
                              </div>
                            </div>
                          </div>

                         

                          {{-- <div class="form-group mb-2">
                            <label class="col-form-label" for="image">Photo Elève (Facultatif) :</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div> --}}
                        </div>
                      </div>
                    </div>

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
@endsection
@section('script')
<script src="{{ asset('assets/vendor/vanilla-wizard/js/wizard.min.js') }}"></script>
<script src="{{ asset('assets/js/components/form-wizard.js') }}"></script>

<script>
  $(document).ready(function() {

    $('.number').on('keypress', function(e) {
      var charCode = e.which ? e.which : e.keyCode;
      if (charCode < 48 || charCode > 57) {
        e.preventDefault();
      }
    });

    
    $('.links').on('click', function() {
      $('li a.active').data('int') == 3 ? $('#submit').show():$('#submit').hide();
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

  });
</script>
@endsection