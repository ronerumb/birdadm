<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anilha extends Model
{
    use HasFactory;

    protected $fillable = ['numeracao'];

    public function rules() {
        return [
            'numeracao' => 'required',
            
        ];
    }

    public function feedback(){
        return [
            'required'=> "o Campo :attribute é obrigatorio"
        ];
    }
    public function passaros(){
        return $this->hasOne('App\Models\Passaro');
    }
}
