<?php

Route::get('/', function () {
	return view('site.index');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Sistema'],  function(){
	Route::group(['prefix' => 'sistema', 'where'=>['id'=>'[0-9]+']], function(){
		route::get('',     ['as'=> 'sistema.home', 'uses' => 'SistemaController@index']);
		route::get('balance',     ['as'=> 'sistema.balance', 'uses' => 'BalanceController@index']);
		route::get('deposit',     ['as'=> 'balance.deposit', 'uses' => 'BalanceController@deposit']);
		route::post('store-deposit',     ['as'=> 'deposit.store', 'uses' => 'BalanceController@store']);

		//sacar
		route::get('withdraw', ['as'=> 'balance.sacar', 'uses' => 'BalanceController@withdraw']);
		route::post('withdraw', ['as'=> 'sacar.withdraw', 'uses' => 'BalanceController@sacar_store']);
		//transferir
		route::get('transfer', ['as'=> 'balance.transfer', 'uses' => 'BalanceController@transfer']);
		route::post('transfer', ['as'=> 'confirm.transfer', 'uses' => 'BalanceController@confirmTransfer']);
		route::post('transfer-save', ['as'=> 'transfer.store', 'uses' => 'BalanceController@TransferStore']);

		route::get('historics', ['as'=> 'historics.index', 'uses' => 'BalanceController@historics']);
		route::any('historic-seach', ['as'=> 'historics.search', 'uses' => 'BalanceController@historicSearch']);

			/***************************************
			*trabalhando no perfil do usuario	   *
			***************************************/
		route::get('perfil', ['as'=> 'profile', 'uses' => 'UserController@index']);
		route::post('perfil-atualizar', ['as'=> 'updade.user', 'uses' => 'UserController@update']);

		});

});



route::post('imagens', ['as'=> 'img.store', 'uses' => 'ImagensController@store']);
route::get('addimg', ['as'=> 'img.add', 'uses' => 'ImagensController@formimg']);

Auth::routes();
