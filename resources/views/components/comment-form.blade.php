<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <div>
                    <x-label for="text" value="{{ __('Comment') }}"/>
                    <x-textarea name="text" id="text" required></x-textarea>
                    <x-input-error for="text"/>
                    <input type="hidden" name="type" value="{{$parentType}}">
                    <input type="hidden" name="parent_id" value="{{$parentId}}">
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
