<div id="comments-{{$comment->id}}" class="p-6 lg:p-8 bg-green-200 border-b border-gray-300">
    <h1 class="text-2xl font-medium text-black">
        {{$comment->user->name}}
    </h1>
    <span class="text-gray-500">{{$comment->created_at->diffForHumans()}}</span>
    @if($comment->user_id === auth()->id())
        <form method="POST" class="mt-1" action="{{ route('comments.destroy', [$comment]) }}">
            @csrf
            @method('DELETE')
            <x-button class="bg-red-500">
                {{ __('Remove') }}
            </x-button>
        </form>
    @endif
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="md:col-span-1 lg:col-span-3 md:col-span-2">
        <div class="inline-flex items-center text-pink-700">
            @auth
                <form method="POST" class="mt-1" action="{{ route('likes.store') }}">
                    @csrf
                    <button>
                        <input type="hidden" name="type" value="comments">
                        <input type="hidden" name="parent_id" value="{{$comment->id}}">
                        @if($comment->user_likes)
                            <input type="hidden" name="mode" value="0">
                            @svg('heroicon-s-thumb-up', 'h-6 w-6')
                        @else
                            <input type="hidden" name="mode" value="1">
                            @svg('heroicon-o-thumb-up', 'h-6 w-6')
                        @endif
                    </button>
                </form>
            @endauth
            @guest
                @svg('heroicon-o-thumb-up', 'h-6 w-6')
            @endguest
            <b>{{$comment->likes_count}}</b>
        </div>
        &ensp;
        <div class="inline-flex items-center text-green-700">
            @svg('heroicon-o-chat', 'h-6 w-6') <b>{{$comment->subcomments_count}}</b>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            {{$comment->text}}
        </p>
    </div>
</div>
@auth
    <div class="{{$comment->subcomments_count ? 'pt-12' : 'py-12'}} bg-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-gray-200 bg-opacity-25 grid grid- cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <div>
                            <x-label for="text" value="{{ __('Comment') }}"/>
                            <x-textarea name="text" id="text" required></x-textarea>
                            <x-input-error for="text"/>
                            <input type="hidden" name="type" value="comment">
                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
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
@endauth
@foreach($comment->subcomments as $subcomment)
    <div id="comments-{{$subcomment->id}}" class="pt-12 {{$loop->last ? 'pb-12' : ''}} bg-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-green-100 border-b border-gray-200">
                    <h1 class="text-2xl font-medium text-black">
                        {{$subcomment->user->name}}
                    </h1>
                    <span class="text-gray-500">{{$comment->created_at->diffForHumans()}}</span>
                    @if($subcomment->user_id === auth()->id())
                        <form method="POST" class="mt-1" action="{{ route('comments.destroy', [$subcomment]) }}">
                            @csrf
                            @method('DELETE')
                            <x-button class="bg-red-500">
                                {{ __('Remove') }}
                            </x-button>
                        </form>
                    @endif
                </div>
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div class="md:col-span-1 lg:col-span-3 md:col-span-2">
                        <div class="inline-flex items-center text-pink-700">
                            @auth
                                <form method="POST" class="mt-1" action="{{ route('likes.store') }}">
                                    @csrf
                                    <button>
                                        <input type="hidden" name="type" value="comments">
                                        <input type="hidden" name="parent_id" value="{{$subcomment->id}}">
                                        @if($subcomment->user_likes)
                                            <input type="hidden" name="mode" value="0">
                                            @svg('heroicon-s-thumb-up', 'h-6 w-6')
                                        @else
                                            <input type="hidden" name="mode" value="1">
                                            @svg('heroicon-o-thumb-up', 'h-6 w-6')
                                        @endif
                                    </button>
                                </form>
                            @endauth
                            @guest
                                @svg('heroicon-o-thumb-up', 'h-6 w-6')
                            @endguest
                            <b>{{$subcomment->likes_count}}</b>
                        </div>
                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            {{$subcomment->text}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
