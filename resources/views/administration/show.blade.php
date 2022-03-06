@extends('layouts.admin')

@section('style')
<style>
</style>
@endsection

@section('content')


<div class="container">
    <div class="row my-2">
        <div class="col-lg-12 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#infos" data-toggle="tab" class="nav-link active">Informations personnelles</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#etude" data-toggle="tab" class="nav-link">Etudes</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#para" data-toggle="tab" class="nav-link">Activités parascolaires</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#projetPerso" data-toggle="tab" class="nav-link">Projet personnel</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#project" data-toggle="tab" class="nav-link">Concours de projets</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#gen" data-toggle="tab" class="nav-link">Questions générales</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="infos">
                    <h5 class="mb-3">Informations personnelles</h5>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">E-mail</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" value="{{$user->email}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Nom (AR)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->last_name_ar}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Prénom (AR)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->first_name_ar}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Nom (FR)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->last_name_fr}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Prénom (FR)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->first_name_fr}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">CIN</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->cin}}" readonly >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Pays</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->country}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Ville d'études(emploi)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->city_local}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Ville d'origine</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->city_origin}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Date de naissance</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{date('j M Y', strtotime($user->form->birthdate))}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Lieu de naissance</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->city_birth}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Numéro de téléphone 1</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->phone_number1}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Numéro de téléphone 2</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->phone_number2}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Lien vers votre profil facebook</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->link_fb}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Lien vers votre profil linkedin</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->link_linkedin}}" readonly>
                            </div>
                        </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="etude">
                <h5 class="mb-3">Etudes</h5>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Status</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="@if($user->form->profession	== "student") étudiant @else lauréat @endif " readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Institut d'études (Abréviation)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->school}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Niveau d'études (2018/2019)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->niveau}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Spécialité</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->specialite}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Pourquoi vous avez choisi cette spécialité ?</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->specialite_why}}</textarea>
                            </div>
                        </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="para">
                <h5 class="mb-3">Activités parascolaires</h5>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Êtes-vous membre d'orema ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="@if($user->form->orema_member == "yes") Oui @else Non @endif " readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Qu'est-ce que vous savez à propos d'orema ?</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->orema_info}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Comment décrivez vous votre participation aux activités parascolaires dans votre établissement ?</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->effect_school}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Avez-vous une expérience dans le travail associatif ? Si oui, mentionnez-la</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->experience_assoc}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Comment avez-vous connu l'Académie des futurs leaders ?</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->afc_info}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Avez-vous déjà participé à l'Académie des futurs leaders ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->afc_participate}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Vos commentaires sur la ou les éditions auxquelles vous avez participé !</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->afc_remarque}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Expliquez brièvement pourquoi vous désirez participer à l'Académie !</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->afc_reason}}</textarea>
                            </div>
                        </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="projetPerso">
                <h5 class="mb-3">Projet personnel</h5>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Vos réalisations marquantes dans la vie</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->life_achievements}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Pourquoi vous choisir plutôt qu'un autre ?</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->choose}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Comment vous voyez-vous dans 10 ans ?</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->ten_years}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Comment avez-vous connu l'Académie des futurs leaders ?</label>
                            <div class="col-lg-9">
                            @foreach (new DirectoryIterator(public_path() . '/storage/files/'.$user->form->cin.'') as $filename)  
                            <a href="/storage/files/{{$user->form->cin}}/{{$filename}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                            @endforeach
                            </div>
                        </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="project">
                <h5 class="mb-3">Concours de projets</h5>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Avez-vous déjà travaillé sur un projet à but lucratif ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="@if($user->form->work_project == "yes") Oui @else Non @endif " readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Expliquez l'idée de projet brièvement !</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->project_details}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Suggérez et décrivez une idée de projet sur laquelle vous souhaitez travailler au sein de l'Académie</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->project_proposition}}</textarea>
                            </div>
                        </div>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="gen">
                <h5 class="mb-3">Questions générales</h5>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Avec quel livre souhaitez-vous participer au sein de l'Académie ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->book_share}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Combien de livres avez-vous lu cette année ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->book_number}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Dans quel domaine préférez-vous lire ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->read_domain}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Quel livre vous a influencé le plus parmi les livres que vous avez lu ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->book_best}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Idée générale du livre !</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->book_idea}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Avec quel talent pouvez-vous participer au sein de l'Académie ?</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="{{$user->form->talent}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Que suggérez-vous comme initiatives pouvant êtres ajoutées au programme parallèle à l'académie ?</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" readonly>{{$user->form->program_propositions}}</textarea>
                            </div>
                        </div>
                    <!--/row-->
                </div>
            </div>
        </div>
        <div class="col-lg-12 order-lg-1 text-center">
            <img src="{{asset(''.$user->form->photo)}}" width="160px" height="160px" class="mx-auto img-fluid img-circle d-block" alt="{{$user->first_name_fr}}">
            <br />
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        $(document).ready(function(){
         $('.delete_form').on('submit', function(){
          if(confirm("Êtes-vous sur de vouloir le supprimer?"))
          {
           return true;
          }
          else
          {
           return false;
          }
         });
        });
</script>
@endsection