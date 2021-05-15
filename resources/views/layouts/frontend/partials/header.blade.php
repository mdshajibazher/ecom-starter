			<!-- Header
		============================================= -->
		<header id="header" class="full-header header-size-md">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">

						<!-- Logo
						============================================= -->
						<div id="logo" class="mr-lg-4">
							<a href="demo-shop.html" class="standard-logo"><img src="{{asset('frontend/demos/shop/images/logo.png')}}" alt="Canvas Logo"></a>
							<a href="demo-shop.html" class="retina-logo"><img src="{{asset('frontend/demos/shop/images/logo@2x.png')}}" alt="Canvas Logo"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= -->


							<cart-component/>

							<!-- Top Search
							============================================= -->
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
							</div><!-- #top-search end -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows mr-lg-auto">

							<ul class="menu-container">
								<li class="menu-item current"><a class="menu-link" href="#"><div>Home</div></a></li>

								@php
									$collections =\App\Models\Collection::with('Subcollections.Label')->limit(2)->get();
								@endphp
								@foreach ($collections as $collection)
								@php
								$subcollection_chunk = $collection->Subcollections->groupBy('label_id');
								@endphp
								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>{{$collection->title}}</div></a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												@foreach ($subcollection_chunk as $label_id => $chunk_array)
												<ul class="sub-menu-container mega-menu-column border-left-0 col-lg-3">


													<li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>{{\App\Models\Label::find($label_id)->title}}</div></a>
														<ul class="sub-menu-container">
															@foreach ($chunk_array as $sub)
															<li class="menu-item"><a class="menu-link" href="#"><div>{{$sub->title}}</div></a></li>
															@endforeach
	
															<li class="menu-item"><a class="menu-link" href="#"><div>Show all <i class="icon-angle-right"></i></div></a></li>
														</ul>
													</li>
												</ul>
												@endforeach
												<ul class="sub-menu-container mega-menu-column col-lg-3 border-left-0">
													<li class="card p-0 bg-transparent border-0">
														<img class="card-img-top" src="{{asset('images/collections/original/'.$collection->image)}}" alt="image cap">
										
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
								@endforeach
							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->
	