@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            
            @auth                
                <form action="{{ route('post') }}" method="post" enctype="multipart/form-data" class="mb-4">
                    @csrf

                    <div class="panel-body"> 
                        <div class="col-md-8">    

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                        <img src="{{asset('images')}}/{{ Session::get('image') }}" width="300" height="300">
                        @endif
                    
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                            <div class="row"> 
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control">
                                </div>      
                            </div>
                        </div>    
                    </div>



                    {{-- title --}}
                    <div class="focus:underline">
                        <label for="title" class="sr-only">Title</label>
                        <input type="text" class="bg-gray-100 
                        border-2 w-1/4 p-4 rounded-lg" name="title" placeholder="Title" ">
                        @error('title')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- body --}}
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 
                        border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" 
                        placeholder="Post something!"></textarea>

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                    </div>
                </form>
            @endauth

            @if ($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
            
        </div>

    </div>
@endsection


