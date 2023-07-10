<div class="p-6 lg:p-8 bg-green-200 border-b border-gray-300">
    <h1 class="text-2xl font-medium text-black">
        {{$comment->user->name}}
    </h1>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="md:col-span-1 lg:col-span-3 md:col-span-2">
        <div class="inline-flex items-center text-pink-700">
            @svg('heroicon-o-thumb-up', 'h-6 w-6') <b>{{$comment->likes_count}}</b>
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
@foreach($comment->subcomments as $subcomment)
    <div class="pt-12 {{$loop->last ? 'pb-12' : ''}} bg-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-green-100 border-b border-gray-200">
                    <h1 class="text-2xl font-medium text-black">
                        {{$subcomment->user->name}}
                    </h1>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div class="md:col-span-1 lg:col-span-3 md:col-span-2">
                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                            {{$subcomment->text}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@auth
    <div class="{{$comment->subcomments_count ? 'pb-12' : 'py-12'}} bg-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div class="md:col-span-1 lg:col-span-3 md:col-span-2">
                        <textarea style="height: 100%; width: 100%; resize: none"></textarea>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add sub comment
                    </button>
                </div>
            </div>
        </div>
    </div>
@endauth
