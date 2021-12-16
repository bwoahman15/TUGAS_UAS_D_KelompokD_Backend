<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Minuman;

class MinumanController extends Controller
{
    public function index()
    {
        $minumans = Minuman::all();

        if(count($minumans)>0)
        {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $minumans
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function show($id)
    {
        $minuman = Minuman::find($id);

        if(!is_null($minuman))
        {
            return response([
                'message' => 'Retrieve Minuman Success',
                'data' => $minuman
            ],200);
        }

        return response([
            'message' => 'Minuman Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'minuman' => 'required',
            'jumlah' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $minuman = Minuman::create($storeData);    
        return response([
            'message' => 'Add Minuman Success',
            'data' => $minuman
        ],200);
    }

    public function destroy($id)
    {
        $minuman = Minuman::find($id);

        if(is_null($minuman))
        {
            return response([
                'message' => 'minuman Not Found',
                'data' => null
            ],404);
        }

        if($minuman->delete())
        {
            return response([
                'message' => 'Delete Minuman Success',
                'data' => $minuman
            ],200);
        }

        return response([
            'message' => 'Delete minuman Failed',
            'data' => null
        ],400);
    }

    public function update(Request $request,$id)
    {
        $minuman = Minuman::find($id);
        if(is_null($minuman))
        {
            return response([
                'message' => 'Minuman Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'minuman' => 'required',
            'jumlah' => 'required'
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()],400);

        $minuman->minuman = $updateData['minuman'];
        $minuman->jumlah = $updateData['jumlah'];
      

        if($minuman->save())
        {
            return response([
                'message' => 'Update Minuman Success',
                'data' => $minuman
            ],200);
        }

        return response([
            'message' => 'Update Minuman Failed',
            'data' => null
        ],400);
    }
}
