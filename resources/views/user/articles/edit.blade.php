<x-site-layout title="Edit article">

    <form action="{{route('user.articles.update', $article)}}" method="post" class="w-2/3 border border-gray-300 p-4">
        @method('PUT')
        @csrf

        <x-form-text name="title" label="Title" value="{{$article->title}}"/>
        <x-form-textarea name="content" label="Your great post" value="{{$article->content}}" placeholder="Make sure to have more than 1 paragraph"/>

        <div class="w-full flex justify-end gap-x-8">
            <a href="{{route('user.articles.index')}}" class="text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 px-4 py-2 rounded uppercase">Undo</a>
            <button type="submit" class="text-xs text-green-700 bg-green-300 hover:bg-green-200 px-4 py-2 rounded uppercase">Save changes</button>
        </div>
    </form>

</x-site-layout>

