<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Bruce CMS</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li>{!! link_to_action('\BruceCms\Pages\PagesController@create', 'Create a New Page') !!}</li>
							<li>{!! link_to_action('\BruceCms\Pages\PagesController@index', 'Manage Your Existing Pages') !!}</li>
							<li>{!! link_to_action('\BruceCms\Pages\AuthenticationController@index', 'Manage Admins') !!}
							<li>{!! link_to_action('\BruceCms\Pages\AuthenticationController@edit', 'Edit Your Profile', Auth::user()->id) !!}</li>
							<hr>
							<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>