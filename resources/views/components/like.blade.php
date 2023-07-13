<div class="inline-flex items-center text-pink-700">
    @auth
        <form method="POST" class="mt-1" action="{{ route('likes.store') }}">
            @csrf
            <button>
                <input type="hidden" name="type" value="{{$type}}">
                <input type="hidden" name="parent_id" value="{{$object->id}}">
                @if($object->user_likes)
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
    <b>{{$object->likes_count}}</b>
</div>
