<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $details = [
            'email' => $request->email,
            'title' => 'Revisi Data Pendukung KPI',
            'msg' => 'Dengan Hormat saya sampaikan bahwa terjadi kesalahan pada data pendukung KPI yang telah diinputkan. Berikut ini adalah data yang perlu direvisi:',
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'comment' => $request->comment,
        ];

        // dd($details);

        Mail::to($details['email'])->send(new PostMail($details));

        return back()->with('success', 'Email has been sent');
    }
}
