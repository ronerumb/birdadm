<?php

namespace App\Http\Controllers;

use App\Models\Anilha;
use Illuminate\Http\Request;

class AnilhaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Anilha $anilha){
        $this->anilha = $anilha;
     }
    public function index()
    {
        return response()->json($this->anilha::all(), 200);
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
        $request->validate($this->anilha->rules(),$this->anilha-> feedback());

        $especie = $this->anilha->create([
            'numeracao' => $request->numeracao
        ]);
        return response()->json($anilha,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anilha  $anilha
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anilha = $this->anilha->find($id);
        if($anilha == null){
           return response()->json('ID não encontrado', 404);
        }
        return response()->json($anilha, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anilha  $anilha
     * @return \Illuminate\Http\Response
     */
    public function edit(Anilha $anilha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anilha  $anilha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
  
        $anilha = $this->anilha->find($id);
        if(!$anilha){
            return response()->json('ID não encontrado',404);
        }

        if($request->method === 'PATCH'){
            $regras = array();

            foreach($anilha->rules() as $input => $regra){//Validacao das regras patch
                if(array_key_exists($input,$request->all())){
                    $regras[$input] = $regra;
                }
            }
            $request->validate($regras);
        }
        else {
            $request->validate($anilha->rules());
        }
        
        $anilha->fill($request->all());
        $anilha->save();
        
        return response()->json($anilha, 200);
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anilha  $anilha
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $anilha = $this->anilha->find($id);
        if(!$anilha){
            return response()->json('ID não encontrado',404);
        }
        $anilha->delete();
    }
    }

