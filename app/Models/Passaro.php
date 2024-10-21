<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passaro extends Model
{
    use HasFactory;
    protected $fillable = ['anilha_id','cor_id','especie_id','situacao_id','nome','sexo','imagem'];
    
    public function rules(){
        return [
            'anilha_id' => 'required|exists:anilhas,id|unique:passaros,anilha_id',
            'cor_id' => 'exists:cors,id',
            'especie_id' => 'exists:especies,id',
            'situacao_id' => 'exists:situacaos,id',
            'nome' => 'min:3',
            'sexo' => 'max:1',
           
            
        ];
    }

    public function feedback(){
        return [
            'required'=> "o Campo :attribute é obrigatorio"
        ];
    }

    public function cors(){
        return $this->belongsTo('App\Models\Cor');
    }
    public function anilhas(){
        return $this->belongsTo('App\Models\Anilha');
    }
    public function especies(){
        return $this->belongsTo('App\Models\Especie');
    }
    public function situacaos(){
        return $this->belongsTo('App\Models\Situacao');
    }
}
