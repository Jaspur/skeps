@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="large-10 large-centered small-12 columns">
			<h2>{{$article->title}}</h2>
			<p><small><abbr title="{{$article->published_at}}">{{$niceDate}}</abbr></small> | <small>Geschreven door: {{$article->user->name}}</small></p>
			<p>{{$article->content}}</p>
			<blockquote>
				{{$article->quote}}
				<cite>{{$article->user->name}}</cite>
			</blockquote>
			@if (!is_null($article->main_picture))
				<img class="large-4 small-12 columns" src="{{$article->main_picture}}" title="{{$article->title}}" />
			@endif
		</div>
	</div>
@endsection
