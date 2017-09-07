@extends('layouts.app')

@section('content')
	<main class="container main">
		@include('partials.carousel')
		<article>
			<div class="col-md-8">
				<a href="{{ javan_is_open() ? route('menu') : route('uber') }}" class="btn btn-success btn-raised btn-round btn-lg btn-block">
					Order Food Online Now !
				</a>
				{{--<a href="{{ auth()->check() ? route('member.reservations') : route('create.reservation') }}"
				   class="btn btn-inverse btn-raised btn-round btn-lg btn-block text-bright">
					Reserve Table Online
				</a>--}}

				<br><br>

				<div class="clearfix"></div>

				<h2 class="hidden-xs">Some of the popular food</h2>
				<h3 class="visible-xs">Some of the popular food</h3>

				<div class="row">
					<div class="col-sm-6">
						<a href="/images/restaurant/chenjeh.jpg" data-lity title="Chelo Chenjeh" data-toggle="tooltip">
							<img src="/images/restaurant/chenjeh.jpg"
							     class="img-space img-rounded img-raised img-responsive"
							     alt="javan Restaurant">
						</a>
					</div><!-- /.col-sm-6 -->
					<div class="col-sm-6">
						<a href="/images/restaurant/momtaz.jpg" data-lity title="Momtaz" data-toggle="tooltip">
							<img src="/images/restaurant/momtaz.jpg"
							     class="img-space img-rounded img-raised img-responsive"
							     alt="javan Restaurant">
						</a>
					</div><!-- /.col-sm-6 -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-sm-6">
						<a href="/images/restaurant/shishlik.jpg" data-lity title="Shishlik - Lamb Chops"
						   data-toggle="tooltip">
							<img src="/images/restaurant/shishlik.jpg"
							     class="img-space img-rounded img-raised img-responsive"
							     alt="javan Restaurant">
						</a>
					</div><!-- /.col-sm-6 -->
					<div class="col-sm-6">
						<a href="/images/restaurant/soltani.jpg" data-lity title="Soltani" data-toggle="tooltip">
							<img src="/images/restaurant/soltani.jpg"
							     class="img-space img-rounded img-raised img-responsive"
							     alt="javan Restaurant">
						</a>
					</div><!-- /.col-sm-6 -->
				</div><!-- /.row -->
			</div>
		</article>
		<aside>
			<div class="col-md-4">
				<div class="card card-nav-tabs card-plain">
					<div class="header header-primary">
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<ul class="nav nav-tabs" data-tabs="tabs">
									<li class="active">
										<a href="#instagram" data-toggle="tab">
											<i class="fa fa-instagram fa-2x fa-fw"></i>
										</a>
									</li>
									<li>
										<a href="#tweets" data-toggle="tab">
											<i class="fa fa-twitter fa-2x fa-fw"></i>
										</a>
									</li>
									<li>
										<a href="#facebook" data-toggle="tab">
											<i class="fa fa-facebook fa-2x fa-fw"></i>
										</a>
									</li>
									<li>
										<a href="#google" data-toggle="tab">
											<i class="fa fa-google-plus fa-2x fa-fw"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="tab-content text-center">
							<div class="tab-pane active" id="instagram">
								{{--@foreach (array_chunk($images, 2) as $row)--}}
									{{--<div class="row">--}}
										{{--@foreach ($row as $image)--}}
											{{--<div class="col-sm-6 col-xs-12">--}}
												{{--<a href="{{ $image['images']['standard_resolution']['url'] }}"--}}
												   {{--data-lity>--}}
													{{--<img class=" img-space img-thumbnail img-raised"--}}
													     {{--src="{{ $image['images']['thumbnail']['url'] }}"--}}
													     {{--alt="{{ $image['link'] }}">--}}
												{{--</a>--}}
											{{--</div>--}}
										{{--@endforeach--}}
									{{--</div>--}}
								{{--@endforeach--}}
							</div>
							<div class="tab-pane" id="tweets">
								@include('partials.twitter')
							</div>
							<div class="tab-pane" id="facebook">
								@include('partials.facebook')
							</div>
							<div class="tab-pane" id="google">
								@include('partials.google+')
							</div>
						</div>
					</div>
				</div>
				<p class="bbcnassim text-danger center lead" dir="rtl">بهترین کیفیت غذای ایرانی</p>
				<p class="bbcnassim text-danger center lead" dir="rtl">قضاوت به عهده شما</p>
			</div>
		</aside>
	</main>
@endsection

