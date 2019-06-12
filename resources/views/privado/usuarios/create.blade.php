@extends('layout.main')

@section('css')
<style>
	.select2-container--default .select2-selection--multiple .select2-selection__choice{
		background-color: #040404;
	}
</style>
@endsection

@section('content-header')
    <h1>
        Usuarios
        <small>Creación de usuarios</small>
    </h1>
@endsection

@section('content')
<div class="row">
	<form action="{{ route('usuarios.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						Datos Personales
					</h3>
				</div>
				<div class="box-body">
						<div class="form-group {{$errors->has('first_name') ? ' has-error' : ''}}">
							<label for="first_name">Nombres:</label>
							<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required="required">
							@if ($errors->has('first_name'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('first_name') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('last_name') ? ' has-error' : ''}}">
							<label for="last_name">Apellidos:</label>
							<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required="required">
							@if ($errors->has('last_name'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('last_name') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('dni') ? ' has-error' : ''}}">
							<label for="dni">DNI:</label>
							<input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required="required" maxlength="8" minlength="8">
							@if ($errors->has('dni'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('dni') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
							<label for="email">Email:</label>
							<input type="email" name="email" class="form-control" value="{{ old('email') }}" required="required">
							@if ($errors->has('email'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('email') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('estado') ? ' has-error' : ''}}">
							<label for="estado">Estado:</label>
							<select name="estado" class="form-control">
								@foreach (['Activo','No activo'] as $value)
								    <option value="{{ $value }}" {{ old('estado')==$value ? 'selected':'' }}>{{ $value }}</option>
								@endforeach
							</select>
							@if ($errors->has('estado'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('estado') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('clave') ? ' has-error' : ''}}">
							<label for="password">Clave:</label>
							<input type="password" name="password" class="form-control" placeholder="Ingrese su clave" required="required">
							@if ($errors->has('clave'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('clave') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('clave') ? ' has-error' : ''}}">
							<label for="password_confirmation">Confirmar clave:</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Ingrese su clave" required="required">
							@if ($errors->has('clave'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('clave') }}</strong>
			                    </span>
			                @endif
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						Roles
					</h3>
				</div>
				<div class="box-body">
					@include('privado.usuarios.roles',['model'=>$usuario])
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						Permisos adicionales
					</h3>
				</div>
				<div class="box-body">
					@include('privado.usuarios.permissions',['model'=>$usuario])
				</div>
			</div>
			<button class="btn btn-primary btn-block">Registrar usuario</button>
			<a class="btn btn-primary btn-block" href="{{ route('usuarios.index') }}">Volver</a>
		</div>
	</form>
</div>
@endsection

@section('js')
<script>
	$('.select2').select2();
</script>
@endsection