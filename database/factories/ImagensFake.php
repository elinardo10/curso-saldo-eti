<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
	/*//download das imagens vindo do laravelpix.com
	$imagemDownload = $faker->image(storage_path('app/public'), 720, 480);
	//criando array do caminho das imagens
	$imagePath = explode('//', $imagemDownload);
	//setando um nome para a imagem
	$imageName = end($imagePath);*/

    return [
    //salvando as imagens no banco
        //'image' => $imageName,
    	'titulo' => $faker->word,
        'image' => $faker->imageUrl($width = 250, $height = 300),
    ];
});
