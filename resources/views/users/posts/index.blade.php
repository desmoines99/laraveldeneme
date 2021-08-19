@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div>
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and 
                received {{ $user->likes->count() }} likes {{ $user->dislikes->count() }} dislike</p>
                
            </div>

            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post)
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
                                            <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ 
                                                $comment->user->name }}</a> <span class="text-gray-600 text-sm">{{ 
                                                $comment->created_at->diffForHumans() }}</span>
                    
                                            <p class="mb-2">{{ $comment->body }}</p>
                    
                                            @if ($comment->ownedBy(auth()->user()))
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-blue-500">Delete this comment</button>
                                                </form>
                                            @endif
                                        @endforeach
                                        
                                        
                                        
                                        
                                    @endif
                                </div>
                            
                                {{-- <a href="{{ route('users.comments', $comment->user) }}" class="font-bold">{{ 
                                    $comment->user->name }}</a> <span class="text-gray-600 text-sm">{{ 
                                    $comment->created_at->diffForHumans() }}</span> --}}
                    
                    
                            @endauth
                    
                            
                    
                        </div>
                    </div>
                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p>{{ $user->name }} does not have any posts</p>
                @endif
            </div>
        </div>
    </div>
@endsection