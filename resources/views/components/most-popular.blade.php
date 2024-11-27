<div class="max-w-7xl mx-auto grid grid-cols-3 gap-8 p-8 bg-zinc-700 text-zinc-50">
    @foreach($articles as $article)
        <div>
            {{$article->title}}
        </div>
    @endforeach
</div>
