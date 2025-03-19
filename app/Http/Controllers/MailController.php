<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessEmail;
use App\Mail\PostMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // dd($request->all());
        $email = $request->email;
        $departmentID = $request->department_id;
        if ($email == '' || $email == 0) {
            $sendTo =  DB::table('employees')->where('department_id', '=', $departmentID)->where('role', '=', 'Inputer')->select('email')->first();
        } else {
            $sendTo = $email;
        }
        // dd($sendTo);

        $from = Auth::user()->name;
        $details = [
            'revised_by' => $from,
            'email' => $sendTo,
            'title' => 'Revisi Data Pendukung KPI',
            'greetings' => 'Dengan Hormat,',
            'msg' => 'Berdasarkan pengecekan yang kami lakukan terdapat perhitungan KPI dan data pendukung yang tidak sesuai, untuk itu segara hubungi personnel yang terkait dan segara siapkan data KPI dan data pendukung yang sesuai. Berikut ini adalah data yang perlu direvisi:',
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'comment' => $request->comment,
        ];

        // dd($details);

        ProcessEmail::dispatch($details);

        return back()->with('success', 'Email has been sent');
    }

    public function sendEmailDept(Request $request)
    {
        $from = Auth::user()->name;
        $departmentID = $request->department_id;
        $sendTo = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->where('employees.department_id', $departmentID)
            ->where('employees.occupation', '=', 'Asst Mng')
            ->select('employees.email')
            ->first();


        $details = [
            'revised_by' => $from,
            'email' => $sendTo,
            'title' => 'Revisi Data Pendukung KPI',
            'greetings' => 'Dengan Hormat,',
            'msg' => 'Berdasarkan pengecekan yang kami lakukan terdapat perhitungan KPI dan data pendukung yang tidak sesuai, untuk itu segara hubungi personnel yang terkait dan segara siapkan data KPI dan data pendukung yang sesuai. Berikut ini adalah data yang perlu direvisi:',
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'comment' => $request->comment,
        ];

        ProcessEmail::dispatch($details);

        return back()->with('success', 'Email has been sent');
    }
}
