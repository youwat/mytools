<?php
namespace App\Http\Controllers\Controller;
use App\Http\Controllers\Controller;

class helloController extends Controller
{
    public function goodmorning($message)
    {
        return view('hello');
    }
}
