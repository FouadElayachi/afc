@extends('layouts.app')
@section('style')
<style>
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
    margin:auto;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
p{
    font-size:1.3vw;
}
h4{
    color:#3490dc;
}
</style>
@endsection

@section('script')
<script>
    $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn'),
  		  allPrevBtn = $('.prevBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });
  
  allPrevBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

          prevStepWizard.removeAttr('disabled').trigger('click');
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});

$(document).ready(function() {

$(".btn-success").click(function(){ 
    var html = $(".clone").html();
    $(".increment").after(html);
});

$("body").on("click",".btn-danger",function(){ 
    $(this).parents(".control-group").remove();
});

});
$('#register').click(function() {
        $(this).attr('disabled','disabled');
});
function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > 1) {
            alert('Le fichier est trops lourd');
            $(file).val(''); //for clearing with Jquery
        } 
}
</script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-uppercase">Tableau de bord</div>

                <div class="card-body">
                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                        <div class="col-xs-12 ">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link @if(Auth::user()->provider == "null") active @endif @if(Auth::user()->provider == "1") disabled @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" @if(Auth::user()->provider == "null") aria-selected="true" @else aria-selected="false" @endif>Remplir le formulaire d'inscription</a>
						<a class="nav-item nav-link @if(Auth::user()->provider == "1") active @endif @if(Auth::user()->provider == "null") disabled @endif" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" @if(Auth::user()->provider == "null") aria-selected="false" @else aria-selected="true" @endif>Modifier le formulaire</a>
					</div>
                    <br />
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show @if(Auth::user()->provider == "null") active @endif" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                <p>Informations personnelles</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                <p>Etudes</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                <p>Activités parascolaires</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                                <p>Projet personnel</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                                <p>Concours de projets</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                                <p>Questions générales</p>
                            </div>
                        </div>
                    </div>
                        
                        <form method="post" action="/form" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <div class="setup-content" id="step-1">
                            @if ($errors->has('cin'))
                            <div class="alert alert-danger">{{ $errors->first('cin') }}</div>
                            @endif
                            @if ($errors->has('country'))
                            <div class="alert alert-danger">{{ $errors->first('country') }}</div>
                            @endif
                            @if ($errors->has('city_local'))
                            <div class="alert alert-danger">{{ $errors->first('city_local') }}</div>
                            @endif
                            @if ($errors->has('city_origin'))
                            <div class="alert alert-danger">{{ $errors->first('city_origin') }}</div>
                            @endif
                            @if ($errors->has('birthdate'))
                            <div class="alert alert-danger">{{ $errors->first('birthdate') }}</div>
                            @endif
                            @if ($errors->has('city_birth'))
                            <div class="alert alert-danger">{{ $errors->first('city_birth') }}</div>
                            @endif
                            @if ($errors->has('phone_number1'))
                            <div class="alert alert-danger">{{ $errors->first('phone_number1') }}</div>
                            @endif
                            @if ($errors->has('link_fb'))
                            <div class="alert alert-danger">{{ $errors->first('link_fb') }}</div>
                            @endif
                            @if ($errors->has('photo'))
                            <div class="alert alert-danger">{{ $errors->first('photo') }}</div>
                            @endif
                            <div>
                                <div class="col-md-12">
                                <br />
                                <h4>Informations personnelles</h4>
                                <br />
                                <div class="form-group">
                                <label for="photo">Photo (Taille max: 2 Mo)<span class="color-theme"> *</span></label>
                                    <input type="file" onchange="ValidateSize(this)" name="photo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                <label for="cin">Numéro de la carte nationale (CINE) (Numéro de passeport pour les étrangers)<span class="color-theme"> *</span></label>
                                    <input type="text" name="cin" class="form-control" value="{{ old('cin')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="country">Pays<span class="color-theme"> *</span></label>
                                    <input type="text" name="country" class="form-control" value="{{ old('country')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="city_local">Ville d'études(emploi)<span class="color-theme"> *</span></label>
                                    <input type="text" name="city_local" class="form-control" value="{{ old('city_local')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="city_origin">Ville d'origine<span class="color-theme"> *</span></label>
                                    <input type="text" name="city_origin" class="form-control" value="{{ old('city_origin')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="birthdate">Date de naissance<span class="color-theme"> *</span></label>
                                    <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="city_birth">Lieu de naissance<span class="color-theme"> *</span></label>
                                    <input type="text" name="city_birth" class="form-control" value="{{ old('city_birth')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="phone_number1">Numéro de téléphone 1<span class="color-theme"> *</span></label>
                                    <input type="text" name="phone_number1" class="form-control" value="{{ old('phone_number1')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="phone_number2">Numéro de téléphone 2</label>
                                    <input type="text" name="phone_number2" class="form-control" value="{{ old('phone_number2')}}">
                                </div>
                                <div class="form-group">
                                <label for="link_fb">Lien vers votre profil facebook<span class="color-theme"> *</span></label>
                                    <input type="text" name="link_fb" class="form-control" value="{{ old('link_fb')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="link_linkedin">Lien vers votre profil linkedin</label>
                                    <input type="text" name="link_linkedin" class="form-control" value="{{ old('link_linkedin')}}">
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-primary nextBtn" type="button">Suivant</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="setup-content" id="step-2">
                            @if ($errors->has('profession'))
                            <div class="alert alert-danger">{{ $errors->first('profession') }}</div>
                            @endif
                            @if ($errors->has('school'))
                            <div class="alert alert-danger">{{ $errors->first('school') }}</div>
                            @endif
                            @if ($errors->has('niveau'))
                            <div class="alert alert-danger">{{ $errors->first('niveau') }}</div>
                            @endif
                            @if ($errors->has('specialite'))
                            <div class="alert alert-danger">{{ $errors->first('specialite') }}</div>
                            @endif
                            @if ($errors->has('specialite_why'))
                            <div class="alert alert-danger">{{ $errors->first('specialite_why') }}</div>
                            @endif
                            <div>
                                <div class="col-md-12">
                                <br />
                                <h4>Etudes</h4>
                                <br />
                                <div class="form-group">
                                    <label for="profession" class="lab">Status<span class="color-theme"> *</span></label>
                                        <select name="profession" class="form-control result" required>
                                            <option @if(old('profession') == "student") selected @endif  value="student" >Etudiant</option>
                                            <option @if(old('profession') == "laureat") selected @endif value="laureat">Lauréat</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="school">Institut d'études (Abréviation)<span class="color-theme"> *</span></label>
                                    <input type="text" name="school" class="form-control" value="{{ old('school')}}">
                                </div>
                                <div class="form-group">
                                <label for="niveau">Niveau d'études (2018/2019)<span class="color-theme"> *</span></label>
                                    <input type="text" name="niveau" class="form-control" value="{{ old('niveau')}}">
                                </div>
                                <div class="form-group">
                                <label for="specialite">Spécialité<span class="color-theme"> *</span></label>
                                    <input type="text" name="specialite" class="form-control" value="{{ old('specialite')}}">
                                </div>
                                <div class="form-group">
                                <label for="specialite_why">Pourquoi vous avez choisi cette spécialité ?<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="specialite_why" class="form-control">{{ old('specialite_why')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">Précédent</button>
                                        <button class="btn btn-primary nextBtn" type="button">Suivant</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="setup-content" id="step-3">
                            @if ($errors->has('orema_member'))
                            <div class="alert alert-danger">{{ $errors->first('orema_member') }}</div>
                            @endif
                            @if ($errors->has('orema_info'))
                            <div class="alert alert-danger">{{ $errors->first('orema_info') }}</div>
                            @endif
                            @if ($errors->has('effect_school'))
                            <div class="alert alert-danger">{{ $errors->first('effect_school') }}</div>
                            @endif
                            @if ($errors->has('experience_assoc'))
                            <div class="alert alert-danger">{{ $errors->first('experience_assoc') }}</div>
                            @endif
                            @if ($errors->has('afc_info'))
                            <div class="alert alert-danger">{{ $errors->first('afc_info') }}</div>
                            @endif
                            @if ($errors->has('afc_participate'))
                            <div class="alert alert-danger">{{ $errors->first('afc_participate') }}</div>
                            @endif
                            @if ($errors->has('afc_reason'))
                            <div class="alert alert-danger">{{ $errors->first('afc_reason') }}</div>
                            @endif
                            <div>
                                <div class="col-md-12">
                                <br />
                                <h4>Activités parascolaires</h4>
                                <br />
                                <div class="form-group">
                                    <label for="orema_member" class="lab">Êtes-vous membre d'orema ?<span class="color-theme"> *</span></label>
                                        <select name="orema_member" class="form-control result" required>
                                            <option @if(old('orema_member') == "yes") selected @endif  value="yes" >Oui</option>
                                            <option @if(old('orema_member') == "no") selected @endif value="no">Non</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="orema_info">Qu'est-ce que vous savez à propos d'orema ?<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="orema_info" class="form-control" required>{{ old('orema_info')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="effect_school">Comment décrivez vous votre participation aux activités parascolaires dans votre établissement ?<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="effect_school" class="form-control" required>{{ old('effect_school')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="experience_assoc">Avez-vous une expérience dans le travail associatif ? Si oui, mentionnez-la<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="experience_assoc" class="form-control" required>{{ old('experience_assoc')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="afc_info">Comment avez-vous connu l'Académie des futurs leaders ?<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="afc_info" class="form-control" required>{{ old('afc_info')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="afc_participate" class="lab">Avez-vous déjà participé à l'Académie des futurs leaders ?<span class="color-theme"> *</span></label>
                                        <select name="afc_participate" class="form-control result" required>
                                            <option @if(old('afc_participate') == "Non") selected @endif  value="Non" >Non</option>
                                            <option @if(old('afc_participate') == "AFC1") selected @endif value="AFC1">AFC 1</option>
                                            <option @if(old('afc_participate') == "AFC2") selected @endif value="AFC2">AFC 2</option>
                                            <option @if(old('afc_participate') == "AFC3") selected @endif value="AFC3">AFC 3</option>
                                            <option @if(old('afc_participate') == "AFC4") selected @endif value="AFC4">AFC 4</option>
                                            <option @if(old('afc_participate') == "AFC5") selected @endif value="AFC5">AFC 5</option>
                                            <option @if(old('afc_participate') == "AFC6") selected @endif value="AFC6">AFC 6</option>
                                            <option @if(old('afc_participate') == "AFC7") selected @endif value="AFC7">AFC 7</option>
                                            <option @if(old('afc_participate') == "AFC8") selected @endif value="AFC8">AFC 8</option>
                                            <option @if(old('afc_participate') == "AFC9") selected @endif value="AFC9">AFC 9</option>
                                            <option @if(old('afc_participate') == "AFC10") selected @endif value="AFC10">AFC 10</option>
                                            <option @if(old('afc_participate') == "AFC11") selected @endif value="AFC11">AFC 11</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="afc_remarque">Vos commentaires sur la ou les éditions auxquelles vous avez participé !</label>
                                <textarea rows="6" name="afc_remarque" class="form-control">{{ old('afc_remarque')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="afc_reason">Expliquez brièvement pourquoi vous désirez participer à l'Académie !<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="afc_reason" class="form-control" required>{{ old('afc_reason')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">Précédent</button>
                                        <button class="btn btn-primary nextBtn" type="button">Suivant</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="setup-content" id="step-4">
                            @if ($errors->has('life_achievements'))
                            <div class="alert alert-danger">{{ $errors->first('life_achievements') }}</div>
                            @endif
                            @if ($errors->has('choose'))
                            <div class="alert alert-danger">{{ $errors->first('choose') }}</div>
                            @endif
                            @if ($errors->has('ten_years'))
                            <div class="alert alert-danger">{{ $errors->first('ten_years') }}</div>
                            @endif
                            @if ($errors->has('files'))
                            <div class="alert alert-danger">{{ $errors->first('files') }}</div>
                            @endif
                            <div>
                                <div class="col-md-12">
                                <br />
                                <h4>Projet personnel</h4>
                                <br />
                                <div class="form-group">
                                <label for="life_achievements">Vos réalisations marquantes dans la vie<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="life_achievements" class="form-control" required>{{ old('life_achievements')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="choose">Pourquoi vous choisir plutôt qu'un autre ?<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="choose" class="form-control" required>{{ old('choose')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="ten_years">Comment vous voyez-vous dans 10 ans ?<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="ten_years" class="form-control" required>{{ old('ten_years')}}</textarea>
                                </div>

                                <div class="form-group">
                                <label for="ten_years">Documents qui confirment vos réalisations ! (Taille max: 1 Mo)</label>
                                <div class="input-group control-group increment" >
                                <input type="file" onchange="ValidateSize(this)" name="files[]" class="form-control">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Ajouter</button>
                                </div>
                                </div>
                                <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" onchange="ValidateSize(this)" name="files[]" class="form-control">
                                    <div class="input-group-btn"> 
                                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Supprimer</button>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <marquee>Si vous avez d'autres documents qui confirment vos réalisations (vidéos, liens ...), veuillez les envoyer à l'adresse mail de l'académie: <a href="mailto:afc12.orema@gmail.com">afc12.orema@gmail.com</a></marquee>

                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">Précédent</button>
                                        <button class="btn btn-primary nextBtn" type="button">Suivant</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="setup-content" id="step-5">
                            @if ($errors->has('work_project'))
                            <div class="alert alert-danger">{{ $errors->first('work_project') }}</div>
                            @endif
                            @if ($errors->has('project_proposition'))
                            <div class="alert alert-danger">{{ $errors->first('project_proposition') }}</div>
                            @endif
                            <div>
                                <div class="col-md-12">
                                <br />
                                <h4>Concours de projets</h4>
                                <br />
                                <div class="form-group">
                                    <label for="work_project" class="lab">Avez-vous déjà travaillé sur un projet à but lucratif ?<span class="color-theme"> *</span></label>
                                        <select name="work_project" class="form-control result" required>
                                            <option @if(old('work_project') == "yes") selected @endif  value="yes" >Oui</option>
                                            <option @if(old('work_project') == "no") selected @endif value="no">Non</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="project_details">Expliquez l'idée de projet brièvement !</label>
                                <textarea rows="6" name="project_details" class="form-control">{{ old('project_details')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="project_proposition">Suggérez et décrivez une idée de projet sur laquelle vous souhaitez travailler au sein de l'Académie<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="project_proposition" class="form-control" required>{{ old('project_proposition')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">Précédent</button>
                                        <button class="btn btn-primary nextBtn" type="button">Suivant</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="setup-content" id="step-6">
                            @if ($errors->has('book_share'))
                            <div class="alert alert-danger">{{ $errors->first('book_share') }}</div>
                            @endif
                            @if ($errors->has('book_number'))
                            <div class="alert alert-danger">{{ $errors->first('book_number') }}</div>
                            @endif
                            @if ($errors->has('read_domain'))
                            <div class="alert alert-danger">{{ $errors->first('read_domain') }}</div>
                            @endif
                            @if ($errors->has('book_best'))
                            <div class="alert alert-danger">{{ $errors->first('book_best') }}</div>
                            @endif
                            @if ($errors->has('book_idea'))
                            <div class="alert alert-danger">{{ $errors->first('book_idea') }}</div>
                            @endif
                            @if ($errors->has('talent'))
                            <div class="alert alert-danger">{{ $errors->first('talent') }}</div>
                            @endif
                            @if ($errors->has('program_propositions'))
                            <div class="alert alert-danger">{{ $errors->first('program_propositions') }}</div>
                            @endif
                            <div>
                                <div class="col-md-12">
                                <br />
                                <h4>Questions générales</h4>
                                <br />
                                <div class="form-group">
                                    <label for="book_share" class="lab">Avec quel livre souhaitez-vous participer au sein de l'Académie ?<span class="color-theme"> *</span></label>
                                    <input type="text" name="book_share" class="form-control" value="{{ old('book_share')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="book_number" class="lab">Combien de livres avez-vous lu cette année ?<span class="color-theme"> *</span></label>
                                        <select name="book_number" class="form-control result" required>
                                            <option @if(old('book_number') == "1") selected @endif  value="1" >1</option>
                                            <option @if(old('book_number') == "2") selected @endif value="2">2</option>
                                            <option @if(old('book_number') == "3") selected @endif value="3">3</option>
                                            <option @if(old('book_number') == "4") selected @endif value="4">4</option>
                                            <option @if(old('book_number') == "5") selected @endif value="5">5</option>
                                            <option @if(old('book_number') == "6") selected @endif value="6">6</option>
                                            <option @if(old('book_number') == "7") selected @endif value="7">7</option>
                                            <option @if(old('book_number') == "8") selected @endif value="8">8</option>
                                            <option @if(old('book_number') == "9") selected @endif value="9">9</option>
                                            <option @if(old('book_number') == "10") selected @endif value="10">10</option>
                                            <option @if(old('book_number') == "11") selected @endif value="11">11</option>
                                            <option @if(old('book_number') == "12") selected @endif value="12">12</option>
                                            <option @if(old('book_number') == "13") selected @endif value="13">13</option>
                                            <option @if(old('book_number') == "14") selected @endif value="14">14</option>
                                            <option @if(old('book_number') == "15") selected @endif value="15">15</option>
                                            <option @if(old('book_number') == "16") selected @endif value="16">16</option>
                                            <option @if(old('book_number') == "17") selected @endif value="17">17</option>
                                            <option @if(old('book_number') == "18") selected @endif value="18">18</option>
                                            <option @if(old('book_number') == "19") selected @endif value="19">19</option>
                                            <option @if(old('book_number') == "20") selected @endif value="20">20</option>
                                            <option @if(old('book_number') == "+20") selected @endif value="+20">Plus que 20</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="read_domain" class="lab">Dans quel domaine préférez-vous lire ?<span class="color-theme"> *</span></label>
                                    <input type="text" name="read_domain" class="form-control" value="{{ old('read_domain')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="book_best" class="lab">Quel livre vous a influencé le plus parmi les livres que vous avez lu ?<span class="color-theme"> *</span></label>
                                    <input type="text" name="book_best" class="form-control" value="{{ old('book_best')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="book_idea">Idée générale du livre !<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="book_idea" class="form-control" required>{{ old('book_idea')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="talent">Avec quel talent pouvez-vous participer au sein de l'Académie ?<span class="color-theme"> *</span></label>
                                    <input type="text" name="talent" class="form-control" value="{{ old('talent')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="program_propositions">Que suggérez-vous comme initiatives pouvant êtres ajoutées au programme parallèle à l'académie ?<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="program_propositions" class="form-control" required>{{ old('program_propositions')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <input id="register" type="submit" class="btn btn-primary" value="Envoyer" />
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </form>					</div>
					<div class="tab-pane fade @if(Auth::user()->provider == "1") show active @endif" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						Votre formulaire a été bien rempli 
					</div>
				</div>

                        
             </div>
            </div>
        </div>
    </div>
</div>
@endsection
