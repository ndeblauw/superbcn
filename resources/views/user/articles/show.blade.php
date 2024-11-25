<x-site-layout title="{{$article->title}}">

    <div>by {{$article->author->name}}</div>

    <div>@foreach($article->categories as $category) {{$category->title}} @endforeach</div>

    @if($article->media->first() !== null)
        <img src="{{$article->media->first()->getUrl('preview')}}">
    @else
        <img src="{{asset('images/default.webp')}}"/>
    @endif

    {!! $article->content !!}
</x-site-layout>
