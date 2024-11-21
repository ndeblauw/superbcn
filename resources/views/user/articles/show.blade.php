<x-site-layout title="{{$article->title}}">

    <img src="{{$article->media->first()->getUrl('preview')}}">

    {{$article->content}}
</x-site-layout>
