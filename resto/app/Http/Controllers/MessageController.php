<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth()->user();
        // $employer = Message::select()->where('userGet_id',$auth->id);
        $emplyee = User::with(['role.role','messagesendNoread','message_get','last_get_send','last_get_send'])
                        ->where('user_id',$auth->id)
                        ->get();
        return view('Message.message',compact('emplyee'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        // dd($request);
        Message::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(User::findOrfail($id)->user_id == Auth()->id())
        {
         $ides = [$id,Auth()->id()];
        $messages = Message::wherein('userSend_id',$ides)
                            ->wherein('userGet_id',$ides)
                            ->orderby('created_at')
                            ->get();

        Message::where('userSend_id',$id)->update(['read_'=>true]);
        return view('Message.send',compact('messages','id'));
        }else
        return 404;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
