<x-site-layout>

    <form action="{{route('user.articles.update', $article)}}" method="post">
        @method('PUT')
        @csrf

        <label for="title">Title</label><br/>
        <input name="title" value="{{old('title', $article->title)}}">

        <br/><br/>

        <label for="content">Content</label><br/>
        <textarea name="content">{{old('content', $article->content)}}</textarea>

        <br/><br/>

        <div>
            <a href="{{route('user.articles.index')}}">Undo</a>
            <button type="submit">Save changes</button>

        </div>
    </form>

</x-site-layout>

