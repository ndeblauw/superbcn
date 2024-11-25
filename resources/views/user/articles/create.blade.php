<x-site-layout title="Create new article">

    <form action="{{route('user.articles.store')}}" method="post" class="w-2/3 border border-gray-300 p-4">
        @csrf

        <x-form-text name="title" label="Title" placeholder="Please make it catchy" />
        <x-form-textarea name="content" :rte="true" label="Your great post" placeholder="Make sure to have more than 1 paragraph"/>
        <x-form-checkboxes name="categories" label="Categories" :options="\App\Models\Category::orderBy('title')->pluck('title', 'id')->toArray()" />

        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.articles.index')}}" class="text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded uppercase">Undo</a>
            <button type="submit" class="text-xs text-green-700 bg-green-300 hover:bg-green-200 px-4 py-2 rounded uppercase">Create article</button>
        </div>
    </form>

</x-site-layout>

