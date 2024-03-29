<div class="site-footer bg-light">
		<div class="container">

			<div class="row justify-content-between">
				<div class="col-lg-4">
                    <div class="widget">
                        <h3 class="line-top">Contact Us</h3>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12">
                        <div class="widget">
                            <ul class="list-unstyled">
                                <li class="my-2">Address: <a style="color: #7a7a7a;" href="https://maps.app.goo.gl/nJbScjAffHx7gmaY8">Riyadh, Al Olaya Dist. Shaddad Ibn Aous, 2nd Floor, Office 7, Al Olaya, Riyadh 12611, KSA</a></li>
                                <li class="my-2">E-mail: {{ $hq -> email}}</li>
                                <li class="my-2">Telephone: {{ $hq -> phone_no }}</li>
                                <li class="my-2">Mobile: +966 58 031 9349 - +966 594782001</li>
                            </ul>
                        </div>
                    </div>
                </div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-6">
							<div class="widget">
								<h3 class="line-top">Navigations</h3>
							</div>
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="widget">
                                    <ul class="links list-unstyled">
                                        <li><a href="{{route('index')}}">Home</a></li>
                                        <li><a href="{{route('services')}}">Services</a></li>
                                        <li><a href="{{ route('projects')}}">Projects</a></li>
                                        <li><a href="{{ route('contact')}}">Contact Us</a></li>
                                        <li><a href="{{ route('about')}}">About Us</a></li>
                                    </ul>
                                </div>
                            </div>
						</div>
                        <div class="col-6">
							<div class="row">
                                <div class="widget">
                                    <h3 class="line-top m-0">Categories</h3>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6">
                                    <div class="widget">
                                        <ul class="list-unstyled links">
                                            @foreach($project_categories as $index => $category)
                                                @if(count($category->projects) >0 )
                                                <li><a href="{{ route('category.projects', $category->slug) }}">{{ ucwords($category->name) }}</a></li>
                                                @if($index == 7)
                                                    @break
                                                @endif
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6">
                                    <div class="widget">
                                        <ul class="list-unstyled links">
                                            @foreach($project_categories as $index => $category)
                                                @if(count($category->projects) >0 && $index > 7 )
                                                <li><a href="{{ route('category.projects', $category->slug) }}">{{ ucwords($category->name) }}</a></li>
                                                @endif
                                            @endforeach
                                            <li><a href="{{ route('awarded.projects') }}">Awarded Projects</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>

			</div>

			<div class="row justify-content-center text-center copyright">
				<div class="col-md-8">
					<p class="small text-black-50">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.<!-- License information: https://untree.co/license/ -->
					</p>
				</div>
			</div>
		</div>
	</div>
