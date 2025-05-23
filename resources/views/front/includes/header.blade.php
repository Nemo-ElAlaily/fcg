<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<nav class="site-nav navbar-main" >
		<div class="container">
			<div class="site-navigation">
				<a href="#" class="logo m-0 float-start">
                    <img alt="logo" src="{{ $site_settings->logo_path }}" style="height: 50px; margin-left: 10px;" oncontextmenu="return false;"/>
				</a>

				<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-start" style="margin-top: 10px;">
					<li class="active"><a href="{{ route('index')}}">Home</a></li>
					<li class="has-children">
						<a href="{{ route('categories') }}">Projects</a>
						<ul class="dropdown">
                            @foreach($project_categories as $index => $category)
                                @if($category->projects()->count() >0 )
							    <li><a href="{{ route('category.projects', $category->slug) }}">{{ ucwords($category->name) }}</a></li>
                                @endif
                            @endforeach
                            <li><a href="{{ route('awarded.projects') }}">Awarded Projects</a></li>
						</ul>
					</li>
					<li><a href="{{ route('services')}}">Services</a></li>
					<li><a href="{{ route('about')}}">About</a></li>
					<li><a href="{{ route('contact')}}">Contact Us</a></li>
					<li><a href="{{ asset('DEC OFFICE PROFIL 024-025 Riyadh REV1.pdf')}}" download>Our Portfolio</a></li>
				</ul>



				<a href="#" class="burger ml-auto float-end site-menu-toggle light js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>
                @if($site_settings -> phone)
				<ul class="site-menu float-end d-none d-md-block">
					<li><a href="{{ route('index') }}" class="p-0 pt-2"><img alt="HRTis Logo" id="hrtis_logo" src="{{ asset('front/images/HRTis-Logo-White.png') }}" style="height: 50px;" oncontextmenu="return false;"/></a></li>
				</ul>
                @endif

			</div>
		</div>
	</nav>
