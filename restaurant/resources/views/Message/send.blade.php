@extends('layouts.user_type.auth')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/send.css') }}">
  {{-- <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg "> --}}
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
            <div class="card mb-4 container">
            <h3 class=" text-center">Messaging</h3>
            <div class="messaging">
                  <div class="inbox_msg">
                    <div class="mesgs">
                      <div class="msg_history">
                        @foreach ($messages as $message)
                        @if ($message->userSend_id!=Auth()->id())
                        <div class="incoming_msg">
                          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                          <div class="received_msg">
                            <div class="received_withd_msg">
                              <p>{{ $message->message }}</p>
                              <span class="time_date">{{$message->created_at}}</span>
                            </div>
                          </div>
                        </div>
                        @else
                        <div class="outgoing_msg">
                          <div class="sent_msg">
                            <p>{{ $message->message }}</p>
                            <span class="time_date">{{$message->created_at}}</span>
                          </div>
                        </div>   
                        @endif

  
                        @endforeach


                      </div>
                      <div class="type_msg">
                        <div class="input_msg_write">
                            <form action="{{ route('message.store') }}" method="POST">
                                @csrf
                            <input name='message' type="text" class="write_msg" placeholder="Type a message" />
                            <input name='userSend_id' value="{{ Auth()->id() }}" type="text" class="write_msg" placeholder="Type a message" hidden/>
                            <input name='userGet_id' value="{{ $id }}" type="text" class="write_msg" placeholder="Type a message" hidden/>
                            <input name='subject' value="chat" type="text" class="write_msg" placeholder="Type a message" hidden/>
                            <input name='importent' value="No" type="text" class="write_msg" placeholder="Type a message" hidden/>

                            <button type="submit" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>   
                            </form>

                        </div>
                      </div>
                    </div>
                  </div>


                </div></div>
        </div>
      </div>

    </div>
  {{-- </main> --}}

  @endsection
