<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "PEWIRA (Pemantauan Wilayah Izin Pertambangan)",
        ];

        //check if user login or not
        if (auth()->check()) {
            return view('index', $data);
        } else {
            return view('index-public', $data);
        }
    }

    public function table()
    {
        $data = [
            "title" => "Table",
        ];

        return view('table', $data);
    }
}
