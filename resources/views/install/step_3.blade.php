@extends('install.layout')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading text-center">Datos de Administrador</div>
	<div class="panel-body">
	   <div class="col-md-12">
	        @if ($errors->any())
				<div class="alert alert-danger alert-dismissible">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					@foreach ($errors->all() as $error)
					   <p>{{ $error }}</p>
					@endforeach
				</div>
			@endif
		    <form action="{{ url('install/store_user') }}" method="post" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Nombres</label>
					<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>				
				</div>

				<div class="form-group">
					<label>Apellidos</label>
					<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>				
				</div>
				
				<div class="form-group">
					<label>DNI</label>
					<input type="text" class="form-control" name="dni" value="{{ old('dni') }}" required>				
				</div>
				
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="{{ old('email') }}" required>	
				</div>
				
				<div class="form-group">
					<label>Clave</label>
					<input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
				</div>
				<div class="form-group">
					<label>Repertir clave</label>
					<input type="password" class="form-control" name="password_confirmation" required>
				</div>

			    <button type="submit" id="next-button" class="btn btn-install">Siguiente</button>
		    </form>
	   </div>
	</div>
</div>
@endsection
