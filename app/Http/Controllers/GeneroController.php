<?php

namespace cinema\Http\Controllers;

use Illuminate\Http\Request;

use cinema\Http\Requests;
use cinema\Http\Controllers\Controller;
use cinema\Genre;
use Illuminate\Routing\Route;

class GeneroController extends Controller
{

        public function __construct(){
            $this->beforeFilter('@find',['only' => ['edit', 'update','destroy']]);
        }

        public function find(Route $route){

        $this->genre = Genre::find($route->getParameter('genero'));
        
            }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function listing(){
        $genres = Genre::all();
        return response()->json(
                $genres->toArray()
            );
    }

    public function index()
    {
        return view('genero.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('genero.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            Genre::create($request->all());
            return response()->json([
                "mensaje" => "Creado"
                ]);
        }
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
        return response()->json(
           $this->genre->toArray()
            );
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
        
        $this->genre->fill($request->all());
        $this->genre->save();

        return response()->json([
            "mensaje" => "Listo"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->genre->delete();
          return response()->json([
            "mensaje" => "borrado"
            ]);
    }
}
