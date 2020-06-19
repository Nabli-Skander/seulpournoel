@extends('layouts.dashboard')

@section('title', 'Changer mon mot de passe')

@section('dashboard-content')
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <nav class="nav flex-column side-nav">
                        <a class="nav-link active icon" href="my-profile.html">
                            <i class="fa fa-user"></i>My Profile
                        </a>
                        <a class="nav-link icon" href="my-ads.html">
                            <i class="fa fa-heart"></i>My Ads Listing
                        </a>
                        <a class="nav-link icon" href="bookmarks.html">
                            <i class="fa fa-star"></i>Bookmarks
                        </a>
                        <a class="nav-link icon" href="change-password.html">
                            <i class="fa fa-recycle"></i>Change Password
                        </a>
                    </nav>
                </div>
                <!--end col-md-3-->
                <div class="col-md-9">
                    <form class="form">
                        <div class="row">
                            <div class="col-md-8">
                                <h2>Personal Information</h2>
                                <section>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="title-selectized" class="col-form-label">Title</label>
                                                <select name="title" id="title" data-placeholder="Title" tabindex="-1"
                                                        class="selectized" style="display: none;">
                                                    <option value="1" selected="selected">Mrs</option>
                                                </select>
                                                <div class="selectize-control single">
                                                    <div class="selectize-input items full has-options has-items">
                                                        <div class="item" data-value="1">Mrs</div>
                                                        <input type="text" autocomplete="off" tabindex=""
                                                               id="title-selectized" readonly="" style="width: 4px;">
                                                    </div>
                                                    <div class="selectize-dropdown single"
                                                         style="display: none; width: 159.984px; top: 51px; left: 0px;">
                                                        <div class="selectize-dropdown-content"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name" class="col-form-label required">Your Name</label>
                                                <input name="name" type="text" class="form-control" id="name"
                                                       placeholder="Your Name" value="Jane Doe" required="">
                                            </div>
                                            <!--end form-group-->
                                        </div>
                                        <!--end col-md-8-->
                                    </div>
                                    <!--end row-->
                                    <div class="form-group">
                                        <label for="location" class="col-form-label required">Your Location</label>
                                        <input name="location" type="text" class="form-control" id="location"
                                               placeholder="Your Location" value="Manhattan, NY" required="">
                                    </div>
                                    <!--end form-group-->
                                    <div class="form-group">
                                        <label for="about" class="col-form-label">More About You</label>
                                        <textarea name="about" id="about" class="form-control" rows="4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</textarea>
                                    </div>
                                    <!--end form-group-->
                                </section>

                                <section>
                                    <h2>Contact</h2>
                                    <div class="form-group">
                                        <label for="phone" class="col-form-label">Phone</label>
                                        <input name="phone" type="text" class="form-control" id="phone"
                                               placeholder="Your Phone" value="312-238-3329">
                                    </div>
                                    <!--end form-group-->
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input name="email" type="email" class="form-control" id="email"
                                               placeholder="Your Email" value="jane.doe@example.com">
                                    </div>
                                    <!--end form-group-->
                                </section>

                                <section>
                                    <h2>Social</h2>
                                    <div class="form-group">
                                        <label for="twitter" class="col-form-label">Twitter</label>
                                        <input name="twitter" type="text" class="form-control" id="twitter"
                                               placeholder="http://" value="http://www.twitter.com/jane.doe">
                                    </div>
                                    <!--end form-group-->
                                    <div class="form-group">
                                        <label for="facebook" class="col-form-label">Facebook</label>
                                        <input name="facebook" type="text" class="form-control" id="facebook"
                                               placeholder="http://" value="http://www.facebook.com/jane.doe">
                                    </div>
                                    <!--end form-group-->
                                </section>

                                <section class="clearfix">
                                    <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                                </section>
                            </div>
                            <!--end col-md-8-->
                            <div class="col-md-4">
                                <div class="profile-image">
                                    <div class="image background-image"
                                         style="background-image: url(&quot;assets/img/author-09.jpg&quot;);">
                                        <img src="assets/img/author-09.jpg" alt="">
                                    </div>
                                    <div class="single-file-input">
                                        <input type="file" id="user_image" name="user_image">
                                        <div class="btn btn-framed btn-primary small">Upload a picture</div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-md-3-->
                        </div>
                    </form>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>

@endsection

@section('scripts')

@endsection