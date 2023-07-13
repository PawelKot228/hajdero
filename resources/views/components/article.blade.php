<div id="articles-{{$article->id}}" class="p-6 lg:p-8 bg-orange-200 border-b border-gray-200">
    <h1 class="text-2xl font-medium text-gray-900">
        {{$article->title}}
    </h1>
    by <span class="text-indigo-700">{{$article->user->name}}</span><br>
    <span class="text-gray-500">{{$article->created_at->diffForHumans()}}</span>
    @if($show && !$article->is_published)
        <form method="GET" class="mt-1" action="{{ route('articles.publish', [$article]) }}">
            @csrf
            <x-button class="bg-cyan-500">
                {{ __('Publish') }}
            </x-button>
        </form>
    @endif
    @if($article->user_id === auth()->id())
        <form method="POST" class="mt-1" action="{{ route('articles.destroy', [$article]) }}">
            @csrf
            @method('DELETE')
            <x-button class="bg-red-500">
                {{ __('Remove') }}
            </x-button>
        </form>
    @endif
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
    @if($article->cover)
        <div class="md:col-span-3 lg:col-span-1 md:col-span-2">
            <img src="{{asset('storage/'.$article->cover)}}" alt="image">
        </div>
    @endif

    <div class="md:col-span-1 lg:col-span-3 md:col-span-2">
        <x-like :object="$article" type="articles"/>
        &ensp;
        <div class="inline-flex items-center text-green-700">
            @svg('heroicon-o-chat', 'h-6 w-6') <b>{{$article->comments_count}}</b>
        </div>
        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            {{$article->text}}
        </p>
        @if(!$show)
            <p class="mt-4 text-sm">
                <a href="{{route('articles.show', [$article])}}"
                   class="inline-flex items-center font-semibold text-indigo-700">
                    Read more

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-5 h-5 fill-indigo-500">
                        <path fill-rule="evenodd"
                              d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                              clip-rule="evenodd"/>
                    </svg>
                </a>
            </p>
        @endif
    </div>
</div>
