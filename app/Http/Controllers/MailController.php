<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use App\Models\Actual;
use App\Jobs\ProcessEmail;
use Illuminate\Http\Request;
use App\Mail\ReminderInputMail;
use App\Jobs\ReminderInputEmail;
use App\Models\DepartmentActual;
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
        $emailBy = Auth::user()->email;
        $details = [
            'revised_by' => $from,
            'email_by' => $emailBy,
            'email' => $sendTo,
            'title' => 'Revisi Data Pendukung KPI',
            'greetings' => 'Dengan Hormat,',
            'msg' => 'Berdasarkan pengecekan yang kami lakukan terdapat perhitungan KPI dan data pendukung yang tidak sesuai, untuk itu segera hubungi personnel yang terkait dan segara siapkan data KPI dan data pendukung yang sesuai. Berikut ini adalah data yang perlu direvisi:',
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'comment' => $request->comment,
            'request' => 'Segera lakukan perbaikan dan upload data yang sesuai (maksimal 3 hari setelah email ini)',
            'closing' => 'Terima kasih atas perhatian dan kerjasamanya.',
        ];

        // dd($details);

        Actual::where('id', $request->actual_id)->update([
            'status' => 'Revise',

        ]);
        ProcessEmail::dispatch($details);

        return back()->with('success', 'Email has been sent');
    }

    public function sendEmailDept(Request $request)
    {
        $from = Auth::user()->name;
        $emailBy = Auth::user()->email;
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
            'email_by' => $emailBy,
            'title' => 'Revisi Data Pendukung KPI',
            'greetings' => 'Dengan Hormat,',
            'msg' => 'Berdasarkan pengecekan yang kami lakukan terdapat perhitungan KPI dan data pendukung yang tidak sesuai, untuk itu segera hubungi personnel yang terkait dan segara siapkan data KPI dan data pendukung yang sesuai. Berikut ini adalah data yang perlu direvisi:',
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'comment' => $request->comment,
            'request' => 'Segera lakukan perbaikan dan upload data yang sesuai (maksimal 3 hari setelah email ini)',
            'closing' => 'Terima kasih atas perhatian dan kerjasamanya.',
        ];

        ProcessEmail::dispatch($details);
        DepartmentActual::where('id', $request->actual_id)->update([
            'status' => 'Revise',

        ]);

        return back()->with('success', 'Email has been sent');
    }


    public function sendEmailReminderInput()
    {
        $details = [
            'title' => 'Notifikasi Pengingat Pengisian data KPI',
            'greetings' => 'Yth. ',
            'name' => '',
            'msg' => 'Mengingatkan kembali untuk mengisi data KPI dan mengupload data pendukung KPI yang sesuai.',
            'msg2' => 'Jika anda sudah mengisi data KPI dan data pendukung KPI, abaikan email ini.',
            'closing' => 'Terima kasih atas perhatian dan kerjasamanya.',
            'email' => '',
        ];

        $sendTo = DB::table('employees')
            ->where('employees.role', '!=', 'Mng Approver')
            ->select('employees.email', 'employees.name')
            ->get();

        foreach ($sendTo as $email) {
            $details['email'] = $email->email;
            $details['name'] = $email->name;

            if ($details['email'] !== null && $details['email'] !== '' && $details['email'] !== 0) {
                ReminderInputEmail::dispatch($details);
            }
        }
    }
}
