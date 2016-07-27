@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    {{ link_to('annonces', 'Annonces', $attributes = array(), $secure = null) }}
                    {{ link_to('users', ' | Mon compte', $attributes = array(), $secure = null) }}
                    {{ link_to('message', ' | Message', $attributes = array(), $secure = null) }}
                    {{ link_to('admin', ' | Admin', $attributes = array(), $secure = null) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
