<div class=" bg-zinc-700 text-zinc-50">
    <div class="max-w-7xl mx-auto p-8">
        <h2 class="font-semibold text-4xl text-teal-400 mb-8">Most popular articles</h2>

        <div class="grid grid-cols-3 gap-8 ">
            @foreach($articles as $article)
                <div class="rounded-lg hover:bg-zinc-600 p-2">
                    <h2 class="line-clamp-1 font-semibold mb-4 text-xl">{{$article->title}}</h2>
                    <p class="line-clamp-2 pr-16">{{$article->content}}</p>
                </div>
            @endforeach
        </div>

    </div>
</div>
