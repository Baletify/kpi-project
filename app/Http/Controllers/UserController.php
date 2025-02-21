<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{


    public function index(Request $request)
    {
        $department = $request->query('department');
        $status = $request->query('status');

        $deptList = DB::table('departments')->get();
        $statusList = DB::table('employees')->select('status')->distinct()->get();
        $query = DB::table('employees')->where('is_active', 1);

        $response = Http::get('http://192.168.99.202/absen/public/api/user');
        $allUsers = [];
        if ($response->status() == 200) {
            $allUsers = $response->json();

            $allUsers = array_map(function ($user) {
                return [
                    'departemen' => $user['dept'] ?? '',
                    'name' => $user['name'] ?? '',
                    'nik' => $user['nik'] ?? '',
                    'status' => $user['status'] ?? '',
                    'grade' => $user['grade'] ?? '',
                    'jabatan' => $user['jabatan'] ?? '',
                    'email' => $user['email'] ?? '',
                ];
            }, $allUsers['user']);
        }

        // dd($allUsers);

        // Paginate external users
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20; // Number of items per page
        $currentItems = array_slice($allUsers, ($currentPage - 1) * $perPage, $perPage);
        $externalUsersPaginated = new LengthAwarePaginator($currentItems, count($allUsers), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('users.list-user', ['title' => 'Employees', 'desc' => 'Master Employee', 'users' => $externalUsersPaginated, 'deptList' => $deptList, 'statusList' => $statusList]);
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
            'phone' => $request->phone,
        ]);

        return redirect()->route('user.index')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $user = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->where('employees.id', $id)->select('departments.*', 'employees.*', 'employees.id as employee_id', 'departments.name as department', 'departments.id as department_id')->first();
        $statusList = DB::table('employees')->select('status')->distinct()->get();
        $deptList = DB::table('departments')->get();

        return view('users.edit-user', ['title' => 'Employees', 'desc' => 'Edit Employee', 'user' => $user, 'statusList' => $statusList, 'deptList' => $deptList]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nik' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'department_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Please fill all the fields.');
        }

        $data = [
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'department_id' => $request->department_id,
            'status' => $request->status,
            'occupation' => $request->occupation,
            'grade' => $request->grade,
            'input_type' => $request->input_type,
            'role' => $request->role,
            'phone' => $request->phone,
        ];

        // Check if password is provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        Employee::where('id', $id)->update($data);

        return redirect()->route('user.index')->with('success', 'Employee updated successfully.');
    }

    public function softDelete($id)
    {
        Employee::where('id', $id)->update(['is_active' => 0]);

        return redirect()->route('user.index')->with('success', 'Employee deleted successfully.');
    }
}
