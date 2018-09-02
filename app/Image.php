<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{	 
	protected $fillable = [
	'image','titulo'
	];

	public function salvarAnexo(){

$novoNomeArquivo = strtolower(str_replace([' ','/'],'_',$nomeAnexo))."_".$contato->id."_".$file->id.".".$anexo->getClientOriginalExtension();
		$file->url = "/files/ver/".$file->id."/".$novoNomeArquivo;
		$file->path = 'data/uploadusers/'.$novoNomeArquivo;
		$file->save();
	}

}
