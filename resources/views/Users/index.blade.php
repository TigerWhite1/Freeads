@extends('layouts.app')
@section('content')

<h1>All Users</h1>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Password</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $users->name }}</td>
            <td>{{ $users->password }}</td>
            <td>{{ $users->email }}</td>
            <td>{{ link_to_route('users.edit', 'Edit', array($users->id), array('class' => 'btn btn-info')) }}</td>
            <td>
              {{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $users->id))) }}                       
              {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
              {{ Form::close() }}
          </td>
      </tr>
  </tbody>

</table>
@endsection('content')


{{-- @stop --}}