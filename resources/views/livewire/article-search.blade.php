<div>
    <input type="text" wire:model.live="search"  class="border border-gray-300 p-2 w-full" placeholder="Search articles...">

    <ul>
        @foreach($articles as $article)
            <li>{{$article->title}}</li>
        @endforeach

    </ul>


</div>
