@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div>
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }}and 
                received {{ $user->likes->count() }} likes</p>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }}and 
                received {{ $user->dislikes->count() }} dislikes</p>
            </div>

            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post :post="$post" />
                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p>{{ $user->name }} does not have any posts</p>
                @endif
            </div>
        </div>
    </div>
@endsection