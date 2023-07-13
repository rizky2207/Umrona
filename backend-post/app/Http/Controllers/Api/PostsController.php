<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $posts = Posts::all();

        if ($posts->count() > 0) {
            return response()->json([
                'status' => 200,
                'posts' => $posts
            ], 200);
        } else {
            return response()->json([
                'status'   => 404,
                'message'   => 'tidak ada data',
            ], 404);
        }
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors'   => $validator->messages()
            ], 422);
        } else {
            $post = Posts::create([
                'title'          => $request->title,
                'slug'           => Str::slug($request->title, '-'),
                'content'        => $request->content,
            ]);
        }
        if ($post) {
            return response()->json([
                'success' => true,
                'message'   => 'Posts success ditambahkan',
                'post' => $post
            ], 200);
        } else {
            //redirect dengan pesan error
            return response()->json([
                'success' => false,
                'message'   => 'data tidak berhasil ditambahkan',
                // 'post' => $post
            ], 500);
        }
    }


    public function show($slug)
    {
        $post = Posts::where('slug', $slug)->first();

        if ($post) {

            return response()->json([
                'success' => true,
                'message'   => 'Detail Data post',
                'post' => $post
            ], 200);
        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data post Tidak Ditemukan',
            ], 404);
        }
    }

    public function edit($id)
    {
        $post = Posts::find($id);
        if ($post) {

            return response()->json([
                'status' => 200,
                'message'   => 'Data post',
                'post' => $post
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message'   => 'Data post Tidak Ditemukan',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors'   => $validator->messages()
            ], 422);
        } else {
            $post = Posts::find($id);
            $post->update([
                'title'  => $request->title,
                'slug'  => $request->slug,
                'content' => $request->content,
            ]);
        }
        if ($post) {
            $post->update([
                'title'  => $request->title,
                'slug'           => Str::slug($request->title, '-'),
                'content' => $request->content,
            ]);
            return response()->json([
                'success' => true,
                'message'   => 'Posts success di update',
            ], 200);
        } else {
            //redirect dengan pesan error
            return response()->json([
                'success' => false,
                'message'   => 'data tidak berhasil ditambahkan',
                // 'post' => $post
            ], 404);
        }
    }

    public function destroy($id)
    {
        $post = Posts::find($id);

        if ($post) {
            $post->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'post berhasil di hapus'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'post gagal di hapus'
            ], 404);
        }
    }
}
