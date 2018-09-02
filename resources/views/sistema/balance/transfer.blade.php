@extends('adminlte::page')

@section('title', 'Transferência de valores')

@section('content_header')
<h1>Recarregar Saldo</h1>

<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Home</a></li>
	<li class="breadcrumb-item active">Saldo            </li>
	<li class="breadcrumb-item active">Transferência            </li>
</ul>

@stop

@section('content')
<div class="box">
 
	<h3>Transferência</h3>
	<div class="box-body">
	@include('sistema.partials._messages')
		
		<form method="POST" action="{{route('confirm.transfer')}}">
		  {{ csrf_field() }}  
			<div class="form-group">
			<input type="text" placeholder="informe o nome de quem vai receber (nome ou e-mail)" name="receiver" class="form-control">
			</div>

			<div class="form-group">
			<button type="submit" class="btn btn-success">próxima etapa</button>
			</div>
		</form>

	</div>

</div>

@stop