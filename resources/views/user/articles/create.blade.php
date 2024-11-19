<x-site-layout title="Create new article">

    <form action="{{route('user.articles.store')}}" method="post">
        @csrf

        <x-form-text name="title" label="Title" placeholder="Please make it catchy" />
        <x-form-textarea name="content" label="Your great post" placeholder="Make sure to have more than 1 paragraph"/>
        
        <div>
            <a href="{{route('user.articles.index')}}">Undo</a>
            <button type="submit">Create article</button>

        </div>
    </form>

</x-site-layout>

