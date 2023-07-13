<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="bg-none max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                {!! $articles->links() !!}
            </div>
        </div>
    </div>

    @foreach($articles as $article)
        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-article :article="$article" :show="false"/>
                </div>
            </div>
        </div>
    @endforeach

    <div class="py-12">
        <div class="bg-none max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                {!! $articles->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
