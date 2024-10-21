<?php

namespace App\Http\Controllers;

use App\Models\Situacao;
use Illuminate\Http\Request;

class SituacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __contruct(Situacao $situacao){
        $this->situacao = $situacao;
    }
    public function index()
    {
        return response()->json($this->situacao::all(), 200);
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
        $request->validate($this->situacao->rules(),$this->situacao->feedback());
        $situacao = $this->situacao->create([
            'nome' => $request->nome,
            'observacoes' => $request->observacoes
        ]);
        return response()->json($situacao,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Situacao  $situacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $situacao = $this->situacao->find($id);
        if($situacao == null){
           return response()->json('ID não encontrado', 404);
        }
        return response()->json($situacao, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Situacao  $situacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Situacao $situacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Situacao  $situacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $situacao = $this->situacao->find($id);
        if(!$situacao){
            return response()->json('ID não encontrado',404);
        }

        if($request->method === 'PATCH'){
            $regras = array();

            foreach($situacao->rules() as $input => $regra){//Validacao das regras patch
                if(array_key_exists($input,$request->all())){
                    $regras[$input] = $regra;
                }
            }
            $request->validate($regras);
        }
        else {
            $request->validate($situacao->rules());
        }
        
        $situacao->fill($request->all());
        $situacao->save();
        
        return response()->json($situacao, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Situacao  $situacao
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $situacao = $this->situacao->find($id);
        if(!$situacao){
            return response()->json('ID não encontrado',404);
        }
        $situacao->delete();
    }
}
