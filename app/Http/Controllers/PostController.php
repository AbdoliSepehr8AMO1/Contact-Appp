<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // show the latest post and limit it with a paginate/max of 5posts
    public function index()
    {
        return PostResource::collection(Post::latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    // if you want to store a thing it has to require the following information
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]);


        $post = new Post();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug($request->title) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/posts');
            $imagePath = $destinationPath . "/" . $name;
            $image->move($destinationPath, $name);
            $post->image = $name;
        }

        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->price = $request->price;
        $post->save();

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */


    // apply the array in the postresoruce
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */



    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'price' => 'required',
        ]);

        // yoou can only update the title and the body and then return the updated version
        $post->update($request->only(['title', 'body' ,'price']));
        return new PostResource($post);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */

    // destroy method to delete a post
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }


    // a method that is performed on the landing page
    public function all()
    {
        $posts = Post::latest()->paginate(5);
        return view('landing', compact('posts'));
    }

    public function single(Post $post)
    {
        return view('single', compact('post'));
    }
}
