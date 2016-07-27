@extends('layouts.app')
@section('content')
<h1>Stats par catégories :</h1>

{{ link_to('admin/user', ' User |', $attributes = array(), $secure = null) }}
{{ link_to('admin/hours', 'Hours', $attributes = array(), $secure = null) }}
<div style="width: 80%; margin: auto">
		<canvas id="buyers"></canvas>
	</div>
@endsection('content')
<script type="text/javascript" src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/chart.js') }}"></script>
<script type="text/javascript" src="{{ url('js/graph.js') }}"></script>
