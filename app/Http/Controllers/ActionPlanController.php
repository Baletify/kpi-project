<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionPlanController extends Controller
{
    public function show()
    {

        return view('action-plan.action-plans', ['title' => 'Action Plan', 'desc' => 'Input Action Plan']);
    }
}
