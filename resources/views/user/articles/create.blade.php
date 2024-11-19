<x-site-layout title="Create new article">

    <form action="{{route('user.articles.store')}}" method="post">
        @csrf

        <x-form-text name="title" label="Title" placeholder="Please make it catchy" />

        <br/><br/>

        <label for="content">Content</label><br/>
        <textarea name="content">{{old('content')}}</textarea>
        @error('content')<div class="text-red-500">{{$message}}</div> @enderror

        <br/><br/>

        <div>
            <a href="{{route('user.articles.index')}}">Undo</a>
            <button type="submit">Create article</button>

        </div>
    </form>

</x-site-layout>

