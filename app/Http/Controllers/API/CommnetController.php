<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Commnet;
use Illuminate\Http\Request;

class CommnetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CommentRequest $request)
    {

        $data['row']=Commnet::create($request->all());
        if ($data) {
            return response()->json([
                'message' => "Comment Successfully",
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
