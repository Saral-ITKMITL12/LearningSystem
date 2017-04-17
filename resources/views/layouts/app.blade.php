<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Learning System</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('css/new-age.css')}}" rel="stylesheet">

    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/button.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.jpg" type="image/x-icon">
    <link rel="icon" href="/favicon.jpg" type="image/x-icon">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


  <div id="app">
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="{{ url('/home' )}}"><i class="fa fa-book" aria-hidden="true"></i> Learning System</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

              <!-- Right Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                  <!-- Authentication Links -->
                  @if (Auth::guest())
                      <li><a href="{{ route('login') }}">Login</a></li>
                  @else
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                              @if(Auth::user()->hasRole('teacher'))
                                (TEACHER)
                              @elseif(Auth::user()->hasRole('admin'))
                                (ADMIN)
                              @elseif(Auth::user()->hasRole('student'))
                                (STUDENT)
                              @endif
                              <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                              <li>
                                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                          </ul>
                      </li>
                  @endif
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

      @yield('content')
  </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js')}}"></script>

    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.js')}}"></script>
    <script src="{{ asset('js/bootstrap-notify.min.js')}}"></script>

    @unless(empty(session('flash_notice')))
    <script type="text/javascript">
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };

    $.notify(
      {
        message: "{{ Session::get('flash_notice') }}"
      },{
        type: "{{ Session::get('flash_type') }}"
      }
    );
    </script>
    @endunless

</body>

</html>
