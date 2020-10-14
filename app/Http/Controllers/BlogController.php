<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BlogCreatedEvent;
use App\Events\BlogPublishedEvent;
use Auth;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'body' => ['required'],
            'editor_id' => 'required',
        ]);

        $user = auth()->user();

        $blog = $user->blogs()->create([
            'title' => request('title'),
            'body' => request('body'),
            'editor_id' => request('editor_id'),
        ]);

        event(new BlogCreatedEvent($user, $blog));

        return $blog;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    public function published($id)
    {
        $blog = Blog::find($id);

        //dd($blog->user);

        $user = $blog->user;

        $blog->update(['publish_status' => 1]);

        event(new BlogPublishedEvent($user, $blog));

        return response('Blog berhasil dipublish');
    }
}
