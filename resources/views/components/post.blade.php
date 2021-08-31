@props(['post' => $post])


<div>
    <a href="{{ route('users.posts', $post->user) }}" class="font-semibold">{{ 
        $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ 
        $post->created_at->diffForHumans() }}</span>
    <p class="italic font-bold text-3xl">{{ $post->title }}</p>
   
    @if ($post->image)
        @if( preg_match('/^https?:\/\//', $post->image))
            <td><img src="{{ $post->image }}" height="300" width="300" alt="" /></td>
        @else
            <td><img src="{{ Storage::url($post->image) }}" height="300" width="300" alt="" /></td>
        @endif
    @endif
    
    <p class="ArticleBody">
        {{ Str::substr(strip_tags($post->body),0, 200) }}
        @if (strlen(strip_tags($post->body)) > 1)
          ... <a href="{{ route('posts.show', $post->slug) }}" class="font-bold btn btn-info btn-sm">Read More</a>
        @else
            {!!$post->body!!}
        @endif
    </p>
    @if ($post->user == auth()->user())
        <a href="{{ route('posts.edit', $post->slug) }}" class="text-blue-500">Edit</a>
    @endif
    

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">Delete</button>
        </form>
    @endcan

    <div class="flex flex-col items-left">
        @auth
        <div class="flex flex-row items-left">
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
                    <button type="submit" class="text-red-500">Unlike</button>
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
                    <button type="submit" class="text-red-500">Undislike</button>
                </form>
            @endif
        </div>
            
            <div class="flex flex-row items-left">
                <div class="mr-8">
                    <span>{{ $post->likes->count() }} {{ Str::plural('like', 
                        $post->likes->count()) }}</span>
                    <span>{{ $post->dislikes->count() }} {{ Str::plural('dislike', 
                        $post->dislikes->count()) }}</span>
                </div>
            </div>

            <br>
            <div class="w-4/8 bg-white p-6 rounded-lg">                             
                @if ($post->comments->count())
                    @foreach ($post->comments as $comment)
                        <a href="{{ route('users.posts', $post->user) }}" class="font-semibold">{{ 
                            $comment->user->name }}</a> <span class="text-gray-600 text-sm">{{ 
                            $comment->created_at->diffForHumans() }}</span>

                        <p class="mb-2">{{ $comment->body }}</p>

                        @if ($comment->ownedBy(auth()->user()))
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete this comment</button>
                            </form>
                        @endif
                    @endforeach
                @endif
            </div>
        @endauth
    
        
        

    </div>
</div>