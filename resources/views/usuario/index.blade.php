@extends('layouts.admin')
<!--
<?php $message=Session::get('message')?>

@if($message == 'store')
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Usuario creado exito
</div>

@endif
-->
@include('alerts.success')
@section('content')

<table class="table">
	<thead>
		<th>Nombre</th>
		<th>Correo</th>
		<th>Operaciones</th>
	</thead>
	@foreach ($users as $user)
	<tbody>
		<td>{{$user->name}}</td>
		<td>{{$user->email}}</td>
		<td>
{!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $user->id, $attributes = ['class'=>'btn btn-
			primary'])!!}
		</td>
	</tbody>
@endforeach
</table>

{!! $users->render() !!}
@endsection
