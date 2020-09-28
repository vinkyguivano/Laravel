<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("auth")->except([
    //         'index','show',
    //     ]);
    // }

    public function index()
    {   
        $posts = Post::latest()->Paginate(6);
        return view('posts.index',['posts'=>$posts]);
    }

    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    public function create()
    {
        return view('posts.create',[
            "post"=> new Post(),
            "category"=> Category::get(),
            "tag"=> Tag::get()
            ]);
    }

    public function store()
    {
        $post = request()->validate([
                    'title' => 'required|min:3',
                    'body' => 'required',
                    'category' => 'required',
                    'tags' => 'array|required',  
                    'thumbnail' => 'image|mimes: jpeg,png,jpg,svg|max:2048'
        ]);

        $slug = \Str::slug(request('title'));
        $post['slug'] = $slug;
        
        $thumbnail = request()->file('thumbnail')? request()->file('thumbnail')->store("images/posts"): null; 
   
        
        $post['category_id'] = request('category'); 
        $post['thumbnail'] = $thumbnail;

        $newPost = auth()->user()->posts()->create($post);

        $newPost->tags()->attach(\request('tags'));


        session()->flash('success','The post was created');

        return \redirect()->to("/Post");
    }

    public function edit(Post $post)
    {
        return view('posts.edit',[
            'post' => $post,
            "category"=> Category::get(),
            "tag"=> Tag::get()
        ]);
    }

    public function update(Post $post)
    {
        $this->authorize('update',$post);
        
        if(request()->file('thumbnail'))
        {
            Storage::delete($post->thumbnail);
            $thumbnail =  request()->file('thumbnail')->store("images/posts"); 
        }else{
            $thumbnail = $post->thumbnail;
        }
        

        $new = request()->validate([
            'title' => 'required|min:3',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        
        $new['category_id'] = request('category');
        $new['thumbnail'] = $thumbnail;
        $post->update($new);

        $post->tags()->sync(\request('tags'));

        session()->flash('success','The post was updated');

        return \redirect()->to("/Post");
    }

    public function destroy(Post $post)
    { 
            $this->authorize('delete',$post);
            Storage::delete($post->thumbnail);
            $post->tags()->detach();
            $post->delete(); 
            Session()->flash('success',"The post was deleted");
            return redirect()->to("/Post");
    }
}
