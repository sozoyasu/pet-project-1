@extends('web.layouts.master')

@section('content')
    @foreach($posts as $post)
        @include('web.blog.short', ['post' => $post])
    @endforeach
@endsection
