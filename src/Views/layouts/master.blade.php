<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">

	<title>The Watchtower</title>
	
	<!-- styles -->
	  <!-- Bootstrap core CSS -->
	  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

	  <!-- Bootstrap Theme CSS // http://www.bootstrapcdn.com/bootswatch/ -->
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/{{$theme}}/bootstrap.min.css" rel="stylesheet">

	  <!-- FontAwesome CDN for the icons -->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	  <!-- Pace loader -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/silver/pace-theme-center-circle.min.css">

	  <!-- Sweetalert (modal) styles  -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

	  <!-- custom page style -->
	  <style>
	    /* Move down content because we have a fixed navbar that is 50px tall */
	    body {
	      padding-top: 60px;
	    }
	  </style>
	<!-- /styles -->

	<!-- modernizr -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	@yield('header_assets')

</head>

<body>
	<!--[if lt IE 8]>
	    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<nav class="navbar navbar-default navbar-fixed-top">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="{{ route( config('watchtower.route.as').'index') }}">{{ $title }}</a>
	        </div>

			<div id="navbar-collapse" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url( config('watchtower.auth_routes.login') ) }}">Login</a></li>
						<li><a href="{{ url( config('watchtower.auth_routes.register') ) }}">Register</a></li>
					@else
						<!-- navigation links -->
						@foreach( config('watchtower-menu.navigation') as $nav_menu )
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="{{ $nav_menu['group'] }}">
				          <i class="{{$nav_menu['class']}}"></i><span class="sr-only"> {{$nav_menu['group']}}</span> <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				          	@forelse($nav_menu['links'] as $navlink)
				          		@if ($navlink == 'separator')
				             		<li role="separator" class="divider"></li>
				             	@elseif ($navlink['route'] === 'header')
    								<li class="text-muted text-center"><i class="{{ $navlink['class'] }}"></i> {{ $navlink['title'] }}</li>
				             	@else
				             		<li><a href="{{ route($navlink['route']) }}"><i class="{{ $navlink['class'] }}"></i>  {{ $navlink['title'] }}</a></li>
				             	@endif
				            @empty
				             <li><a href="#">No links defined yet</a></li>
				            @endforelse
				          </ul>
				        </li>
						@endforeach

				        <!-- user dropdown links -->
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="User Information">
				          <i class="glyphicon glyphicon-user"></i> {{ Auth::user()->name }} <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a href="{{ route( config('watchtower.route.as') . 'index') }}"><i class="fa fa-fw fa-tasks"></i> Dashboard</a></li>
    						
    						<li role="separator" class="divider"></li>
    						<li class="text-muted text-center"><i class="fa fa-users"></i> Your Roles</li>
							@forelse(Auth::user()->roles as $role)
								<li><a href="{{ route( config('watchtower.route.as') . 'role.permission.edit', $role->id) }}"><i class="fa fa-users fa-xs"></i> {{ $role->name }}</a></li>
							@empty
								<li><a href="#"><i class="fa fa-hand-stop-o fa-xs"></i> No roles</a></li>
							@endforelse    						
    						<li role="separator" class="divider"></li>
				            <li><a href="{{ url( config('watchtower.auth_routes.logout') ) }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a></li>
				          </ul>
				        </li>
					@endif
				</ul>
			</div>

	    </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		@include(config('watchtower.views.layouts.flash'))
	
		@yield('content')
	</div>

	<hr/>

	<div class="container">
	    <p class="text-muted">{{ date('Y') }} Smarch Software</p>
	    <br/>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- Pace Loader -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    
    <!-- For Delete Modal prompts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
		/*!
		* IE10 viewport hack for Surface/desktop Windows 8 bug
		* Copyright 2014-2015 Twitter, Inc.
		* Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
		*/

		// See the Getting Started docs for more information:
		// http://getbootstrap.com/getting-started/#support-ie10-width

		(function () {
			$('[data-toggle="popover"]').popover();

			'use strict';

			if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
				var msViewportStyle = document.createElement('style')
				msViewportStyle.appendChild(
					document.createTextNode(
					  '@-ms-viewport{width:auto!important}'
					)
				)
				document.querySelector('head').appendChild(msViewportStyle)
				}
		})();

		/**
		 * To auto-hide all alerts, except danger
		 */
		$('div.alert').not('div.alert-danger').delay(4000).slideUp();

		/**
		 * To use the bootstrap tooltip popups.
		 */
  		$('[data-toggle="tooltip"]').tooltip({
  			container: 'body',
  			trigger:'click hover focus'
  		});

		/*!
		 * For Delete Modal prompts
		 * 
		 */
	    $('button[type="submit"]').click(function(e) {
		    if ( $(this).hasClass('btn-danger') ) {
		        var currentForm = this.closest("form");
		        e.preventDefault();
		        swal({
		           title: "Are you sure?",
		           text: "You will not be able to recover this object.",
		           type: "warning",
		           showCancelButton: true,
		           confirmButtonColor: "#DD6B55",
		           confirmButtonText: "Yes, delete it!",
		           cancelButtonText: "No, keep it.",
		           closeOnConfirm: true,
		           closeOnCancel: false
		            },
		            function(isConfirm){
	            		if (isConfirm) {
	            			currentForm.submit();
	            		} else {
	            		     swal({
	            		     	title: "Cancelled!",
	            		     	text: 'Object not deleted. <br /> <em><small>(I will close in 2 seconds)</em></small>',
	            		     	timer: 2000,
	            		     	showConfirmButton: true,
		           				confirmButtonText: "Close now.",
	            		     	type: 'error',
		           				html: true
	            		     });
	            	    }
	            	}
		        );
		    }
	    });
    </script>

	@yield('footer_assets')

  </body>
</html>