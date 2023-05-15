<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$post = DB::select("SELECT * FROM posts WHERE id = ?",[1]);
        //  $posts = DB::table('posts')->get();
       // dd($post);
       // return view('blog.index',compact('posts'));
        $posts = Post::all();
        //dd($posts);
        return view('blog.index',[
            'posts'=> $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' =>  'required|unique:posts|max:255',
            'excerpt' =>  'required',
            'body' =>  'required',
            'image' => [
                'required', 'mimes:jpg,png,jpeg', 'max:5048'
            ],
            'min_to_read' =>  'min:0|max:60',
        ]);
        //dd($request->all());
        /* first method
        $post = new Post();
        $post->title = $request->title;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->image_path = 'temporary';
        $post->is_published = $request->is_published === "on";
        $post->min_to_read = $request->min_to_read;
            $post->save();
        */
        //second method
            Post::create([
               'title' =>  $request->title,
                'excerpt' =>  $request->excerpt,
                'body' =>  $request->body,
                'image_path' =>  $this->storeImg($request),
                'is_published' =>  $request->is_published === "on",
                'min_to_read' =>  $request->min_to_read,
            ]);


        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singlePost = Post::find($id);

        return view('blog.show', [
            'post' => $singlePost
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function storeImg($request){
        $newImageName = uniqid() .'-'.$request->title.'.'.$request->image->extension();
        return $request->image->move(public_path('images'),$newImageName);
    }
}
