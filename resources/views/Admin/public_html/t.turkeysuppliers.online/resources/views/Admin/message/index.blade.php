@extends('Admin.layouts.master')
@section('title','الرسائل')
@section('css')
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <!-- Left sidebar -->
                                <div class="col-lg-3 col-md-4">
                                    <div class="card shadow-none mt-3">
                                        <div class="list-group shadow-none">
                                            @forelse($messages as $message)
                                            <a data-url="{{ route('admin.message.show', $message->id) }}" data-id="{{$message->id}}" class="list-group-item message"><i class="fa fa-inbox mr-2"></i>{{$message->subject}}</a><br>
                                                @empty
                                                <h6>there is no message</h6>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <!-- End Left sidebar -->

                                <!-- Right Sidebar -->
                                <div class="col-lg-9 col-md-8" style="display: none" id="messageBody">
                                    <div class="card shadow-none mt-3 border border-light">
                                        <div class="card-body">
                                            <div class="media mb-3">
{{--                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-3 mail-img shadow" alt="media image"  width="100" height="100">--}}
                                                <div class="media-body">
                                                    <span class="media-meta float-right" id="date"></span>
                                                    <h4 class="text-primary m-0" id="userName"></h4>
                                                    <small id="email" class="text-muted"></small>
                                                </div>
                                            </div> <!-- media -->

                                            <h3><b id="title"></b></h3><br>
                                            <h4 id="address"></h4><br>
                                            <h4 id="phone"></h4><br>
                                            <p id="body"></p>

                                            <hr>
                                        </div>
                                    </div> <!-- card -->
                                </div> <!-- end Col-9 -->

                            </div><!-- End row -->

                        </div>
                    </div>
                </div>
            </div><!-- End row -->

        </div>
    </div>
</div>
@endsection
@push('js')
<script>

    $('body').on('click', '.message', function () {
        var userURL = $(this).data('url');
        $.get(userURL, function (data) {
            console.log(data.message);
            var newDate = new Date(data.message.created_at);
            $("#userName").text(data.message.name);
            $("#phone").text(data.message.phone);
            $("#email").text(data.message.email);
            $("#title").text(data.message.subject);
            $("#body").text(data.message.message);
            $("#date").text(newDate.toDateString());
        })
        $("#messageBody").css("display", "block");
        const messages = document.querySelectorAll('.message');
        messages.forEach(message => {
            message.classList.remove('active');
        });
        $(this).addClass( "active" );
    });
</script>
@endpush
