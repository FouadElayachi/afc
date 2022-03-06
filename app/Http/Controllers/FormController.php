<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index', 'create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('form');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = Form::all();
        return view('form.create')->withForm($form);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'photo'         => 'required|mimes:jpeg,bmp,png,gif,svg,pdf,jpg',
            'cin'         => 'required|min:3|max:40',
            'country'         => 'required|min:3|max:40',
            'city_local'         => 'required|min:3|max:40',
            'city_origin'         => 'required|min:3|max:40',
            'birthdate'         => 'required|date',
            'city_birth'         => 'required|min:3|max:40',
            'phone_number1'         => 'required|min:5|max:18',
            'link_fb'         => 'required',
            'profession'         => 'required',
            'school'         => 'required|min:3|max:15',
            'niveau'         => 'required|min:1|max:100',
            'specialite'         => 'required|min:5',
            'specialite_why'         => 'required|min:10',
            'orema_member'         => 'required',
            'orema_info'         => 'required|min:10',
            'effect_school'         => 'required|min:10',
            'experience_assoc'         => 'required|min:10',
            'afc_info'         => 'required|min:10',
            'afc_participate'         => 'required',
            'afc_reason'         => 'required|min:10',
            'life_achievements'         => 'required|min:10',
            'choose'         => 'required|min:10',
            'ten_years'         => 'required|min:10',
            'files'         => 'max:1024',
            'work_project'         => 'required',
            'project_proposition'         => 'required|min:10',
            'book_share'         => 'required|min:5',
            'book_number'         => 'required',
            'read_domain'         => 'required|min:5',
            'book_best'         => 'required|min:5',
            'book_idea'         => 'required|min:20',
            'talent'         => 'required|min:3',
            'program_propositions'         => 'required|min:10',
        ));
        $form = new Form;
        $user = User::where('id','=',Auth::user()->id)->first();
        $user->provider = "1";
        $form->user_id = Auth::user()->id;
        $form->cin = $request->cin;
        $form->country = $request->country;
        $form->city_local = $request->city_local;
        $form->city_origin = $request->city_origin;
        $form->birthdate = $request->birthdate;
        $form->city_birth = $request->city_birth;
        $form->phone_number1 = $request->phone_number1;
        if(isset($request->phone_number2)) $form->phone_number2 = $request->phone_number2;
        $form->link_fb = $request->link_fb;
        if(isset($request->link_linkedin)) $form->link_linkedin = $request->link_linkedin;
        $form->profession = $request->profession;
        $form->school = $request->school;
        $form->niveau = $request->niveau;
        $form->specialite = $request->specialite;
        $form->specialite_why = $request->specialite_why;
        $form->orema_member = $request->orema_member;
        $form->orema_info = $request->orema_info;
        $form->effect_school = $request->effect_school;
        $form->experience_assoc = $request->experience_assoc;
        $form->afc_info = $request->afc_info;
        $form->afc_participate = $request->afc_participate;
        if(isset($request->afc_remarque)) $form->afc_remarque = $request->afc_remarque;
        $form->afc_reason = $request->afc_reason;
        $form->life_achievements = $request->life_achievements;
        $form->choose = $request->choose;
        $form->ten_years = $request->ten_years;

        if($request->hasfile('files'))
         {

            foreach($request->file('files') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->storeAs(
                    'public/files/'.$form->cin.'', $name
                );
                $data[] = $name;  
            }
            $form->files=json_encode($data);
         }

         if($request->hasfile('photo')){
            $photo = $request->file('photo');
            $name=$photo->getClientOriginalName();
            $photo->storeAs(
                'public/files/'.$form->cin.'', $name
            );
         }
         $form->photo = '/storage/files/'.$form->cin.'/'. $name;

        $form->work_project = $request->work_project;
        if(isset($request->project_details)) $form->project_details = $request->project_details;
        $form->project_proposition = $request->project_proposition;
        $form->book_share = $request->book_share;
        $form->book_number = $request->book_number;
        $form->read_domain = $request->read_domain;
        $form->book_best = $request->book_best;
        $form->book_idea = $request->book_idea;
        $form->talent = $request->talent;
        $form->program_propositions = $request->program_propositions;
        $form->save();
        $user->save();
        if(url()->previous() == "".url('/')."/home"){
        return redirect('/home')->with('success', 'Le formulaire a été bien rempli');
        }
        else return redirect('/الرئيسية')->with('success', 'لقد تم ملء الاستمارة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}
