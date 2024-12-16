@include('front.common.header')
@include('front.common.navbar')
<section id="page-title" data-bg-parallax="{{asset('assets/images/top-banner.png')}}">
            <div class="container">
                <div class="page-title">
                    <h1>404 Page Not Found</h1>
                    
                </div>
            </div>
        </section>
<div class="container pt-5">
    <div class="row justify-content-center">
        @extends('errors::illustrated-layout')

		@section('code', '404 😭')

		@section('title', __('Page Not Found'))

		@section('image')

		@endsection

		@section('message', __('Sorry, the page you are looking for could not be found.'))	
    </div>
</div>
<div class="clearfix pt-5"></div>
@include('front.common.footer')
