<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\curses;
use Illuminate\Http\Request;

class CursesController extends Controller
{
    public function index(){
        return Curses::all();
    }
}
