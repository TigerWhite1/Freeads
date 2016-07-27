@extends('layouts.app')
@section('content')
<h1>Stats par user:</h1>
{{ link_to('admin', 'Admin |', $attributes = array(), $secure = null) }}
{{ link_to('admin/hours', 'Hours', $attributes = array(), $secure = null) }}


<div class="container">
	{{ Form::open(array('url' => 'admin/jsonuser', 'class' => 'id')) }}
	<div>
		<div class="form-group">
		{{ Form::label('id') }}
			{{ Form::text('id', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

		{{ Form::close() }}
	</div>
</div>

<div style="width: 50%; margin: auto">
	<canvas id="buyers"></canvas>
</div>
@endsection('content')
<script type="text/javascript" src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ url('js/chart.js') }}"></script>
<script type="text/javascript" src="{{ url('js/graphuser.js') }}"></script>
