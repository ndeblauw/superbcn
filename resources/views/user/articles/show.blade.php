<x-site-layout title="{{$article->title}}">

    <div>by {{$article->author->name}}</div>

    <div>@foreach($article->categories as $category) {{$category->title}} @endforeach</div>

    <img src="{{$article->media->first()->getUrl('preview')}}">

    {{$article->content}}
</x-site-layout>
