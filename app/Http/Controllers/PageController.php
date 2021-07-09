<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function Index()
    {
        return view('pages.trangchu');
    }

    public function Loaisanpham()
    {
        return view('pages.loaisanpham');
    }

    public function ChitietSP()
    {
        return view('pages.chitiet_sanpham');
    }

    public function Lienhe()
    {
        return view('pages.lienhe');
    }

    public function Gioithieu()
    {
        return view('pages.gioithieu');
    }
}
