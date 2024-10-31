<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionPlanController extends Controller
{
    public function index()
    {
        return view('action-plan', ['title' => 'Action Plan', 'desc' => 'Input Action Plan']);
    }
}
