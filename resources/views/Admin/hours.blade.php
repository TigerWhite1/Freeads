@extends('layouts.app')
@section('content')
<h1>Stats par catégorie et heures:</h1>
{{ link_to('admin', 'Admin |', $attributes = array(), $secure = null) }}
{{ link_to('admin/user', 'User', $attributes = array(), $secure = null) }}

<div class="container">
	{{ Form::open(array('url' => 'admin/jsonhours', 'class' => 'id')) }}
	<div>
		<div class="form-group">
			{{ Form::label('Date') }}
			{{Form::date('date', \Carbon\Carbon::now(), array('class' => 'test')) }}
		</div>
		<div class="form-group">
		{{ Form::label('Catégories') }}
			{{ Form::text('genre', null, array('class' => 'form-control genre')) }}
		</div>

		{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

		{{ Form::close() }}
	</div>
</div>

<div style="width: 70%; margin: auto">
	<canvas id="buyers"></canvas>
</div>
@endsection('content')
<script type="text/javascript" src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ url('js/chart.js') }}"></script>
<script type="text/javascript" src="{{ url('js/graphhours.js') }}"></script>
