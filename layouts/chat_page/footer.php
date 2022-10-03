<script src="<?php echo Registry::load('config')->site_url.'assets/js/combined_js_chat_page.js'.$cache_timestamp; ?>"></script>

<?php include 'layouts/chat_page/web_push_service_scripts.php'; ?>

<?php
if (Registry::load('settings')->progressive_web_application === 'enable') {
    ?> 
    <script type="module">
        import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwainstall';
        const el = document.createElement('pwa-update');
        document.body.appendChild(el);
    </script>
    <script>
        $(window).on('load', function() {
            if ("serviceWorker" in navigator) {
                navigator.serviceWorker.register(baseurl+"pwa-sw.js");
            }
        });
    </script>

    <?php

}
if (Registry::load('current_user')->logged_in) {

    $bg_image = get_image(['from' => 'site_users/backgrounds', 'search' => Registry::load('current_user')->id, 'replace_with_default' => false]);

    if (!empty($bg_image)) {
        ?>
        <style>
            body {
                background: url('<?php echo $bg_image;
                ?>');
                background-size: cover;
                background-position: center;
            }
        </style>
        <?php
    }
}

?>
<script>
$("body").on("keyup", ".main .aside > .site_records > .search > input", function (e) {
	console.log('1');
// 	  var force_search = !1;
// 	  if (e.keyCode === 8) {
// 	      if ($(this).val().length === 0) {
// 	          force_search = !0;
// 	      }
// 	  }
//	    if (e.which == 13 || force_search) {
	      if ($(".main .aside > .site_records > .current_record").attr("load") !== undefined) {
	          var search = $(this).val();
	          if (search.length != 0 || $(".main .aside > .site_records > .current_record").attr("null_search") !== undefined) {
	              $(".main .aside > .site_records .current_record_search_keyword").val(search);
	              $(".main .aside > .site_records .current_record_offset").val("");
	              load_aside($(".main .aside > .site_records > .current_record"), 2, 1);
	          } else {
	              $(".main .aside > .site_records .current_record_filter").val("");
	              $(".main .aside > .site_records .current_record_sort_by").val("");
	              $(".main .aside > .site_records .current_record_offset").val("");
	              $(".main .aside > .site_records .current_record_search_keyword").val("");
	              load_aside($(".main .aside > .site_records > .current_record"));
	          }
	      }
	//  }
	});
$("body").on("click", ".topsearch", function (e) {
    if ($(".top22").is(":visible")) {
        $(".top22").hide();
    } else {
        $(".top22").removeClass('d-none')
        $(".main .chatbox > .header > .switch_user").removeClass("open");
        $(".top22").fadeIn();
        $(".top22 > div > .search > div > input").trigger("focus");
        
    }
});
var mouse_is_inside = false;

$(document).ready(function()
{
    $('.top22').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside) $('.top22').hide();
    });
});
var mouse_is_inside1 = false;

$(document).ready(function()
{
    $('.search_messages').hover(function(){ 
        mouse_is_inside1=true; 
    }, function(){ 
        mouse_is_inside1=false; 
    });

    $("body").mouseup(function(){ 
        if(! mouse_is_inside1) $('.search_messages').hide();
    });
});
</script>
<?php
include 'layouts/chat_page/google_analytics.php';
include 'assets/headers_footers/chat_page/footer.php';
?>
</html>