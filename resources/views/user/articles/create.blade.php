<x-site-layout title="Create new article">

    <form action="{{route('user.articles.store')}}" method="post">
        @csrf

        <label for="title">Title</label><br/>
        <input name="title" value="{{old('title')}}">

        <br/><br/>

        <label for="content">Content</label><br/>
        <textarea name="content">{{old('content')}}</textarea>

        <br/><br/>

        <div>
            <a href="{{route('user.articles.index')}}">Undo</a>
            <button type="submit">Create article</button>

        </div>
    </form>

</x-site-layout>

