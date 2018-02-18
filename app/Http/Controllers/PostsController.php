<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Likes;
use App\Comment;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    public function index()
    {
        //$posts = Post::all();
        $posts = Post::orderBy('id','desc')->get();
        
        return view('post')->with('posts',$posts);
    }

    public function myposts()
    {
        //$posts = Post::all();
        $user_id = auth()->user()->id;
        $user=User::find($user_id);
        
        return view('post')->with('posts',$user->posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_pic' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_pic'))
        {
            //Get the file name with extension
            $fileNameWithExt=$request->file('cover_pic')->getClientOriginalName();

            //Get just the file name
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);

            //Get just the extension
            $extension = pathinfo($fileNameWithExt,PATHINFO_EXTENSION);

            //File name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //Upload Pic
            $path=$request->file('cover_pic')->storeAs('public/cover_pics',$fileNameToStore);
        }
        else
        {
            $fileNameToStore='noimage.jpg';
        }

        $post = new Post();
        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->author =auth()->user()->name;
        $post->user_id = auth()->user()->id;
        $post->cover_pic = $fileNameToStore;
        
        //return $post;

        $post->save();
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        
        $comments=Comment::where('post_id',$id)->orderBy('id','desc')->get();

        return view('post_single')->with('post',$post)->with('comments',$comments);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);

        if(auth()->user()->id!=$post->user_id){
            return redirect('posts')->with('error','Unauthorized Post');
        }
        else{
            return view('post_edit')->with('post',$post);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_pic' => 'image|nullable|max:1999'
        ]);

        $post = Post::find($id);
        
        if($request->hasFile('cover_pic'))
        {
            //Get the file name with extension
            $fileNameWithExt=$request->file('cover_pic')->getClientOriginalName();

            //Get just the file name
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);

            //Get just the extension
            $extension = pathinfo($fileNameWithExt,PATHINFO_EXTENSION);

            //File name to Store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //Delete previous file and Upload Pic
            Storage::delete('public/cover_pics/'.$post->cover_pic);
            $path=$request->file('cover_pic')->storeAs('public/cover_pics',$fileNameToStore);
        }

        

        if(auth()->user()->id!=$post->user_id)
            return redirect('posts')->with('error','Unauthorized Post');

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_pic'))
        {
            $post->cover_pic=$fileNameToStore;
        }
        
        $post->save();
        return redirect("/posts");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);


        if(auth()->user()->id!=$post->user_id){
            return redirect('posts')->with('error','Unauthorized Post');
        }

        if($post->cover_pic!='noimage.jpg')
        {
            Storage::delete('public/cover_pics/'.$post->cover_pic);
        }

        $post->delete();

        return redirect('/posts');
    }


    public function addLike($post_id)
    {
        $like_master = Likes::where([
            ['post_id','=',$post_id],
            ['user_id','=',auth()->user()->id]

        ])->get();

        

        //$like_count = count($like_master);

        if($like_master->isEmpty())
        {
            $like = new Likes();
            
            $like->post_id=$post_id;
            $like->user_id = auth()->user()->id;

            $like->save();
        }
        else
        {
            //although one record is present
            foreach($like_master as $like)
                Likes::destroy($like->id);

        }
        
        return redirect("/posts/$post_id");
    }

    
}
