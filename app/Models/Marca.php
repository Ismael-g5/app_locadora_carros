<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem'];

    public function rules()
    {
        return
        ['nome'=>'required|unique:marcas,nome,'.$this->id.'|min:3',
        'imagem'=>'required|file|mimes:png,jpeg,jpg,pdf,svg'];
    }

    public function feedback()
    {
        return
          ['required'=>'o campo attribute é obrigatório',
        'nome.unique'=>'o nome da marca ja existe',
        'nome.min'=>'o nome deve ter ao menos 3 caracteres',
    'imagem.mimes'=>'a imagem precisa ser algum arquivo do tipo (png, jpg, pdf, svg)'];
    }

    //uma marca pode possuir muitos modelos -> use o hasmany

    public function modelos()
    {
        return $this->hasMany('App\Models\Modelo');
    }
}
