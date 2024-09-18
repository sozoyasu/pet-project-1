@extends('web.layouts.master')

@section('content')
    <h1>{{ $category->title }}</h1>

    @foreach($posts as $post)
        @include('web.blog.short', ['post' => $post])
    @endforeach
@endsection
