<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('superadmin.subscriber.manage',compact('subscribers',$subscribers));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function sendNewsToSubscriber()
    {
        return \view('superadmin.subscriber.sendNews');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Send News
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $userEmail = Subscriber::all();
        for ($i=0; $i < $userEmail->count(); $i++) { 
            $data = [
                'subject' => $request->subject,
                'email' => $userEmail[$i]['email'],
                'content' => $request->message
              ];
            Mail::send('superadmin.subscriber.email-template', $data, function($message) use ($data) {
                $message->to($data['email'])
                ->subject($data['subject']);
            });
        }

        $msg='News Send Successfully';
        Toastr::success($msg, 'Success.!');
        return \back()->with('success','News Send successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        $msg='Subscriber Deleted Successfully';
        Toastr::success($msg, 'Success.!');
        return back()->with('success','Subscriber deleted successfully');
    }

    
}
