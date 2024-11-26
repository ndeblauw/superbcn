<x-site-layout title="{{$article->title}}">

    <div class="max-w-4xl mx-auto">
        <p class="text-xl">
            {!! $article->getContent() !!}
        </p>

    </div>



</x-site-layout>

