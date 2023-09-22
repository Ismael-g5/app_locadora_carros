<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // post
       /* $marcas = Marca::all();
        return $marcas;*/

        //get
        $marca = $this->marca->all();

        return $marca;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =
        ['nome'=>'required|unique:marcas',
        'imagem'=>'required'];

        $feedback =
        ['required'=>'o campo attribute é obrigatório',
        'nome.unique'=>'o nome da marca ja existe'];

        $request->validate($rules, $feedback);

        $marca = $this->marca->create($request->all());
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);
        if($marca === null)
        {
            return ['error' => 'recurso pesquisado não existe'];
        }
        else

        {
            return $marca;
        }


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $marca = $this->marca->find($id);

                if($marca === null)
                {
                    return ['error' =>'recurso pesquisado não existe ou não pode ser atualizado'];
                }
                else{

                    $marca->update($request->all());
                    return $marca;
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $marca = $this->marca->find($id);

       if($marca === null)
       {
        return ['error' =>'recurso pesquisado não existe ou não pode ser deletado'];
       }else{

       $marca->delete();
           return ['msg' =>'a marca foi removida com sucesso!'];
        }
    }
}
