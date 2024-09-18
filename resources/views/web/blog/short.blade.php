@php /** @var $post \App\Models\BlogPost */ @endphp

<div>
    <h3>{{ $post->title }}</h3>
    <div>{{ $post->short_text }}</div>
    <div><a href="{{ route('blog.show', [$post->slug]) }}">Подробнее</a></div>
</div>
