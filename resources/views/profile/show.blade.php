@extends('layouts.default')

@section('title', $user->first_name)



@section('content')

    <section class="block">
        <div class="container">
            <section class="my-0">
                <div class="author big">
                    <div class="author-image">
                        <div class="background-image">
                            <img src="{{$user->imageURL() }}" alt="">
                        </div>
                    </div>
                    <!--end author-image-->
                    <div class="author-description">
                        <div class="section-title">
                            <h2>{{ $user->first_name }}</h2>
                            <h4 class="location">
                                <a href="#">{{ $user->location() }}</a>
                            </h4>
                            <h4>
                                {{ $user->sexAndAge() }}
                            </h4>
                            <figure>
                                {{--<div class="float-left">--}}
                                {{--<div class="rating" data-rating="4"></div>--}}
                                {{--</div>--}}
                                <div class="text-align-right social">
                                    {{--<a href="#">--}}
                                    {{--<i class="fa fa-facebook-square"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#">--}}
                                    {{--<i class="fa fa-twitter-square"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#">--}}
                                    {{--<i class="fa fa-instagram"></i>--}}
                                    {{--</a>--}}
                                </div>
                                <br>
                            </figure>
                        </div>
                        @if(\Auth::user()->isRelatedTo($user))
                            <div class="additional-info">
                                <ul>
                                    @if( $user->phone)
                                        <li>
                                            <figure>@lang('Téléphone')</figure>
                                            <aside>{{ $user->phone }}</aside>
                                        </li>
                                    @endif
                                    <li>
                                        <figure>@lang('E-mail')</figure>
                                        <aside><a href="#">{{ $user->email }}</a></aside>
                                    </li>
                                </ul>
                            </div>
                    @endif
                    <!--end addition-info-->
                        <p>
                            {{ $user->about }}
                        </p>
                    </div>
                    <!--end author-description-->
                </div>
                <!--end author-->
            </section>

            {{--<hr>--}}

            {{--<section>--}}
            {{--<h2>Evenements</h2>--}}
            {{--<!--============ Section Title===================================================================-->--}}
            {{--<div class="section-title clearfix">--}}

            {{--<div class="float-right float-xs-none d-xs-none thumbnail-toggle">--}}
            {{--<a href="#" class="change-class active" data-change-from-class="list compact"--}}
            {{--data-change-to-class="grid" data-parent-class="items">--}}
            {{--<i class="fa fa-th"></i>--}}
            {{--</a>--}}
            {{--<a href="#" class="change-class" data-change-from-class="grid"--}}
            {{--data-change-to-class="list compact" data-parent-class="items">--}}
            {{--<i class="fa fa-th-list"></i>--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!--============ Items ==========================================================================-->--}}
            {{--<div class="read-more" data-read-more-link-more="Show More"--}}
            {{--data-read-more-link-less="Show Less">--}}
            {{--<div class="items grid grid-xl-3-items grid-lg-3-items grid-md-2-items">--}}
            {{--<div class="item">--}}
            {{--<div class="ribbon-featured">Featured</div>--}}
            {{--<!--end ribbon-->--}}
            {{--<div class="wrapper">--}}
            {{--<div class="image">--}}
            {{--<h3>--}}
            {{--<a href="#" class="tag category">Home & Decor</a>--}}
            {{--<a href="single-listing-1.html" class="title">Furniture for sale</a>--}}
            {{--<span class="tag">Offer</span>--}}
            {{--</h3>--}}
            {{--<a href="single-listing-1.html" class="image-wrapper background-image">--}}
            {{--<img src="assets/img/image-01.jpg" alt="">--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<!--end image-->--}}
            {{--<h4 class="location">--}}
            {{--<a href="#">Manhattan, NY</a>--}}
            {{--</h4>--}}
            {{--<div class="price">$80</div>--}}
            {{--<div class="meta">--}}
            {{--<figure>--}}
            {{--<i class="fa fa-calendar-o"></i>02.05.2017--}}
            {{--</figure>--}}
            {{--<figure>--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-user"></i>Jane Doe--}}
            {{--</a>--}}
            {{--</figure>--}}
            {{--</div>--}}
            {{--<!--end meta-->--}}
            {{--<div class="description">--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis--}}
            {{--lobortis</p>--}}
            {{--</div>--}}
            {{--<!--end description-->--}}
            {{--<a href="single-listing-1.html" class="detail text-caps underline">Detail</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!--end item-->--}}

            {{--<div class="item">--}}
            {{--<div class="wrapper">--}}
            {{--<div class="image">--}}
            {{--<h3>--}}
            {{--<a href="#" class="tag category">Education</a>--}}
            {{--<a href="single-listing-1.html" class="title">Creative Course</a>--}}
            {{--<span class="tag">Offer</span>--}}
            {{--</h3>--}}
            {{--<a href="single-listing-1.html" class="image-wrapper background-image">--}}
            {{--<img src="assets/img/image-02.jpg" alt="">--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<!--end image-->--}}
            {{--<h4 class="location">--}}
            {{--<a href="#">Nashville, TN</a>--}}
            {{--</h4>--}}
            {{--<div class="price">$125</div>--}}
            {{--<div class="meta">--}}
            {{--<figure>--}}
            {{--<i class="fa fa-calendar-o"></i>28.04.2017--}}
            {{--</figure>--}}
            {{--<figure>--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-user"></i>Peter Browner--}}
            {{--</a>--}}
            {{--</figure>--}}
            {{--</div>--}}
            {{--<!--end meta-->--}}
            {{--<div class="description">--}}
            {{--<p>Proin at tortor eros. Phasellus porta nec elit non lacinia. Nam bibendum--}}
            {{--erat at leo faucibus vehicula. Ut laoreet porttitor risus, eget suscipit--}}
            {{--tellus tincidunt sit amet. </p>--}}
            {{--</div>--}}
            {{--<!--end description-->--}}
            {{--<div class="additional-info">--}}
            {{--<ul>--}}
            {{--<li>--}}
            {{--<figure>Start Date</figure>--}}
            {{--<aside>25.06.2017 09:00</aside>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<figure>Length</figure>--}}
            {{--<aside>2 months</aside>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<figure>Bedrooms</figure>--}}
            {{--<aside>3</aside>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--<!--end addition-info-->--}}
            {{--<a href="single-listing-1.html" class="detail text-caps underline">Detail</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!--end item-->--}}

            {{--<div class="item">--}}
            {{--<div class="wrapper">--}}
            {{--<div class="image">--}}
            {{--<h3>--}}
            {{--<a href="#" class="tag category">Adventure</a>--}}
            {{--<a href="single-listing-1.html" class="title">Into The Wild</a>--}}
            {{--<span class="tag">Ad</span>--}}
            {{--</h3>--}}
            {{--<a href="single-listing-1.html" class="image-wrapper background-image">--}}
            {{--<img src="assets/img/image-03.jpg" alt="">--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<!--end image-->--}}
            {{--<h4 class="location">--}}
            {{--<a href="#">Seattle, WA</a>--}}
            {{--</h4>--}}
            {{--<div class="price">$1,560</div>--}}
            {{--<div class="meta">--}}
            {{--<figure>--}}
            {{--<i class="fa fa-calendar-o"></i>21.04.2017--}}
            {{--</figure>--}}
            {{--<figure>--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-user"></i>Peak Agency--}}
            {{--</a>--}}
            {{--</figure>--}}
            {{--</div>--}}
            {{--<!--end meta-->--}}
            {{--<div class="description">--}}
            {{--<p>Nam eget ullamcorper massa. Morbi fringilla lectus nec lorem tristique--}}
            {{--gravida</p>--}}
            {{--</div>--}}
            {{--<!--end description-->--}}
            {{--<a href="single-listing-1.html" class="detail text-caps underline">Detail</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!--end item-->--}}

            {{--<div class="item">--}}
            {{--<div class="wrapper">--}}
            {{--<div class="image">--}}
            {{--<h3>--}}
            {{--<a href="#" class="tag category">Real Estate</a>--}}
            {{--<a href="single-listing-1.html" class="title">Luxury Apartment</a>--}}
            {{--<span class="tag">Offer</span>--}}
            {{--</h3>--}}
            {{--<a href="single-listing-1.html" class="image-wrapper background-image">--}}
            {{--<img src="assets/img/image-04.jpg" alt="">--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<!--end image-->--}}
            {{--<h4 class="location">--}}
            {{--<a href="#">Greeley, CO</a>--}}
            {{--</h4>--}}
            {{--<div class="price">$75,000</div>--}}
            {{--<div class="meta">--}}
            {{--<figure>--}}
            {{--<i class="fa fa-calendar-o"></i>13.03.2017--}}
            {{--</figure>--}}
            {{--<figure>--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-user"></i>Hills Estate--}}
            {{--</a>--}}
            {{--</figure>--}}
            {{--</div>--}}
            {{--<!--end meta-->--}}
            {{--<div class="description">--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis--}}
            {{--lobortis</p>--}}
            {{--</div>--}}
            {{--<!--end description-->--}}
            {{--<div class="additional-info">--}}
            {{--<ul>--}}
            {{--<li>--}}
            {{--<figure>Area</figure>--}}
            {{--<aside>368m<sup>2</sup></aside>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<figure>Bathrooms</figure>--}}
            {{--<aside>2</aside>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<figure>Bedrooms</figure>--}}
            {{--<aside>3</aside>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<figure>Garage</figure>--}}
            {{--<aside>1</aside>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--<!--end addition-info-->--}}
            {{--<a href="single-listing-1.html" class="detail text-caps underline">Detail</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!--end item-->--}}

            {{--<div class="item">--}}
            {{--<div class="wrapper">--}}
            {{--<div class="image">--}}
            {{--<h3>--}}
            {{--<a href="#" class="tag category">Architecture</a>--}}
            {{--<a href="single-listing-1.html" class="title">We'll Redesign Your--}}
            {{--Apartment</a>--}}
            {{--<span class="tag">Offer</span>--}}
            {{--</h3>--}}
            {{--<a href="single-listing-1.html" class="image-wrapper background-image">--}}
            {{--<img src="assets/img/image-05.jpg" alt="">--}}
            {{--</a>--}}
            {{--</div>--}}
            {{--<!--end image-->--}}
            {{--<h4 class="location">--}}
            {{--<a href="#">Greeley, CO</a>--}}
            {{--</h4>--}}
            {{--<div class="price">--}}
            {{--<span class="appendix">From</span>--}}
            {{--$200--}}
            {{--</div>--}}
            {{--<div class="meta">--}}
            {{--<figure>--}}
            {{--<i class="fa fa-calendar-o"></i>13.03.2017--}}
            {{--</figure>--}}
            {{--<figure>--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-user"></i>XL Designers--}}
            {{--</a>--}}
            {{--</figure>--}}
            {{--</div>--}}
            {{--<!--end meta-->--}}
            {{--<div class="description">--}}
            {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis--}}
            {{--lobortis</p>--}}
            {{--</div>--}}
            {{--<!--end description-->--}}
            {{--<div class="additional-info">--}}
            {{--<ul>--}}
            {{--<li>--}}
            {{--<figure>Area</figure>--}}
            {{--<aside>368m<sup>2</sup></aside>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<figure>Bathrooms</figure>--}}
            {{--<aside>2</aside>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<figure>Bedrooms</figure>--}}
            {{--<aside>3</aside>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--<!--end addition-info-->--}}
            {{--<a href="single-listing-1.html" class="detail text-caps underline">Detail</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<!--end item-->--}}
            {{--</div>--}}
            {{--<!--============ End Items ==============================================================-->--}}
            {{--</div>--}}
            {{--<!--end read-more-->--}}
            {{--</section>--}}
            {{--<section>--}}
            {{--<h2>Write a Review</h2>--}}
            {{--<form class="form">--}}
            {{--<div class="row">--}}
            {{--<div class="col-md-8">--}}
            {{--<div class="form-group">--}}
            {{--<label for="subject" class="col-form-label">Subject</label>--}}
            {{--<input name="subject" type="text" class="form-control" id="subject"--}}
            {{--placeholder="Did you like a deal?">--}}
            {{--</div>--}}
            {{--<!--end form-group-->--}}
            {{--</div>--}}
            {{--<!--end col-md-8-->--}}
            {{--<div class="col-md-4">--}}
            {{--<div class="form-group">--}}
            {{--<label for="rating" class="col-form-label">Rating</label>--}}
            {{--<select name="rating" id="rating" data-placeholder="Select Rating">--}}
            {{--<option value="">Select Rating</option>--}}
            {{--<option value="1" data-option-stars="1">Horrible</option>--}}
            {{--<option value="2" data-option-stars="2">Average</option>--}}
            {{--<option value="3" data-option-stars="3">Good</option>--}}
            {{--<option value="4" data-option-stars="4">Very Good</option>--}}
            {{--<option value="5" data-option-stars="5">Excellent</option>--}}
            {{--</select>--}}
            {{--</div>--}}
            {{--<!--end form-group-->--}}
            {{--</div>--}}
            {{--<!--end col-md-4-->--}}
            {{--<div class="col-md-12">--}}
            {{--<div class="form-group">--}}
            {{--<label for="review" class="col-form-label">Your Review</label>--}}
            {{--<textarea name="review" id="review" class="form-control" rows="4"--}}
            {{--placeholder="Good seller, I am satisfied."></textarea>--}}
            {{--</div>--}}
            {{--<!--end form-group-->--}}
            {{--</div>--}}
            {{--<!--end col-md-12-->--}}
            {{--</div>--}}
            {{--<!--end row-->--}}
            {{--</form>--}}
            {{--<!--end form-->--}}
            {{--</section>--}}
            {{--<section>--}}
            {{--<h2>Reviews</h2>--}}
            {{--<div class="comments">--}}
            {{--<div class="comment">--}}
            {{--<div class="author">--}}
            {{--<a href="#" class="author-image">--}}
            {{--<div class="background-image">--}}
            {{--<img src="assets/img/author-09.jpg" alt="">--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--<div class="author-description">--}}
            {{--<h3>Positive experience!</h3>--}}
            {{--<div class="meta">--}}
            {{--<span class="rating" data-rating="4"></span>--}}
            {{--<span>02.05.2017</span>--}}
            {{--<h5><a href="#">Jane Doe</a></h5>--}}
            {{--</div>--}}
            {{--<!--end meta-->--}}
            {{--<p>--}}
            {{--Nam pulvinar tortor nec lacinia efficitur. Integer erat tortor, ultricies--}}
            {{--ut est vel, euismod imperdiet lacus. Aenean nec turpis condimentum, mollis--}}
            {{--mauris id, scelerisque quam.--}}
            {{--</p>--}}
            {{--</div>--}}
            {{--<!--end author-description-->--}}
            {{--</div>--}}
            {{--<!--end author-->--}}
            {{--</div>--}}
            {{--<!--end comment-->--}}


            {{--</div>--}}

            {{--</section>--}}
        </div>
        <!--end container-->
    </section>
@endsection