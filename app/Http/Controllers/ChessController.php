<?php

namespace App\Http\Controllers;

use App\Chess\Knight\DepthFirstKnight;
use App\Chess\Knight\BreadthFirstKnight;

class ChessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function depthFirstKnight(DepthFirstKnight $knight)
    {
        $knight->navigate();
    }

    public function breadthFirstKnight(BreadthFirstKnight $knight)
    {
        $knight->navigate();
    }
}
