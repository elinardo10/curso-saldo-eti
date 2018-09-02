@extends('adminlte::page')

@section('title', 'confirmar transferência')

@section('content_header')
<h1>confirmar transferência</h1>

<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Home</a></li>
	<li class="breadcrumb-item active">Saldo </li>
	<li class="breadcrumb-item active">Transferência </li>
	<li class="breadcrumb-item active">Confirmar Transferência </li>
</ul>

@stop

@section('content')
<div class="box">
 
	<h3>Transferência</h3>
	<div class="box-body">
	@include('sistema.partials._messages')
	<p><strong>Recebedor: {{ $receiver->name }}</strong></p>
	<p class="{{ $balance->amount <= 0 ? 'alert-warning' : '' }}"><strong>Saldo Atual: {{ number_format($balance->amount, 2, ',', '') }}</strong></p>
		
		<form method="POST" action="{{route('transfer.store')}}">
		  {{ csrf_field() }}

		  <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">  

			<div class="form-group">
			<input type="text" placeholder="Valor:" name="value" class="form-control">
			</div>

			<div class="form-group">
			<button type="submit" class="btn btn-success">Transferir</button>
			</div>
		</form>

	</div>

</div>

@stop