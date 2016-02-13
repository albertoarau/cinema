<?php

namespace cinema\Http\Controllers;

use Illuminate\Http\Request;
use cinema\Http\Requests;
use cinema\Http\Requests\UserCreateRequest;
use cinema\Http\Requests\UserUpdateRequest;
use cinema\Http\Controllers\Controller;
use cinema\User;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class UsuarioController extends Controller
{

    public function __construct(){

         $this->middleware('auth');
         $this->middleware('admin', ['only'=> ['create', 'edit']]);
        $this->beforeFilter('@find', ['only'=> ['edit','update','destroy']]);


    }


    public function find(Route $route){

        $this->usr = User::find($route->getParameter('usuario'));
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       //$usr= User::All();
      // $usr= User::OnlyTrashed->Paginate(2); - Muestra solos los elementos eliminados
      $usr= User::Paginate(2);
        return view('Usuario.index', ['users' => $usr]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

          /*
          $usr = new User;
          $usr->name = $request->name;
          $usr->email = $request->email;
          $usr->password = bcrypt($request->password);
          $usr->save();
          */
         
          User::Create($request->all());
          return redirect('/usuario')->with('message','El usuario ha sido dado de alta satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          //$usr= User::find($id);
        return view('Usuario.edit', ['user' => $this->usr]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //
        //$usr= User::find($id);
        //$usr->fill($request->all());
        $this->usr->fill($request->all()); 
        $this->usr->save();

        Session::flash('message', 'Usuario editado correctamente');
         return redirect('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
       // User::destroy($id);
        // $usr = User::find($id);
         $this->usr->delete();
         Session::flash('message', 'Usuario eliminado correctamente');
         return redirect('/usuario');

    }
}
