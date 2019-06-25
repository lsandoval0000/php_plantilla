@extends('install.layout')

@section('content')

<div class="panel panel-default">
  <div class="panel-heading text-center">Base de Datos</div>
	<div class="panel-body">
	   <div class="col-md-12">
			@if (session()->has('error'))
			  <div class="alert alert-danger">
				<p>{{ session('error') }}</p>
			  </div>
			  <br />
			@endif
		   <form action="{{ url('install/process_install') }}" method="post" autocomplete="off">
			   {{ csrf_field() }}
			  <div class="form-group">
				<label>Servidor:</label>
				<input type="text" class="form-control" value="localhost" name="hostname" id="hostname">
			  </div>
			  
			  <div class="form-group">
				<label>Base de datos:</label>
				<input type="text" class="form-control" name="database" id="database">
			  </div>
			  
			  <div class="form-group">
				<label>Usuario:</label>
				<input type="text" class="form-control" name="username" id="username">
			  </div>
			  
			  <div class="form-group">
				<label>Clave:</label>
				<input type="password" class="form-control" name="password">
			  </div>
			  <button type="submit" id="next-button" class="btn btn-install">Siguiente</button>
		   </form>
	   </div>
	</div>
</div>
@endsection

@section('js-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#next-button').attr('disabled', true);

            $('#hostname, #username, #database').keyup(function() {
                inputCheck();
            });
        });

        function inputCheck() {
            hostname = $('#hostname').val();
            username = $('#username').val();
            database = $('#database').val();

            if (hostname != '' && username != '' && database != '') {
                $('#next-button').attr('disabled', false);
            } else {
                $('#next-button').attr('disabled', true);
            }
        }
    </script>
@stop
