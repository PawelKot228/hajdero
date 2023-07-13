<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-article :article="$article" :show="true"/>
            </div>
        </div>
    </div>
    @if($article->images->count())
        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-pink-200 border-b border-gray-200">
                        <h1 class="text-2xl font-medium text-gray-900">
                            Gallery
                        </h1>
                    </div>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                            @foreach($article->images as $image)
                                <img class="w-full" src="{{asset('storage/'.$image->image)}}" alt="image">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @auth
        <div class="pt-12">
            <div class="bg-gray-100">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                            <form method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <div>
                                    <x-label for="text" value="{{ __('Comment') }}"/>
                                    <x-textarea name="text" id="text" required></x-textarea>
                                    <x-input-error for="text"/>
                                    <input type="hidden" name="type" value="article">
                                    <input type="hidden" name="parent_id" value="{{$article->id}}">
                                </div>
                                <div class="flex justify-end">
                                    <x-button>
                                        {{ __('Comment') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    @foreach($article->comments as $comment)
        <div class="pt-12 {{$loop->last ? 'pb-12' : ''}}">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-comment :comment="$comment"/>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
