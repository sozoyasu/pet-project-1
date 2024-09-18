@extends('web.layouts.master')

@section('content')
    <h1>{{ $post->title }}</h1>
    <div>{!! $post->detail_text !!}</div>
@endsection
