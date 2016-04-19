@extends('layouts.app')

@section('content')
	<div class="row">
		@foreach ($articles as $article)
			<div class="large-6 small-12 columns article-box">
				<h3><a href="{{url('/articles', $article->slug)}}" title="{{$article->title}}">{{$article->title}}</a></h3>
				<p><small>{{$article->published_at}}</small></p>
				<p>{{str_limit($article->content, $limit = 150, $end = '...')}} </p>
				<p><a class="button" title="Lees {{$article->title}} verder" href="{{url('/articles', $article->slug)}}">Lees meer</a></p>
			</div>
		@endforeach
	</div>
@endsection