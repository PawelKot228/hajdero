<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-article :article="$article" :more="false"/>
            </div>
        </div>
    </div>

    @auth
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                        <div class="md:col-span-1 lg:col-span-3 md:col-span-2">
                            <textarea style="width: 100%; resize: none"></textarea>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add comment
                        </button>
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
