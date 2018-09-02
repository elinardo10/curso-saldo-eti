@if(Session::has('msgsuccess'))
	
	<div class="alert alert-success" role="alert">
		<strong>Tudo pronto!</strong> {{ Session::get('msgsuccess') }}
	</div>

@endif

@if ($errors->any())
    <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif