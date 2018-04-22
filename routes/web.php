<?php

Route::get('/', function () {
    return view('site.welcome');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Sistema'],  function(){
		Route::group(['prefix' => 'sistema', 'where'=>['id'=>'[0-9]+']], function(){
		route::get('',     ['as'=> 'sistema.home', 'uses' => 'SistemaController@index']);
		route::get('balance',     ['as'=> 'sistema.balance', 'uses' => 'BalanceController@index']);
		
 	});

});

Auth::routes();
