<?php

namespace App\Http\Controllers\ParamanentData;

use App\Http\Controllers\Controller;
use App\Models\ParamanentData\CursePageData;
use Illuminate\Http\Request;

class CursePageDataController extends Controller
{
    public function show($cursName){
        $data = CursePageData::where('cursName', $cursName)->first();

        if ($data && $data->firstImge) {
            $data->image = 'data:image/jpeg;base64,' . base64_encode($data->image);
        }

        return response()->json($data);
    }
}
