@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/chat.css')}}">

<section class="forumbox">

    <div class="subject">
      <div class="subjectTitle text-center">
        <p class="courseHeader">Course</p>
      </div>

      @if(!empty($courses))
      @foreach($courses as $key => $course)
      <div class="ListBoxforSubject">
        <div class="subjectList text-center">
          <p class="subjectTitleParagrap">
            {{ $course->code.' '.$course->name }}
          </p>
        </div>
      </div>
      @endforeach
      @endif

    </div><!-- Course  -->


    <div class="messenger">
      <div class="messengerHeaderBox text-center">
        <p class="messengerHeaderText">06016208 MULTIMEDIA AND WEB TECHNOLOGY</p>
      </div>
      <div class="messengerList" id="style-1">

        <div class="text-left">
          <div class="talk-bubble tri-right left-top">
            <div class="talktext">
              <p>This one adds a right triangle on the left, flush at the top by using .tri-right and .left-top to specify the location.</p>
            </div>
          </div>
        </div>

        <div class="text-right">
          <div class="talk-bubble-sender tri-right right-top">
            <div class="talktext">
              <p>This one adds a rightt triangle on the left, flush at the top bt triangle on the left, flush at the top bt triangle on the left, flush at the top b.</p>
            </div>
          </div>
        </div>
        <div class="text-right">
          <div class="talk-bubble-sender tri-right right-top">
            <div class="talktext">
              <img class="sendImage" src="http://www.rd.com/wp-content/uploads/sites/2/2016/04/01-cat-wants-to-tell-you-laptop.jpg" alt="">
              <p>สวัสดี ฮัลโหลๆ</p>
            </div>
          </div>
        </div>

        <div class="text-left">
          <div class="talk-bubble tri-right left-top">
            <div class="talktext">
              <img class="sendImage" src="http://www.rd.com/wp-content/uploads/sites/2/2016/04/01-cat-wants-to-tell-you-laptop.jpg" alt="">
              <p>This one adds a righ  flush at the top bt triangle on the left, flush at the top bt triangle on th</p>
            </div>
          </div>
        </div>

      </div>

      <div class="senderBox">
        <div class="box80">
          <input id="message" class="senderMessage" type="text" name="" value="" data-token="{{ csrf_token() }}" placeholder="พิมพ์ข้อความ..." onkeydown="commentPostEnter()">
        </div>
        <div class="box20">
          <a href="#" class="senderItem">
            <i class="fa fa-picture-o" aria-hidden="true"></i>
          </a>
        </div>
        <div class="box20">
          <a href="#" class="senderItem">
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    </div>


</section>

<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/chat.js') }}" type="text/javascript"></script>


@endsection
