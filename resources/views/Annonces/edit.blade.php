@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Edit {{ $users->name }}</h1>

	<!-- if there are creation errors, they will show here -->
	{{-- {{ HTML::ul($errors->all()) }} --}}

	{{ Form::model($users, array('route' => array('annonces.update', $users->id), 'method' => 'PUT', 'files' => true)) }}

	<div class="form-group">
		{{ Form::label('title', 'title') }}
		{{ Form::text('title', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'description') }}
		{{ Form::textarea('description', null, array('class' => 'form-control')) }}
	</div>

	<div class="control-group">
		<div class="controls">
			{!! Form::file('images[]', array('multiple'=>true)) !!}
			<p class="errors">{!!$errors->first('images')!!}</p>
			@if(Session::has('error'))
			<p class="errors">{!! Session::get('error') !!}</p>
			@endif
		</div>
	</div>
	<div class="form-group">
		{{ Form::label('price') }}
		{{ Form::number('price', null, array('class' => 'form-control')) }}
	</div>
	<div class="control-group">
		<div class="controls">
			{{ Form::label('Catégories') }}
			{{ Form::select('categorie', [
				'1' => 'multimedia',
				'2' => 'vehicules',
				'3' => 'vacances',
				'4' => 'loisirs',
				'5' => 'maison',
				'6' => 'emploi',
				]) }}
			</div>
		</div>
		<br/>
		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

		{{ Form::close() }}
		@endsection('content')
	</div>
</body>

