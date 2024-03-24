<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return inertia(
            'Notifications/Index',
            [
                'notifications' => $notifications
            ]
        );
    }

}
