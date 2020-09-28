@extends('layouts.app')

@section('content')
       
    <div class="container">  
        <div class ="d-flex justify-content-between">
            @if ($posts->count()==0)
                    <div class="alert alert-info">
                        There are no post
                    </div>

                </div>
                @if (Auth::check())
                    <div><a href="/Post/create" class="btn btn-primary">CreatePost</a></div>
                @else
                <div><a href="{{route('login')}}" class="btn btn-primary">Login</a></div>
                @endif
            @else 
                <div>  
                    @isset($category)
                    <h4>Category : {{$category->name}}</h4>
                    @endisset

                    @isset($tag)
                    <h4>Tag : #{{$tag->name}}</h4>    
                    @endisset
                    
                    @if(!isset($category) && !isset($tag))
                    <h4>All Posts</h4>    
                    @endif
                    
                    </div>
                    @if (Auth::check())
                        <div><a href="/Post/create" class="btn btn-primary">CreatePost</a></div>
                    @else
                    <div><a href="{{route('login')}}" class="btn btn-primary">Login</a></div>
                    @endif
                    
                </div>
               
                <br>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif

                <div class="row">   
               
                @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-4">
                       
                        @if ($post->thumbnail)
                            <img style="height:270px; object-fit:cover; object-position:center" class="card-img-top" src="{{ asset($post->takeImage) }}" alt="">
                        @endif
                    
                            <div class="card-body">
                                <div class="card-title">
                                    {{$post->title}}
                                </div>

                                {{ Str::Limit($post->body,100)}}
                                
                                <div>
                                    <a href="/Post/{{$post->slug}}">Read more</a>
                                </div>
                            </div>
                        <div class="card-footer d-flex justify-content-between">
                            Published on : {{$post->created_at->diffForHumans()}}
                            @can('update', $post)
                                 <a href="/Post/{{$post->slug}}/edit" class="btn btn-sm btn btn-success">Edit</a>    
                            @endcan
                        </div>
                </div>
            </div>
                @endforeach 
                @endif  
            </div> 
       </div>
        <div style="margin-left: 200px">  {{$posts->links()}} </div>
       
    </div>   
    
@endsection