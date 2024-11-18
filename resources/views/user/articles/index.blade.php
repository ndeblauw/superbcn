<x-site-layout>

    <a href="{{route('user.articles.create')}}">create article</a>

    @if(session()->has('success'))
        <div class="bg-green-100 text-green-500 p-2">
            {!! session()->get('success') !!}
        </div>
    @endif

    <ul class="list-disc pl-4">
        @foreach($articles as $article)
            <li>
                {{$article->title}}
                <a href="{{route('user.articles.edit', $article)}}">edit</a>
                <form action="{{route('user.articles.destroy', $article)}}" method="post">@method('delete')@csrf<button type="submit">delete</button></form>
            </li>
        @endforeach
    </ul>

</x-site-layout>
