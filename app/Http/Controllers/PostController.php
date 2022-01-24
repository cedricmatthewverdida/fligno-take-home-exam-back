<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Helpers\APIHelper;
use Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = post::all();
        $response = APIHelper::APIResponse(false,200,'',$post);
        return response()->json($response,200);
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
    public function store(Request $request)
    {
        $post = new post();
        $post->title = $request->title;
        $post->body = $request->body;

        try{    
            $savePost = $post->save();

            if($savePost){
                $response = APIHelper::APIResponse(false,200,'Success',null);
                return response()->json($response,200);
            }else{
                $response = APIHelper::APIResponse(true,'Failed',null);
                return response()->json($response,400);
            }
        }catch(Exception $e){
            $response = APIHelper::APIResponse(true,'Failed known error occured',null);
            return response()->json($response,400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::find($id);
        if(empty($post)){
            $response = APIHelper::APIResponse(true,200,'Cannot find ',$post);
            return response()->json($response,200);
        }else{
            $response = APIHelper::APIResponse(false,200,'',$post);
            return response()->json($response,200);
        }
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
        $post = post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;

        try{    
            $saveUpdate = $post->save();

            if($saveUpdate){
                $response = APIHelper::APIResponse(false,200,'Success',null);
                return response()->json($response,200);
            }else{
                $response = APIHelper::APIResponse(true,'Failed',null);
                return response()->json($response,400);
            }
        }catch(Exception $e){
            $response = APIHelper::APIResponse(true,'Failed known error occured',null);
            return response()->json($response,400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= post::find($id);
        $deletePost = $post->delete();

        if($deletePost){
            $response = APIHelper::APIResponse(false,200,'Success',null);
            return response()->json($response,200);
        }else{
            $response = APIHelper::APIResponse(true,'Failed',null);
            return response()->json($response,400);
        }
    }
}
