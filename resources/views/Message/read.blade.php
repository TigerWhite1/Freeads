@extends('layouts.app')
@section('content')
<h1>Read</h1>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Expediteur</th>
			<th>Objet</th>
			<th>Message</th>
			<th>Date</th>
			<th>Lus</th>
			<th>Reponsse</th>
			<th>Delete</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($messages as $message)
		<tr>
			<td>{{$message->name }}</td>
			<td>{{$message->objet }}</td>
			<td>{{$message->content }}</td>
			<td>{{$message->created_at }}</td>

			@if ($message->email_read == 1)
			<td>				
				{{ Form::open(array('method' => 'PUT', 'url' => array('message/read',$message->email_id))) }}                       
				{{ Form::submit('Marquer comme lus', array('class' => 'btn btn-sucsess')) }}
				{{ Form::close() }}
				</td>
			@else
			<td>Message lus</td>
			@endif
			<td>{{ link_to_route('message.edit', 'Répondre', array($message->user_id_exp), array('class' => 'btn btn-info')) }}</td>
				<td>
					{{ Form::open(array('method' => 'DELETE', 'route' => array('message.destroy',$message->email_id))) }}                       
					{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>


	</table>


	@endsection('content')