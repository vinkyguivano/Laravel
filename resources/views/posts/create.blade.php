@extends('layouts.app')

@section('title')

@section('content')
     <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    @include('alert')
                    <div class="card-header">CreatePost</div>

                    <div class="card-body">
                       
                        <form action="/Post/store" method="post" enctype="multipart/form-data">
                            @csrf
                           @include('posts.Forms.Form',['submit' => 'create'])

                        </form>
                    </div>

                </div>

            </div>

        </div>

     </div>
@endsection