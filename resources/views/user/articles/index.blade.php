<x-site-layout>

    <a href="{{route('user.articles.create')}}">create article</a>

    <ul class="list-disc pl-4">
        @foreach($articles as $article)
            <li>
                {{$article->title}}
                <a href="{{route('user.articles.edit', $article)}}">edit</a>
            </li>
        @endforeach
    </ul>

</x-site-layout>
