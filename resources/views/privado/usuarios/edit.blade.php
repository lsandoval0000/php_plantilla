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
        Usuario
        <small>{{ Auth::user()->getFullName() }}</small>
    </h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						Datos Personales
					</h3>
				</div>
				<div class="box-body">
					<form action="{{ route('usuarios.update', $usuario) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="form-group {{$errors->has('first_name') ? ' has-error' : ''}}">
							<label for="first_name">Nombres:</label>
							<input type="text" name="first_name" class="form-control" value="{{ old('first_name',$usuario->first_name) }}" required="required">
							@if ($errors->has('first_name'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('first_name') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('last_name') ? ' has-error' : ''}}">
							<label for="last_name">Apellidos:</label>
							<input type="text" name="last_name" class="form-control" value="{{ old('last_name',$usuario->last_name) }}" required="required">
							@if ($errors->has('last_name'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('last_name') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('dni') ? ' has-error' : ''}}">
							<label for="dni">DNI:</label>
							<input type="text" name="dni" class="form-control" value="{{ old('dni',$usuario->dni) }}" required="required" maxlength="8" minlength="8">
							@if ($errors->has('dni'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('dni') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
							<label for="email">Email:</label>
							<input type="email" name="email" class="form-control" value="{{ old('email',$usuario->email) }}" required="required">
							@if ($errors->has('email'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('email') }}</strong>
			                    </span>
			                @endif
						</div>
						@can('Editar usuarios')
							<div class="form-group {{$errors->has('estado') ? ' has-error' : ''}}">
								<label for="estado">Estado:</label>
								<select name="estado" class="form-control">
									@foreach (['Activo','No activo'] as $value)
									    <option value="{{ $value }}"
									    @if ($value == old('estado', $usuario->estado))
									        selected="selected"
									    @endif
									    >{{ $value }}</option>
									@endforeach
								</select>
								@if ($errors->has('estado'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('estado') }}</strong>
				                    </span>
				                @endif
							</div>
						@endcan
						<div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
							<label for="password">Clave:</label>
							<input type="password" name="password" class="form-control" placeholder="Ingrese su clave">
							<span class="help-block text-red">Dejar en blanco si no quieres cambiar la clave.</span>
							@if ($errors->has('password'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('password') }}</strong>
			                    </span>
			                @endif
						</div>
						<div class="form-group {{$errors->has('password') ? ' has-error' : ''}}">
							<label for="password_confirmation">Confirmar clave:</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Ingrese su clave">
							@if ($errors->has('password'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('password') }}</strong>
			                    </span>
			                @endif
						</div>
						<button class="btn btn-primary btn-block">Actualizar datos de usuario</button>
					</form>
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
					@can('Modificar usuarios')
						<form action="{{ route('usuarios.roles.update', $usuario) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							@include('privado.usuarios.roles',['model'=>$usuario])
							<button class="btn btn-primary btn-block">Actualizar roles</button>
						</form>
					@else
						<ul class="list-group">
							@forelse ($usuario->roles as $role)
								<li class="list-group-item">{{ $role->name }}</li>
							@empty
								<li class="list-group-item">No tiene roles asignados</li>
							@endforelse
						</ul>
					@endcan
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						Permisos adicionales
					</h3>
				</div>
				<div class="box-body">
					@can('Modificar usuarios')
						<form action="{{ route('usuarios.permissions.update', $usuario) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							@include('privado.usuarios.permissions',['model'=>$usuario])
							<button class="btn btn-primary btn-block">Actualizar Permisos</button>
						</form>
					@else
						<ul class="list-group">
							@forelse ($usuario->permissions as $permission)
								<li class="list-group-item">{{ $permission->name }}</li>
							@empty
								<li class="list-group-item">No tiene permisos adicionales asignados</li>
							@endforelse
						</ul>
					@endcan
				</div>
			</div>
			<a class="btn btn-primary btn-block" href="{{ route('usuarios.index') }}">Volver</a>
		</div>
	</div>
@endsection

@section('js')
<script>
	$('.select2').select2()
</script>
@endsection