@extends('layouts.appAR')
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
            alert('?????? ?????????????? ?????????? ?????????????? ???? ( 1Mo )');
            $(file).val(''); //for clearing with Jquery
        } 
}
</script>
@endsection
@section('content')
<div class="container droid-arabic-kufi" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-uppercase">?????????? ????????????</div>

                <div class="card-body text-right">
                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @endif
                        <div class="col-xs-12 ">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link @if(Auth::user()->provider == "null") active @endif @if(Auth::user()->provider == "1") disabled @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" @if(Auth::user()->provider == "null") aria-selected="true" @else aria-selected="false" @endif>?????? ?????????????? ??????????????</a>
						<a class="nav-item nav-link @if(Auth::user()->provider == "1") active @endif @if(Auth::user()->provider == "null") disabled @endif" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" @if(Auth::user()->provider == "null") aria-selected="false" @else aria-selected="true" @endif>?????????? ??????????????????</a>
					</div>
                    <br />
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show @if(Auth::user()->provider == "null") active @endif" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="stepwizard droid-arabic-kufi">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                <p>???????????? ????????????</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                <p>???????????? ??????????????</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                <p>?????????????? ????????????????</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                                <p>?????????? ????????????</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                                <p>???????????? ????????????????</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                                <p>?????????? ????????</p>
                            </div>
                        </div>
                    </div>
                        
                        <form method="post" action="/form" enctype="multipart/form-data" dir="rtl">
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
                                <h4>???????????? ????????????</h4>
                                <br />
                                <div class="form-group">
                                <label for="photo" dir="rtl">???????? (2 Mo ???????? ????????)<span class="color-theme"> *</span></label>
                                    <input type="file" onchange="ValidateSize(this)" name="photo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                <label for="cin">?????? ?????????? ?????????????? ?????????????? (CINE) (?????? ???????? ?????????? ???????? ????????????????)<span class="color-theme"> *</span></label>
                                    <input type="text" name="cin" class="form-control" value="{{ old('cin')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="country">????????????<span class="color-theme"> *</span></label>
                                    <input type="text" name="country" class="form-control" value="{{ old('country')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="city_local">?????????? ?????????????? ???? ??????????<span class="color-theme"> *</span></label>
                                    <input type="text" name="city_local" class="form-control" value="{{ old('city_local')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="city_origin">?????????????? ??????????????<span class="color-theme"> *</span></label>
                                    <input type="text" name="city_origin" class="form-control" value="{{ old('city_origin')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="birthdate">?????????? ????????????????<span class="color-theme"> *</span></label>
                                    <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="city_birth">???????? ????????????????<span class="color-theme"> *</span></label>
                                    <input type="text" name="city_birth" class="form-control" value="{{ old('city_birth')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="phone_number1">???????????? 1<span class="color-theme"> *</span></label>
                                    <input type="text" name="phone_number1" class="form-control" value="{{ old('phone_number1')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="phone_number2">???????????? 2</label>
                                    <input type="text" name="phone_number2" class="form-control" value="{{ old('phone_number2')}}">
                                </div>
                                <div class="form-group">
                                <label for="link_fb">???????? ?????????? ???????????? ?????? ????????????????<span class="color-theme"> *</span></label>
                                    <input type="text" name="link_fb" class="form-control" value="{{ old('link_fb')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="link_linkedin">?????????? ?????? LinkedIn</label>
                                    <input type="text" name="link_linkedin" class="form-control" value="{{ old('link_linkedin')}}">
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-primary nextBtn" type="button">????????????</button>
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
                                <h4>???????????? ??????????????</h4>
                                <br />
                                <div class="form-group">
                                    <label for="profession" class="lab">?????? ????????<span class="color-theme"> *</span></label>
                                        <select name="profession" class="form-control result">
                                            <option @if(old('profession') == "student") selected @endif  value="student" >????????</option>
                                            <option @if(old('profession') == "laureat") selected @endif value="laureat">????????</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="school">???????????? ???????? ???????? ???? ???????? ?????? ( ?????????????? ?????????????????? ??????????????)<span class="color-theme"> *</span></label>
                                    <input type="text" name="school" class="form-control" value="{{ old('school')}}">
                                </div>
                                <div class="form-group">
                                <label for="niveau">?????????????? ?????????????? ???????? 2018/2019<span class="color-theme"> *</span></label>
                                    <input type="text" name="niveau" class="form-control" value="{{ old('niveau')}}">
                                </div>
                                <div class="form-group">
                                <label for="specialite">????????????<span class="color-theme"> *</span></label>
                                    <input type="text" name="specialite" class="form-control" value="{{ old('specialite')}}">
                                </div>
                                <div class="form-group">
                                <label for="specialite_why">?????????? ?????????? ?????? ???????????? ??<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="specialite_why" class="form-control">{{ old('specialite_why')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">????????????</button>
                                        <button class="btn btn-primary nextBtn" type="button">????????????</button>
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
                                <h4>?????????????? ????????????????</h4>
                                <br />
                                <div class="form-group">
                                    <label for="orema_member" class="lab">???? ?????? ?????? ???????????? ?????????????? ?????????????? ??<span class="color-theme"> *</span></label>
                                        <select name="orema_member" class="form-control result">
                                            <option @if(old('orema_member') == "yes") selected @endif  value="yes" >??????</option>
                                            <option @if(old('orema_member') == "no") selected @endif value="no">????</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="orema_info">???????? ???????? ???? ?????????? ?????????????? ?????????????? ??<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="orema_info" class="form-control" required>{{ old('orema_info')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="effect_school">???? ?????? ???????????? ???????? ???????????? ???? ???????? ?????????????? ???? ?????????? ???????????? ???? ?????? ?????? ?????? ??<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="effect_school" class="form-control" required>{{ old('effect_school')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="experience_assoc">???? ???????? ?????? ???????? ???? ?????????? ?????????????? ?? ???? ?????? ???????????? ???????? ????????????<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="experience_assoc" class="form-control" required>{{ old('experience_assoc')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="afc_info">?????? ?????????? ?????? ???????????????? ?????? ???????? ??<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="afc_info" class="form-control" required>{{ old('afc_info')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="afc_participate" class="lab">???? ?????? ???? ???? ?????????? ?????????????????? ?????? ???????? ??<span class="color-theme"> *</span></label>
                                        <select name="afc_participate" class="form-control result">
                                            <option @if(old('afc_participate') == "Non") selected @endif  value="Non" >????</option>
                                            <option @if(old('afc_participate') == "AFC1") selected @endif value="AFC1">???????????? 1</option>
                                            <option @if(old('afc_participate') == "AFC2") selected @endif value="AFC2">???????????? 2</option>
                                            <option @if(old('afc_participate') == "AFC3") selected @endif value="AFC3">???????????? 3</option>
                                            <option @if(old('afc_participate') == "AFC4") selected @endif value="AFC4">???????????? 4</option>
                                            <option @if(old('afc_participate') == "AFC5") selected @endif value="AFC5">???????????? 5</option>
                                            <option @if(old('afc_participate') == "AFC6") selected @endif value="AFC6">???????????? 6</option>
                                            <option @if(old('afc_participate') == "AFC7") selected @endif value="AFC7">???????????? 7</option>
                                            <option @if(old('afc_participate') == "AFC8") selected @endif value="AFC8">???????????? 8</option>
                                            <option @if(old('afc_participate') == "AFC9") selected @endif value="AFC9">???????????? 9</option>
                                            <option @if(old('afc_participate') == "AFC10") selected @endif value="AFC10">???????????? 10</option>
                                            <option @if(old('afc_participate') == "AFC11") selected @endif value="AFC11">???????????? 11</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="afc_remarque">???????????????? ???? ???????????? ???? ?????????????? ???????? ?????????? ?????? !</label>
                                <textarea rows="6" name="afc_remarque" class="form-control">{{ old('afc_remarque')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="afc_reason">???????? ?????????????? ?????? ?????????? ???? ???????????????? ??????????????????????<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="afc_reason" class="form-control" required>{{ old('afc_reason')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">????????????</button>
                                        <button class="btn btn-primary nextBtn" type="button">????????????</button>
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
                                <h4>?????????? ????????????</h4>
                                <br />
                                <div class="form-group">
                                <label for="life_achievements">?????? ???????????????? ???? ????????????<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="life_achievements" class="form-control" required>{{ old('life_achievements')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="choose">???? ???????? ?????????? ???????????? ?????????????? ???????????? ???? ?????? ?????????????? ??<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="choose" class="form-control" required>{{ old('choose')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="ten_years">?????? ?????? ???????? ?????? 10 ?????????? ??<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="ten_years" class="form-control" required>{{ old('ten_years')}}</textarea>
                                </div>

                                <div class="form-group">
                                <label for="ten_years">?????????? ???????? ??  ???????? ???????????????? (1Mo  ???????? ???????? ?????? ??????)</label>
                                <div class="input-group control-group increment" >
                                <input type="file" onchange="ValidateSize(this)" name="files[]" class="form-control">
                                <div class="input-group-btn"> 
                                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>??????????</button>
                                </div>
                                </div>
                                <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" onchange="ValidateSize(this)" name="files[]" class="form-control">
                                    <div class="input-group-btn"> 
                                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>??????</button>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <marquee direction="right">???? ???????? ???????????? ?????? ???????? ???????? (?????????????????? ?????????? ...) ???????? ?? ???????? ???????????????????? ???????????? ?????????????? ?????????? ???????????????????? : <a href="mailto:afc12.orema@gmail.com">afc12.orema@gmail.com</a></marquee>

                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">????????????</button>
                                        <button class="btn btn-primary nextBtn" type="button">????????????</button>
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
                                <h4>???????????? ????????????????</h4>
                                <br />
                                <div class="form-group">
                                    <label for="work_project" class="lab">???? ?????? ???????????? ?????? ?????????? ???????? ???? ?????? ??<span class="color-theme"> *</span></label>
                                        <select name="work_project" class="form-control result">
                                            <option @if(old('work_project') == "yes") selected @endif  value="yes" >??????</option>
                                            <option @if(old('work_project') == "no") selected @endif value="no">????</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="project_details">???????? ?????????????? ???? ????????</label>
                                <textarea rows="6" name="project_details" class="form-control">{{ old('project_details')}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="project_proposition">???? ?????????????? ???????? ???????? ?????????? ???????? ?????????? ?????????? ???????? ????????????????????<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="project_proposition" class="form-control" required>{{ old('project_proposition')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <button class="btn btn-secondary prevBtn" type="button">????????????</button>
                                        <button class="btn btn-primary nextBtn" type="button">????????????</button>
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
                                <h4>?????????? ????????</h4>
                                <br />
                                <div class="form-group">??
                                    <label for="book_share" class="lab">???? ???? ???????????? ???????? ?????? ???????????????? ???? ???????? ???????????????????? ??<span class="color-theme"> *</span></label>
                                    <input type="text" name="book_share" class="form-control" value="{{ old('book_share')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="book_number" class="lab">???? ?????????? ???????? ?????? ?????????? ??<span class="color-theme"> *</span></label>
                                        <select name="book_number" class="form-control result">
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
                                            <option @if(old('book_number') == "+20") selected @endif value="+20">???????? ???? 20</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="read_domain" class="lab">???? ???????????? ???????? ???????? ?????????????? ?????? ??<span class="color-theme"> *</span></label>
                                    <input type="text" name="read_domain" class="form-control" value="{{ old('read_domain')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="book_best" class="lab">???? ???? ?????? ???????? ?????? ?????? ???? ?????????? ???????? ???????? ??<span class="color-theme"> *</span></label>
                                    <input type="text" name="book_best" class="form-control" value="{{ old('book_best')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="book_idea">???????? ???????????? ???????????? ???????? ?????????????? ????????????<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="book_idea" class="form-control" required>{{ old('book_idea')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="talent">???????? ?????????? ?????????? ???????????????? ???????? ???????????????????? ??<span class="color-theme"> *</span></label>
                                    <input type="text" name="talent" class="form-control" value="{{ old('talent')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="program_propositions">???? ???? ?????????????????? ???????????????? ???????? ?????????????? ???????????????? ?????????????? ???????????????????? ??<span class="color-theme"> *</span></label>
                                <textarea rows="6" name="program_propositions" class="form-control" required>{{ old('program_propositions')}}</textarea>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-9 offset-md-12">
                                        <input id="register" type="submit" class="btn btn-primary" value="??????" />
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </form>					</div>
					<div class="tab-pane fade @if(Auth::user()->provider == "1") show active @endif" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    ?????? ???? ?????? ?????????????????? ??????????
					</div>
				</div>

                        
             </div>
            </div>
        </div>
    </div>
</div>
@endsection
