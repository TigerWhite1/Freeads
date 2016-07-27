@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="container">
		<h1>Edit {{ $users->name }}</h1>

		<!-- if there are creation errors, they will show here -->
		{{-- {{ HTML::ul($errors->all()) }} --}}

		{{ Form::model($users, array('route' => array('users.update', $users->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('email', 'Email') }}
			{{ Form::email('email', null, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password') }}
			{{ Form::password('password', null, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password_confirmation') }}
			{{ Form::password('password_confirmation', null, array('class' => 'form-control')) }}
		</div>
		{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

		{{ Form::close() }}

	</div>
@endsection('content')

</body>
</html>