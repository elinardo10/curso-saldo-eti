@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
<h1>Saldo</h1>

<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Home</a></li>
	<li class="breadcrumb-item active">Saldo            </li>
</ul>

@stop

@section('content')
<div class="box">

@include('sistema.partials._messages')

	<div class="box-header">
		<a href="{{ route('balance.deposit')}}" class="btn btn-primary">Recarregar</a>
		@if($amount > 0)
		<a href="{{ route('balance.sacar') }}" class="btn btn-danger">Sacar</a>
		@endif

		@if($amount > 0)
		<a href="{{ route('balance.transfer') }}" class="btn btn-primary">
		<i class="fa fa-exchange" aria-hidden="true"></i> Transferir</a>

		@endif
	</div>
	<div class="box-body">
		
		<div class="small-box bg-green">
			<div class="inner">
				<h3>R$ {{ number_format($amount, 2, ',', '') }}</h3>

				<p>Bounce Rate</p>
			</div>
			<div class="icon">
				<i class="ion ion-cash"></i>
			</div>
			<a href="{{ route('historics.index') }}" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

</div>

@stop