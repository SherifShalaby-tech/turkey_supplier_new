@extends('layouts.website.master')
@section('title','Messages')
@section('css')

@stop
@section('content')

<style>
.grid {
  list-style: none;
  margin-left: -40px;
}

.gc {
  box-sizing: border-box;
  display: inline-block;
  margin-right: -0.25em;
  min-height: 1px;
  padding-left: 40px;
  vertical-align: top;
}

.gc--1-of-3 {
  width: 20%;
}

.gc--2-of-3 {
  width: 80%;
}

.naccs {
  position: relative;
  width: 100%;
  margin: 100px auto 0;
  font-family: Arial, Helvetica, sans-serif !important;
  font-size: 18px;
}

.naccs .menu div {
  padding: 15px 20px 15px 40px;
  margin-bottom: 10px;
  color: rgba(77, 77, 77, 0.719) ;
  background: #99d5e5;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  position: relative;
  vertical-align: middle;
  font-weight: 700;
  transition: 1s all cubic-bezier(0.075, 0.82, 0.165, 1);

}

.naccs .menu div:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.naccs .menu div span.light {
  height: 10px;
  width: 10px;
  position: absolute;
  top: 24px;
  left: 15px;
  background-color: rgba(255, 255, 255, 0);
  border-radius: 100%;
  transition: 1s all cubic-bezier(0.075, 0.82, 0.165, 1);
}

.naccs .menu div.active span.light {
  background-color: #333;
  left: 0;
  height: 100%;
  width: 5px;
  top: 0;
  border-radius: 0;
}

.naccs .menu div.active {
  color: #333;
  padding: 15px 20px 15px 20px;
}

ul.nacc {
  position: relative;
  height: 0px;
  list-style: none;
  margin: 0;
  padding: 0;
  transition: 0.5s all cubic-bezier(0.075, 0.82, 0.165, 1);
}

ul.nacc li {
  width: 100%;
  opacity: 0;
  transform: translateX(50px);
  position: absolute;
  list-style: none;
  transition: 1s all cubic-bezier(0.075, 0.82, 0.165, 1);
}

ul.nacc li.active {
  transition-delay: 0.3s;
  z-index: 2;
  opacity: 1;
  transform: translateX(0px);
}

ul.nacc li p {
  margin: 0;
}
/**/





  .open-button-s {
    background-color: #3d9fb9;
    color: white;
    padding: 14px 10px;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    font-size: 16px;
    border-radius: 2px;
    z-index: 1000;
    position: absolute;
    top: -60px;
    width: 195px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
  }

  .chat-popup-s {
 display: none;
  position: fixed;
  bottom:  20%;
  right: 18%;
  border: 3px solid #f1f1f1;
  z-index: 9;
  width: 500px;
  }

  .form-container-s {
width: 100%;
  padding: 10px;
  background-color: white;
  }

  .form-container-s textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
  }

  .form-container-s textarea:focus {
  background-color: #ddd;
  outline: none;
  }

  /* Set a style for the submit/send button */
  .form-container-s .btn {
    background-color: #3d9fb9;
    color: white;
    padding: 8px;
    border: none;
    cursor: pointer;
    width: 30%;
    margin-bottom: 10px;
    opacity: 0.8;
    border-radius: 10px;
  }

  /* Add a red background color to the cancel button */
  .form-container-s .cancel {

    position: absolute;
  right: 0;
  }

  /* Add some hover effects to buttons */
  .form-container-s .btn:hover, .open-button:hover {
  opacity: 1;
  }


</style>

<div class="container">
  <div class="row">




      <div class="naccs">
        <div class="grid">
        <div class="gc gc--1-of-3">
{{--          <button class="open-button-s" onclick="openForm()"><i class="fa-solid fa-pen"></i> compose</button>--}}
          <div class="menu">
          <div class="active"><span class="light"></span><span> <i class="fa-solid fa-inbox"></i> Inbox</span></div>
          <div><span class="light"></span><span> <i class="fa-solid fa-share"></i> Sent</span></div>
          </div>
        </div>
        <div class="gc gc--2-of-3">
          <ul class="nacc">
          <li class="active">
            <div>
                <table class="table" style="width:100% ;">
                  <thead class="">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">{{trans('custom.receiver_name')}}</th>
                      <th scope="col">{{trans('custom.sender_name')}}</th>
                      <th scope="col">{{trans('custom.subject')}}</th>
                      <th scope="col">{{trans('custom.message')}}</th>
                      <th scope="col">{{trans('custom.documents')}}</th>
                      <th scope="col">{{trans('custom.date')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                      @if($messages->count() > 0)
                          @foreach($messages as $key => $msg)
                              <tr>
                                  <td>{{$key + 1}}</td>
                                  <td>{{$msg->user->name}}</td>
                                  <td>{{$msg->supplier->name}}</td>
                                  <td>{{$msg->subject}}</td>
                                  <td>{{$msg->message}}</td>
                                  <td>
                                      @if($msg->file == null)
                                          No Documents
                                      @else
                                      <a class="btn btn-primary" href="{{route('downloadFile',$msg->file)}}">Download</a>
                                      @endif
                                  </td>
                                  <td>{{$msg->created_at->format('Y-m-d')}}</td>
                              </tr>
                          @endforeach
                      @endif
                  </tbody>
                </table>
            </div>
          </li>
          <li>
            <div>
                <table class="table" style="width:100% ;">
                  <thead class="">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">{{trans('custom.receiver_name')}}</th>
                      <th scope="col">{{trans('custom.sender_name')}}</th>
                      <th scope="col">{{trans('custom.subject')}}</th>
                      <th scope="col">{{trans('custom.message')}}</th>
                      <th scope="col">{{trans('custom.documents')}}</th>
                      <th scope="col">{{trans('custom.date')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                      @if($sender_messags->count() > 0)
                          @foreach($sender_messags as $key => $msg)
                              <tr>
                                  <td>{{$key + 1}}</td>
                                  <td>{{$msg->user->name}}</td>
                                  <td>{{$msg->supplier->name}}</td>
                                  <td>{{$msg->subject}}</td>
                                  <td>{{$msg->message}}</td>
                                  <td>
                                      @if($msg->file == null)
                                          No Documents
                                      @else
                                          <a class="btn btn-primary" href="{{route('downloadFile',$msg->file)}}">Download</a>
                                      @endif
                                  </td>
                                  <td>{{$msg->created_at->format('Y-m-d')}}</td>
                              </tr>
                          @endforeach
                      @endif
                  </tbody>
                </table>
          </div>
          </li>

              <div class="chat-popup-s" id="myForm">
                <form action="#" class="form-container-s"method="POST" enctype="multipart/form-data">
                  <button type="button" class="cancel" onclick="closeForm()">X</button>
                  <label for="msg"><b> New Message</b></label> <br>
                  <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="To">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="subject">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Type message.."></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlFile1">upload file</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                  </div>
                  <button type="submit" class="btn btn-primary">Send</button>
                </form>
              </div>



          </ul>
        </div>
        </div>
      </div>

  </div>
</div>



 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
 <script>
  // Acc
$(document).on("click", ".naccs .menu div", function() {
	var numberIndex = $(this).index();

	if (!$(this).is("active")) {
		$(".naccs .menu div").removeClass("active");
		$(".naccs ul li").removeClass("active");

		$(this).addClass("active");
		$(".naccs ul").find("li:eq(" + numberIndex + ")").addClass("active");

		var listItemHeight = $(".naccs ul")
			.find("li:eq(" + numberIndex + ")")
			.innerHeight();
		$(".naccs ul").height(listItemHeight + "px");
	}
});
 </script>
@stop
