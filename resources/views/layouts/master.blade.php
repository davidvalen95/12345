
{{--
    variable
        title
        danger
        success


    object
        user


    section
        content



--}}


@include('layouts.header')
<body  class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    {{-- menu diatas --}}
  <header class="main-header">
    <!-- Logo -->
    <a href={{url('')}} class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Gbz</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Youth</b>GBZ</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">

         @if(isset($user))
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src={{$user->getImageLogo()}} class="user-image" alt="User Image">
              <span class="hidden-xs">{{$user->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src={{$user->getImageLogo()}}  class="img-circle" alt="User Image">

                <p>
                  {{$user->name}}

                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">

                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
    @endIf



      </div>
    </nav>
  </header>

    {{-- menu samping --}}
    <!-- Left side column. contains the logo and sidebar -->

    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
            @if(isset($user))

            @endisset)
                <div class="user-panel">

                    <div class="pull-left image">

                            <img src={{$user->getImageLogo()}} class="img-circle" alt="User Image">

                    </div>
                    <div class="pull-left info">

                        <p>{{$user->name}}</p>
                        <a href="{{route('home')}}"><i class="fa fa-circle text-success"></i>{{$user->instrument}}</a>
                    </div>

                </div>
            @endIf

        <!-- search form -->
        <form action={{action('HomeController@index')}} method="POST" class="sidebar-form">

            {{csrf_field()}}
          <div class="input-group">
            <input type="text" name="songSearch" class="form-control" placeholder="Song search...">
            <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <!-- <li class="header">MAIN NAVIGATION</li>
          <li class="active treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
              <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
            </ul>
          </li> -->


          <!-- <li class="treeview">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Layout Options</span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right">4</span>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
              <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
              <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
              <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
            </ul>
          </li> -->



          <!-- <li>
            <a href="pages/widgets.html">
              <i class="fa fa-th"></i> <span>Widgets</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
        </li> -->

        <li><a href={{route('home')}}><i class="fa fa-home"></i> <span>Home</span></a></li>

        <li class='treeview'>
            <a href="#">
                <i class="fa fa-music"></i> <span>Songs</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>

            </a>
            <ul class="treeview-menu">
              <li><a href={{route('song.new')}}><i class="fa fa-circle-o"></i>Add song
                  <span class="pull-right-container">
                      <small class="label pull-right bg-green">+</small>
                  </span>
              </a></li>
              {{-- <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i>See all</a></li> --}}
             </ul>
        </li>

    </aside>



    <div class="content-wrapper">
    <!-- Content Header (Page header) -->

        @include('layouts.alert')


        @section('content')
            main body yang ada di tengah
        @show


    </div>
    <!-- /.content-wrapper -->


    <!--  sudah ada /html dan /body-->
    @include('layouts.footer')
