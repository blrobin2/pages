@inject('pages', 'BruceCms\Pages\Page')

<nav class="nav --main" role="navigation">
	{{ $pages->printMenu() }}
</nav><!-- nav-main -->