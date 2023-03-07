@if(auth('company')->user())
{{--    @php--}}
{{--        $support_chat = \App\Models\SupportChat::where('company_id',auth('company')->user()->id)--}}
{{--                                                 ->get(['id','message','company_id','admin_id','sender']);--}}
{{--    @endphp--}}
@endif
@if(auth('company')->user())
    @if($support_chat->count() > 0)
        @foreach($support_chat as $msg)
            @if($msg->admin_id != null)
                <div class="message message-left">
                    <div class="avatar-wrapper avatar-small">
                        <img src="{{asset('website/imgs/supportChat.png')}}" alt="avatar" />
                    </div>
                    <div class="bubble bubble-light">
                        <p>{{$msg->message}}</p>
                    </div>
                </div>
            @endif
            @if($msg->sender == 'company')
                <div class="message message-right">
                    <div class="avatar-wrapper avatar-small">
                        <img src="{{asset('website/imgs/user.png')}}" alt="avatar" />
                    </div>
                    <div class="bubble bubble-dark">
                        {{$msg->message}}
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endif
