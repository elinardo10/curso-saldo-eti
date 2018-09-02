<?php

namespace App\Http\Controllers;
use Storage;
Use App\Image;
use Illuminate\Http\Request;
use Session;

class ImagensController extends Controller
{
    public function index(){

    	$imagens = Image::all();
    	
        return response()->json($imagens);
        //'email' => $insert['email'],

    }

    public function formimg(){

    	return view('sistema.formimg');
    }

     public function store(Request $request){
   
    $file = $request->file('image');
    $random_name = str_random(8);
    $extension = $file->extension();
    $filename=$random_name.'_projeto_image.'.$extension;
    $uploadSuccess = $request->image->storeAs('imagens', $filename);
    Image::create(array(
      'image' => $uploadSuccess,
      'titulo'=> $request->get('titulo')
    ));

    Session::flash('msgsuccess', 'Imagem salvo com Sucesso!');
    return redirect()->route('listar.img');
  }
}
