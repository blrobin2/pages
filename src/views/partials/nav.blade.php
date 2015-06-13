@inject('pages', 'BruceCms\Pages\Page')

<nav class="nav --main" role="navigation">
	<ul class="nav__list">
		<li class="nav__item">
			<a class="link nav__link" href="{{ url('/') }}">Home</a>
		</li>
		@foreach($pages->unhidden()->get() as $page)
			<li class="nav__item">
				<a class="link nav__link" href="{{ url($page->link) }}">{{ $page->title }}</a>
			</li><!--nav__item-->
		@endforeach
	</ul><!--nav__list-->
</nav><!-- nav-main -->