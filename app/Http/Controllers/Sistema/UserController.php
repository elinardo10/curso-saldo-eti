<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserUpdateRequest;
use File;

class UserController extends Controller
{
    public function index(){

    	return view('sistema.profile.profile');
    }

    public function update(UserUpdateRequest $request){
    	$user = auth()->user();
    	$data = $request->all();

    	if (!empty($data['password'])) 
            $data['password'] = bcrypt($data['password']);
        else
        	unset($data['password']);
        //upload da imagem
        $data['image'] = $user->image;

        if($request->hasFile('image') && $request->file('image')->isValid()){

        $usersImage = storage_path("app/public/users/{$user->image}"); // get previous image from folder
      
        	if(File::exists($usersImage)){
        		unlink($usersImage);
                //unlink(storage_path('app/public/users/'.$name));
            }
        	else
                $name = null;
        	$name = $user->id.kebab_case($user->name);
        	$extension = $request->image->getClientOriginalExtension();
        	$nameFile = time()."{$name}.{$extension}";
        	
        	$data['image'] = $nameFile;
        	$upload = $request->image->storeAs('users', $nameFile);
        	if(!$upload)
        		 return redirect()
                     	->back()
                    	->with('error', 'falha ao carregar imagem');


        }
        

        $update = $user->update($data);

        if($update) 
        return redirect()->route('profile')
    									->with('msgsuccess','Perfil alterado com Sucesso!');

         return redirect()
                     	->back()
                    	->with('error', 'Erro ao atualizar perfil');
    }
}
