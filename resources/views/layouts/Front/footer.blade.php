<!-- Footer -->
<footer class="footer-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
               <div>
                   <ul class="footer-main-links wow slideInLeft">
                       <li><a href="">About Us</a></li>
                       <li><a href="">FAQ</a></li>
                       <li><a href="">Occasions</a></li>
                       <li><a href="">Wedding</a></li>
                       <li><a href="">Corporate</a></li>
                       <li><a href="">Contact Us</a></li>
                       <li><a href="">Blogs</a></li>
                   </ul>
               </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="copyright-line">
                    <p>Site By Quest Global Technologies <br>copyright voodh</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="social-links">
                    <ul>
                        <li><a href=""><img src="assets/images/icons/snapchat.png"></a></li>
                        <li><a href=""><img src="assets/images/icons/whatsup.png"></a></li>
                        <li><a href=""><img src="assets/images/icons/youtobe.png"></a></li>
                        <li><a href=""><img src="assets/images/icons/twitter.png"></a></li>
                        <li><a href=""><img src="assets/images/icons/FB.png"></a></li>
                        <li><a href=""><img src="assets/images/icons/INSTA.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

        <a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
        <!-- JQuery -->
        <script type="text/javascript" src="{{ url('/public/assets/js/jquery-2.2.0.min.js') }}"></script>
        <!-- <script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script> -->
        <!-- Bootstrap Core JavaScript -->
        <script type="text/javascript" src="{{ url('/public/assets/js/bootstrap.min.js') }}"></script>
        <!-- dropdownhover effects JavaScript -->
        <script type="text/javascript" src="{{ url('/public/assets/js/bootstrap-dropdownhover.min.js') }}"></script>
        <!-- slick JavaScript -->
        <script type="text/javascript" src="{{ url('/public/assets/js/slick.js') }}"></script>
         <script type="text/javascript" src="{{ url('/public/assets/js/slick.min.js') }}"></script>
        <!-- wow JavaScript -->
        <script type="text/javascript" src="{{ url('/public/assets/js/wow.min.js') }}"></script>
        <!-- video player JavaScript -->

        <!-- Custom JavaScript -->
        <script type="text/javascript" src="{{ url('/public/assets/js/custom.js') }}"></script>

         <script type="text/javascript">
            $(document).on('ready', function() {

                $(".banner-slider").slick({
                dots: true,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                  {
                    breakpoint: 768,
                    settings: {
                      arrows: false,
                      centerMode:false,
                      centerPadding: '40px',
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      arrows: false,
                      centerMode: false,
                      centerPadding: '40px',
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
                  ]
              });


              $(".follow-slider").slick({
                dots: true,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                arrows: false,
                slidesToShow: 5,
                slidesToScroll: 3,
                responsive: [
                  {
                    breakpoint: 768,
                    settings: {
                      arrows: false,
                      centerMode: false,
                      centerPadding: '40px',
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  },
                  {
                    breakpoint: 480,
                    settings: {
                      arrows: false,
                      centerMode: false,
                      centerPadding: '40px',
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
                  ]
              });
            });
        </script>
               <script>
          /*---- scroll top end-----*/
jQuery(document).ready(function ($) {
    var navbar = $('.header-main'),
            distance = navbar.offset().top + 5,
            $window = $(window);

    $window.scroll(function () {
        if ($window.scrollTop() >= distance) {
            navbar.removeClass('header-fixed').addClass('header-fixed');
            $("body").css("padding-top", "0px");
        } else {
            navbar.removeClass('header-fixed');
            $("body").css("padding-top", "0px");
        }
    });
});
/*---- scroll top end-----*/
        </script>

        <script>
    $(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
    $(this).removeClass("active");
    }
    $(this).addClass("active");

    });
</script>
<script>
    $(document).ready(function(){
        $(".seller-option ul li a").click(function(){
            $(".seller-option ul li").removeClass("active");
            $(this).parent("li").addClass("active");
        });
    });
</script> 
<script>
  $('#gNavi li').hover(function(){
    if($(this).has('ul'))
      $(this).find('ul').stop().slideDown(200);
      },function(){
       if($(this).has('ul'))
          $(this).find('ul').stop().slideUp(200);
  });
</script>

    </body>
</html>
