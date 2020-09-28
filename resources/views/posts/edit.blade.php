@extends('layouts.app')

@section('title')

@section('content')
     <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    
                  @include('alert')
                         
                <div class="card-header">Update Post : {{$post->title}}</div>

                    <div class="card-body">
                        <form action="/Post/{{$post->slug}}/edit" method="post" enctype="multipart/form-data">
                            @method("patch")
                            @csrf
                           @include('posts.Forms.Form')
                        </form>
                    </div>

                </div>

            </div>

        </div>

     </div>
@endsection