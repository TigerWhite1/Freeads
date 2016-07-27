@extends('layouts.app')
@section('content')
<h1>Message</h1>
<div class="container">
	{{ Form::open(array('route' => array('message.update', $id), 'class' => 'id')) }}
	<div>
		<div class="form-group">
			{{ Form::label('Objet') }}
			{{ Form::text('objet', null, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Content') }}
			{{ Form::textarea('content', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

		{{ Form::close() }}
	</div>
</div>
@endsection('content')