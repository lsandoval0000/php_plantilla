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
        Roles
        <small>Nuevo rol</small>
    </h1>
@endsection

@section('content')
<div class="row">
	<form action="{{ route('roles.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">
						Datos del rol
					</h3>
				</div>
				<div class="box-body">
					<div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
						<label for="name">Nombre:</label>
						<input type="text" name="name" class="form-control" value="{{ old('name') }}" required="required">
						@if ($errors->has('name'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('name') }}</strong>
		                    </span>
		                @endif
					</div>
					<div class="form-group {{$errors->has('permissions') ? ' has-error' : ''}}">
						@include('privado.usuarios.permissions',['model'=>$role])
						@if ($errors->has('permissions'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('permissions') }}</strong>
		                    </span>
		                @endif
					</div>
				</div>
			</div>
			<button class="btn btn-primary btn-block">Registrar rol</button>
			<a class="btn btn-primary btn-block" href="{{ route('roles.index') }}">Volver</a>
		</div>
	</form>
</div>
@endsection

@section('js')
<script>
	$('.select2').select2();
</script>
@endsection