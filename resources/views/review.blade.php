<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>PressCheck Template</title>
    <link rel="stylesheet" href="{{asset('styles/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('styles/css/presscheck_style.css')}}">
    <link rel="stylesheet" href="{{asset('styles/css/presscheck_review.css')}}">
    <link rel="stylesheet" href="{{asset('styles/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('styles/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('styles/css/owl.theme.default.min.css')}}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse">

<!-- PRE LOADER -->
<section class="preloader">
    <div class="spinner">

        <span class="spinner-rotate"></span>

    </div>
</section>

<section id="header-block" class="header-block-review">
    <div class="container">
        <div class="row d-flex header-branding">
            <a href="{{env('APP_URL')}}" class="navbar-brand"><img src="{{asset('styles/images/logo/presscheck-white-logo.svg')}}"></a>
            <a href="preesscheck-landing.html" class="presscheck-review-link"> What represents PressCheck?</a>



        </div>
    </div>
</section>
<!-- end   about-us -->


<section id="reviews" data-stellar-background-ratio="1">
    <div class="overlay"></div>
    <div class="container">

        <div class="row">

            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 left-column-reviews">
                <div class="row review-top-block">
                    <div class="col-sm-12 col-md-3 reviews-mark d-flex ">
                        <img class="reviews-chart" src="{{asset($imageSource)}}">
                        <h3>{{$review->mark}} / 10</h3>
                    </div>
                    <div class="col-sm-12 col-md-9 reviews-description">
                        <div class="review-website">{{$review->media->title}}
                            <a href="{{$review->media->url}}">{{$review->media->url}}</a>
                        </div>
                        <p>{{$review->media->description}}</p>
                    </div>
                </div>


                <div class="row">
                    @if ($review->proofs->isNotEmpty())
                        <div class="pc-reviews-proofs">
                            <div class="footer-heading"><h2>Proofs.</h2></div>
                                @foreach ($review->proofs as $proof)
                                    <div class="review-data review-proofs">
                                        <div class="review-title">
                                            <p>{{$proof->title}}</p>
                                        </div>
                                        <div class="review-description">
                                            <p>{{$proof->body}}</p>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    @endif


                    @if ($review->naratives->isNotEmpty())
                        <div class="pc-reviews-naratives">
                            <div class="footer-heading"><h2>Naratives.</h2></div>
                            @foreach ($review->naratives as $narative)
                                <div class="review-data review-naratives">
                                    <div class="review-title">
                                        <p>{{$narative->title}}</p>
                                    </div>
                                    <div class="review-description">
                                        <p>{{$narative->body}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 right-column-reviews">
                <div class="review-criterias">
                    <ul class="">
                        @foreach ($criterias as $criteria)
                            <li>
                                @if (in_array($criteria->id, $review->criterias->pluck('id')->toArray()))
                                    <img src="{{asset('styles/images/Group 289.svg')}}">
                                @else
                                    <img src="{{asset('styles/images/Group 345.svg')}}">
                                @endif
                                <span class="review-criteria">
                                    {{$criteria->title}}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- end   about-us -->


<!-- start   footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <a href="{{env('APP_URL')}}"><img src="{{asset('styles/images/logo/presscheck-white-logo.svg')}}"></a>
                <div class="footer-slogan ">
                    <div class="text-uppercase">Seeking the truth</div>
                    <div>
                        Our trained analysts, who are experienced journalists, research online news brands to help readers and viewers know which ones are trying to do legitimate journalism—and which are not.
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 d-flex flex-row footer-links-folow">
                <div class="footer-links d-flex flex-col col-md-offset-2 col-md-3 col-sm-6 col-xs-12 padding-0">
                    <div class="text-uppercase footer-heading">Links</div>

                    <a href="#header-block" class="d-flex">Home</a>
                    <a href="#about-us" class="d-flex">About us</a>
                    <a href="#reviews" class="d-flex">Reviews</a>
                    <a href="#contact" class="d-flex">Get in touch</a>
                </div>
                <div class="d-flex flex-col col-md-7 col-sm-6 col-xs-12 padding-0">
                    <div class="social_icon">
                        <div class="text-uppercase footer-heading">Follow us</div>
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-linkedin"></a>
                        <a href="#" class="fa fa-tumblr"></a>
                    </div>
                    <p>Copyright © 2084 Your Company Name</p>
                </div>
            </div>

        </div>
    </div>
</footer>
<!-- end   footer -->

<!-- start back to top -->
<a href="#top" class="go-top"><i class="fa fa-chevron-up fa-1x"></i></a>
<!-- end back to top -->

<script src="{{asset('styles/js/jquery.js')}}"></script>
<script src="{{asset('styles/js/bootstrap.min.js')}}"></script>
<script src="{{asset('styles/js/wow.min.js')}}"></script>
<script src="{{asset('styles/js/smoothscroll.js')}}"></script>
<script src="{{asset('styles/js/jquery.flexslider.js')}}"></script>
<script src="{{asset('styles/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('styles/js/wow.min.js')}}"></script>
<!--    <script src="js/presschek-custom.js"></script>-->
<!-- start   back to top js -->
<script>
    $(document).ready(function() {
        $(window).load(function(){
            $('.preloader').fadeOut(1000); // set duration in brackets
        });
        // FlexSlider
        $('.flexslider').flexslider({
            animation: "fade",
            directionNav: false
        });

        // Show or hide the sticky footer button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 200) {
                $('.go-top').fadeIn(200);
            } else {
                $('.go-top').fadeOut(200);
            }
        });
        // Animate the scroll to top
        $('.go-top').click(function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop: 0}, 300);
        });


        $('.owl-carousel').owlCarousel({
            animateOut: 'fadeOut',
            items:1,
            loop:true,
            autoplayHoverPause: false,
            autoplay: true,
            smartSpeed: 1000,
        });

        new WOW({ mobile: false }).init();

    });
</script>
<!-- end   back to top js -->

</body>
</html>
