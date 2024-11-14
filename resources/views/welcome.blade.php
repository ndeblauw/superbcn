<x-site-layout title="super BCN blog">

    @foreach($articles as $article)
        <div class="mt-4">
            <h2 class="font-bold text-lg">{{$article->title}}</h2>
            <div>
                {{ $article->published_at->format('M d') }}
                |
                {{$article->author->name}} ({{$article->author->email}})
            </div>
            <p class="text-sm">{{ $article->summary(250) }}</p>

            <ul class="list-disc pl-4">
                @foreach($article->comments->take(3) as $comment)
                    <li>{{$comment->content}}</li>
                @endforeach
            </ul>
        </div>
    @endforeach


    hello class
</x-site-layout>
