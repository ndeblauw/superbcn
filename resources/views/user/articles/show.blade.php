<x-site-layout title="{{$article->title}}">

    <img src="{{$article->media->first()->getUrl()}}">

    {{$article->content}}
</x-site-layout>
