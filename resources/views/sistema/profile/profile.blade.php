@extends('adminlte::page')

@section('title', 'Recarregar Saldo')

@section('content_header')
<h1>Recarregar Saldo</h1>

<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Home</a></li>
	<li class="breadcrumb-item active">Editar Perfil            </li>
	
</ul>

@stop

@section('content')
<div class="box">
 @include('sistema.partials._messages')
	<h3>Alterar dados do Usuário</h3>
	<div class="box-body">
		
		<form method="POST" action="{{route('updade.user')}}" enctype="multipart/form-data">

		  {{ csrf_field() }}  
		  
			<div class="form-group col-md-6">
			<label for="name">Nome: </label>
			<input type="text" name="name" value="{{auth()->user()->name}}" class="form-control">
			</div>

			<div class="form-group col-md-6">
			<label for="email">Email: </label>
			<input type="email" name="email" value="{{auth()->user()->email}}" class="form-control">
			</div>

			<div class="form-group col-md-6">
			<label for="password">Senha: </label>
			<input type="password" name="password" value="" placeholder="Senha" class="form-control">
			</div>
			<br>
			<div class="form-group  col-md-6">
				@if(auth()->user()->image != null)
				<img src="{{ url('storage/users/'.auth()->user()->image)}}" alt="{{auth()->user()->name}}" style="max-width: 50px">
				@endif
			</div>

			<div class="form-group col-md-6">
			<label for="image">Imagem: </label>
			<input type="file" name="image">
			</div>
			

			<div class="form-group col-md-5">
			<button type="submit" class="btn btn-primary">alterar Dados</button>
			</div>
		</form>

	</div>

</div>

@stop