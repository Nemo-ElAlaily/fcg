<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<nav class="site-nav" style="position: fixed; background-color: #000000a0;">
		<div class="container">
			<div class="site-navigation">
				<a href="#" class="logo m-0 float-start">
                    <img alt="HRTis Logo" src="{{ asset('front/images/HRTis-Logo-Gray.png') }}" style="height: 50px;"/>
                    <img alt="logo" src="{{ $site_settings->logo_path }}" style="height: 50px; margin-left: 10px;"/>
				</a>

				<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-start" style="margin-top: 10px;">
					<li class="active"><a href="{{ route('index')}}">Home</a></li>
					<li class="has-children">
						<a href="#">Projects</a>
						<ul class="dropdown">
                            @foreach($project_categories as $index => $category)
                                @if(count($category->projects) >0 )
							    <li><a href="{{ route('category.projects', $category->slug) }}">{{ ucwords($category->name) }}</a></li>
                                @endif
                            @endforeach
						</ul>
					</li>
					<li><a href="{{ route('services')}}">Services</a></li>
					<li><a href="{{ route('about')}}">About</a></li>
					<li><a href="{{ route('contact')}}">Contact Us</a></li>
					<li><a href="{{ asset('DEC OFFICE PROFIL 2023 Riyadh REV1.pdf')}}" download>Our Portfolio</a></li>
				</ul>



				<a href="#" class="burger ml-auto float-end site-menu-toggle light js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>
                @if($site_settings -> phone)
				<ul class="site-menu float-end d-none d-md-block" style="margin-top: 10px;">
					<li><a href="#" class="d-flex align-items-center text-white h2 fw-bold"><span class="icon-phone me-2"></span> <span>{{ $site_settings -> phone }}</span></a></li>
				</ul>
                @endif

			</div>
		</div>
	</nav>
