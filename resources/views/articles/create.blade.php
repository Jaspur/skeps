@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="large-10 small-12 columns large-centered">
			<h2>Nieuw artikel</h2>
			@include('errors.list')

			{!! Form::open(['url' => 'articles', 'files' => true]) !!}
				@include('articles._form', ['submitButtonText' => 'Opslaan'])	
			{!! Form::close() !!}
		</div>
	</div>
@endsection