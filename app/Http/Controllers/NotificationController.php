<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('notification.notifications', ['title' => 'Notification', 'desc' => 'Notification Lists', 'notifications' => $notifications]);
    }

    public function create()
    {
        return view('notification.create-notification', ['title' => 'Create Notification', 'desc' => 'Create Notification']);
    }

    public function store(Request $request)
    {
        Notification::create(
            [
                'title' => $request->title,
                'content' => $request->content,
                'input_by' => $request->author,
                'input_dept' => $request->department,
            ]
        );

        flash()->success('Notification has been added');

        return redirect()->route('dashboard');
    }
}
