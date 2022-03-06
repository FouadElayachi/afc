<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index', 'create', 'store', 'edit', 'update', 'destroy');
        $this->middleware('admin')->only('index', 'create', 'store', 'edit', 'update', 'destroy','indexRegistred');
        $this->middleware('admin2')->only('index2', 'show2');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('administration.index', compact('users'));
    }

    public function indexRegistred()
    {
        $users = User::where('provider',1)->paginate(10);
        return view('administration.util.endregister', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('administration.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('administration.index')->with('alert', 'La filière a été supprimée');
    }

    public function active($id)
    {
        $user = User::find($id);
        if($user->is_active==0)
        {
        $user->update(['is_active'=>1]);
        }
        else
        {
            $user->update(['is_active'=>0]);
        }
        return redirect()->route('administration.index');
    }

    // Admin 2

    public function index2()
    {
        $users = User::where('provider',1)->paginate(10);
        return view('administration2.index', compact('users'));
    }
    public function show2($id)
    {
        $user = User::find($id);
        return view('administration2.show')->withUser($user);
    }
}
