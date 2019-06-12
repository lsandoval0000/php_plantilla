<div class="form-group">
	<select class="form-control select2" name="permissions[]" multiple="multiple" data-placeholder="Seleccione uno o más permisos" style="width: 100%;">
		@foreach ($permissions as $id => $name)
			<option value="{{ $name }}" {{ ($model->permissions->contains($id) or collect(old('permissions'))->contains($name)) ? 'selected':'' }}>
				{{ $name }}
			</option>
		@endforeach
	</select>
</div>