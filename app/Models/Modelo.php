<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = ['marca_id','nome', 'imagem', 'numero_portas','lugares', 'air_bag','abs'];

    public function rules()
    {
        return
        [    'marca_id' => 'exists:marcas,id',
            'nome'=>'required|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem'=>'required|file|mimes:png,jpeg,jpg,pdf,svg',
            'numero_portas'=>'required|integer|digits_between:1,5', //(1, 2, 3, 4, 5)
            'lugares'=>'required|integer|digits_between:1,20',
            'air_bag'=>'required|boolean',
            'abs'=>'required|boolean'
    ];
    }

    public function feedback()
    {
        return
          ['required'=>'o campo attribute é obrigatório',
        'nome.unique'=>'o nome da marca ja existe',
        'nome.min'=>'o nome deve ter ao menos 3 caracteres',
    'imagem.mimes'=>'a imagem precisa ser algum arquivo do tipo (png, jpg, pdf, svg)'];
    }


    public function marca()
    {
            return $this->belongsTo('App\Models\Marca');
    }
}
