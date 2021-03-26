<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classes;

class ClassController extends Controller
{
    public function index()
    {
        try {
            $classes = Classes::all();
            return response([
                'data' => $classes
            ]);
        } catch (\Exception $ex) {
            return response([
                'data' => '',
                'message' => $ex->getMessage()
            ]);
        }
    }


}
