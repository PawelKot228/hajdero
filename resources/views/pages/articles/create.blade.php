<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create an article') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                        <div class="md:col-span-1 lg:col-span-4 md:col-span-2">
                            <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <x-label for="title" value="{{ __('Title') }}"/>
                                    <x-input id="title" name="title" class="block mt-1 w-full" type="text" required/>
                                    <x-input-error for="title" class="mt-2"/>
                                </div>

                                <div class="mt-2">
                                    <x-label for="text" value="{{ __('Text') }}"/>
                                    <x-textarea id="text" name="text" required></x-textarea>
                                    <x-input-error for="text"/>
                                </div>

                                <div class="mt-2">
                                    <x-label for="is_published" value="{{ __('Publish') }}"/>
                                    <x-checkbox id="is_published" name="is_published" value="1"/>
                                </div>

                                <div class="mt-2">
                                    <x-label for="images[]" value="{{ __('Images') }}"/>
                                    <input type="file" name="images[]" multiple/>
                                </div>

                                <div class="mt-2">
                                    <x-label for="cover" value="{{ __('Cover') }}"/>
                                    <input type="file" name="cover"/>
                                </div>

                                <div class="flex justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Confirm') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
