<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $department = $request->query('department');
        $status = $request->query('status');

        $deptList = DB::table('departments')->get();
        $statusList = DB::table('employees')->select('status')->distinct()->get();
        $query = DB::table('employees')->where('is_active', 1);
        if ($department && $status) {
            $users = $query->where('department_id', $department)->where('status', $status)->paginate(20);
        } elseif ($department) {
            $users = $query->where('department_id', $department)->paginate(20);
        } elseif ($status) {
            $users = $query->where('status', $status)->paginate(20);
        } else {
            $users = $query->paginate(20);
        }

        return view('users.list-user', ['title' => 'Employees', 'desc' => 'Master Employee', 'users' => $users, 'deptList' => $deptList, 'statusList' => $statusList]);
    }

    public function create()
    {
        $statusList = DB::table('employees')->select('status')->distinct()->get();
        $deptList = DB::table('departments')->get();

        return view('users.create-user', ['title' => 'Employees', 'desc' => 'Create Employee', 'statusList' => $statusList, 'deptList' => $deptList]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nik' => 'required',
            'email' => 'required',
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please fill all the fields.');
        }

        $hashedPassword = Hash::make($request->password);
        // dd($hashedPassword);

        Employee::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => $hashedPassword,
            'department_id' => $request->department_id,
            'status' => $request->status,
            'occupation' => $request->occupation,
            'grade' => $request->grade,
            'input_type' => $request->input_type,
            'role' => $request->role,
            'is_active' => 1,
        ]);

        return redirect()->route('user.index')->with('success', 'Employee created successfully.');
    }

    public function softDelete($id)
    {
        Employee::where('id', $id)->update(['is_active' => 0]);

        return redirect()->route('user.index')->with('success', 'Employee deleted successfully.');
    }
}
