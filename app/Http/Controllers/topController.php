<?php
/**
 * Created by PhpStorm.
 * User: Yu
 * Date: 2015/11/09
 * Time: 16:43
 */
namespace App\Http\Controllers\Controller;
use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function index()
    {
        return view('top');
    }
}