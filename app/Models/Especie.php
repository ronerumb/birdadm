<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    protected $fillable = ['nome','observacoes'];

    public function rules() {
        return [
            'nome' => 'required',
            
        ];
    }

    public function feedback(){
        return [
            'required'=> "o Campo :attribute é obrigatorio"
        ];
    }
}
