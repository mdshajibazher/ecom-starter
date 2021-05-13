@extends('layouts.frontend.app')
@section('title', 'Home')

@section('slider')
@include('layouts.frontend.partials.slider')
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
<div class="content-wrap pt-0">
	
	<!-- Client Carousel
	============================================= -->
	<div class="section bg-transparent m-0 border-bottom py-5">
		<div class="container">
			<div id="oc-clients" class="owl-carousel image-carousel carousel-widget" data-margin="100" data-loop="true" data-autoplay="5000" data-nav="false" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">
				<div class="oc-item"><a href="#"><img src="{{asset('frontend/demos/business/images/clients/linkedin.svg')}}" alt="Brands"></a></div>
				<div class="oc-item"><a href="#"><img src="{{asset('frontend/demos/business/images/clients/nat-geo.svg')}}" alt="Brands"></a></div>
				<div class="oc-item"><a href="#"><img src="{{asset('frontend/demos/business/images/clients/jetblue.svg')}}" alt="Brands"></a></div>
				<div class="oc-item"><a href="#"><img src="{{asset('frontend/demos/business/images/clients/zillow.svg')}}" alt="Brands"></a></div>
				<div class="oc-item"><a href="#"><img src="{{asset('frontend/demos/business/images/clients/amazon.svg')}}" alt="Brands"></a></div>
			</div>
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

	<!-- Features
	============================================= -->
	<div class="section bg-transparent mt-4 mb-0 pb-0">
		<div class="container">
			<div class="heading-block border-bottom-0 center mx-auto mb-0" style="max-width: 550px">
				<div class="badge badge-pill badge-default">Services</div>
				<h3 class="nott ls0 mb-3">What We Do</h3>
				<p>Dynamically provide access to resource-leveling mindshare vis-a-vis bricks-and-clicks ideas authoritatively.</p>
			</div>
			<div class="row justify-content-between align-items-center">

				<div class="col-lg-4 col-sm-6">

					<div class="feature-box flex-md-row-reverse text-md-right border-0">
						<div class="fbox-icon">
							<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/seo.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
						</div>
						<div class="fbox-content">
							<h3 class="nott ls0">SEO optimization</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, dolore, voluptates!</p>
						</div>
					</div>

					<div class="feature-box flex-md-row-reverse text-md-right border-0 mt-5">
						<div class="fbox-icon">
							<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/adword.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
						</div>
						<div class="fbox-content">
							<h3 class="nott ls0">Adwords Campaign</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, provident.</p>
						</div>
					</div>

					<div class="feature-box flex-md-row-reverse text-md-right border-0 mt-5">
						<div class="fbox-icon">
							<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/analysis.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
						</div>
						<div class="fbox-content">
							<h3 class="nott ls0">Digital Analysis</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, ipsa!</p>
						</div>
					</div>

				</div>

				<div class="col-lg-3 col-7 offset-3 offset-sm-0 d-sm-none d-lg-block center my-5">
					<img src="{{asset('frontend/demos/seo/images/sections/2.png')}}" alt="iphone" class="rounded  parallax" data-bottom-top="transform: translateY(-30px)" data-top-bottom="transform: translateY(30px)">
				</div>

				<div class="col-lg-4 col-sm-6">

					<div class="feature-box border-0">
						<div class="fbox-icon">
							<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/social.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
						</div>
						<div class="fbox-content">
							<h3 class="nott ls0">Social Media Marketing</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, dolore, voluptates!</p>
						</div>
					</div>

					<div class="feature-box border-0 mt-5">
						<div class="fbox-icon">
							<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/experience.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
						</div>
						<div class="fbox-content">
							<h3 class="nott ls0">Customer Experience</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, ipsa!</p>
						</div>
					</div>

					<div class="feature-box border-0 mt-5">
						<div class="fbox-icon">
							<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/content_marketing.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
						</div>
						<div class="fbox-content">
							<h3 class="nott ls0">Content Marketing</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, provident.</p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

	<!-- Pricing
	============================================= -->
	<div class="section m-0" style="background: url('{{asset('frontend/demos/seo/images/sections/4.png')}}') no-repeat center top; background-size: cover; padding: 140px 0 0;">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-4 mt-4">
					<div class="heading-block border-bottom-0 bottommargin-sm">
						<div class="badge badge-pill badge-default">Pricing Table</div>
						<h3 class="nott ls0">No Hidden Charges. <br>Choose Your Best Plan.</h3>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dolore voluptatem assumenda quae possimus sunt dignissimos tempora officia.</p>
					<div class="pricing-tenure-switcher d-flex align-items-center mb-4 position-relative" data-container="#pricing-switch">
						<span class="pts-left font-weight-bold text-muted">Monthly</span>
						<div class="pts-switcher mx-3">
							<div class="switch">
								<input id="switch-toggle-pricing-tenure" class="switch-toggle switch-toggle-round" type="checkbox">
								<label for="switch-toggle-pricing-tenure" class="mb-0"></label>
							</div>
						</div>
						<span class="pts-right font-weight-bold text-muted">Yearly</span>
						<div class="price-discount"></div>
					</div>
				</div>

				<div class="col-lg-8">
					<div id="section-pricing" class="page-section p-0 m-0">

						<div id="pricing-switch" class="pricing row align-items-end no-gutters col-mb-50 mb-4">

							<div class="col-md-6">

								<div class="pricing-box">
									<div class="pricing-title">
										<img class="mb-2 bg-transparent rounded-0" src="{{asset('frontend/demos/seo/images/icons/man.svg')}}" alt="Pricing Icon" width="50">
										<h3>Single User Plan</h3>
										<span>Most Popular</span>
									</div>
									<div class="pricing-price">
										<div class="pts-switch-content-left"><span class="price-unit">&dollar;</span>5<span class="price-tenure">Per Month</span></div>
										<div class="pts-switch-content-right"><span class="price-unit">&dollar;</span>48<span class="price-tenure">Per Year</span></div>
									</div>
									<div class="pricing-features border-0 bg-transparent">
										<ul>
											<li><i class="icon-check-circle color mr-2"></i><strong>Limited</strong> Support</li>
											<li class="pts-switch-content-left text-black-50"><i class="icon-minus-circle mr-2"></i><del style="opacity: .5"><strong>1</strong> Free Optimization</del></li>
											<li class="pts-switch-content-right"><i class="icon-check-circle color mr-2"></i><strong>1</strong> Free Optimization</li>
											<li><i class="icon-check-circle color mr-2"></i><strong>100+</strong> Pages</li>
											<li><i class="icon-check-circle color mr-2"></i><strong>Single</strong> User License</li>
											<li><i class="icon-check-circle color mr-2"></i>Phone &amp; Email Support</li>
										</ul>
									</div>
									<div class="pricing-action">
										<div class="pts-switch-content-left"><a href="#" class="button button-large button-rounded btn-block text-capitalize m-0 ls0">Get Started</a></div>
										<div class="pts-switch-content-right"><a href="#" class="button button-large button-rounded btn-block text-capitalize m-0 ls0">Get Started</a></div>
									</div>
								</div>

							</div>

							<div class="col-md-6">

								<div class="pricing-box">
									<div class="pricing-title">
										<img class="mb-2 bg-transparent rounded-0" src="{{asset('frontend/demos/seo/images/icons/group.svg')}}" alt="Pricing Icon" width="60">
										<h3>Multiple User Plan</h3>
									</div>
									<div class="pricing-price">
										<div class="pts-switch-content-left"><span class="price-unit">&dollar;</span>12<span class="price-tenure">Per Month</span></div>
										<div class="pts-switch-content-right"><span class="price-unit">&dollar;</span>115<span class="price-tenure">Per Year</span></div>
									</div>
									<div class="pricing-features border-0 bg-transparent">
										<ul>
											<li><i class="icon-check-circle color mr-2"></i><strong>24*7</strong> Support</li>
											<li><i class="icon-check-circle color mr-2"></i><strong>10</strong> Free Optimization</li>
											<li><i class="icon-check-circle color mr-2"></i><strong>1000+</strong> Pages</li>
											<li><i class="icon-check-circle color mr-2"></i><strong>Unlimited</strong> User License</li>
											<li><i class="icon-check-circle color mr-2"></i>Phone &amp; Email Support</li>
										</ul>
									</div>
									<div class="pricing-action">
										<div class="pts-switch-content-left"><a href="#" class="button button-rounded button-large button-light text-dark bg-white border btn-block nott m-0 ls0">Get Started</a></div>
										<div class="pts-switch-content-right"><a href="#" class="button button-rounded button-large button-light text-dark bg-white border btn-block nott m-0 ls0">Get Started</a></div>
									</div>
								</div>

							</div>

						</div>

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Form Section
	============================================= -->
	<div class="section m-0" style="background: url('{{asset('frontend/demos/seo/images/sections/1.jpg')}}') no-repeat center center; background-size: cover; padding: 100px 0;">
		<div class="container">
			<div class="row justify-content-between align-items-center">

				<div class="col-md-4">
					<div class="heading-block border-bottom-0 bottommargin-sm">
						<div class="badge badge-pill badge-default">Careers</div>
						<h3 class="nott ls0">Get your free Quote today</h3>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dolore voluptatem assumenda quae possimus sunt dignissimos tempora officia.</p>
				</div>

				<div class="col-lg-3 col-md-4">
					<div class="card shadow-sm">
						<div class="card-body">
							<h4 class="mb-3">Apply Now</h4>
							<div class="form-widget">
								<div class="form-result"></div>
								<form class="row mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post">
									<div class="col-12 form-group mb-3">
										<label for="template-contactform-name">Name:*</label>
										<input type="text" id="template-contactform-name" name="template-contactform-name" class="form-control input-sm required" value="">
									</div>
									<div class="col-12 form-group mb-3">
										<label for="template-contactform-email">Email Address:*</label>
										<input type="email" id="template-contactform-email" name="template-contactform-email" class="form-control input-sm required" value="">
									</div>
									<div class="col-12 form-group mb-4">
										<label for="template-contactform-website">Website:*</label>
										<input type="text" id="template-contactform-website" name="template-contactform-website" class="form-control input-sm required" value="">
									</div>
									<div class="col-12 form-group mb-0">
										<button class="button button-rounded btn-block nott ls0 m-0" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Apply Now</button>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mt-5 mt-md-0 center">
					<a href="https://www.youtube.com/watch?v=P3Huse9K6Xs" data-lightbox="iframe" class="play-icon shadow"><i class="icon-play"></i></a>
				</div>

			</div>

		</div>
	</div>

	<!-- Works/Projects
	============================================= -->
	<div class="section m-0" style="background: url('{{asset('frontend/demos/seo/images/sections/5.jpg')}}') no-repeat center center; background-size: cover;padding: 80px 0;">
		<div class="container">
			<div class="heading-block border-bottom-0 center">
				<div class="badge badge-pill badge-default">Completed Projects</div>
				<h3 class="nott ls0">Our Latest Works</h3>
			</div>

			<div id="portfolio" class="portfolio row grid-container gutter-20">

				<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-media pf-icons">
					<div class="grid-inner">
						<div class="portfolio-image">
							<img src="{{asset('frontend/demos/seo/images/works/1.jpg')}}" alt="The Atmosphere">
							<div class="bg-overlay">
								<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="500">
									<a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeIn" data-hover-speed="500"><i class="icon-line-ellipsis"></i></a>
								</div>
								<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="500"></div>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3><a href="#">The Atmosphere</a></h3>
							<span>Digital Marketing</span>
						</div>
					</div>
				</article>

				<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-illustrations">
					<div class="grid-inner">
						<div class="portfolio-image">
							<img src="{{asset('frontend/demos/seo/images/works/2.jpg')}}" alt="Wavelength Structure">
							<div class="bg-overlay">
								<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="500">
									<a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeIn" data-hover-speed="500"><i class="icon-line-ellipsis"></i></a>
								</div>
								<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="500"></div>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Wavelength Structure</h3>
							<span>SEO</span>
						</div>
					</div>
				</article>

				<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-graphics pf-uielements">
					<div class="grid-inner">
						<div class="portfolio-image">
							<img src="{{asset('frontend/demos/seo/images/works/3.jpg')}}" alt="Greenhouse Garden">
							<div class="bg-overlay">
								<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="500">
									<a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeIn" data-hover-speed="500"><i class="icon-line-ellipsis"></i></a>
								</div>
								<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="500"></div>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Simplicity Pages</h3>
							<span>Analytics</span>
						</div>
					</div>
				</article>

				<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-icons pf-illustrations">
					<div class="grid-inner">
						<div class="portfolio-image">
							<img src="{{asset('frontend/demos/seo/images/works/4.jpg')}}" alt="Industrial Hub">
							<div class="bg-overlay">
								<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="500">
									<a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeIn" data-hover-speed="500"><i class="icon-line-ellipsis"></i></a>
								</div>
								<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="500"></div>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>SEO Analysis</h3>
							<span>SEO</span>
						</div>
					</div>
				</article>

				<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-uielements pf-media">
					<div class="grid-inner">
						<div class="portfolio-image">
							<img src="{{asset('frontend/demos/seo/images/works/5.jpg')}}" alt="Corporate Headquarters">
							<div class="bg-overlay">
								<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="500">
									<a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeIn" data-hover-speed="500"><i class="icon-line-ellipsis"></i></a>
								</div>
								<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="500"></div>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Marketing Strategy</h3>
							<span>Digital Marketing</span>
						</div>
					</div>
				</article>

				<article class="portfolio-item col-12 col-sm-6 col-md-4 pf-graphics pf-illustrations">
					<div class="grid-inner">
						<div class="portfolio-image">
							<img src="{{asset('frontend/demos/seo/images/works/6.jpg')}}" alt="Space Station">
							<div class="bg-overlay">
								<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="500">
									<a href="#" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeIn" data-hover-speed="500"><i class="icon-line-ellipsis"></i></a>
								</div>
								<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="500"></div>
							</div>
						</div>
						<div class="portfolio-desc">
							<h3>Space Station</h3>
							<span>Social Media</span>
						</div>
					</div>
				</article>

			</div>

			<div class="center">
				<a href="demo-seo-about.html" class="button button-large button-rounded text-capitalize ml-0 mt-5 ls0">View All Works</a>
			</div>

		</div>
	</div>

	<!-- Features
	============================================= -->
	<div class="container clearfix py-5">
		<div class="row">
			<div class="col-md-4 mt-5">
				<div class="feature-box fbox-center border-0">
					<div class="fbox-icon">
						<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/research.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
					</div>
					<div class="fbox-content">
						<h3 class="nott ls0">1. Planning &amp; Research</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, dolore, voluptates!</p>
					</div>
				</div>
			</div>

			<div class="col-md-4 mt-5">
				<div class="feature-box fbox-center border-0">
					<div class="fbox-icon">
						<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/optimizing.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
					</div>
					<div class="fbox-content">
						<h3 class="nott ls0">2. Optimizing</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, provident.</p>
					</div>
				</div>
			</div>

			<div class="col-md-4 mt-5">
				<div class="feature-box fbox-center border-0">
					<div class="fbox-icon">
						<a href="#"><img src="{{asset('frontend/demos/seo/images/icons/result.svg')}}" alt="Feature Icon" class="bg-transparent rounded-0"></a>
					</div>
					<div class="fbox-content">
						<h3 class="nott ls0">3. Result</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, ipsa!</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Testimonials
	============================================= -->
	<div class="section mt-0" style="background: url('{{asset('frontend/demos/seo/images/sections/3.jpg')}}') no-repeat top center; background-size: cover; padding: 80px 0 70px;">
		<div class="container">
			<div class="heading-block border-bottom-0 center">
				<div class="badge badge-pill badge-default">Testimonials</div>
				<h3 class="nott ls0">What Clients Says</h3>
			</div>

			<div id="oc-testi" class="owl-carousel testimonials-carousel carousel-widget clearfix" data-margin="0" data-pagi="true" data-loop="true" data-center="true" data-autoplay="5000" data-items-sm="1" data-items-md="2" data-items-xl="3">

				<div class="oc-item">
					<div class="testimonial">
						<div class="testi-image">
							<a href="#"><img src="{{asset('frontend/demos/pet/images/testimonials/1.jpg')}}" alt="Customer Testimonails"></a>
						</div>
						<div class="testi-content">
							<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum repellendus!</p>
							<div class="testi-meta">
								John Doe
								<span>XYZ Inc.</span>
							</div>
						</div>
					</div>
				</div>

				<div class="oc-item">
					<div class="testimonial">
						<div class="testi-image">
							<a href="#"><img src="{{asset('frontend/demos/pet/images/testimonials/2.jpg')}}" alt="Customer Testimonails"></a>
						</div>
						<div class="testi-content">
							<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
							<div class="testi-meta">
								Collis Ta'eed
								<span>Envato Inc.</span>
							</div>
						</div>
					</div>
				</div>
				<div class="oc-item">
					<div class="testimonial">
						<div class="testi-image">
							<a href="#"><img src="{{asset('frontend/demos/pet/images/testimonials/3.jpg')}}" alt="Customer Testimonails"></a>
						</div>
						<div class="testi-content">
							<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
							<div class="testi-meta">
								Collis Ta'eed
								<span>Envato Inc.</span>
							</div>
						</div>
					</div>
				</div>
				<div class="oc-item">
					<div class="testimonial">
						<div class="testi-image">
							<a href="#"><img src="{{asset('frontend/demos/pet/images/testimonials/4.jpg')}}" alt="Customer Testimonails"></a>
						</div>
						<div class="testi-content">
							<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
							<div class="testi-meta">
								Mary Jane
								<span>Google Inc.</span>
							</div>
						</div>
					</div>
				</div>
				<div class="oc-item">
					<div class="testimonial">
						<div class="testi-image">
							<a href="#"><img src="{{asset('frontend/images/testimonials/5.jpg')}}" alt="Customer Testimonails"></a>
						</div>
						<div class="testi-content">
							<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
							<div class="testi-meta">
								Steve Jobs
							<span>Apple Inc.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blogs
	============================================= -->
	<div class="container py-4">
		<div class="heading-block border-bottom-0 center">
			<div class="badge badge-pill badge-default">Latest Articles</div>
			<h3 class="nott ls0">Recently From the Blog</h3>
		</div>

		<div class="row mt-5 clearfix">
			<div class="col-md-4">
				<article class="entry">
					<div class="entry-image mb-3">
						<a href="#"><img src="{{asset('frontend/demos/seo/images/blog/1.jpg')}}" alt="Image 3"></a>
					</div>
					<div class="entry-title">
						<h3><a href="#">Top Most SEO Optizied Websites</a></h3>
					</div>
					<div class="entry-meta">
						<ul>
							<li><i class="icon-line2-user"></i><a href="#"> John Doe</a></li>
							<li><i class="icon-calendar-times1"></i><a href="#"> 11 Mar 2021</a></li>
						</ul>
					</div>
					<div class="entry-content clearfix">
						<p>Asperiores, tenetur, blanditiis, quaerat odit ex exercitationem progressive technology through pariatur quibusdam veritatis quisquam. Efficiently communicate alternative.</p>
					</div>
				</article>
			</div>

			<div class="col-md-4">
				<article class="entry">
					<div class="entry-image mb-3">
						<a href="#"><img src="{{asset('frontend/demos/seo/images/blog/2.jpg')}}" alt="Image 3"></a>
					</div>
					<div class="entry-title">
						<h3><a href="#">10 Recent SEO Tips for Startups</a></h3>
					</div>
					<div class="entry-meta">
						<ul>
							<li><i class="icon-line2-user"></i><a href="#"> Semicolonweb</a></li>
							<li><i class="icon-calendar-times1"></i><a href="#"> 18 Apr 2021</a></li>
						</ul>
					</div>
					<div class="entry-content clearfix">
						<p>Interactively predominate progressive technology through distinctive materials. Progressively benchmark extensible intellectual. Exercitationem progressive technology through pariatur.</p>
					</div>
				</article>
			</div>

			<div class="col-md-4">
				<article class="entry">
					<div class="entry-image mb-3">
						<a href="#"><img src="{{asset('frontend/demos/seo/images/blog/3.jpg')}}" alt="Image 3"></a>
					</div>
					<div class="entry-title">
						<h3><a href="#">3 Ways to Transform Your Site Into a SEO</a></h3>
					</div>
					<div class="entry-meta">
						<ul>
							<li><i class="icon-line2-user"></i><a href="#"> John Doe</a></li>
							<li><i class="icon-calendar-times1"></i><a href="#"> 06 Aug 2021</a></li>
						</ul>
					</div>
					<div class="entry-content clearfix">
						<p>Globally synergize premium metrics with holistic e-markets. Professionally morph interoperable networks vis-a-vis value-added methods.</p>
					</div>
				</article>
			</div>
		</div>

	</div>

	<!-- Promo/Contact
	============================================= -->
	<div class="section mt-5 footer-stick promo-section bg-transparent" style="padding: 100px 0; overflow: visible">
		<div class="container">
			<div class="heading-block border-bottom-0 center">
				<h5 class="text-uppercase ls1 mb-1">Grab your Free Trail and Explore the Options</h5>
				<h2 class="nott ls0">Try Keyword Search 30 Days Free With Canvas<span>SEO</span></h2>
				<a href="demo-seo-contact.html" class="button button-large button-rounded nott ml-0 ls0 mt-4">Contact Us Now</a>
			</div>
		</div>
	</div>
</div>

@endsection
