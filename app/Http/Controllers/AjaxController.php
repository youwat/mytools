<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;


class AjaxController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Tool Top
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogAction()
    {
        // 末尾からの読み取り行数を取得する
        $num = Input::get('line');
        return $num;
    }
}
