@extends('install.layout')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading text-center">Opciones del Sistema</div>
	<div class="panel-body">

		<form action="{{ url('install/finish') }}" method="post" autocomplete="off">
			{{ csrf_field() }}
			
			@if ($errors->any())
				<div class="alert alert-danger alert-dismissible">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					@foreach ($errors->all() as $error)
					   <p>{{ $error }}</p>
					@endforeach
				</div>
			@endif

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">Nombre del aplicativo</label>						
				<input type="text" class="form-control" name="app_name" value="{{ old('app_name') }}" required>
			  </div>
			</div>
			
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">Siglas del aplicativo (Solo 3)</label>						
				<input type="text" class="form-control" name="app_sigla" value="{{ old('app_sigla') }}" required>
			  </div>
			</div>
			
			<div class="col-md-12">
				<button type="submit" id="next-button" class="btn btn-install">Finalizar</button>
		    </div>
		</form>

	</div>
</div>
@endsection

