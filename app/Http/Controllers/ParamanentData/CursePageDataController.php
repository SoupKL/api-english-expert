<?php

namespace App\Http\Controllers\ParamanentData;

use App\Http\Controllers\Controller;
use App\Models\ParamanentData\CursePageData;
use Illuminate\Http\Request;

class CursePageDataController extends Controller
{
    public function show($cursName){
        return CursePageData::where('cursName', $cursName)->first();
    }
}
