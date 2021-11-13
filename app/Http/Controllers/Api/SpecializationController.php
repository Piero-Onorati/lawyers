<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Specialization;

class SpecializationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $specializations = Specialization::all();
        
        return response()->json([
            'success' => true,
            'results' => $specializations
        ]);
    }

}
