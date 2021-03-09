<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class UserSubscriberController extends Controller
{
    public function subscriberStore(Request $request)
    {
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();
        $msg='Success!';
        Toastr::success($msg, 'Subscription Successfull !');
        return \back();
    }
}
