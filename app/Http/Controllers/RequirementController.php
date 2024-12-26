<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KpiRequirement;
use Illuminate\Support\Facades\Validator;

class RequirementController extends Controller
{
    public function index()
    {
        $data = KpiRequirement::orderBy('created_at', 'desc')->get();

        return response()->json($data);
    }

    public function create()
    {
        return view('kpi-requirement.create-requirement', ['title' => 'Index Requirement', 'desc' => 'KPI Requirement']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            flash()->error('Only accept .pdf format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('file')) {
            $recordFile = $request->file('file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('kpi_requirement_files'), $recordFileName);
        }

        KpiRequirement::create(
            [
                'file' => $recordFileName,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'KPI Requirement has been added');
    }
}
