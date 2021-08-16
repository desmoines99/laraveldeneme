@props(['post' => $post])

<div>
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ 
        $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ 
        $post->created_at->diffForHumans() }}</span>
    
    <p class="mb-2">{{ $post->body }}</p>

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan

    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post->id) }}" method="post" 
                    class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
            @if (!$post->dislikedBy(auth()->user()))
                <form action="{{ route('posts.dislikes', $post->id) }}" method="post" 
                    class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Dislike</button>
                </form>
            @else
                <form action="{{ route('posts.dislikes', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Undislike</button>
                </form>
            @endif
            
            <div class="w-4/8 bg-white p-6 rounded-lg">               
                <form action="{{ route('posts.comments', $post->id) }}" method="post" class="mb-2">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 
                        border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" 
                        placeholder="Comment something!"></textarea>

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Comment</button>
                    </div>
                </form>

                @if ($post->comments->count())
                    @foreach ($post->comments as $comment)
                        <a href="{{ route('comments.show', $post->id) }}" class="font-bold">{{ 
                            $comment->user->name }}</a> <span class="text-gray-600 text-sm">{{ 
                            $comment->created_at->diffForHumans() }}</span>
                    @endforeach
                    
                    
                    
                    <p class="mb-2">{{ $comment->body }}</p>
                @endif
            </div>
        
            {{-- <a href="{{ route('users.comments', $comment->user) }}" class="font-bold">{{ 
                $comment->user->name }}</a> <span class="text-gray-600 text-sm">{{ 
                $comment->created_at->diffForHumans() }}</span> --}}


        @endauth

        <span>{{ $post->likes->count() }} {{ Str::plural('like', 
        $post->likes->count()) }}</span>
        <span>{{ $post->dislikes->count() }} {{ Str::plural('dislike', 
        $post->dislikes->count()) }}</span>

    </div>
</div>