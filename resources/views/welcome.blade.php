<x-site-layout title="super BCN blog">

    <x-quote/>

    <div class="grid grid-cols-2 gap-x-8">
    @foreach($articles as $article)
        <a href="{{route('articles.show',$article->id )}}" class="mt-4">
            <h2 class="font-bold text-lg">{{$article->title}}</h2>
            <div>
                {{ $article->published_at->format('Y-M-d') }}
                |
                {{$article->author?->name ?? 'Unknown'}}
            </div>
            <div>
                @foreach($article->categories as $category)
                    <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded-full text-xs">{{$category->title}}</span>
                @endforeach
            </div>


            <p class="text-sm">{{ $article->summary(250) }}</p>

            <ul class="list-disc pl-4">
                @foreach($article->comments->take(3) as $comment)
                    <li>{{$comment->content}}</li>
                @endforeach
            </ul>
        </a>
    @endforeach
    </div>

</x-site-layout>
