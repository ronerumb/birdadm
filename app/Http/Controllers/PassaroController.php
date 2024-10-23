<?php

namespace App\Http\Controllers;

use App\Models\Passaro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PassaroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function __construct(Passaro $passaro){
        $this->passaro = $passaro;
    }
    public function index()
    {
        return reponse()->json($this->passaro->all());
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
        $request->validate($this->passaro->rules(),$this->passaro->feedback());
        $imagemPath = null;
    if($request->hasFile('imagem')) {
        $imagemPath = $request->file('imagem')->store('imagens/passaros', 'public'); // Armazena na pasta 'public/imagens/passaros'
    }

        $passaro = $this->passaro->create([
            'anilha_id' => $request->anilha_id,
            'cor_id' => $request->cor_id,
            'especie_id' => $request->especie_id,
            'situacao_id' => $request->situacao_id,
            'nome' => $request->nome,
            'sexo' => $request->sexo,
            'imagem' =>  $imagemPath,

        ]);
        return response()->json($passaro, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Passaro  $passaro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $passaro = $this->passaro->find($id);
        if(!$passaro){
            return response()->json('Passaro não encontrado', 404);
        }
        return response()->json($passaro, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Passaro  $passaro
     * @return \Illuminate\Http\Response
     */
    public function edit(Passaro $passaro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Passaro  $passaro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $passaro = Passaro::find($id);
        if (!$passaro) {
            return response()->json('ID não encontrado', 404);
        }
    
        // Validação das regras
        if ($request->isMethod('PATCH')) {
            $regras = [];
    
            foreach ($passaro->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regras[$input] = $regra;
                }
            }
            $request->validate($regras);
        } else {
            $request->validate($passaro->rules());
        }
    
        // Verifica se a imagem foi enviada
        if ($request->hasFile('imagem')) {
            // Deleta a imagem antiga se existir
            if ($passaro->imagem) {
                Storage::disk('public')->delete($passaro->imagem);
            }
            // Armazena a nova imagem
            $imagemPath = $request->file('imagem')->store('imagens/passaros', 'public');
            $passaro->imagem = $imagemPath; 
        }
    
        // Preenche os dados restantes, exceto a imagem
        $passaro->fill($request->except('imagem'));
        $passaro->save();
    
        // Retorna a resposta com os dados atualizados
        return response()->json($passaro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Passaro  $passaro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $passaro = $this->passaro->find($id);
        if(!$passaro){
            return response()->json('ID não encontrado',404);
        }
        $passaro->delete();
    }
}
