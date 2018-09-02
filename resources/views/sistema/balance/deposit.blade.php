@extends('adminlte::page')

@section('title', 'Recarregar Saldo')

@section('content_header')
<h1>Recarregar Saldo</h1>

<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Home</a></li>
	<li class="breadcrumb-item active">Saldo            </li>
	<li class="breadcrumb-item active">Depositar            </li>
</ul>

@stop

@section('content')
<div class="box">
 @include('sistema.partials._messages')
	<h3>Fazer Deposito</h3>
	<div class="box-body">
		
		<form method="POST" action="{{route('deposit.store')}}">
		  {{ csrf_field() }}  
			<div class="form-group">
			<input type="text" placeholder="valor da Recarga" name="value">
			</div>

			<div class="form-group">
			<button type="submit" class="btn btn-success">Recarregar</button>
			</div>
		</form>

	</div>

</div>

@stop