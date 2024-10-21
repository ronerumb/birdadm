<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(Especie $especie){
        $this->especie = $especie;
     }
    public function index()
    {
         return response()->json($this->especie::all(), 200);
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
        $request->validate($this->especie->rules(),$this->especie-> feedback());

        $especie = $this->especie->create([
            'nome' => $request->nome,
            'observacoes' => $request->observacoes
        ]);
        return response()->json($especie,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especie = $this->especie->find($id);
        if($especie == null){
           return response()->json('ID não encontrado', 404);
        }
        return response()->json($especie, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function edit(Especie $especie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $especie = $this->especie->find($id);
        if(!$especie){
            return response()->json('ID não encontrado',404);
        }

        if($request->method === 'PATCH'){
            $regras = array();

            foreach($especie->rules() as $input => $regra){//Validacao das regras patch
                if(array_key_exists($input,$request->all())){
                    $regras[$input] = $regra;
                }
            }
            $request->validate($regras);
        }
        else {
            $request->validate($especie->rules());
        }
        
        $especie->fill($request->all());
        $especie->save();
        
        return response()->json($especie, 200);
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = $this->especie->find($id);
        if(!$especie){
            return response()->json('ID não encontrado',404);
        }
        $especie->delete();
    }
}
