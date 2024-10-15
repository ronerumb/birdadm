<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;

class CorController extends Controller
{

    public function __construct(Cor $cor){
        $this->cor = $cor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cor::all();        
        return Cor::all();

        
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
        $request->validate($this->cor->rules(),$this->cor-> feedback());

        $cor = $this->cor->create([
            'nome' => $request->nome
        ]);
        return response()->json($cor,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cor = $this->cor->find($id);
        if($cor == null){
           return response()->json('ID não encontrado', 404);
        }
        return response()->json($cor, 200);
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Http\Response
     */
    public function edit(Cor $cor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cor = $this->cor->find($id);
        if(!$cor){
            return response()->json('ID não encontrado',404);
        }

        if($request->method === 'PATCH'){
            $regras = array();

            foreach($cor->rules() as $input => $regra){//Validacao das regras patch
                if(array_key_exists($input,$request->all())){
                    $regras[$input] = $regra;
                }
            }
            $request->validate($regras);
        }
        else {
            $request->validate($cor->rules());
        }
        
        $cor->fill($request->all());
        $cor->save();
        
        return response()->json($cor, 200);
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cor  $cor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cor = $this->cor->find($id);
        if(!$cor){
            return response()->json('ID não encontrado',404);
        }
        $cor->delete();
        
    }
}
