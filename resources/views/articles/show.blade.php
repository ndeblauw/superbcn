<x-site-layout title="{{$article->title}}">

    <div class="max-w-4xl mx-auto">

        @if(session()->has('purchase_id'))
            <livewire:article-purchase-component :purchase_id="session()->get('purchase_id')"/>
        @endif

        <div class="bg-red-100 p-4 my-4">
            Support our author {{$article->author->name}}, buy this article
            @auth
                <a class="bg-red-200 p-2 rounded text-red-800" href="{{route('articles.buy', ['slug' => $article->slug, 'amount' => 5])}}">BUY NOW FOR 5 EUR</a>
                <a class="bg-red-200 p-2 rounded text-red-800" href="{{route('articles.buy', ['slug' => $article->slug, 'amount' => 10])}}">BUY NOW FOR 10 EUR</a>
            @endauth
            @guest
                <a class="bg-red-200 p-2 rounded text-red-800" href="{{route('login')}}">LOG IN to be able to buy</a>

            @endguest
        </div>

            <div>by {{$article->author->name}}</div>

            <div>@foreach($article->categories as $category) {{$category->title}} @endforeach</div>

            @if($article->media->first() !== null)
                <img src="{{$article->media->first()->getUrl('preview')}}">
            @else
                <img src="{{asset('images/default.webp')}}"/>
            @endif

        <p class="text-xl">
            {!! $article->getContent() !!}
        </p>

    </div>



</x-site-layout>

