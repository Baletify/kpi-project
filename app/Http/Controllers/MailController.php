<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use App\Models\Actual;
use App\Jobs\ProcessEmail;
use Illuminate\Http\Request;
use App\Mail\ReminderInputMail;
use App\Jobs\ReminderInputEmail;
use App\Mail\ReminderCheck1Mail;
use App\Models\DepartmentActual;
use App\Jobs\ReminderCheck1Email;
use App\Jobs\ReminderCheck2Email;
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
            if (!$sendTo || !$sendTo->email) {
                return back()->withErrors(['email' => 'No valid email address found for the specified department.']);
            }
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
        $now = now()->format('d');
        $newDeadline = $now + 3;
        $newDeadline > 31 ? $newDeadline = 31 : $newDeadline;

        // dd($details);

        Actual::where('id', $request->actual_id)->update([
            'status' => 'Revise',
            'deadline' => $newDeadline,

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
        if (!$sendTo || !$sendTo->email) {
            return back()->withErrors(['email' => 'No valid email address found for the specified department.']);
        }


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
        $now = now()->format('d');
        $newDeadline = $now + 3;
        $newDeadline > 31 ? $newDeadline = 31 : $newDeadline;



        ProcessEmail::dispatch($details);
        DepartmentActual::where('id', $request->actual_id)->update([
            'status' => 'Revise',
            'deadline' => $newDeadline,

        ]);

        return back()->with('success', 'Email has been sent');
    }
}
