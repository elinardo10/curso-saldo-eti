<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SistemaController extends Controller
{
    public function index(){

    return view('sistema.index');
    }
}
