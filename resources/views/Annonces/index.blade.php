@extends('layouts.app')
@section('content')
{{ link_to_route('annonces.create', 'ADD')}}
{{-- <img src="/var/www/html/freeads/picture/jpeg_compression_result.jpg" class="coupon-img img-rounded"> --}}
@foreach ($annonces as $annonce)
</tr>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default coupon">
			<div class="panel-heading" id="head">
				<div class="panel-title" id="title">
					<td>{{ link_to_route('message.edit', 'Email', array($annonce->user_id), array('class' => 'btn btn-info edit')) }}</td>
					@if($annonce->user_id == $data)
					<td>{{ link_to_route('annonces.edit', 'Edit', array($annonce->id), array('class' => 'btn btn-info edit')) }}</td>

					<td>
						{{ Form::open(array('method'=> 'DELETE', 'route' => array('annonces.destroy', $annonce->id))) }}                       
						{{ Form::submit('Delete', array('class' => 'btn btn-danger delete')) }}
						{{ Form::close() }}
					</td>
					@endif					<span class="hidden-xs">{{ $annonce->title }}</span>
					<span class="visible-xs">{{ $annonce->title }}</span>
				</div>
			</div>
			<div class="panel-body">
				{!! $annonce->picture !!}
				<div class="col-md-9">
					<p class="items">
						{{ $annonce->description }}
					</p>
				</div>
				<div class="col-md-3">
					<div class="offer">
						<span class="number">{{ $annonce->price }}</span>
						<span class="usd"><sup>€</sup></span>

					</div>
				</div>
			</div>
			<div class="panel-footer">
				<div class="coupon-code">
					<span class="print">
						<div class="exp">Update :{{ $annonce->updated_at }}</div>
					</span>
				</div>
				<div class="exp">Created :{{ $annonce->created_at }}</div>
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection('content')
