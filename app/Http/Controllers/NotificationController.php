<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getAllNotifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $notifications = Auth::user()->unreadNotifications;
        return \view('superadmin.notification.notification',\compact('notifications'));
    }
}
