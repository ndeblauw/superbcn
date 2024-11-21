<x-site-layout title="Edit article">

    <form action="{{route('user.articles.update', $article)}}" method="post" class="w-2/3 border border-gray-300 p-4" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <x-form-text name="title" label="Title" value="{{$article->title}}"/>
        <x-form-textarea name="content" label="Your great post" value="{{$article->content}}" placeholder="Make sure to have more than 1 paragraph"/>
        <x-form-select name="author_id" label="Author" value="{{$article->author_id}}" :options="\App\Models\User::pluck('name', 'id')->toArray()" />
        <x-form-checkboxes name="categories" label="Categories" :options="\App\Models\Category::orderBy('title')->pluck('title', 'id')->toArray()" :values="$article->categories->pluck('id')->toArray()" />

        <input type="file" name="image">
        @php $name='image'; @endphp
        @include('components.form._form-error-handling');


        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.articles.index')}}" class="text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded uppercase">Undo</a>
            <button type="submit" class="text-xs text-green-700 bg-green-300 hover:bg-green-200 px-4 py-2 rounded uppercase">Save changes</button>
        </div>
    </form>

</x-site-layout>

