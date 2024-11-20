<x-site-layout title="Create new article">

    <form action="{{route('user.articles.store')}}" method="post" class="w-2/3 border border-gray-300 p-4">
        @csrf

        <x-form-text name="title" label="Title" placeholder="Please make it catchy" />
        <x-form-textarea name="content" label="Your great post" placeholder="Make sure to have more than 1 paragraph"/>
        <x-form-checkboxes name="categories" label="Categories" :options="\App\Models\Category::orderBy('title')->pluck('title', 'id')->toArray()" />

        <div>
            <a href="{{route('user.articles.index')}}">Undo</a>
            <button type="submit">Create article</button>

        </div>
    </form>

</x-site-layout>

