<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\category;
use App\Helpers\APIHelper;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = category::all();
        $response = APIHelper::APIResponse(false,200,'',$category);
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
        $category = new category();

        $category->name = $request->name;

        try{
            $saveCategory = $category->save();

            if($saveCategory){
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
        $category = category::find($id);
        if(empty($category)){
            $response = APIHelper::APIResponse(true,200,'Cannot find ',$category);
            return response()->json($response,200);
        }else{
            $response = APIHelper::APIResponse(false,200,'',$category);
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


        $category = category::find($id);

        $category->name = $request->name;

        try{
            $saveCategory = $category->save();

            if($saveCategory){
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
        $category = category::find($id);
        $deleteCategory = $category->delete();

        if($deleteCategory){
            $response = APIHelper::APIResponse(false,200,'Success',null);
            return response()->json($response,200);
        }else{
            $response = APIHelper::APIResponse(true,'Failed',null);
            return response()->json($response,400);
        }
    }
}
