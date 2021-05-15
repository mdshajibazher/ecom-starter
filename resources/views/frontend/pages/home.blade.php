@extends('layouts.frontend.app')
@section('title', 'Home')

@section('slider')
@include('layouts.frontend.partials.slider')
@endsection

@section('onload-modal')
{{-- <div class="modal-on-load" data-target="#myModal1"></div> --}}

<!-- On LOad Modal -->
<div class="modal1 mfp-hide subscribe-widget mx-auto" id="myModal1" style="max-width: 750px;">
	<div class="row justify-content-center bg-white align-items-center" style="min-height: 380px;">
		<div class="col-md-5 p-0">
			<div style="background: url('{{asset('frontend/images/modals/modal1.jpg')}}') no-repeat center right; background-size: cover;  min-height: 380px;"></div>
		</div>
		<div class="col-md-7 bg-white p-4">
			<div class="heading-block border-bottom-0 mb-3">
				<h3 class="font-secondary nott ">Join Our Newsletter &amp; Get <span class="text-danger">40%</span> Off your First Order</h3>
				<span>Get Latest Fashion Updates &amp; Offers</span>
			</div>
			<div class="widget-subscribe-form-result"></div>
			<form class="widget-subscribe-form2 mb-2" action="include/subscribe.php" method="post">
				<input type="email" id="widget-subscribe-form2-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email Address..">
				<div class="d-flex justify-content-between align-items-center mt-1">
					<button class="button button-dark  bg-dark text-white ml-0" type="submit">Subscribe</button>
					<a href="#" class="btn-link" onClick="$.magnificPopup.close();return false;">Don't Show me</a>
				</div>
			</form>
			<small class="mb-0 font-italic text-black-50">*We also hate Spam &amp; Junk Emails.</small>
		</div>
	</div>
</div>

@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <div style="position: absolute; top: 4px;
		  right: 9px;z-index: 999">
		  <button style="font-size: 20px" type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">Close</span>
		</button>
		</div>
		
		<div class="modal-body">
			<product-detail post-title="Hello World"></product-detail>		
		</div>

	  </div>
	</div>
  </div>




@endsection

@section('content')
<div class="content-wrap">
	<div class="container clearfix">
							<!-- Shop Categories
					============================================= -->
					<div class="fancy-title title-border title-center mb-4">
						<h4>Shop popular categories</h4>
					</div>

					<div class="row shop-categories clearfix">
						@foreach ($collections as $collection)
						@if($collection->image != null)
						<div class="col-lg-4">
							<a href="#" style="background: url('{{asset('images/collections/resized/'.$collection->image)}}') no-repeat center center; background-size: cover;">
								<div class="vertical-middle dark center">
									<div class="heading-block m-0 border-0">
										<h3 class="nott font-weight-semibold ls0">{{$collection->title}}</h3>
										<small class="button bg-white text-dark button-light button-mini">Shop Now</small>
									</div>
								</div>
							</a>
						</div>
						@endif
						@endforeach
					</div>

	</div>
	<div class="content-wrap">
		<div class="container clearfix">

			<!-- Shop
			============================================= -->
			<div id="shop" class="shop row grid-container gutter-30" data-layout="fitRows">

				@foreach ($products as $product)
				<div class="product col-lg-3 col-md-4 col-sm-6 col-12">
					<div class="grid-inner">
						<div class="product-image">
							@foreach ($product->images as $image)

							<a href="#"><img src="{{asset('images/products/resized/'.$image->file_path)}}" alt="Checked Short Dress"></a>
							@endforeach

							<div class="sale-flash badge badge-secondary p-2">Out of Stock</div>
							<div class="bg-overlay">
								<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">

									<view-button product_id="{{$product->id}}"></view-button>
									{{-- <a href="include/ajax/shop-item.html" class="btn btn-success" data-lightbox="ajax"><i class="icon-eye"></i> Deatails</a> --}}
								</div>
								<div class="bg-overlay-bg bg-transparent"></div>
							</div>
						</div>
						<div class="product-desc">
							<div class="product-title"><h3><a href="#">{{$product->title}}</a></h3></div>


						</div>
					</div>
				</div>
				@endforeach





			</div><!-- #shop end -->

		</div>
	</div>

					<!-- New Arrival Section
				============================================= -->
				<div class="section my-4">
					<div class="container">
						<div class="row align-items-stretch">
							<div class="col-md-5">
								<div class="row">
									<div class="col-md-12 center p-5">
										<div class="heading-block mb-1 border-bottom-0 mx-auto">
											<div class="font-secondary text-black-50 mb-1">New Arrivals</div>
											<h3 class="nott ls0">Fresh Arrivals / Autumn 18</h3>
											<p class="font-weight-normal mt-2 mb-3 text-muted" style="font-size: 17px; line-height: 1.4">Dynamically drive interdependent metrics for worldwide portals. Proactively grow client technology schemas.</p>
											<a href="#" class="button bg-dark text-white button-dark button-small ml-0">Shop Now</a>
										</div>
									</div>
									<div class="col-6">
										<a href="{{asset('demos/demos/shop/images/sections/1-2.jpg')}}" data-lightbox="image"><img src="{{asset('frontend/demos/shop/images/sections/1-2.jpg')}}" alt="Image"></a>
									</div>
									<div class="col-6">
										<a href="{{asset('demos/demos/shop/images/sections/1-3.jpg')}}" data-lightbox="image"><img src="{{asset('frontend/demos/shop/images/sections/1-3.jpg')}}" alt="Image"></a>
									</div>
								</div>
							</div>
							<div class="col-md-7 min-vh-50">
								<a href="https://www.youtube.com/watch?v=bpNcuh_BnsA" data-lightbox="iframe" class="d-block position-relative h-100" style="background: url('{{asset('frontend/demos/shop/images/sections/1.jpg')}}') center center no-repeat; background-size: cover;">
									<div class="vertical-middle text-center">
										<div class="play-icon"><i class="icon-play-sign display-3 text-light"></i></div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="clear"></div>

				<!-- New Arrivals Men
				============================================= -->
				<div class="container clearfix">

					<div class="fancy-title title-border topmargin-sm mb-4 title-center">
						<h4>New Arrivals: Men</h4>
					</div>

					<div class="row grid-6">

						<!-- Shop Item 1
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/1.jpg')}}" alt="Image 1"></a>
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/1-1.jpg')}}" alt="Image 1"></a>
									<div class="sale-flash badge badge-danger p-2">Sale!</div>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Light Blue Denim</a></h3></div>
									<div class="product-price font-primary"><del class="mr-1">$24.99</del> <ins>$12.49</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 2
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/2.jpg')}}" alt="Image 2"></a>
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/2-1.jpg')}}" alt="Image 2"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Deep Blue Sport Shoe</a></h3></div>
									<div class="product-price font-primary"><ins>$19.99</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 3
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/4.jpg')}}" alt="Image 3"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="sale-flash badge badge-danger p-2">Sale!</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Printed Men Short</a></h3></div>
									<div class="product-price font-primary"><del class="mr-1">$41.99</del> <ins>$35.00</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 4
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<div class="fslider" data-arrows="false" data-autoplay="4500">
										<div class="flexslider">
											<div class="slider-wrap">
												<div class="slide"><a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/3.jpg')}}" alt="Image 4"></a></div>
												<div class="slide"><a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/3-1.jpg')}}" alt="Image 4"></a></div>
											</div>
										</div>
									</div>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Women Sportd Track Pant</a></h3></div>
									<div class="product-price font-primary"><ins>$21.00</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 5
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/6.jpg')}}" alt="Image 5"></a>
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/6-1.jpg')}}" alt="Image 5"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Cool Printed Dress</a></h3></div>
									<div class="product-price font-primary"><ins>$31.49</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 6
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/5.jpg')}}" alt="Image 6"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="sale-flash badge badge-danger p-2">Sale!</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Red Stripe Girls Top</a></h3></div>
									<div class="product-price font-primary"><del class="mr-1">$41.99</del> <ins>$35.00</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 7
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/7.jpg')}}" alt="Image 7"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Dark Brown Lady Bag for Women</a></h3></div>
									<div class="product-price font-primary"><ins>$49.49</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 8
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/8.jpg')}}" alt="Image 8"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">UV Poection Sunglass</a></h3></div>
									<div class="product-price font-primary"><ins>$39.99</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 9
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/9.jpg')}}" alt="Image 9"></a>
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/9-1.jpg')}}" alt="Image 3"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="sale-flash badge badge-danger p-2">Sale!</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Workout Sweat T-shirt</a></h3></div>
									<div class="product-price font-primary"><del class="mr-1">$21.99</del> <ins>$15.00</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 10
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/10.jpg')}}" alt="Image 10"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="include/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="sale-flash badge badge-secondary p-2">Out of Stock!</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Sky Blue Printed Bag</a></h3></div>
									<div class="product-price font-primary"><ins>$61.49</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 11
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<div class="fslider" data-arrows="false" data-autoplay="4500">
										<div class="flexslider">
											<div class="slider-wrap">
												<div class="slide"><a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/11.jpg')}}" alt="Image 10"></a></div>
												<div class="slide"><a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/11-1.jpg')}}" alt="Image 10"></a></div>
											</div>
										</div>
									</div>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Blue Women Watch</a></h3></div>
									<div class="product-price font-primary"><ins>$23.00</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star-half-full"></i>
										<i class="icon-star-empty"></i>
									</div>
								</div>
							</div>
						</div>

						<!-- Shop Item 12
						============================================= -->
						<div class="col-lg-2 col-md-3 col-6 px-2">
							<div class="product">
								<div class="product-image">
									<a href="#"><img src="{{asset('frontend/demos/shop/images/items/new/12.jpg')}}" alt="Image 6"></a>
									<div class="bg-overlay">
										<div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
											<a href="#" class="btn btn-dark mr-2"><i class="icon-shopping-basket"></i></a>
											<a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
										</div>
										<div class="bg-overlay-bg bg-transparent"></div>
									</div>
								</div>
								<div class="product-desc">
									<div class="product-title mb-1"><h3><a href="#">Blue Party Shoe</a></h3></div>
									<div class="product-price font-primary"><ins>$51.00</ins></div>
									<div class="product-rating">
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
										<i class="icon-star3"></i>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

				<!-- Sign Up
				============================================= -->
				<div class="section my-4 py-5">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="row align-items-stretch align-items-center">
									<div class="col-md-7 min-vh-50" style="background: url('{{asset('frontend/demos/shop/images/sections/3.jpg')}}') center center no-repeat; background-size: cover;">
										<div class="vertical-middle pl-5">
											<h2 class="pl-5"><strong>40%</strong> Off<br>First Order*</h2>
										</div>
									</div>
									<div class="col-md-5 bg-white">
										<div class="card border-0 py-2">
											<div class="card-body">
												<h3 class="card-title mb-4 ls0">Sign up to get the most out of shopping.</h3>
												<ul class="iconlist ml-3">
													<li><i class="icon-circle-blank text-black-50"></i> Receive Exclusive Sale Alerts</li>
													<li><i class="icon-circle-blank text-black-50"></i> 30 Days Return Policy</li>
													<li><i class="icon-circle-blank text-black-50"></i> Cash on Delivery Accepted</li>
												</ul>
												<a href="#" class="button button-rounded ls0 font-weight-semibold ml-0 mb-2 nott px-4">Sign Up</a><br>
												<small class="font-italic text-black-50">Don't worry, it's totally free.</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="container">

					<!-- Features
					============================================= -->
					<div class="row col-mb-50 mb-0 mt-5">
						<div class="col-lg-7">
							<div class="row mt-3">
								<div class="col-sm-6">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-present text-dark text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">100% Original</h3>
											<p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 mt-4 mt-sm-0">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-globe text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">Free Shipping</h3>
											<p>Display your Content attractively using Parallax Sections that have unlimited customizable areas.</p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 mt-4">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-reload text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">30-Days Returns</h3>
											<p>You have complete easy control on each &amp; every element that provides endless customization possibilities.</p>
										</div>
									</div>
								</div>

								<div class="col-sm-6 mt-4">
									<div class="feature-box fbox-sm fbox-plain">
										<div class="fbox-icon">
											<a href="#"><i class="icon-line2-wallet text-dark"></i></a>
										</div>
										<div class="fbox-content">
											<h3 class="font-weight-normal">Payment Options</h3>
											<p>We accept Visa, MasterCard and American Express. And We also Deliver by COD(only in US)</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-5">
							<div class="accordion clearfix">

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										Our Mission
									</div>
								</div>
								<div class="accordion-content">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										What we Do?
									</div>
								</div>
								<div class="accordion-content">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										Our Company's Values
									</div>
								</div>
								<div class="accordion-content">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

								<div class="accordion-header">
									<div class="accordion-icon">
										<i class="accordion-closed icon-ok-circle"></i>
										<i class="accordion-open icon-remove-circle"></i>
									</div>
									<div class="accordion-title">
										Our Return Policy
									</div>
								</div>
								<div class="accordion-content">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

							</div>
						</div>

					</div>

					<div class="clear"></div>

					<!-- Brands
					============================================= -->
					<div class="row mt-5">
						<div class="col-12">
							<div class="fancy-title title-border title-center mb-4">
								<h4>Brands who give Flat <span class="text-danger">40%</span> Off</h4>
							</div>

							<ul class="clients-grid grid-2 grid-sm-3 grid-md-6 grid-lg-8 mb-0">
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/1.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/2.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/3.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/4.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/5.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/6.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/7.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/8.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/9.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/10.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/11.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/12.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/13.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/14.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/15.png')}}" alt="Clients"></a></li>
								<li class="grid-item"><a href="#"><img src="{{asset('frontend/images/clients/logo/16.png')}}" alt="Clients"></a></li>
							</ul>
						</div>
					</div>

				</div>

				<div class="clear"></div>

				<!-- App Buttons
				============================================= -->
				<div class="section pb-0 mb-0" style="background-color: #f8f5f0">
					<div class="container">
						<div class="row">
							<div class="col-md-6 offset-1 bottommargin-lg d-flex flex-column align-self-center">
								<h3 class="card-title font-weight-normal ls0">Follow. Find. Favorite.<br>Discover Fashion on the Go.</h3>
								<span>Proactively enable Corporate Benefits.</span>
								<div class="mt-3">
									<a href="#" class="button inline-block button-small button-rounded button-desc font-weight-normal ls1 clearfix"><i class="icon-apple"></i><div><span>Download Canvas Shop</span>App Store</div></a>
									<a href="#" class="button inline-block button-small button-rounded button-desc button-light text-dark font-weight-normal ls1 bg-white border clearfix"><i class="icon-googleplay"></i><div><span>Download Canvas Shop</span>Google Play</div></a>
								</div>
							</div>
							<div class="col-md-4 d-none d-md-flex align-items-end">
								<img src="{{asset('frontend/demos/shop/images/sections/app.png')}}" alt="Image" class="mb-0">
							</div>
						</div>
					</div>
				</div>

				<!-- Last Section
				============================================= -->
				<div class="section footer-stick bg-white m-0 py-3 border-bottom">
					<div class="container clearfix">

						<div class="row clearfix">
							<div class="col-lg-4 col-md-6">
								<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-globe-alt"></i><h5 class="inline-block mb-0 ml-2 font-weight-semibold"><a href="#">Free Shipping</a><span class="font-weight-normal text-muted"> &amp; Easy Returns</span></h5></div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-notebook"></i><h5 class="inline-block mb-0 ml-2"><a href="#">Geniune Products</a><span class="font-weight-normal text-muted"> Guaranteed</span></h5></div>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="shop-footer-features mb-3 mb-lg-3"><i class="icon-line2-lock"></i><h5 class="inline-block mb-0 ml-2"><a href="#">256-Bit</a> <span class="font-weight-normal text-muted">Secured Checkouts</span></h5></div>
							</div>
						</div>

					</div>
				</div>
</div>
@endsection

