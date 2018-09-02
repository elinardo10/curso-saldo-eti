@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
<h1>Saldo</h1>

<ul class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Home</a></li>
	<li class="breadcrumb-item active">histórico  </li>
</ul>

@stop

@section('content')
<div class="box">
	<div class="box-header">
		<form action="{{ route('historics.search') }}" method="post" class="form form-inline">
			{{ csrf_field() }}
			<input type="text" name="id" class="form-control" placeholder="ID">
			<input type="date" name="date" class="form-control">
			<select name="type" class="form-control">
				<option value="">--Selecione um tipo--</option>
				@foreach($types as $key => $type)
				<option value="{{ $key }}">{{ $type }}</option>
				@endforeach
			</select>

			<button type="submit" class="btn btn-primary">Pesquisar</button>

		</form>
	</div>
	<div class="box-body">
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>valor</th>
					<th>Tipo</th>
					<th>data</th>
					<th>Recebeu/Enviou para/ De</th>
				</tr>
			</thead>
			<tbody>
				@foreach($historics as $historic)
				<tr>
					<td>{{ $historic->id }}</td>
					<td>{{ number_format($historic->amount, 2, ',', '') }}</td>
					<td>{{ $historic->type($historic->type) }}</td>
					<td>{{ $historic->date }}</td>
					<td>
						@if($historic->user_id_trasanction )
						{{ $historic->userReceiver->name }}
						@else
						-
						@endif

					</td>
				</tr>
				@endforeach 	
			</tbody>
		</table>
		@if (isset($dataForm))
		{!! $historics->appends($dataForm)->links() !!}
		@else
		{!! $historics->links() !!}
		@endif
	</div>

</div>

@stop