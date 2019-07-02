<script src="{{ url('/public/admin_assets/js/bootstrap.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/js/select2.full.min.js')}}"></script>
<script src="{{ url('/public/admin_assets/js/jQuery-plugin-progressbar.js')}}"></script>
<script src="{{ url('/public/admin_assets/js/jquery.datetimepicker.js')}}"></script>
<script src="{{ url('/public/admin_assets/js/fSelect.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<script>
    jQuery(function ($) {
        $(".sidebar-dropdown > a").click(function() {
          $(".sidebar-submenu").slideUp(200);
            if (
              $(this)
              .parent()
              .hasClass("active")
            ) {
              $(".sidebar-dropdown").removeClass("active");
              $(this)
               .parent()
               .removeClass("active");
            } else {
             $(".sidebar-dropdown").removeClass("active");
              $(this)
               .next(".sidebar-submenu")
               .slideDown(200);
              $(this)
               .parent()
               .addClass("active");
            }
         });
        $("#toggle-sidebar").click(function() {
          $(".page-wrapper").toggleClass("toggled");
          $(".sidebar-wrapper").toggleClass("show-icon-side");
        });
        $( window ).resize(function() {
      if($(window).width() <=500) $('.sidebar-wrapper').addClass("show-icon-side");
      else $('.sidebar-wrapper').removeClass("show-icon-side");
    });
    });
</script>
<script>
    $(".progress-bar").loading();
    $('input').on('click', function () {
        $(".progress-bar").loading();
    });
</script>

<script>
   $(function() {
      // turn the element to select2 select style
      $('.select2').select2();

      /**__ Kp __**/ 
        get_unread_notification_counts();
        get_unread_notification_list();

        function get_unread_notification_counts(){
          $.ajax({
            url:'{{url("/notification-unread-count")}}',
            success:function (data)
            { 
              // alert(data);
              if (data > 0 ) {
                
                $('#unread_count_show').text(data);              
                $('#unread_count_show').show();              

              }else{
                
                $('#unread_count_show').hide();              
              }
            }
          });
        }

        function get_unread_notification_list(){
          $.ajax({
            url:'{{url("/notification-unread-list")}}',
            success:function (data)
            { 

              $('#unread_list_show').html(data);              
            }
          });
        }
      /**__ Kp __**/ 

    });


    
</script>

</body>

</html>