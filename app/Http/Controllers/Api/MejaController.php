<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Meja;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::all();

        if(count($mejas)>0)
        {
            return response([
                'message' => 'Retrieve All Success',
                'data' => $mejas
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function show($id)
    {
        $meja = Meja::find($id);

        if(!is_null($meja))
        {
            return response([
                'message' => 'Retrieve Meja Success',
                'data' => $meja
            ],200);
        }

        return response([
            'message' => 'Meja Not Found',
            'data' => null
        ],404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'no_meja' => 'required',
            'tanggal_reservasi' => 'required',
            'jam_reservasi' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $meja = Meja::create($storeData);    
        return response([
            'message' => 'Add Meja Success',
            'data' => $meja
        ],200);
    }

    public function destroy($id)
    {
        $meja = Meja::find($id);

        if(is_null($meja))
        {
            return response([
                'message' => 'meja Not Found',
                'data' => null
            ],404);
        }

        if($meja->delete())
        {
            return response([
                'message' => 'Delete Meja Success',
                'data' => $meja
            ],200);
        }

        return response([
            'message' => 'Delete Meja Failed',
            'data' => null
        ],400);
    }

    public function update(Request $request,$id)
    {
        $meja = Meja::find($id);
        if(is_null($meja))
        {
            return response([
                'message' => 'Meja Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'no_meja' => 'required',
            'tanggal_reservasi' => 'required',
            'jam_reservasi' => 'required'
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()],400);

        $meja->no_meja = $updateData['no_meja'];
        $meja->tanggal_reservasi = $updateData['tanggal_reservasi'];
        $meja->jam_reservasi = $updateData['jam_reservasi'];
      

        if($meja->save())
        {
            return response([
                'message' => 'Update Meja Success',
                'data' => $meja
            ],200);
        }

        return response([
            'message' => 'Update Meja Failed',
            'data' => null
        ],400);
    }
}
