<x-site-layout title="Articles list">

    @foreach($articles as $article)
        <div class="flex gap-x-4">
            <div class="w-20">
                @if($article->media->first() !== null)
                    <img src="{{$article->media->first()->getUrl('preview')}}">
                @else
                    <img src="{{asset('images/default.webp')}}"/>
                @endif
            </div>
            <div>
                <a href="{{route('articles.show', $article->slug)}}" class="mt-4">
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

            </div>

        </div>

    @endforeach

</x-site-layout>
