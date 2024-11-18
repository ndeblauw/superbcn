<x-site-layout>

    <a href="{{route('user.articles.create')}}">create article</a>

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
