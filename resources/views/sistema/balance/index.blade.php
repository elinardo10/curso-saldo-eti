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
	<div class="box-header">
		<a href="" class="btn btn-primary">Recarregar</a>
		<a href="" class="btn btn-danger">Sacar</a>
	</div>
	<div class="box-body">
		
		<div class="small-box bg-green">
			<div class="inner">
				<h3>R$ 90</h3>

				<p>Bounce Rate</p>
			</div>
			<div class="icon">
				<i class="ion ion-cash"></i>
			</div>
			<a href="#" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

</div>

@stop