@extends('app')

@section('header-styles')
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
	<link rel="stylesheet" href="{{ url('css/slick-theme.css') }}" />
@stop

@section('content')
	<div class="slider">
		@foreach($vendors as $vendor)
			<div class="slider__slide" style="width:100%">
				<div class="slider__image" style="background-image: url('{{ url('img/vendors/test-vendor/test-vendor-image.jpg') }}')">
				</div><!--slider__image-->
				<div class="container">
					<div class="row">
						<div class="slider__text">
							<div class="col-md-8"></div>
							<div class="col-md-4">
								<h1 class="h1">{{ $vendor->name }}</h1>
								<p>{!! $vendor->description !!}</p>
								<a href="{{ url('vendors/'.$vendor->nameAsLink()) }}"><button class="button button-primary">Shop Vendor</button></a>
							</div>
						</div>
					</div><!-- row -->
				</div><!--container -->
			</div><!--slider__slide-->
		@endforeach
	</div><!--slider-->
	<div class="bg-grey">
		<div class="line-navigation">
			<div class="container">
				<div class="col-md-2">
					<h2 class="h2" style="margin-top:2em">Vendors</h2>
				</div><!--col-md-2-->
				<div class="col-md-10">
					<nav class="nav --slider">
						@foreach($vendors as $vendor)
							<li class="nav__item">
								<img src="{{ url($vendor->logo) }}" alt="{{ $vendor->name }}" />
							</li>
						@endforeach
				</nav>
				</div><!--col-md-10-->
			</div><!--container-->
		</div><!--line-navigation-->
	</div><!--bg-grey-->
@stop

@section('footer-scripts')
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
	<script>
		$('.slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			asNavFor: '.nav.--slider'
		});

		$('.nav.--slider').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			asNavFor: '.slider',
			centerMode: true,
			focusOnSelect: true
		});
	</script>
@stop