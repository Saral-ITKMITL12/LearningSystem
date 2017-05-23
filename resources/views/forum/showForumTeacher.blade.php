@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/chat.css')}}">

<section class="forumbox">

    <div class="subject" id="style-2">
      <div class="subjectTitle text-center">
        <p class="courseHeader">Course</p>
      </div>

      @if(!empty($courses))
      @foreach($courses as $key => $course)
      <a href="/course/forum/{{ $course->id }}/show">
      <div class="ListBoxforSubject">
        <div class="subjectList text-center">
          <p class="subjectTitleParagrap">
            {{ $course->code.' '.$course->name }}
          </p>
        </div>
      </div>
    </a>
      @endforeach
      @endif

    </div><!-- Course  -->


    <div class="messenger">
      <div class="messengerHeaderBox text-center">
        <p class="messengerHeaderText">{{ $thisCourse->code.' '.$thisCourse->name }}</p>
      </div>
      <div class="messengerList" id="style-1">
        @if(!empty($message))
          @foreach($message as $key => $value)
            @if($value->user_type == 'teacher')
            <div class="text-right">
              <p class="techerName">{{ $value->user_name }}</p>
              <div class="talk-bubble-sender tri-right right-top">
                <div class="talktext">
                  @if($value->image != null)
                  <img class="sendImage" src="{{ $value->image }}" alt="">
                  @endif
                  <p>{{ $value->message }}</p>
                </div>
              </div>
            </div>
            @elseif($value->user_type == 'student')
            <div class="text-left">
              <div class="talk-bubble tri-right left-top">
                <div class="talktext">
                  @if($value->image != null)
                  <img class="sendImage" src="{{ $value->image }}" alt="">
                  @endif
                  <p>{{ $value->message }}</p>
                </div>
              </div>
            </div>
            @endif
          @endforeach
        @endif

      </div>

      <div class="senderBox">
        <div class="box80">
          <input id="message" class="senderMessage" type="text" name="" value="" data-token="{{ csrf_token() }}" placeholder="พิมพ์ข้อความ..." onkeydown="commentPostEnter()">
        </div>
        <div class="box20">
          <a href="#" class="senderItem">
            <!-- <i class="fa fa-picture-o" aria-hidden="true"></i> -->
          </a>
        </div>
        <div class="box20">
          <a href="#" class="senderItem" onclick="commentPostEnterWithIcon()">
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    </div>


</section>

<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
@include('forum.chatTeacherJS')


@endsection
