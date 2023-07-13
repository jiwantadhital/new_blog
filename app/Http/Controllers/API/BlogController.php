<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['Blog']=Blog::all();
        if ($data) {
            return response()->json([
                'message' => "Blog List",
                'data' => $data,
            ]);
        }
        else
            return response()->json([
                'message' => "No Blog Found",
            ],500);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $file = $request->file('image_file');
        if ($request->hasFile("image_file")) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/images/Blog/'), $fileName);
            $request->request->add(['image' => $fileName]);
        }
        $data['row']=Blog::create($request->all());
        if ($data) {
            return response()->json([
                'message' => "Blog Created Successfully",
                'data' => $data,
            ]);
        }
        else
            return response()->json([
                'message' => "Some Error Occured",
            ],500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['blog']=Blog::find($id);
        if (!$data['blog']) {
            return response()->json([
                'message' => "Blog not found",

            ],404);
        }
        else
            return response()->json([
                'message' => "Singe Blog",
                'data'=>$data
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['blog']=Blog::find($id);
        if ($data) {
            return response()->json([
                'message' => "Singe Blog",
                'data' => $data,
            ]);
        }
        else
            return response()->json([
                'message' => "Some Error Occured",
            ],500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file = $request->file('image_file');
        if ($request->hasFile("image_file")) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/images/Blog/'), $fileName);
            $request->request->add(['image' => $fileName]);
        }

        $data['row'] =Blog::find($id);
        if(!$data ['row']){
            return response()->json([
                'message' => "Blog not found",
            ],404);
        }
        if ($data['row']->update($request->all())) {
            return response()->json([
                'message' => "Blog Updated ",
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'message' => "Update failed",
            ],404);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data['blog'] = Blog::findorfail($id);

        if (!$data['blog']) {
            return response()->json([
                'message' => "Blog not found",
            ], 404);
        }

        $data['blog']->delete();

        return response()->json([
            'message' => "Blog deleted successfully",
        ]);
    }
}
