<x-site-layout>

    <ul class="list-disc pl-4">
        @foreach($articles as $article)
            <li>
                {{$article->title}}
            </li>
        @endforeach
    </ul>

</x-site-layout>
