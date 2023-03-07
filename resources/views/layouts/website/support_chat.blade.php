<style>


  .others-show {
  top: -55px !important;
  z-index: 10 !important;
  }

  .emoji-show {
      display: flex !important;
  flex-wrap: wrap;
  align-content: flex-start;
  width: 150px !important;
  height: 70px !important;
  padding: 10px;
  top: -14px !important;
  right: 50px !important;
  background-color: #fff;
  box-shadow: 0 0 25px -5px lightgrey;
  border-radius: 5px 5px 0 5px;
  }



  .chat-box img {
  width: 100%;
  object-fit: cover;

  }

  .avatar-wrapper {
  border-radius: 50%;
  overflow: hidden;
  }

  .chat-box {
  width: 100%;
  margin: auto ;

  }
  .chat-box .header {
  background-color: #fff;
  border-radius: 20px 20px 0 0;
  padding: 15px;
  box-shadow: 0px 4px 50px 0px rgb(0 0 0 / 15%);
  margin-bottom: 50px;
  }
  .chat-box .header-flex {
  display: flex;
  align-items: center;

  }
  .chat-box .header .avatar-big {
  width: 35px;
  height: 35px;
  }
  .chat-box .header .name {
  margin-left: 20px;
  font-size: 20px;
  font-weight: 500;
  }
  .chat-box .header .options {
  font-size: 20px;
  color: lightgrey;
  margin-left: auto;
  cursor: pointer;
  }
  .chat-box .chat-room {
  min-height: 300px;
  background-color: #f7f9fb;
  padding: 15px;
  max-height: 300px;
    overflow-y: scroll;
  }
  .chat-box .chat-room .avatar-small {
  width: 25px;
  height: 25px;
  }
  .chat-box .chat-room .message {
  margin-bottom: 15px;
  display: flex;
  flex-direction: column;
  }
  .chat-box .chat-room .message-left {
  align-items: flex-start;
  }
  .chat-box .chat-room .message-left .bubble {
  border-radius: 0 5px 5px 5px;
  }
  .chat-box .chat-room .message-right {
  align-items: flex-end;
  }
  .chat-box .chat-room .message-right .bubble {
  border-radius: 5px 0 5px 5px;
  }
  .chat-box .chat-room .bubble {
  padding: 10px;
  font-size: 14px;
  margin-top: 5px;
  display: inline-block;
  }
  .chat-box .chat-room .bubble-light {
  background-color: #cff1fc;
  }
  .chat-box .chat-room .bubble-dark {
  color: #fff;
  background-color: #3d9fb9;
  }
  .chat-box .type-area {
  display: flex;
  height: 75px;
  background-color: #fff;
  border-radius: 0 0 20px 20px;
  }
  .chat-box .type-area .input-wrapper {
  overflow: hidden;
  border-radius: 0 0 0 20px;
  }
  .chat-box .type-area .input-wrapper input {
  outline: none;
  border: none;
  padding-left: 20px;
  height: 100%;
  width: 220px;
  font-size: 14px;
  }
  .chat-box .type-area .button-add {
  display: flex;
  align-items: center;
  position: relative;
  }
  .chat-box .type-area .button-add i {
  font-size: 30px;
  color: lightgrey;
  cursor: pointer;
  }
  .chat-box .type-area .button-add i:hover {
  color: #3d9fb9;
  }
  .chat-box .type-area .button-add .others {
  display: flex;
  padding: 10px 15px;
  background-color: #fff;
  position: absolute;
  top: 5px;
  z-index: -1;
  right: -52px;
  border-radius: 10px;
  box-shadow: 0 0 25px -5px lightgray;
  transition: 0.3s all ease-out;
  width: 100px;
  }
  .chat-box .type-area .button-add .others span.image-button {
  margin: 0 25px;
  }
  .chat-box .type-area .button-add .others .emoji-button {
  position: relative;
  }
  .chat-box .type-area .button-add .others .emoji-button .emoji-box {
  display: none;
  position: absolute;
  width: 0px;
  height: 0px;
  top: 0px;
  right: 0px;
  transition: 0.3s all ease-out;
  }
  .chat-box .type-area .button-add .others .emoji-button .emoji-box span {
  user-select: none;
  cursor: pointer;
  margin-right: 5px;
  margin-bottom: 5px;
  width: 20px;
  height: 20px;
  }
  .chat-box .type-area .button-send {
  background-color: #fff;
  margin-left: auto;
  width: 65px;
  color: #3d9fb9;
  font-weight: bold;
  border: none;
  border-radius: 0 0 20px 0;
  }
  .chat-box .type-area .button-send:hover {
  background-color: #3d9fb9;
  color: #fff;
  }


  /* */
  .open-button{
  background-color:transparent;
  color: #333;
  padding: 10px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom:20%;
  right: 10px;
  font-size: 13px;
  font-weight: 600;
  border-radius: 25%;
  z-index: 1000;
  }

  /**/
  .BTNsend{
      background: rgb(50,175,210);
      background: linear-gradient(135deg, rgba(50,175,210,1) 0%, rgba(3,91,116,1) 100%);
  }

  .uploadFile::-webkit-file-upload-button{
      visibility: hidden;
  }
  .uploadFile{
      color: #3d9fb9;
      border: none;

  }
  .emoji-button{
      color: #3d9fb9;
      padding: 6px;
  }
  .chat-box .type-area .button-add .others span i {
  font-size: 20px;
  color: #3d9fb9;
  }
  .chat-popup{
  border: none;
  position: fixed;
  bottom:40%;
  right: 5px;
  font-size: 13px;
  font-weight: 600;
  border-radius: 25%;
  z-index: 1000;
  /*box-shadow: 0px 4px 50px 0px rgb(0 0 0 / 15%);*/

  }
  .form-container{
    max-width: 300px;
    padding: 10px;
    background-color: transparent;
  }
  .online{
    height: 10px;
  width: 10px;
    border-radius: 50%;
    border: none;
    background-color: #1fda92;
    position: absolute;
    top: 50px;
    left: 80px;
  }
  .offline{
    height: 10px;
    width: 10px;
    border-radius: 50%;
    border: none;
    background-color: #da1f1f;
    position: absolute;
    top: 50px;
    left: 80px;
  }
  .closeForm-ar{
    top: 0;
  position: relative;
  right: 106px;
  }
  .online-ar {
  height: 10px;
  width: 10px;
  border-radius: 50%;
  border: none;
  background-color: #1fda92;
  position: absolute;
  top: 50px;
  left: 160px;
  }
  .offline-ar{
    height: 10px;
    width: 10px;
    border-radius: 50%;
    border: none;
    background-color: #da1f1f;
    position: absolute;
    top: 50px;
    left: 80px;
  }

  #test-btn{
    display: block;
    background-color: #3d9fb9;
    color: #fff;
    width: 70px;
    font-weight: 100;
    font-size: 15px;
    letter-spacing: 1px;
  }
</style>




<button id="test-btn" class="open-button" onclick="myFunction()">{{trans('custom.support')}} <br><i class="fa-solid fa-comment-dots"></i></button>
<div class=" open-button" id="myDIV" style=" display: none;">
  <form id="send_message" enctype="multipart/form-data" action="{{route('chat.support.send.message')}}" class="form-container" method="POST">
      @csrf
      @if(auth('company')->user())
          <input type="hidden" name="company_id" value="{{auth('company')->user()->id}}">
      @endif


        <!--       <label for="msg"><b> Your Message</b></label>
      <textarea placeholder="Type message.." name="message" required="required"></textarea>
      <label for="msg"><b>upload Files</b></label>
      <input type="file" name="document" class="form-control mb-3">
      <button type="submit" class="btn BTNsend">Send</button>
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>  -->

      <div class="chat-box">
          <div class="header">
            <div class="header-flex">
              <div class="avatar-wrapper avatar-big">
              <img src="{{asset('website/imgs/supportChat.png')}}" alt="avatar" />
              </div>

              <span class="name">
                 <span class="online @if (app()->getLocale() == 'ar') online-ar @endif"></span> <!-- change online chat to offline -->
                  Support
              </span>

              <span class="options">
              <i class="fas fa-close @if (app()->getLocale() == 'ar') closeForm-ar @endif"  onclick="myFunction()"></i>
              </span>
            </div>
              <p>Hi, if you have any questions, let me know or WhatsApp us at</p>
          </div>
          <!-- chat-room -->
          <div class="chat-room">

          </div>
{{--          end chat-room--}}

          <!-- type-area -->
          <div class="type-area">
              <div class="input-wrapper">
                  <input id="message" autocomplete="off" type="text" id="inputText" name="message" required="required" placeholder="Type messages here..." />
              </div>
              <span class="button-add">
                  <i class="fas fa-plus-circle"></i>
                  <div class="others">
                      <span>
                          <input type="file" name="document" class="form-control mb-3 uploadFile fas fa-paperclip">
                      </span>
                  </div>
              </span>
              <button class="button-send" type="submit">Send</button>
          </div>
          <!-- end type-area -->

      </div>

  </form>
</div>
<!-- end of support chat -->
<script src="{{asset('website/js/jquery-3.4.1.js')}}"></script>
<script>
  //Content Loaded
window.addEventListener("DOMContentLoaded", (e) => {
var header = document.querySelector(".header");
var chatRoom = document.querySelector(".chat-room");
var typeArea = document.querySelector(".type-area");
var btnAdd = document.querySelector(".button-add");
var others = document.querySelector(".others");
var emojiBox = document.querySelector(".emoji-button .emoji-box");
var emojiButton = document.querySelector(".others .emoji-button");
var emojis = document.querySelectorAll(".emoji-box span");
var inputText = document.querySelector("#inputText");
var btnSend = document.querySelector(".button-send");
var messageArea=document.querySelector(".message.message-right");
//Header onclick event
header.addEventListener("click", (e) => {
  if (typeArea.classList.contains("d-none")) {
    header.style.borderRadius = "20px 20px 0 0";
  } else {
    header.style.borderRadius = "20px";
  }
  typeArea.classList.toggle("d-none");
//   chatRoom.classList.toggle("d-none");
});
//Button Add onclick event
btnAdd.addEventListener("click", (e) => {
  others.classList.add("others-show");
});
//Emoji onclick event
emojiButton.addEventListener("click", (e) => {
  emojiBox.classList.add("emoji-show");
});
 //Button Send onclick event
btnSend.addEventListener("click", (e) => {
  var mess=inputText.value;
  var bubble=document.createElement('div');
  bubble.className+=" bubble bubble-dark";
  bubble.textContent=mess;
  messageArea.appendChild(bubble);
  inputText.value="";
});
for (var emoji of emojis) {
  emoji.addEventListener("click", (e) => {
    e.stopPropagation();
    emojiBox.classList.remove("emoji-show");
    others.classList.remove("others-show");
    inputText.value+=e.target.textContent;
  });
}
});
</script>

<script>
  function myFunction() {
  var x = document.getElementById("myDIV");
  var y = document.getElementById("test-btn");

  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}
</script>
<script>
    $(function (){
        getSupportMessage();

        $("#send_message").on('submit',function(e){
            e.preventDefault();
            let form = $(this).serialize(),
                url = $(this).attr('action');
            $.ajax({
                type:'POST',
                url : url,
                data:form,
                dataType: 'json',
                success:function(){
                    $("#send_message")[0].reset();
                    getSupportMessage();
                }
            });
        });
        function getSupportMessage(){
            $.get("{{route('chat.support.get.message')}}",function(data){
                $(".chat-room").empty().html(data);
            });
        }
    })
</script>
