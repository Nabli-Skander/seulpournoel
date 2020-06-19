<footer class="footer">
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <a href="#" class="brand">
                        <img src="/img/logo_{{LaravelLocalization::getCurrentLocale()}}.png" alt="Seul Pour Noël"/>
                    </a>
                    <p>

                        @include('partials.description-' .  LaravelLocalization::getCurrentLocale())

                    </p>
                </div>
                <!--end col-md-5-->
                <div class="col-md-4">
                    <h2>@lang('Navigation')</h2>

                    @include('navigation.footer')


                </div>
                <!--end col-md-3-->
                <div class="col-md-3">
                    <h2>@lang('Contact')</h2>
                    <a href="https://www.facebook.com/seulpourNoel" target="_blank"
                       class="btn btn-primary btn-framed btn-block"><i class="fa fa-facebook"></i> &nbsp;Facebook</a>
                    <br><br>
                    <a href="&#x6d;&#x61;&#x69;&#x6c;&#116;&#x6f;&#x3a;&#x74;&#101;&#x61;&#109;&#64;&#x73;&#101;&#x75;&#108;&#112;&#111;&#117;&#x72;&#110;&#x6f;&#101;&#x6c;&#x2e;&#x66;&#114;"
                       class="btn btn-primary btn-framed btn-block"><i class="fa fa-envelope-o"></i> &nbsp;E-mail</a>

                </div>
                <!--end col-md-4-->
            </div>
            <!--end row-->
        </div>
        <div class="background">
            <div class="background-image original-size">
                <img src="/theme/img/footer-background-icons.jpg" alt="">
            </div>
            <!--end background-image-->
        </div>
        <!--end background-->
    </div>
</footer>
