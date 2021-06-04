<?php
/**
 *Template Name: template-round
 */

wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );
wp_enqueue_script('affilate-api.js');
$curl = curl_init();

    $api_url = 'https://api-sandbox.rezserver.com/api/';
    $refid = '10068';
    $api_key = 'f8e4553f1837afa17047b7fdb9c6924a';
    $sid = '545b7d84c5b770a8a24c55a8857ea78720150703115359';
    $adults = $_GET["adults"];
    $child = $_GET["childs"];
    $departm = $_GET["departm"];
    $returnn = $_GET["returnn"];
    $destinattion = $_GET["destinattion"];
    $origin = $_GET["origin"];
    


curl_setopt_array($curl, [
    CURLOPT_URL => $api_url."/air/getFlightRoundTrip?format=json2&refid=".$refid."&api_key=".$api_key."&sid=".$sid."&origin_airport_code%5B%5D=".$origin."&destination_airport_code%5B%5D=".$destinattion."&departure_date%5B%5D=".$departm."&origin_airport_code%5B%5D=".destinattion."&destination_airport_code%5B%5D=".$origin."&departure_date%5B%5D=".$returnn,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Cache-Control: no-cache"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
    $flights;
    
    $array = json_decode($response, true);

    foreach($array as $producto =>$detalles){
       //echo "<p> $producto:$detalles</p>";
      foreach($detalles as $clave =>$valor){
       //echo "<p> $clave:$valor</p>";
        foreach($valor as $clave2 =>$valor2){
          //echo "<p> $clave2:$valor2</p>";
          foreach($valor2 as $clave3 =>$valor3){
             //echo "<p> $clave3:$valor3</p>";
                 if($clave3=="itinerary_count"){
                     $itinerary_count= $valor3;
                 }
                 else if ($clave3=="search_data"){
                    foreach($valor3 as $clave6 =>$valor6){
                         foreach($valor6 as $clave7 =>$valor7){
                           //echo  "<p> $clave7:$valor7</p>";
                           if($clave7=="origin"){
                               $origin = $valor7;
                              foreach($valor7 as $clave8 =>$valor8){
                                    
                                //echo  "<p> $clave8:$valor8</p>";
                              }        
                           }
                         }        
                     }
                 }
                 else if($clave3=="itinerary_data"){
                  //echo sizeof($valor3);
                       $itinerary_data= $valor3;
                  foreach($valor3 as $clave4 =>$valor4){
                     //echo  "<p> $clave4:$valor4</p>";
                     foreach($valor4 as $clave5 =>$valor5){
                       //echo  "<p> $clave5:$valor5</p>";
                          if($clave5 == "slice_data"){
                           foreach($valor5 as $clave9 =>$valor9){
                             //echo  "<p> $clave9:$valor9</p>";
                              foreach($valor9 as $clave10 =>$valor10){
                                //echo  "<p> $clave10:$valor10</p>";
                                   if($clave10=="airline"){
                                         $airline= $valor10;
                                        foreach($valor10 as $clave11 =>$valor11){
                                          //echo  "<p> $clave11:$valor11</p>";
                                         }
                                      }
                                    else if($clave10=="departure"){
                                           $departure= $valor10;
                                         foreach($valor10 as $clave12 => $valor12){
                                            //echo  "<p> $clave12:$valor12</p>";
                                               if($clave12=="airport"){
                                                   $airportd= $valor12;
                                                }
                                               else if($clave12=="datetime"){
                                                   $datetimed= $valor12;
                                                }
                                         }
                                    }
                                    else if($clave10=="arrival"){
                                        foreach($valor10 as $clave13 => $valor13){
                                            //echo  "<p> $clave13:$valor13</p>";
                                               if($clave13=="airport"){
                                                   $airporta= $valor13;
                                                }
                                               else if($clave13=="datetime"){
                                                   $datetimea= $valor13;
                                                }
                                         }
                                    }else if($clave10=="flight_data"){
                                        foreach($valor10 as $clave15 => $valor15){
                                          //echo  "<p> $clave15:$valor15</p>";
                                          foreach($valor15 as $clave16 => $valor16){
                                             //echo  "<p> $clave16:$valor16</p>";
                                             if($clave16=="info"){
                                                  $info=$valor16;
                                              }
                                           }
                                         }
                                     }//fin else if
                              }
                           }
                          }else if($clave5 == "price_details"){
                                  $pricet=$valor5;
                                foreach($valor5 as $clave14 => $valor14){
                                     //echo  "<p> $clave14:$valor14</p>";
                                     
                                     
                                }
                            }
                     }
                  }

               }
            
          }
        }
      }    
    }



    //var_dump($array);
}


?>

<style>

.daterangepicker{
    top: 353.188px !important;
 }

#destinationn{
    box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    height: auto;
    position: absolute;
    z-index: 9999;
    width: 95%;
}
 
#destinationn .suggest-element {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
}

#page-navi{
     padding-top: 0% !important;
}

.momento::after {
  content: '';
  position: absolute;
  top: -8px;
  right: calc(-11.11% - 11.5px);
  height: 20px;
  width: 20px;
  background-color: #000;
  border-radius: 50%;
}

.momento:nth-child(even)::after {
  left: calc(-11.11% - 8.5px);
}

.momento {
  position: relative;
  width: 45%;
  box-sizing: border-box;

}
.momento:nth-child(even) {
  left: 55%;
}

#connection {
    position: absolute;
    margin-top: -32px;
    margin-left: 156px;
}

.momento2::after {
  content: '';
  position: absolute;
  top: -8px;
  right: calc(39.89% - 11.5px);
  height: 20px;
  width: 20px;
  background-color: #000;
  border-radius: 50%;
}

.momento2:nth-child(even)::after {
  left: calc(-11.11% - 8.5px);
}

.momento2 {
  position: relative;
  width: 45%;
  box-sizing: border-box;

}
.momento2:nth-child(even) {
  left: 33.3%;
}

#connection2 {
    position: absolute;
    margin-top: -32px;
    margin-left: 80px;
}

.momento3::after {
  content: '';
  position: absolute;
  top: -8px;
  right: calc(-11.11% - 11.5px);
  height: 20px;
  width: 20px;
  background-color: #000;
  border-radius: 50%;
}

.momento3:nth-child(even)::after {
  left: calc(-11.11% - 8.5px);
}

.momento3 {
  position: relative;
  width: 45%;
  box-sizing: border-box;

}
.momento3:nth-child(even) {
  left: 80%;
}

#connection3 {
    position: absolute;
    margin-top: -32px;
    margin-left: -30px;
}

.tooltiptext {
    visibility: hidden;
    width: 200px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
 
   
    position: absolute;
    z-index: 1;
}

.tooltiptext2 {
    visibility: hidden;
    width: 200px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
    margin-left: -92px;

   
    position: absolute;
    z-index: 1;
}

.tooltiptext3 {
    visibility: hidden;
    width: 200px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
    margin-left: -170px;

   
    position: absolute;
    z-index: 1;
}

   
.momento:hover .tooltiptext {
    visibility: visible;
}

.momento2:hover .tooltiptext2 {
    visibility: visible;
}
.momento3:hover .tooltiptext3 {
    visibility: visible;
}

@media screen and (max-width: 999px){
 #head1{
    padding: 3px !important;
 }

 #head2{
    padding-top: 0px !important;
 }

 #logoairline{
    width: 80px !important;
    margin-top: 37px !important;
 }

 #nameair{
    padding-left: 10px !important;
 }

 #connection {
    margin-left: 55px !important;
 }

 #connection2 {
    margin-left: 27px !important;
 }

 #connection3 {
    margin-left: -17px !important;
 }

 .head3{
    padding-right: 0px !important;
    padding-left: 0px !important;
 }
 
 h3{
      font-size: 16px !important;
 }

 #line{
  border-right: 0px !important;
 }

}

#destinationf{
    box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    height: auto;
    position: absolute;
    z-index: 9999;
    width: 36%;
    margin-left: 15px;
    margin-top: 79px;
   
}
 
#destinationf .suggest-element {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
}
#destinationff{
    box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    height: auto;
    position: absolute;
    z-index: 9999;
    width: 34%;
    margin-left: 234px;
    margin-top: 79px;
   
}
 
#destinationff .suggest-element {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
}

@media screen and (min-width: 1000px){
 .clearfix .visible-xs{
    display: none !important;
  }
 .radiod{
     display: block !important;
   }
}

@media screen and (max-width: 999px){
 .clearfix .visible-xs{
    display: block !important;
  }
 .radiod{
     display: none !important;
   }

 .advance{
   margin-left: 40px !important;
   }
 .dropdown-menu{
      width: 90% !important;
  }

 #destinationf{
      width: 90%;
      margin-top: 0px;
      margin-left: 0px;
  }

 #destinationff{
      margin-left: 0px;
      margin-top: 0px;  
      width: 90%;
 }

 #ss_location_origin{
      width: 250px !important;
 }
 
 #ss_location_destination{
      width: 250px !important;
 }

}

</style>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=2, minimum-scale=1">
        <meta name="theme-color" content="#ED8323"/>
        <meta name="robots" content="follow"/>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
                    <meta name="traveler" content="2.9.2"/>          <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="https://dividivitravel.com/xmlrpc.php">
                <title>Search Flights &#8211; WP-CLI</title>
<meta name='robots' content='noindex,nofollow' />
<link rel='dns-prefetch' href='//api.tiles.mapbox.com' />
<link rel='dns-prefetch' href='//cdn.jsdelivr.net' />
<link rel='dns-prefetch' href='//apis.google.com' />
<link rel='dns-prefetch' href='//www.google.com' />
<link rel='dns-prefetch' href='//fonts.googleapis.com' />
<link rel='dns-prefetch' href='//maxst.icons8.com' />
<link rel='dns-prefetch' href='//api.mapbox.com' />
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="WP-CLI &raquo; Feed" href="https://dividivitravel.com" />
<link rel="alternate" type="application/rss+xml" title="WP-CLI &raquo; Comments Feed" href="https://dividivitravel.com/?feed=comments-rss2" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/dividivitravel.com\/wp-includes\/js\/wp-emoji-release.min.js"}};
			!function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>

<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
	<link rel='stylesheet' id='dashicons-css'  href='https://dividivitravel.com/wp-includes/css/dashicons.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='admin-bar-css'  href='https://dividivitravel.com/wp-includes/css/admin-bar.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wp-block-library-css'  href='https://dividivitravel.com/wp-includes/css/dist/block-library/style.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='wc-block-vendors-style-css'  href='https://dividivitravel.com/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/vendors-style.css' type='text/css' media='all' />
<link rel='stylesheet' id='wc-block-style-css'  href='https://dividivitravel.com/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='https://dividivitravel.com/wp-content/plugins/contact-form-7/includes/css/styles.css' type='text/css' media='all' />
<link rel="stylesheet" href="https://dividivitravel.com/wp-content/themes/traveler/css/pagination.css" >
<link rel='stylesheet' id='woocommerce-layout-css'  href='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css' type='text/css' media='all' />
<link rel='stylesheet' id='woocommerce-smallscreen-css'  href='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)' />
<link rel='stylesheet' id='woocommerce-general-css'  href='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/css/woocommerce.css' type='text/css' media='all' />
<style id='woocommerce-inline-inline-css' type='text/css'>
.woocommerce form .form-row .required { visibility: visible; }
</style>
<link rel='stylesheet' id='google-font-css-css'  href='https://fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600&#038;ver=5.6.2' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/bootstrap.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='helpers-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/helpers.css' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/font-awesome.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='fotorama-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/js/fotorama/fotorama.css' type='text/css' media='all' />
<link rel='stylesheet' id='rangeSlider-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/js/ion.rangeSlider/css/ion.rangeSlider.css' type='text/css' media='all' />
<link rel='stylesheet' id='rangeSlider-skinHTML5-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/js/ion.rangeSlider/css/ion.rangeSlider.skinHTML5.css' type='text/css' media='all' />
<link rel='stylesheet' id='daterangepicker-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/js/daterangepicker/daterangepicker.css' type='text/css' media='all' />
<link rel='stylesheet' id='awesome-line-awesome-css-css'  href='https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.1.0/css/line-awesome.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='sweetalert2-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/sweetalert2.css' type='text/css' media='all' />
<link rel='stylesheet' id='select2.min-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/select2.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='flickity-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/flickity.css' type='text/css' media='all' />
<link rel='stylesheet' id='magnific-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/js/magnific-popup/magnific-popup.css' type='text/css' media='all' />
<link rel='stylesheet' id='owlcarousel-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/js/owlcarousel/assets/owl.carousel.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='st-style-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='affilate-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/affilate.css' type='text/css' media='all' />
<link rel='stylesheet' id='affilate-h-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/affilate-h.css' type='text/css' media='all' />
<link rel='stylesheet' id='search-result-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/search_result.css' type='text/css' media='all' />
<link rel='stylesheet' id='st-fix-safari-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/fsafari.css' type='text/css' media='all' />
<link rel='stylesheet' id='checkout-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/checkout.css' type='text/css' media='all' />
<link rel='stylesheet' id='partner-page-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/partner_page.css' type='text/css' media='all' />
<link rel='stylesheet' id='responsive-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/responsive.css' type='text/css' media='all' />
<link rel='stylesheet' id='mCustomScrollbar-css-css'  href='https://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.1.3/jquery.mCustomScrollbar.min.css' type='text/css' media='all' />
<link rel='stylesheet' id='single-tour-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/sin-tour.css' type='text/css' media='all' />
<link rel='stylesheet' id='enquire-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/enquire.css' type='text/css' media='all' />
<link rel='stylesheet' id='mapbox-css-css'  href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.css?optimize=true&#038;ver=5.6.2' type='text/css' media='all' />
<link rel='stylesheet' id='mapbox-css-api-css'  href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' type='text/css' media='all' />
<link rel='stylesheet' id='mapbox-custom-css-css'  href='https://dividivitravel.com/wp-content/themes/traveler/v2/css/mapbox-custom.css' type='text/css' media='all' />
<link rel='stylesheet' id='vcv:assets:front:style-css'  href='https://dividivitravel.com/wp-content/plugins/visualcomposer/public/dist/front.bundle.css' type='text/css' media='all' />
<script type='text/javascript' id='jquery-core-js-extra'>
/* <![CDATA[ */
var list_location = {"list":"\"\""};
var st_checkout_text = {"without_pp":"Submit Request","with_pp":"Booking Now","validate_form":"Please fill all required fields","error_accept_term":"Please accept our terms and conditions","email_validate":"Email is not valid","adult_price":"Adult","child_price":"Child","infant_price":"Infant","adult":"Adult","child":"Child","infant":"Infant","price":"Price","origin_price":"Origin Price","text_unavailable":"Not Available: "};
var st_params = {"theme_url":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler","caculator_price_single_ajax":"off","site_url":"https:\/\/dividivitravel.com","load_price":"https:\/\/dividivitravel.com","ajax_url":"https:\/\/dividivitravel.com\/wp-admin\/admin-ajax.php","loading_url":"https:\/\/dividivitravel.com\/wp-admin\/images\/wpspin_light.gif","st_search_nonce":"67de5e5575","facebook_enable":"on","facbook_app_id":"RBKANUDGJN6KY7WQ","booking_currency_precision":"2","thousand_separator":".","decimal_separator":",","currency_symbol":"\u20ac","currency_position":"right","currency_rtl_support":"","free_text":"Free","date_format":"mm\/dd\/yyyy","date_format_calendar":"mm\/dd\/yyyy","time_format":"12h","mk_my_location":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/img\/my_location.png","locale":"en_US","header_bgr":"","text_refresh":"Refresh","date_fomat":"MM\/DD\/YYYY","text_loading":"Loading...","text_no_more":"No More","weather_api_key":"a82498aa9918914fa4ac5ba584a7e623","no_vacancy":"No vacancies","a_vacancy":"a vacancy","more_vacancy":"vacancies","utm":"https:\/\/shinetheme.com\/utm\/utm.gif","_s":"7bda3c85bd","mclusmap":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/icon_map\/ico_gruop_location.svg","icon_contact_map":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/markers\/ico_location_3.png","text_adult":"Adult","text_adults":"Adults","text_child":"Children","text_childs":"Childrens","text_price":"Price","text_origin_price":"Origin Price","text_unavailable":"Not Available ","text_available":"Available ","text_adult_price":"Adult Price ","text_child_price":"Child Price ","text_update":"Update ","token_mapbox":"pk.eyJ1IjoidGhvYWluZ28iLCJhIjoiY2p3dTE4bDFtMDAweTQ5cm5rMXA5anUwMSJ9.RkIx76muBIvcZ5HDb2g0Bw","text_rtl_mapbox":"","st_icon_mapbox":"http:\/\/travelhotel.wpengine.com\/wp-content\/uploads\/2018\/11\/ico_mapker_hotel.png","text_use_this_media":"Use this media","text_select_image":"Select Image","text_confirm_delete_item":"Are you sure want to delete this item?","text_process_cancel":"You cancelled the process","start_at_text":"Start at","end_at_text":"End at"};
var st_timezone = {"timezone_string":""};
var locale_daterangepicker = {"direction":"ltr","applyLabel":"Apply","cancelLabel":"Cancel","fromLabel":"From","toLabel":"To","customRangeLabel":"Custom","daysOfWeek":["Su","Mo","Tu","We","Th","Fr","Sa"],"monthNames":["January","February","March","April","May","June","July","August","September","October","November","December"],"firstDay":"0","today":"Today"};
var st_list_map_params = {"mk_my_location":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/img\/my_location.png","text_my_location":"3000 m radius","text_no_result":"No Result","cluster_0":"<div class='cluster cluster-1'>CLUSTER_COUNT<\/div>","cluster_20":"<div class='cluster cluster-2'>CLUSTER_COUNT<\/div>","cluster_50":"<div class='cluster cluster-3'>CLUSTER_COUNT<\/div>","cluster_m1":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/img\/map\/m1.png","cluster_m2":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/img\/map\/m2.png","cluster_m3":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/img\/map\/m3.png","cluster_m4":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/img\/map\/m4.png","cluster_m5":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/img\/map\/m5.png","icon_full_screen":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/icon_map\/ico_fullscreen.svg","icon_my_location":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/icon_map\/ico_location.svg","icon_my_style":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/icon_map\/ico_view_maps.svg","icon_zoom_out":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/icon_map\/ico_maps_zoom-out.svg","icon_zoom_in":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/icon_map\/ico_maps_zoom_in.svg","icon_close":"https:\/\/dividivitravel.com\/wp-content\/themes\/traveler\/v2\/images\/icon_map\/icon_close.svg"};
var st_config_partner = {"text_er_image_format":""};
var st_hotel_localize = {"booking_required_adult":"Please select adult number","booking_required_children":"Please select children number","booking_required_adult_children":"Please select Adult and  Children number","room":"Room","is_aoc_fail":"Please select the ages of children","is_not_select_date":"Please select Check-in and Check-out date","is_not_select_check_in_date":"Please select Check-in date","is_not_select_check_out_date":"Please select Check-out date","is_host_name_fail":"Please provide Host Name(s)"};
var st_icon_picker = {"icon_list":["fa-glass","fa-music","fa-search","fa-envelope-o","fa-heart","fa-star","fa-star-o","fa-user","fa-film","fa-th-large","fa-th","fa-th-list","fa-check","fa-remove","fa-close","fa-times","fa-search-plus","fa-search-minus","fa-power-off","fa-signal","fa-gear","fa-cog","fa-trash-o","fa-home","fa-file-o","fa-clock-o","fa-road","fa-download","fa-arrow-circle-o-down","fa-arrow-circle-o-up","fa-inbox","fa-play-circle-o","fa-rotate-right","fa-repeat","fa-refresh","fa-list-alt","fa-lock","fa-flag","fa-headphones","fa-volume-off","fa-volume-down","fa-volume-up","fa-qrcode","fa-barcode","fa-tag","fa-tags","fa-book","fa-bookmark","fa-print","fa-camera","fa-font","fa-bold","fa-italic","fa-text-height","fa-text-width","fa-align-left","fa-align-center","fa-align-right","fa-align-justify","fa-list","fa-dedent","fa-outdent","fa-indent","fa-video-camera","fa-photo","fa-image","fa-picture-o","fa-pencil","fa-map-marker","fa-adjust","fa-tint","fa-edit","fa-pencil-square-o","fa-share-square-o","fa-check-square-o","fa-arrows","fa-step-backward","fa-fast-backward","fa-backward","fa-play","fa-pause","fa-stop","fa-forward","fa-fast-forward","fa-step-forward","fa-eject","fa-chevron-left","fa-chevron-right","fa-plus-circle","fa-minus-circle","fa-times-circle","fa-check-circle","fa-question-circle","fa-info-circle","fa-crosshairs","fa-times-circle-o","fa-check-circle-o","fa-ban","fa-arrow-left","fa-arrow-right","fa-arrow-up","fa-arrow-down","fa-mail-forward","fa-share","fa-expand","fa-compress","fa-plus","fa-minus","fa-asterisk","fa-exclamation-circle","fa-gift","fa-leaf","fa-fire","fa-eye","fa-eye-slash","fa-warning","fa-exclamation-triangle","fa-plane","fa-calendar","fa-random","fa-comment","fa-magnet","fa-chevron-up","fa-chevron-down","fa-retweet","fa-shopping-cart","fa-folder","fa-folder-open","fa-arrows-v","fa-arrows-h","fa-bar-chart-o","fa-bar-chart","fa-twitter-square","fa-facebook-square","fa-camera-retro","fa-key","fa-gears","fa-cogs","fa-comments","fa-thumbs-o-up","fa-thumbs-o-down","fa-star-half","fa-heart-o","fa-sign-out","fa-linkedin-square","fa-thumb-tack","fa-external-link","fa-sign-in","fa-trophy","fa-github-square","fa-upload","fa-lemon-o","fa-phone","fa-square-o","fa-bookmark-o","fa-phone-square","fa-twitter","fa-facebook-f","fa-facebook","fa-github","fa-unlock","fa-credit-card","fa-feed","fa-rss","fa-hdd-o","fa-bullhorn","fa-bell","fa-certificate","fa-hand-o-right","fa-hand-o-left","fa-hand-o-up","fa-hand-o-down","fa-arrow-circle-left","fa-arrow-circle-right","fa-arrow-circle-up","fa-arrow-circle-down","fa-globe","fa-wrench","fa-tasks","fa-filter","fa-briefcase","fa-arrows-alt","fa-group","fa-users","fa-chain","fa-link","fa-cloud","fa-flask","fa-cut","fa-scissors","fa-copy","fa-files-o","fa-paperclip","fa-save","fa-floppy-o","fa-square","fa-navicon","fa-reorder","fa-bars","fa-list-ul","fa-list-ol","fa-strikethrough","fa-underline","fa-table","fa-magic","fa-truck","fa-pinterest","fa-pinterest-square","fa-google-plus-square","fa-google-plus","fa-money","fa-caret-down","fa-caret-up","fa-caret-left","fa-caret-right","fa-columns","fa-unsorted","fa-sort","fa-sort-down","fa-sort-desc","fa-sort-up","fa-sort-asc","fa-envelope","fa-linkedin","fa-rotate-left","fa-undo","fa-legal","fa-gavel","fa-dashboard","fa-tachometer","fa-comment-o","fa-comments-o","fa-flash","fa-bolt","fa-sitemap","fa-umbrella","fa-paste","fa-clipboard","fa-lightbulb-o","fa-exchange","fa-cloud-download","fa-cloud-upload","fa-user-md","fa-stethoscope","fa-suitcase","fa-bell-o","fa-coffee","fa-cutlery","fa-file-text-o","fa-building-o","fa-hospital-o","fa-ambulance","fa-medkit","fa-fighter-jet","fa-beer","fa-h-square","fa-plus-square","fa-angle-double-left","fa-angle-double-right","fa-angle-double-up","fa-angle-double-down","fa-angle-left","fa-angle-right","fa-angle-up","fa-angle-down","fa-desktop","fa-laptop","fa-tablet","fa-mobile-phone","fa-mobile","fa-circle-o","fa-quote-left","fa-quote-right","fa-spinner","fa-circle","fa-mail-reply","fa-reply","fa-github-alt","fa-folder-o","fa-folder-open-o","fa-smile-o","fa-frown-o","fa-meh-o","fa-gamepad","fa-keyboard-o","fa-flag-o","fa-flag-checkered","fa-terminal","fa-code","fa-mail-reply-all","fa-reply-all","fa-star-half-empty","fa-star-half-full","fa-star-half-o","fa-location-arrow","fa-crop","fa-code-fork","fa-unlink","fa-chain-broken","fa-question","fa-info","fa-exclamation","fa-superscript","fa-subscript","fa-eraser","fa-puzzle-piece","fa-microphone","fa-microphone-slash","fa-shield","fa-calendar-o","fa-fire-extinguisher","fa-rocket","fa-maxcdn","fa-chevron-circle-left","fa-chevron-circle-right","fa-chevron-circle-up","fa-chevron-circle-down","fa-html5","fa-css3","fa-anchor","fa-unlock-alt","fa-bullseye","fa-ellipsis-h","fa-ellipsis-v","fa-rss-square","fa-play-circle","fa-ticket","fa-minus-square","fa-minus-square-o","fa-level-up","fa-level-down","fa-check-square","fa-pencil-square","fa-external-link-square","fa-share-square","fa-compass","fa-toggle-down","fa-caret-square-o-down","fa-toggle-up","fa-caret-square-o-up","fa-toggle-right","fa-caret-square-o-right","fa-euro","fa-eur","fa-gbp","fa-dollar","fa-usd","fa-rupee","fa-inr","fa-cny","fa-rmb","fa-yen","fa-jpy","fa-ruble","fa-rouble","fa-rub","fa-won","fa-krw","fa-bitcoin","fa-btc","fa-file","fa-file-text","fa-sort-alpha-asc","fa-sort-alpha-desc","fa-sort-amount-asc","fa-sort-amount-desc","fa-sort-numeric-asc","fa-sort-numeric-desc","fa-thumbs-up","fa-thumbs-down","fa-youtube-square","fa-youtube","fa-xing","fa-xing-square","fa-youtube-play","fa-dropbox","fa-stack-overflow","fa-instagram","fa-flickr","fa-adn","fa-bitbucket","fa-bitbucket-square","fa-tumblr","fa-tumblr-square","fa-long-arrow-down","fa-long-arrow-up","fa-long-arrow-left","fa-long-arrow-right","fa-apple","fa-windows","fa-android","fa-linux","fa-dribbble","fa-skype","fa-foursquare","fa-trello","fa-female","fa-male","fa-gittip","fa-gratipay","fa-sun-o","fa-moon-o","fa-archive","fa-bug","fa-vk","fa-weibo","fa-renren","fa-pagelines","fa-stack-exchange","fa-arrow-circle-o-right","fa-arrow-circle-o-left","fa-toggle-left","fa-caret-square-o-left","fa-dot-circle-o","fa-wheelchair","fa-vimeo-square","fa-turkish-lira","fa-try","fa-plus-square-o","fa-space-shuttle","fa-slack","fa-envelope-square","fa-wordpress","fa-openid","fa-institution","fa-bank","fa-university","fa-mortar-board","fa-graduation-cap","fa-yahoo","fa-google","fa-reddit","fa-reddit-square","fa-stumbleupon-circle","fa-stumbleupon","fa-delicious","fa-digg","fa-pied-piper","fa-pied-piper-alt","fa-drupal","fa-joomla","fa-language","fa-fax","fa-building","fa-child","fa-paw","fa-spoon","fa-cube","fa-cubes","fa-behance","fa-behance-square","fa-steam","fa-steam-square","fa-recycle","fa-automobile","fa-car","fa-cab","fa-taxi","fa-tree","fa-spotify","fa-deviantart","fa-soundcloud","fa-database","fa-file-pdf-o","fa-file-word-o","fa-file-excel-o","fa-file-powerpoint-o","fa-file-photo-o","fa-file-picture-o","fa-file-image-o","fa-file-zip-o","fa-file-archive-o","fa-file-sound-o","fa-file-audio-o","fa-file-movie-o","fa-file-video-o","fa-file-code-o","fa-vine","fa-codepen","fa-jsfiddle","fa-life-bouy","fa-life-buoy","fa-life-saver","fa-support","fa-life-ring","fa-circle-o-notch","fa-ra","fa-rebel","fa-ge","fa-empire","fa-git-square","fa-git","fa-y-combinator-square","fa-yc-square","fa-hacker-news","fa-tencent-weibo","fa-qq","fa-wechat","fa-weixin","fa-send","fa-paper-plane","fa-send-o","fa-paper-plane-o","fa-history","fa-circle-thin","fa-header","fa-paragraph","fa-sliders","fa-share-alt","fa-share-alt-square","fa-bomb","fa-soccer-ball-o","fa-futbol-o","fa-tty","fa-binoculars","fa-plug","fa-slideshare","fa-twitch","fa-yelp","fa-newspaper-o","fa-wifi","fa-calculator","fa-paypal","fa-google-wallet","fa-cc-visa","fa-cc-mastercard","fa-cc-discover","fa-cc-amex","fa-cc-paypal","fa-cc-stripe","fa-bell-slash","fa-bell-slash-o","fa-trash","fa-copyright","fa-at","fa-eyedropper","fa-paint-brush","fa-birthday-cake","fa-area-chart","fa-pie-chart","fa-line-chart","fa-lastfm","fa-lastfm-square","fa-toggle-off","fa-toggle-on","fa-bicycle","fa-bus","fa-ioxhost","fa-angellist","fa-cc","fa-shekel","fa-sheqel","fa-ils","fa-meanpath","fa-buysellads","fa-connectdevelop","fa-dashcube","fa-forumbee","fa-leanpub","fa-sellsy","fa-shirtsinbulk","fa-simplybuilt","fa-skyatlas","fa-cart-plus","fa-cart-arrow-down","fa-diamond","fa-ship","fa-user-secret","fa-motorcycle","fa-street-view","fa-heartbeat","fa-venus","fa-mars","fa-mercury","fa-intersex","fa-transgender","fa-transgender-alt","fa-venus-double","fa-mars-double","fa-venus-mars","fa-mars-stroke","fa-mars-stroke-v","fa-mars-stroke-h","fa-neuter","fa-genderless","fa-facebook-official","fa-pinterest-p","fa-whatsapp","fa-server","fa-user-plus","fa-user-times","fa-hotel","fa-bed","fa-viacoin","fa-train","fa-subway","fa-medium","fa-yc","fa-y-combinator","fa-optin-monster","fa-opencart","fa-expeditedssl","fa-battery-4","fa-battery-full","fa-battery-3","fa-battery-three-quarters","fa-battery-2","fa-battery-half","fa-battery-1","fa-battery-quarter","fa-battery-0","fa-battery-empty","fa-mouse-pointer","fa-i-cursor","fa-object-group","fa-object-ungroup","fa-sticky-note","fa-sticky-note-o","fa-cc-jcb","fa-cc-diners-club","fa-clone","fa-balance-scale","fa-hourglass-o","fa-hourglass-1","fa-hourglass-start","fa-hourglass-2","fa-hourglass-half","fa-hourglass-3","fa-hourglass-end","fa-hourglass","fa-hand-grab-o","fa-hand-rock-o","fa-hand-stop-o","fa-hand-paper-o","fa-hand-scissors-o","fa-hand-lizard-o","fa-hand-spock-o","fa-hand-pointer-o","fa-hand-peace-o","fa-trademark","fa-registered","fa-creative-commons","fa-gg","fa-gg-circle","fa-tripadvisor","fa-odnoklassniki","fa-odnoklassniki-square","fa-get-pocket","fa-wikipedia-w","fa-safari","fa-chrome","fa-firefox","fa-opera","fa-internet-explorer","fa-tv","fa-television","fa-contao","fa-500px","fa-amazon","fa-calendar-plus-o","fa-calendar-minus-o","fa-calendar-times-o","fa-calendar-check-o","fa-industry","fa-map-pin","fa-map-signs","fa-map-o","fa-map","fa-commenting","fa-commenting-o","fa-houzz","fa-vimeo","fa-black-tie","fa-fonticons","fa-reddit-alien","fa-edge","fa-credit-card-alt","fa-codiepie","fa-modx","fa-fort-awesome","fa-usb","fa-product-hunt","fa-mixcloud","fa-scribd","fa-pause-circle","fa-pause-circle-o","fa-stop-circle","fa-stop-circle-o","fa-shopping-bag","fa-shopping-basket","fa-hashtag","fa-bluetooth","fa-bluetooth-b","fa-percent","fa-gitlab","fa-wpbeginner","fa-wpforms","fa-envira","fa-universal-access","fa-wheelchair-alt","fa-question-circle-o","fa-blind","fa-audio-description","fa-volume-control-phone","fa-braille","fa-assistive-listening-systems","fa-asl-interpreting","fa-american-sign-language-interpreting","fa-deafness","fa-hard-of-hearing","fa-deaf","fa-glide","fa-glide-g","fa-signing","fa-sign-language","fa-low-vision","fa-viadeo","fa-viadeo-square","fa-snapchat","fa-snapchat-ghost","fa-snapchat-square"]};
var st_timezone = {"timezone_string":""};
var st_social_params = {"google_client_id":"279159914253-lgqi4tsbe4jjq37un2bcmecaeprq7l2s.apps.googleusercontent.com"};
/* ]]> */
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/js/compatible-wp/jquery/jquery-1.12.4-wp.js' id='jquery-core-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/js/compatible-wp/jquery-migrate/jquery-migrate-1.4.1-wp.js' id='jquery-migrate-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js' id='jquery-blockui-js'></script>

<script type='text/javascript' id='wc-add-to-cart-js-extra'>
/* <![CDATA[ */
var wc_add_to_cart_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"https:\/\/dividivitravel.com","is_cart":"","cart_redirect_after_add":"no"};
/* ]]> */
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js' id='wc-add-to-cart-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart.js' id='vc_woocommerce-add-to-cart-js-js'></script>
<script type='text/javascript' src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.js' id='mapbox-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/magnific-popup/jquery.magnific-popup.min.js' id='magnific-js-js'></script>
<script type='text/javascript' src='https://apis.google.com/js/api:client.js' id='google-api-js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
<link rel="https://api.w.org/" href="https://dividivitravel.com/index.php?rest_route=/" /><link rel="alternate" type="application/json" href="https://dividivitravel.com/index.php?rest_route=/wp/v2/pages/7406" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://dividivitravel.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://dividivitravel.com/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 5.6.2" />
<meta name="generator" content="WooCommerce 5.0.0" />
<link rel="canonical" href="https://dividivitravel.com/?page_id=7406" />
<link rel='shortlink' href='https://dividivitravel.com/?p=7406' />

<link rel="alternate" type="application/json+oembed" href="https://dividivitravel.com/index.php?rest_route=%2Foembed%2F1.0%2Fembed&#038;url=https%3A%2F%2Fdividivitravel.com%2F%3Fpage_id%3D7406" />
<link rel="alternate" type="text/xml+oembed" href="https://dividivitravel.com/index.php?rest_route=%2Foembed%2F1.0%2Fembed&#038;url=https%3A%2F%2Fdividivitravel.com%2F%3Fpage_id%3D7406&#038;format=xml" />
<meta name="generator" content="Powered by Visual Composer Website Builder - fast and easy-to-use drag and drop visual editor for WordPress."/>	<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
	<meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress."/>
<style type="text/css" media="print">#wpadminbar { display:none; }</style>
	<style type="text/css" media="screen">
	html { margin-top: 32px !important; }
	* html body { margin-top: 32px !important; }
	@media screen and ( max-width: 782px ) {
		html { margin-top: 46px !important; }
		* html body { margin-top: 46px !important; }
	}
</style>
	
        <!-- Custom_css.php-->
        <style id="st_custom_css_php">
        
@media screen and (max-width: 782px) {
  html {
    margin-top: 0px !important;
  }

  .admin-bar.logged-in #header {
    padding-top: 45px;
  }

  .logged-in #header {
    margin-top: 0;
    display: block;
  }
}

:root {
	--main-color: #1A2B48;
    --link-color: #5191FA;
    --link-color-dark: #5191FA;
	--grey-color: #5E6D77;
	--light-grey-color: #EAEEF3;
    --orange-color: #FA5636;
}

    .booking-item-rating .fa ,
    .booking-item.booking-item-small .booking-item-rating-stars,
    .comment-form .add_rating,
    .booking-item-payment .booking-item-rating-stars .fa-star,
    .st-item-rating .fa,
    li  .fa-star , li  .fa-star-o , li  .fa-star-half-o{
    color:#FA5636    }

.feature_class{
 background: #3366cc;
}
.feature_class::before {
   border-color: #3366cc #3366cc transparent transparent;
}
.feature_class::after {
    border-color: #3366cc transparent #3366cc #3366cc;
}
.featured_single .feature_class::before{
   border-color: transparent #3366cc transparent transparent;
}
.item-nearby .st_featured::before {
    border-color: transparent transparent #3366cc #3366cc;
}
.item-nearby .st_featured::after {
   border-color: #3366cc #3366cc #3366cc transparent  ;
}

.st_sale_class{
    background-color: #3366cc;
}
.st_sale_class.st_sale_paper * {color: #3366cc }
.st_sale_class .st_star_label_sale_div::after,.st_sale_label_1::before{
    border-color: #3366cc transparent transparent #3366cc ;
}

.btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
  outline: none;
}

.st_sale_class .st_star_label_sale_div::after{
border-color: #3366cc


        </style>
        <!-- End Custom_css.php-->
        <!-- start css hook filter -->
        <style type="text/css" id="st_custom_css">
                </style>
        <!-- end css hook filter -->
        <!-- css disable javascript -->
                <style type="text/css" id="st_enable_javascript">
        .search-tabs-bg > .tabbable >.tab-content > .tab-pane{display: none; opacity: 0;}.search-tabs-bg > .tabbable >.tab-content > .tab-pane.active{display: block;opacity: 1;}.search-tabs-to-top { margin-top: -120px;}        </style>

        <style>
                </style>
        
        <!-- Begin Custom CSS        -->
        <style>
            
body{
                
            }

body{
                
            }

.global-wrap{
                
            }

.header-top, .menu-style-2 .header-top{
                
            }

.st_menu ul.slimmenu li a, .st_menu ul.slimmenu li .sub-toggle>i,.menu-style-2 ul.slimmenu li a, .menu-style-2 ul.slimmenu li .sub-toggle>i, .menu-style-2 .nav .collapse-user{
                
            }

#menu1,#menu1 .menu-collapser, #menu2 .menu-wrapper, .menu-style-2 .user-nav-wrapper{
                
            }
        </style>
        <!-- End Custom CSS -->
                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
                    <script src="https://apis.google.com/js/platform.js" async defer></script>
                        <meta name="google-signin-client_id" content="279159914253-lgqi4tsbe4jjq37un2bcmecaeprq7l2s.apps.googleusercontent.com">
                        <META NAME="description" CONTENT="Tour hotel booking">
            <META NAME="keywords" CONTENT="traveler">
            <META NAME="title" CONTENT="Traveler ">
            <meta name="st_utm" content="YTo0OntzOjE6InUiO3M6MjU6Imh0dHA6Ly9kaXZpZGl2aXRyYXZlbC5jb20iO3M6MToibiI7czo4OiJUcmF2ZWxlciI7czoxOiJ2IjtzOjU6IjIuOS4yIjtzOjE6ImkiO3M6MTM6IjM0LjIzMy4zMC4xNzMiO30=">
            <noscript><style> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>        <script>
            // Load the SDK asynchronously
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            window.fbAsyncInit = function () {
                FB.init({
                    appId: st_params.facbook_app_id,
                    cookie: true, // enable cookies to allow the server to access
                    // the session
                    xfbml: true, // parse social plugins on this page
                    version: 'v3.1' // use graph api version 2.8
                });

            };
        </script>
    </head>
        <body class="page-template page-template-template-hotel-search page-template-template-hotel-search-php page page-id-7406 logged-in admin-bar no-customize-support  st-header-2 theme-traveler vcwb woocommerce-no-js menu_style1 topbar_position_default search_enable_preload admin_bar_showing wpb-js-composer js-comp-ver-6.6.0 vc_responsive">
        <header id="header">
                    <div id="topbar">
                                            <div class="topbar-left">
                            <ul class="st-list socials">
                                <li>
                                    <a href="" target=""><i class="fa fa fa-facebook"></i></a><a href="#" target=""><i class="fa fa fa-linkedin"></i></a><a href="#" target=""><i class="fa fa fa-google-plus"></i></a>                                </li>
                            </ul>
                            <ul class="st-list topbar-items">
                                <li class="hidden-xs hidden-sm"><a href="" target="">contact@shinetheme.com</a></li>                            </ul>
                        </div>
                                            <div class="topbar-right">
                        <ul class="st-list topbar-items">
                                                                    <li class="topbar-item link-item ">
                                            <a href="" class="login">(000) 999 - 656 -888</a>
                                        </li>
                                        <li class="dropdown dropdown-user-dashboard">
                <a href="javascript: void(0);" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
            Hi, diviuser            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="https://dividivitravel.com/?page_id=625">Dashboard</a>
            </li>
            <li>
                <a href="https://dividivitravel.com/?page_id=625&sc=booking-history">Booking History</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="https://dividivitravel.com/wp-login.php?action=logout&amp;_wpnonce=d1265497df&amp;redirect_to=https%3A%2F%2Fdividivitravel.com%2F">Log out</a>
            </li>
        </ul>
    </li>
    <li class="dropdown dropdown-currency hidden-xs hidden-sm">
    <a href="" data-toggle="dropdown" aria-haspopup="true"
       aria-expanded="false">
        EUR                    <i class="fa fa-angle-down"></i>
            </a>
    <ul class="dropdown-menu">
        <li><a href="/?page_id=7406&#038;currency=USD">USD</a>
                          </li><li><a href="/?page_id=7406&#038;currency=AUD">AUD</a>
                          </li>    </ul>
</li>                        </ul>
                    </div>
                </div>
                    <div class="header">
        <a href="#" class="toggle-menu">
            <i class="input-icon field-icon fa"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Ico_off_menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Group" stroke="#fff" stroke-width="1.5">
            <g id="navigation-menu-4">
                <rect id="Rectangle-path" x="0.75" y="0.753" width="22.5" height="22.5" rx="1.5"></rect>
                <path d="M6.75,7.503 L17.25,7.503" id="Shape"></path>
                <path d="M6.75,12.003 L17.25,12.003" id="Shape"></path>
                <path d="M6.75,16.503 L17.25,16.503" id="Shape"></path>
            </g>
        </g>
    </g>
</svg></i>        </a>
        <div class="header-left">
                        <a href="https://dividivitravel.com/" class="logo hidden-xs">
                <img src="http://shinetheme.com/travelerdata/mixmap/wp-content/uploads/2018/11/mix_logo-2-1.svg" alt="Just another WordPress site">
            </a>
            <a href="https://dividivitravel.com/" class="logo hidden-lg hidden-md hidden-sm">
                <img src="http://shinetheme.com/travelerdata/mixmap/wp-content/uploads/2018/11/mix_logo-2-1.svg" alt="Just another WordPress site">
            </a>
            <nav id="st-main-menu">
                <a href="" class="back-menu"><i class="fa fa-angle-left"></i></a>
                <ul id="main-menu" class="menu main-menu"><li id="menu-item-9527" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-9527"><a class="" href="https://dividivitravel.com/">Home</a></li>
<li id="menu-item-9553" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9553"><a class="" href="#">Hotel</a></li>
<li id="menu-item-9543" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9543"><a class="" href="#">Tour</a></li>
<li id="menu-item-9564" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9564"><a class="" href="#">Activities</a></li>
<li id="menu-item-9528" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-9528"><a class="" href="#">Pages</a>
<i class='fa fa-angle-down'></i><ul class="menu-dropdown">
	<li id="menu-item-9530" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9530"><a class="" href="https://dividivitravel.com/?page_id=8028">About Us</a></li>
	<li id="menu-item-9529" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9529"><a class="" href="https://dividivitravel.com/?page_id=7979">Blog</a></li>
	<li id="menu-item-9565" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9565"><a class="" href="https://dividivitravel.com/?page_id=9172">FAQs</a></li>
	<li id="menu-item-9566" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9566"><a class="" href="https://dividivitravel.com/?page_id=9165">Become Local Expert</a></li>
	<li id="menu-item-9531" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9531"><a class="" href="http://travelhotel.wpengine.com/not-found/">404 Page</a></li>
	<li id="menu-item-9542" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9542"><a class="" href="https://dividivitravel.com/?page_id=8088">Contact</a></li>
</ul>
</li>
</ul>            </nav>
        </div>
        <div class="header-right">
                    </div>
    </div>
</header>
    <div id="st-content-wrapper" class="search-result-page">
<div class="banner st_1616163085 ">
    <div class="container">
                <h1>
            Search Flights                   </h1>
                    

</div>

</div>
    <div class="full-map">
        <div class="search-form-wrapper">
    <div class="container">

<div>
            <div class="row">
     <div role="tabpanel" class="tab-pane " id="ss_flight"><div class="search-form hotel-search-form-home hotel-search-form in_tab" >
                <form action="" class="form" method="get">
                
                 <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="row">
               <div class="clearfix visible-xs">
               
               <div class="col-lg-4 col-md-4 col-xs-6" style="margin-top: 2%; padding-left: 10%;">
               <input class="form-check-input" type="radio" name="radios" id="Round-trip" value="option1" checked="">
               <label class="form-check-label" for="exampleRadios1">
                Round-trip
               </label>
              </div> 
                <div class="col-lg-3 col-md-3 col-xs-6" style="margin-top: 2%; padding-left: 6%; border-right: 1px solid #dfdfdf;">
               <input class="form-check-input" type="radio" name="radios" id="One-way" value="option2">
               <label class="form-check-label" for="exampleRadios2">
               One-way
               </label>
               </div> </div> 

               <div class="radiod">
               <div class="col-lg-4 col-md-4 col-xs-6" style="margin-top: 2%; padding-left: 10%;">
               <input class="form-check-input" type="radio" name="radios" id="Round-trip" value="option1" checked="">
               <label class="form-check-label" for="exampleRadios1">
                Round-trip
               </label>
              </div> 
                <div class="col-lg-3 col-md-3 col-xs-6" style="margin-top: 2%; padding-left: 6%; border-right: 1px solid #dfdfdf;">
               <input class="form-check-input" type="radio" name="radios" id="One-way" value="option2">
               <label class="form-check-label" for="exampleRadios2">
               One-way
               </label>
               </div> </div>

               <div class="col-lg-5 col-md-5" style="margin-top: 2%; border-right: 1px solid #dfdfdf;">
               <div class="row">
               <div class="col-lg-6 col-md-6 col-xs-6">
                <div class="row">
                  <div class="col-lg-6 col-md-6"><label class="form-check-label">Adults</label></div> 
                  <div class="col-lg-6 col-md-6">
                <input type="text" id="num_adults" name="num_adults" value="1" class="form-control st-input-number" autocomplete="off" data-min="1" data-max="20" style="height: 25px !important; padding: 6px 10px !important;"></div> 
                </div>
                </div> 
             
                <div class="col-lg-6 col-md-6 col-xs-6">
                <div class="row">
                <div class="col-lg-6 col-md-6"><label class="form-check-label">Childs</label></div>
                <div class="col-lg-6 col-md-6">
                <input type="text" id="num_child" name="num_child" value="0" class="form-control st-input-number" autocomplete="off" data-min="1" data-max="20" style="height: 25px !important; padding: 6px 10px !important;"></div>
                </div>
               
                </div> 

               </div> 
               </div> 
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-5 field-origin">
                        <i class="input-icon field-icon fa"><svg width="24px" height="24px" viewBox="0 0 17 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Search_Result_1_Grid" transform="translate(-165.000000, -328.000000)" stroke="#A0A9B2">
            <g id="form_search_hotel_row" transform="translate(135.000000, 290.000000)">
                <g id="input" transform="translate(30.000000, 0.000000)">
                    <g id="where" transform="translate(0.000000, 26.000000)">
                        <g id="Group" transform="translate(0.000000, 12.000000)">
                            <g id="ico_maps_search_box">
                                <path d="M15.75,8.25 C15.75,12.471 12.817,14.899 10.619,17.25 C9.303,18.658 8.25,23.25 8.25,23.25 C8.25,23.25 7.2,18.661 5.887,17.257 C3.687,14.907 0.75,12.475 0.75,8.25 C0.75,4.10786438 4.10786438,0.75 8.25,0.75 C12.3921356,0.75 15.75,4.10786438 15.75,8.25 Z" id="Shape"></path>
                                <circle id="Oval" cx="8.25" cy="8.25" r="3"></circle>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                        



<div class="form-group form-group-lg form-group-icon-left st_left">
    <label for="ss_location_origin">Origin</label>
    <div class="st-select-wrapper ss-flight-wrapper">
        <input required="" id="ss_location_origin" onkeyup="stKeyupsmartSearchflights(this.value)" touchend="stKeyupsmartSearchflights(this)" type="text" class="form-control ss-flight-location required" autocomplete="off" data-value="" value="" placeholder="Enter your origin" data-index="1">
    </div> <input type="hidden" id="airport_id" name="airport_id">
</div>
                    </div>
                   <div class="item" id="destinationf"></div>
                    <div class="col-lg-4 col-md-4 field-destination" style="border-right: 0px;">
                        
<style>

@media screen and (min-width: 1000px){
 .st_right{
     margin-left: -26px;
  }
}


</style>
<div class="form-group form-group-lg form-group-icon-left st_right">
    <label for="ss_location_destination">Destination</label>
    <div class="st-select-wrapper ss-flight-wrapper">
        <input required="" id="ss_location_destination" onkeyup="Searchflightsdest(this.value)" touchend="Searchflightsdest(this)" type="text" class="form-control ss-flight-location required" autocomplete="off" data-value="" data-name="ss_destination" value="" placeholder="Enter your destination" data-index="2">
    </div> <input type="hidden" id="airport_iddest" name="airport_iddest">
</div>                    </div>
                    <div class="item" id="destinationff"></div>
                    <div class="col-lg-3 col-md-3" style="border-right: 1px solid #dfdfdf;">
                    <div class="advance">
                     <div class="form-group form-extra-field dropdown clearfix field-advance" style="margin-left: -23px">
                         <div class="dropdown" data-toggle="dropdown" id="dropdown-advance">
                                <label class="hidden-xs">Cabin class</label>
                                <div class="render" style="margin-top: 7%;">
                                <span id="clase" style="font-size: 15px !important;">Economy <i class="fa fa-caret-down"></i></span>
                               
                    
                         </div>
                         </div>
                      <ul class="dropdown-menu" aria-labelledby="dropdown-advance" style="margin-left: -4px; padding: 15px !important;">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="advance-item range-slider">
                            <div class="item-content">
                               <li>Economy</li>
                               <hr>
                               <li>Premiun Economy</li>
                               <hr>
                               <li>Business</li>
                               <hr>
                               <li>First</li>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </ul> 

                     
                
                     </div> 
                    </div>
           
                    </div>
                </div>
            </div> 
            <div class="col-lg-4 col-md-4">
                <div class="row" style="margin-top: 4%;">
                    <div class="col-lg-6 col-md-6 field-depart">
                        <i class="input-icon field-icon fa"><svg height="24px" width="24px" viewBox="0 0 24 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Search_Result_1_Grid" transform="translate(-436.000000, -328.000000)" stroke="#A0A9B2">
            <g id="form_search_hotel_row" transform="translate(135.000000, 290.000000)">
                <g id="input" transform="translate(30.000000, 0.000000)">
                    <g id="check-in" transform="translate(270.000000, 26.000000)">
                        <g id="ico_calendar_search_box" transform="translate(1.000000, 12.000000)">
                            <g id="calendar-add-1">
                                <path d="M9.5,18.5 L1.5,18.5 C0.94771525,18.5 0.5,18.0522847 0.5,17.5 L0.5,3.5 C0.5,2.94771525 0.94771525,2.5 1.5,2.5 L19.5,2.5 C20.0522847,2.5 20.5,2.94771525 20.5,3.5 L20.5,10" id="Shape"></path>
                                <path d="M5.5,0.501 L5.5,5.501" id="Shape"></path>
                                <path d="M15.5,0.501 L15.5,5.501" id="Shape"></path>
                                <path d="M0.5,7.501 L20.5,7.501" id="Shape"></path>
                                <circle id="Oval" cx="17.5" cy="17.501" r="6"></circle>
                                <path d="M17.5,14.501 L17.5,20.501" id="Shape"></path>
                                <path d="M20.5,17.501 L14.5,17.501" id="Shape"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                        
<div data-tp-date-format="mm/dd/yyyy" class="form-group input-daterange  form-group-lg form-group-icon-left st_left">
    <label for="field-depart-date">Depart</label>
    <input id="datepicker1" placeholder="mm/dd/yyyy" data-toggle="daterangepicker" class="form-control tp_depart_date required" readonly="" value="" type="text" style="text-align: center;">
    <input id="departm" type="hidden" class="tp-date-from ss_depart" value="">
</div>
                    </div>
                    <div class="col-lg-6 col-md-6 field-return">
                        
<div data-tp-date-format="mm/dd/yyyy" class="form-group input-daterange input-daterange-return form-group-lg form-group-icon-left st_right">
    <label for="field-return-date">Return</label>
    <input name="datepicker2" placeholder="mm/dd/yyyy" readonly="" class="form-control tp_return_date required" value="" type="text" style="text-align: center;">
    <input id="returnn" type="hidden" class="tp-date-to ss_return" value="">
    <!--<span class="fa fa-question-circle tp-return-note">
        <span class="return-data-tooltip none">
                    </span>
    </span>-->
</div>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-2 col-md-2 ss-button-submit">
                <div class="form-button">
                    <button class="btn btn-primary btn-search" id="bflight" type="button" style="min-height: 60px; margin-top: 26%; width: 90%; margin-right: 8%;">SEARCH</button>
                </div>
            </div>
        </div>
               




                </form>
            </div>
        </div>
 </div>
        </div>









    </div>
</div>    </div>

    <div class="container">
        <div class="st-hotel-result style-full-map" style = "padding-top: 3%">
            <div class="row">
             <div class="contents">
               
  <?php foreach( $itinerary_data as $itinerary =>$prueba){      ?>        
   <div id="head1" style="border: 2px solid #dfdfdf; padding: 10px; height: 170px; margin-top: 50px;">
       <div id="head2" class="col-lg-3 col-md-3 col-xs-3" style="text-align: center; padding-top: 10px;">
        <?php foreach( $prueba as $lave4 =>$alor4){ 
                 
                      if($lave4 == "slice_data"){   
                         foreach($alor4 as $lave9 =>$alor9){ 
                             foreach($alor9 as $lave10 =>$alor10){
                                   if($lave10=="airline"){?>  
          <img id="logoairline" src="<?php echo $alor10["logo"]; ?>">
          <p id="nameair"><?php echo $alor10["name"]; ?></p>
       </div><?php }else if($lave10=="departure"){ ?>
       <div id="line" class="col-lg-6 col-md-6 col-xs-6 head3" style="padding-top: 50px; text-align: center; border-right: 1px solid #dfdfdf; height: 100%;">   
          <div class="col-lg-2 col-md-2 col-xs-2 head3">               
           <?php foreach( $alor10 as $lave11 =>$alor11){ 
                         if($lave11=="datetime"){?>                           
          <b><?php echo $alor11["time_24h"]; ?></b><?php }else if($lave11=="airport"){ ?>
          <p><?php echo $alor11["code"]; ?></p><?php } } } else if($lave10=="arrival"){ ?>
          </div>
          <div class="col-lg-8 col-md-8 col-xs-8 head3" style="height: 3px; background-color: black; margin-top: 25px;">
             <?php if($prueba["slice_data"][0]["info"]["connection_count"]==1){ ?>
               <div class="momento">
                   <span class="tooltiptext"><?php echo $prueba["slice_data"][0]["flight_data"][0]["info"]["notes"][0]["value"];  ?></span>
                 <p id="connection"><?php echo $prueba["slice_data"][0]["flight_data"][0]["arrival"]["airport"]["code"]; ?></p>
              </div> <?php } else if($prueba["slice_data"][0]["info"]["connection_count"]==2){ ?>
                <div class="momento2">
                  <span class="tooltiptext2"><?php echo $prueba["slice_data"][0]["flight_data"][0]["info"]["notes"][1]["value"];  ?></span>
                 <p id="connection2"><?php echo $prueba["slice_data"][0]["flight_data"][0]["arrival"]["airport"]["code"]; ?></p>
              </div>
                <div class="momento3">
                  <span class="tooltiptext3"><?php echo $prueba["slice_data"][0]["flight_data"][1]["info"]["notes"][1]["value"];  ?></span>
                 <p id="connection3"><?php echo $prueba["slice_data"][0]["flight_data"][1]["arrival"]["airport"]["code"]; ?></p>
              </div><?php } ?>
          </div>
          <div class="col-lg-2 col-md-2 col-xs-2 head3">
            <?php foreach( $alor10 as $lave12 =>$alor12){
                        if($lave12=="datetime"){  ?> 
          <b><?php echo $alor12["time_24h"]; ?></b><?php }else if($lave12=="airport"){ ?>
          <p><?php echo $alor12["code"]; ?></p> <?php } } } else if($lave10=="flight_data"){ ?>
          </div>
        
       </div>
       <div class="col-lg-3 col-md-3 col-xs-3" style="text-align: center; padding-top: 20px; color: #5191FA;">
         <?php foreach( $alor10 as $lave13 =>$alor13){
                   foreach( $alor13 as $lave14 =>$alor14){
                    if($lave14=="info"){ if($alor14["id"]==1){ ?>
         <h4><?php echo $alor14["cabin_name"]; ?></h4>
         <h3><b style="color:#36C558;"><?php echo $prueba["price_details"]["source_total_fare"]." ".$prueba["price_details"]["display_symbol"]; ?></b></h3><?php } } } } } } } } } ?>
         <p>per person</p>
       </div>
   </div> <?php } ?>
             </div>       
<div class="col-lg-9 col-md-9 col-xs-9">
    <div class="toolbar ">
  

  
    <div class="dropdown-menu sort-menu sort-menu-mobile">
                <div class="sort-item st-icheck">
            <div class="st-icheck-item"><label> New hotel<input class="service_order" type="radio" name="service_order_m_" data-value="new" /><span class="checkmark"></span></label></div>
        </div>
        <div class="sort-item st-icheck">
            <span class="title">Price</span>
            <div class="st-icheck-item"><label> Low to High<input class="service_order" type="radio" name="service_order_m_"  data-value="price_asc"/><span class="checkmark"></span></label></div>
            <div class="st-icheck-item"><label> High to Low<input class="service_order" type="radio" name="service_order_m_"  data-value="price_desc"/><span class="checkmark"></span></label></div>
        </div>
        <div class="sort-item st-icheck">
            <span class="title">Name</span>
            <div class="st-icheck-item"><label> a - z<input class="service_order" type="radio" name="service_order_m_"  data-value="name_asc"/><span class="checkmark"></span></label></div>
            <div class="st-icheck-item"><label> z - a<input class="service_order" type="radio" name="service_order_m_"  data-value="name_desc"/><span class="checkmark"></span></label></div>
        </div>
    </div>
  
     
</div>
    <div id="modern-search-result" class="modern-search-result" data-layout="1">
        <div class="map-content-loading">
    <div class="st-loader"></div>
</div>        
<div class="row row-wrapper">
<div class="contents">
<?php foreach( $hotels as $hotel){      ?>     
   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item-service grid-item has-matchHeight">
    <div class="thumb">
                                <div class="service-add-wishlist login "
                 data-id="988"
                 data-type="st_hotel"
                 title="Add to wishlist">
                <i class="fa fa-heart"></i>
                <div class="lds-dual-ring"></div>
            </div>
                <div class="service-tag bestseller">
            <div class="feature_class st_featured featured">Featured</div>        </div>
        <a href="https://www.priceline.com/relax/at/<?php echo $hotel["id_t"]; ?>/from/<?php echo $newDate; ?>/to/<?php echo $newDate2; ?>/rooms/<?php echo $rooms; ?>/adults/<?php echo $adults; ?>">
            <img width="300" height="200" src="<?php echo $hotel["thumbnail"]; ?>" class="img-responsive wp-post-image" alt="Just another WordPress site" loading="lazy" />        </a>
                            <ul class="icon-list icon-group booking-item-rating-stars">
                <span class="pull-left mr10">Hotel star</span>
                <li><i class="fa  fa-star"></i></li><li><i class="fa  fa-star"></i></li><li><i class="fa  fa-star"></i></li><li><i class="fa  fa-star"></i></li><li><i class="fa  fa-star"></i></li>            </ul>
            </div>
    <h4 class="service-title"><a
                href="https://www.priceline.com/relax/at/<?php echo $hotel["id_t"]; ?>/from/<?php echo $newDate; ?>/to/<?php echo $newDate2; ?>/rooms/<?php echo $rooms; ?>/adults/<?php echo $adults; ?>"</a>
    </h4>
            <p class="service-location"><i class="input-icon field-icon fa"><svg width="15px" height="15px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Ico_maps" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Group" transform="translate(4.000000, 0.000000)" stroke="#666666">
            <g id="pin-1" transform="translate(-0.000000, 0.000000)">
                <path d="M15.75,8.25 C15.75,12.471 12.817,14.899 10.619,17.25 C9.303,18.658 8.25,23.25 8.25,23.25 C8.25,23.25 7.2,18.661 5.887,17.257 C3.687,14.907 0.75,12.475 0.75,8.25 C0.75,4.10786438 4.10786438,0.75 8.25,0.75 C12.3921356,0.75 15.75,4.10786438 15.75,8.25 Z" id="Shape"></path>
                <circle id="Oval" cx="8.25" cy="8.25" r="3"></circle>
            </g>
        </g>
    </g>
</svg></i><?php echo $hotel["city"]["name"]; ?></p>
    
    <div class="section-footer">
        <div class="service-review">
                        <span class="rating">4.4/5 Excellent</span>
            <span class="st-dot"></span>
            <span class="review">2 Reviews</span>
        </div>
        <div class="service-price">
            <span>
                <i class="input-icon field-icon fa"><svg width="10px" height="16px" viewBox="0 0 11 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Room_Only_Detail_1" transform="translate(-135.000000, -4858.000000)" fill="#ffab53" fill-rule="nonzero">
            <g id="nearby-hotel" transform="translate(130.000000, 4334.000000)">
                <g id="h1-g" transform="translate(5.000000, 136.000000)">
                    <g id="hotel-grid">
                        <g id="price" transform="translate(0.000000, 383.000000)">
                            <g id="thunder" transform="translate(0.000000, 5.000000)">
                                <path d="M10.0143234,6.99308716 C9.91102517,6.83252576 9.73362166,6.73708716 9.54386728,6.73708716 L5.61404272,6.73708716 L5.61404272,0.561648567 C5.61404272,0.296666111 5.42877956,0.0676134793 5.16941114,0.0125959355 C4.90555149,-0.0435444154 4.64730587,0.0923152337 4.5395164,0.333718743 L0.0482883306,10.4389819 C-0.0291853536,10.6118942 -0.0123432484,10.8139994 0.0909549973,10.9723152 C0.194253243,11.1317538 0.371656752,11.2283152 0.561411138,11.2283152 L4.4912357,11.2283152 L4.4912357,17.4037538 C4.4912357,17.6687363 4.67649886,17.8977889 4.93586728,17.9528065 C4.97516552,17.9606661 5.01446377,17.9651573 5.05263921,17.9651573 C5.27046377,17.9651573 5.47369184,17.8382801 5.56576201,17.6316837 L10.0569901,7.5264205 C10.133341,7.35238541 10.1187445,7.15252576 10.0143234,6.99308716 Z" id="Shape"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                                    Avg                            </span>
            <span class="price">
                <?php echo $hotel["room_data"][0]["rate_data"][0]["price_details"]["baseline_price"]." ".$hotel["room_data"][0]["rate_data"][0]["price_details"]["baseline_symbol"]; ?></span>
            <span>/night</span>
        </div>
    </div>
</div>
<?php } ?>
        </div>
        </div>
    </div>


</div>
            </div>
        </div>
    </div>
    </div>
<div class="st-popup popup-date hidden-lg hidden-md" data-format="MM/DD/YYYY">
	<h3 class="popup-title">
		Check In - Out		<span class="popup-close"><i class="input-icon field-icon fa"><svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Ico_close" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Group" stroke="#1A2B48" stroke-width="1.5">
            <g id="close">
                <path d="M0.75,23.249 L23.25,0.749" id="Shape"></path>
                <path d="M23.25,23.249 L0.75,0.749" id="Shape"></path>
            </g>
        </g>
    </g>
</svg></i></span>
	</h3>
	<div class="popup-content">
		<input type="text" class="check-in-out" value="" name="date" />
	</div>
</div><div class="st-popup popup-guest hidden-lg hidden-md">
	<h3 class="popup-title">
		Guest		<span class="popup-close"><i class="input-icon field-icon fa"><svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Ico_close" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Group" stroke="#1A2B48" stroke-width="1.5">
            <g id="close">
                <path d="M0.75,23.249 L23.25,0.749" id="Shape"></path>
                <path d="M23.25,23.249 L0.75,0.749" id="Shape"></path>
            </g>
        </g>
    </g>
</svg></i></span>
	</h3>
	<div class="popup-content">
		<ul>
            <li class="item">
                <label>Rooms</label>
                <div class="select-wrapper">
                    <div class="st-number-wrapper">
                        <input type="text" name="room_num_search" value="1" class="form-control st-input-number" autocomplete="off" readonly data-min="1" data-max="20"/>
                    </div>
                </div>
            </li>
			<li class="item">
				<label>Adults</label>
				<div class="select-wrapper">
                    <div class="st-number-wrapper">
                        <input type="text" name="adult_number" value="1" class="form-control st-input-number" autocomplete="off" readonly data-min="1" data-max="20"/>
                    </div>
				</div>
			</li>
			<li class="item">
				<label>Children</label>
				<div class="select-wrapper">
                    <div class="st-number-wrapper">
                        <input type="text" name="child_number" value="0" class="form-control st-input-number" autocomplete="off" readonly data-min="0" data-max="20"/>
                    </div>
				</div>
			</li>
		</ul>
        <button class="btn btn-link btn-guest-apply">Apply</button>
	</div>
</div><footer id="main-footer" class="clearfix  "><div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true" class="vc_row wpb_row st bg-holder vc_custom_1592470064670 vc_row-has-fill vc_row-no-padding"><div class='container-fluid'> <div class='row'>
	<div class="wpb_column column_container col-md-12"><div class="vc_column-inner wpb_wrapper">
			<div class="mailchimp">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                <div class="row">
                    <div class="col-xs-12  col-md-7 col-lg-6">
                        <div class="media ">
                            <div class="media-left pr30 hidden-xs">
                                                                <img class="media-object st_1616163086"
                                    src="https://dividivitravel.com/wp-content/themes/traveler/v2/images/svg/ico_email_subscribe.svg"
                                    alt="">
                            </div>
                            <div class="media-body">
                                                                    <h4 class="media-heading st-heading-section f24">Get Updates &amp; More</h4>
                                                                                                        <p class="f16 c-grey">Thoughtful thoughts to your inbox</p>
                                                                </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5 col-lg-6">
                                                        <form action="" class="subcribe-form">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Email">
                                        <input type="submit" name="submit" value="Subscribe">
                                    </div>
                                </form>
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
	</div> 
</div><!--End .row--></div><!--End .container--></div><div class="vc_row-full-width vc_clearfix"></div><div class="vc_row wpb_row st bg-holder"><div class='container '><div class='row'>
	<div class="wpb_column column_container col-md-12"><div class="vc_column-inner wpb_wrapper">
			<div class="vc_empty_space"   style="height: 50px"><span class="vc_empty_space_inner"></span></div></div>
	</div> 
</div><!--End .row--></div><!--End .container--></div><div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row st bg-holder vc_custom_1542265299369 vc_row-has-fill"><div class='container '><div class='row'>
	<div class="wpb_column column_container col-md-3"><div class="vc_column-inner wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element  vc_custom_1543220007372" >
		<div class="wpb_wrapper">
			<h4 style="font-size: 14px;">NEED HELP?</h4>

		</div>
	</div>
<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_40 vc_sep_pos_align_left vc_separator_no_text" ><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span>
</div>
	<div class="wpb_text_column wpb_content_element  vc_custom_1543221092622" >
		<div class="wpb_wrapper">
			<p><span style="color: #5e6d77;">Call Us</span></p>
<h4>+ 00 222 44 5678</h4>

		</div>
	</div>

	<div class="wpb_text_column wpb_content_element  vc_custom_1543221080532" >
		<div class="wpb_wrapper">
			<p><span style="color: #5e6d77;">Email for Us</span></p>
<h4>hello@yoursite.com</h4>

		</div>
	</div>

	<div class="wpb_text_column wpb_content_element  vc_custom_1544512778823" >
		<div class="wpb_wrapper">
			<p><span style="color: #5e6d77; margin-bottom: 5px;">Follow Us<br />
</span></p>
<p><a style="margin-right: 20px;" href="#"><img loading="lazy" class="alignnone wp-image-7794 size-full" src="https://travelhotel.wpengine.com/wp-content/uploads/2018/12/ico_facebook_footer.png" alt="" width="21" height="25" /></a><a style="margin-right: 20px;" href="#"><img loading="lazy" class="alignnone wp-image-7795 size-full" src="https://travelhotel.wpengine.com/wp-content/uploads/2018/12/ico_twitter_footer.png" alt="" width="32" height="24" /></a><a style="margin-right: 20px;" href="#"><img loading="lazy" class="alignnone wp-image-7796 size-full" src="https://travelhotel.wpengine.com/wp-content/uploads/2018/12/ico_instagram_footer.png" alt="" width="24" height="22" /></a></p>

		</div>
	</div>
</div>
	</div> 

	<div class="wpb_column column_container col-md-3"><div class="vc_column-inner wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element  vc_custom_1543220015251" >
		<div class="wpb_wrapper">
			<h4 style="font-size: 14px;">COMPANY</h4>

		</div>
	</div>
<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_40 vc_sep_pos_align_left vc_separator_no_text" ><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span>
</div><div class="widget widget_nav_menu"><ul id="menu-footer-new" class="menu"><li id="menu-item-9532" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9532"><a href="#">About Us</a></li>
<li id="menu-item-9533" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9533"><a href="#">Community Blog</a></li>
<li id="menu-item-9534" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9534"><a href="#">Rewards</a></li>
<li id="menu-item-9535" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9535"><a href="#">Work with Us</a></li>
<li id="menu-item-9536" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9536"><a href="#">Meet the Team</a></li>
</ul></div></div>
	</div> 

	<div class="wpb_column column_container col-md-3"><div class="vc_column-inner wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element  vc_custom_1543220022219" >
		<div class="wpb_wrapper">
			<h4 style="font-size: 14px;">SUPPORT</h4>

		</div>
	</div>
<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_40 vc_sep_pos_align_left vc_separator_no_text" ><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span>
</div><div class="widget widget_nav_menu"><ul id="menu-footer-new-2" class="menu"><li id="menu-item-9537" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9537"><a href="#">Account</a></li>
<li id="menu-item-9538" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9538"><a href="#">Legal</a></li>
<li id="menu-item-9539" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9539"><a href="#">Contact</a></li>
<li id="menu-item-9540" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9540"><a href="#">Affiliate Program</a></li>
<li id="menu-item-9541" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9541"><a href="#">Privacy Policy</a></li>
</ul></div></div>
	</div> 

	<div class="wpb_column column_container col-md-3"><div class="vc_column-inner wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element  vc_custom_1543220028834" >
		<div class="wpb_wrapper">
			<h4 style="font-size: 14px;">SETTING</h4>

		</div>
	</div>
<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_40 vc_sep_pos_align_left vc_separator_no_text" ><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:#eaeaea;" class="vc_sep_line"></span></span>
</div><div class="form-group ">
    <label class="block f14 c-grey font-normal">Currencies</label>
    <select name="currency" class=" f14 select2-currencies">
                        <option  selected='selected'                        value="EUR"
                        data-target="/?page_id=7406&#038;currency=EUR">EUR</option>
                                <option                         value="USD"
                        data-target="/?page_id=7406&#038;currency=USD">USD</option>
                                <option                         value="AUD"
                        data-target="/?page_id=7406&#038;currency=AUD">AUD</option>
                    </select>
</div>
</div>
	</div> 
</div><!--End .row--></div><!--End .container--></div><div class="vc_row-full-width vc_clearfix"></div>
 </footer>
    <div class="container main-footer-sub">
        <div class="st-flex space-between">
            <div class="left mt20">
                <div class="f14">
                    Copyright © 2021 by <a
                            href="https://dividivitravel.com/"
                            class="st-link">WP-CLI</a>
                                        </div>
            </div>
            <div class="right mt20">
                            </div>
        </div>
    </div>

<div class="modal fade" id="st-login-form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 450px;">
        <div class="modal-content relative">
            <div class="loader-wrapper">
    <div class="st-loader"></div>
</div>            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="input-icon field-icon fa"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Ico_close" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Group" stroke="#1A2B48" stroke-width="1.5">
            <g id="close">
                <path d="M0.75,23.249 L23.25,0.749" id="Shape"></path>
                <path d="M23.25,23.249 L0.75,0.749" id="Shape"></path>
            </g>
        </g>
    </g>
</svg></i>                </button>
                <h4 class="modal-title">Log In</h4>
            </div>
            <div class="modal-body relative">
                <form action="" class="form" method="post">
                    <input type="hidden" name="st_theme_style" value="modern"/>
                    <input type="hidden" name="action" value="st_login_popup">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" autocomplete="off"
                               placeholder="Email or Username">
                               <i class="input-icon field-icon fa"><svg width="18px" viewBox="0 0 24 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Log-In" transform="translate(-912.000000, -220.000000)" stroke="#A0A9B2">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="input" transform="translate(30.000000, 119.000000)">
                    <g id="Group" transform="translate(416.000000, 22.000000)">
                        <g id="ico_email_login_form">
                            <rect id="Rectangle-path" x="0.5" y="0.0101176471" width="23" height="16.9411765" rx="2"></rect>
                            <polyline id="Shape" points="22.911 0.626352941 12 10.0689412 1.089 0.626352941"></polyline>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" autocomplete="off"
                               placeholder="Password">
                               <i class="input-icon field-icon fa"><svg width="16px" viewBox="0 0 18 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Log-In" transform="translate(-918.000000, -307.000000)" stroke="#A0A9B2">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="input" transform="translate(30.000000, 209.000000)">
                    <g id="Group" transform="translate(422.000000, 18.000000)">
                        <g id="ico_pass_login_form">
                            <path d="M3.5,6 C3.5,2.96243388 5.96243388,0.5 9,0.5 C12.0375661,0.5 14.5,2.96243388 14.5,6 L14.5,9.5" id="Shape"></path>
                            <path d="M17.5,11.5 C17.5,10.3954305 16.6045695,9.5 15.5,9.5 L2.5,9.5 C1.3954305,9.5 0.5,10.3954305 0.5,11.5 L0.5,21.5 C0.5,22.6045695 1.3954305,23.5 2.5,23.5 L15.5,23.5 C16.6045695,23.5 17.5,22.6045695 17.5,21.5 L17.5,11.5 Z" id="Shape"></path>
                            <circle id="Oval" cx="9" cy="16.5" r="1.25"></circle>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-submit"
                               value="Log In">
                    </div>
                    <div class="message-wrapper mt20"></div>
                    <div class="mt20 st-flex space-between st-icheck">
                        <div class="st-icheck-item">
                            <label for="remember-me" class="c-grey">
                                <input type="checkbox" name="remember" id="remember-me"
                                       value="1"> Remember me                                <span class="checkmark fcheckbox"></span>
                            </label>
                        </div>
                        <a href="" class="st-link open-loss-password"
                           data-toggle="modal">Forgot Password?</a>
                    </div>
                    <div class="advanced">
                        <p class="text-center f14 c-grey">or continue with</p>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4">
                                                                    <a onclick="return false" href="#"
                                       class="btn_login_fb_link st_login_social_link" data-channel="facebook">
                                           <i class="input-icon field-icon fa"><svg width="100%" viewBox="0 0 140 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Log-In" transform="translate(-496.000000, -560.000000)">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="social" transform="translate(0.000000, 417.000000)">
                    <g id="fb" transform="translate(30.000000, 63.000000)">
                        <rect id="Rectangle-2" fill="#395899" x="0" y="0" width="140" height="40" rx="3"></rect>
                        <g transform="translate(26.000000, 9.000000)">
                            <text id="Facebook" font-family="Poppins-Medium, Poppins" font-size="14" font-weight="400" fill="#F9F9F9">
                                <tspan x="19" y="16">Facebook</tspan>
                            </text>
                            <g id="facebook-logo" transform="translate(0.000000, 3.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <path d="M8.24940206,0.00329896907 L6.19331959,0 C3.88338144,0 2.39059794,1.53154639 2.39059794,3.90202062 L2.39059794,5.7011134 L0.323298969,5.7011134 C0.144659794,5.7011134 0,5.84593814 0,6.02457732 L0,8.63125773 C0,8.80989691 0.144824742,8.9545567 0.323298969,8.9545567 L2.39059794,8.9545567 L2.39059794,15.5320412 C2.39059794,15.7106804 2.53525773,15.8553402 2.71389691,15.8553402 L5.41113402,15.8553402 C5.5897732,15.8553402 5.73443299,15.7105155 5.73443299,15.5320412 L5.73443299,8.9545567 L8.15158763,8.9545567 C8.3302268,8.9545567 8.4748866,8.80989691 8.4748866,8.63125773 L8.47587629,6.02457732 C8.47587629,5.93880412 8.44173196,5.85665979 8.38119588,5.79595876 C8.32065979,5.73525773 8.23818557,5.7011134 8.15241237,5.7011134 L5.73443299,5.7011134 L5.73443299,4.176 C5.73443299,3.44296907 5.9091134,3.07084536 6.864,3.07084536 L8.24907216,3.07035052 C8.42754639,3.07035052 8.57220619,2.92552577 8.57220619,2.74705155 L8.57220619,0.326597938 C8.57220619,0.14828866 8.42771134,0.00362886598 8.24940206,0.00329896907 Z" id="Shape"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                                    </a>
                                                            </div>
                            <div class="col-xs-4 col-sm-4">
                                                                    <a href="javascript: void(0)" id="st-google-signin2"
                                       class="btn_login_gg_link st_login_social_link" data-channel="google">
                                           <i class="input-icon field-icon fa"><svg width="100%" viewBox="0 0 140 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Log-In" transform="translate(-816.000000, -560.000000)">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="social" transform="translate(0.000000, 417.000000)">
                    <g id="g+" transform="translate(350.000000, 63.000000)">
                        <rect id="Rectangle-2" fill="#F34A38" x="0" y="0" width="140" height="40" rx="3"></rect>
                        <g id="Group-3" transform="translate(24.000000, 9.000000)" fill="#FFFFFF">
                            <g id="google-plus" transform="translate(10.000000, 3.000000)" fill-rule="nonzero">
                                <path d="M8.74974949,9.62441417 L12.6460216,9.62441417 C11.9621032,11.5580196 10.1098039,12.9443598 7.9412597,12.9283598 C5.3100216,12.9089312 3.13434813,10.804006 3.03219847,8.17467268 C2.92270187,5.3562237 5.18387194,3.02838696 7.97842977,3.02838696 C9.25619847,3.02838696 10.4222393,3.51524411 11.3013141,4.31301281 C11.5095318,4.50201962 11.8264842,4.5032169 12.0312733,4.31045499 L13.4623481,2.96357064 C13.6861304,2.75290397 13.6869468,2.39714887 13.4638175,2.18577472 C12.0696951,0.865012814 10.1995454,0.0417747189 8.13723249,0.00150261009 C3.73853861,-0.0843749409 0.0308379286,3.52210125 0.000198472791,7.92155703 C-0.0307130918,12.3540468 3.55312364,15.9568768 7.97842977,15.9568768 C12.2341577,15.9568768 15.7107291,12.6246863 15.9435998,8.42718968 C15.9498039,8.37456383 15.9538855,6.59600601 15.9538855,6.59600601 L8.74974949,6.59600601 C8.45445698,6.59600601 8.21511004,6.83535295 8.21511004,7.13064547 L8.21511004,9.08977472 C8.21511004,9.38506724 8.4545114,9.62441417 8.74974949,9.62441417 Z" id="Shape"></path>
                            </g>
                            <text id="Google" font-family="Poppins-Medium, Poppins" font-size="14" font-weight="400">
                                <tspan x="36" y="16">Google</tspan>
                            </text>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                                    </a>
                                    <!--<div id="st-google-signin2" class="btn_login_gg_link st_login_social_link"></div>-->
                                                            </div>
                            <div class="col-xs-4 col-sm-4">
                                                                    <a href="https://dividivitravel.com/social-login/twitter"
                                       onclick="return false"
                                       class="btn_login_tw_link st_login_social_link" data-channel="twitter">
                                           <i class="input-icon field-icon fa"><svg width="100%" viewBox="0 0 140 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Log-In" transform="translate(-656.000000, -560.000000)">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="social" transform="translate(0.000000, 417.000000)">
                    <g id="tt" transform="translate(190.000000, 63.000000)">
                        <rect id="Rectangle-2" fill="#03A9F4" x="0" y="0" width="140" height="40" rx="3"></rect>
                        <g id="Group-2" transform="translate(31.000000, 9.000000)" fill="#FFFFFF">
                            <text id="Twitter" font-family="Poppins-Medium, Poppins" font-size="14" font-weight="400">
                                <tspan x="30" y="16">Twitter</tspan>
                            </text>
                            <g id="twitter" transform="translate(0.000000, 3.000000)" fill-rule="nonzero">
                                <path d="M19.6923077,1.89415385 C18.96,2.21538462 18.1796923,2.42830769 17.3661538,2.53169231 C18.2030769,2.032 18.8418462,1.24676923 19.1421538,0.300307692 C18.3618462,0.765538462 17.5003077,1.09415385 16.5821538,1.27753846 C15.8412308,0.488615385 14.7852308,0 13.6332308,0 C11.3981538,0 9.59876923,1.81415385 9.59876923,4.03815385 C9.59876923,4.35815385 9.62584615,4.66584615 9.69230769,4.95876923 C6.336,4.79507692 3.36615385,3.18646154 1.37107692,0.736 C1.02276923,1.34030769 0.818461538,2.032 0.818461538,2.77661538 C0.818461538,4.17476923 1.53846154,5.41415385 2.61169231,6.13169231 C1.96307692,6.11938462 1.32676923,5.93107692 0.787692308,5.63446154 C0.787692308,5.64676923 0.787692308,5.66276923 0.787692308,5.67876923 C0.787692308,7.64061538 2.18707692,9.27015385 4.02215385,9.64553846 C3.69353846,9.73538462 3.33538462,9.77846154 2.96369231,9.77846154 C2.70523077,9.77846154 2.44430769,9.76369231 2.19938462,9.70953846 C2.72246154,11.3083077 4.20676923,12.4836923 5.97169231,12.5218462 C4.59815385,13.5963077 2.85415385,14.2436923 0.966153846,14.2436923 C0.635076923,14.2436923 0.317538462,14.2289231 -5.68434189e-14,14.1883077 C1.78830769,15.3415385 3.90769231,16 6.19323077,16 C13.6221538,16 17.6836923,9.84615385 17.6836923,4.512 C17.6836923,4.33353846 17.6775385,4.16123077 17.6689231,3.99015385 C18.4701538,3.42153846 19.1433846,2.71138462 19.6923077,1.89415385 Z" id="Shape"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                                    </a>
                                                            </div>
                        </div>
                    </div>
                    <div class="mt20 c-grey font-medium f14 text-center">
                        Do not have an account?                         <a href=""
                           class="st-link open-signup"
                           data-toggle="modal">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><div class="modal fade" id="st-register-form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 520px;">
        <div class="modal-content relative">
            <div class="loader-wrapper">
    <div class="st-loader"></div>
</div>            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="input-icon field-icon fa"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Ico_close" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Group" stroke="#1A2B48" stroke-width="1.5">
            <g id="close">
                <path d="M0.75,23.249 L23.25,0.749" id="Shape"></path>
                <path d="M23.25,23.249 L0.75,0.749" id="Shape"></path>
            </g>
        </g>
    </g>
</svg></i>                </button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
                <form action="" class="form" method="post">
                    <input type="hidden" name="st_theme_style" value="modern"/>
                    <input type="hidden" name="action" value="st_registration_popup">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" autocomplete="off"
                               placeholder="Username *">
                               <i class="input-icon field-icon fa"><svg width="20px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Sign-Up" transform="translate(-912.000000, -207.000000)" stroke="#A0A9B2">
            <g id="sign-up" transform="translate(466.000000, 80.000000)">
                <g id="input" transform="translate(30.000000, 109.000000)">
                    <g id="ico_username_form_signup" transform="translate(416.000000, 18.000000)">
                        <g id="Light">
                            <circle id="Oval" cx="12" cy="12" r="11.5"></circle>
                            <path d="M8.338,6.592 C10.3777315,8.7056567 13.5128387,9.33602311 16.211,8.175" id="Shape"></path>
                            <circle id="Oval" cx="12" cy="8.75" r="4.25"></circle>
                            <path d="M18.317,18.5 C17.1617209,16.0575309 14.7019114,14.4999182 12,14.4999182 C9.29808863,14.4999182 6.83827906,16.0575309 5.683,18.5" id="Shape"></path>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullname" autocomplete="off"
                               placeholder="Full Name">
                               <i class="input-icon field-icon fa"><svg width="20px" viewBox="0 0 23 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Sign-Up" transform="translate(-914.000000, -295.000000)" stroke="#A0A9B2">
            <g id="sign-up" transform="translate(466.000000, 80.000000)">
                <g id="input" transform="translate(30.000000, 199.000000)">
                    <g id="Group" transform="translate(418.000000, 17.000000)">
                        <g id="ico_fullname_signup">
                            <path d="M14.5,23.5 L14.5,20.5 L15.5,20.5 C17.1568542,20.5 18.5,19.1568542 18.5,17.5 L18.5,14.5 L21.313,14.5 C21.4719994,14.4989403 21.6210158,14.4223193 21.7143842,14.2936169 C21.8077526,14.1649146 21.8343404,13.9994766 21.786,13.848 C19.912,8.048 18.555,1.813 12.366,0.681 C9.63567371,0.151893606 6.80836955,0.784892205 4.56430871,2.42770265 C2.32024786,4.07051309 0.862578016,6.57441697 0.542,9.337 C0.21983037,12.7556062 1.72416582,16.0907612 4.5,18.112 L4.5,23.5" id="Shape"></path>
                            <path d="M7.5,8 C7.49875423,6.44186837 8.69053402,5.14214837 10.2429354,5.00863533 C11.7953368,4.87512228 13.1915367,5.95226513 13.4563532,7.48772858 C13.7211696,9.02319203 12.7664402,10.5057921 11.259,10.9 C10.8242888,10.9952282 10.5108832,11.3751137 10.5,11.82 L10.5,13.5" id="Shape"></path>
                            <path d="M10.5,15.5 C10.6380712,15.5 10.75,15.6119288 10.75,15.75 C10.75,15.8880712 10.6380712,16 10.5,16 C10.3619288,16 10.25,15.8880712 10.25,15.75 C10.25,15.6119288 10.3619288,15.5 10.5,15.5" id="Shape"></path>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" autocomplete="off"
                               placeholder="Email *">
                               <i class="input-icon field-icon fa"><svg width="18px" viewBox="0 0 24 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Log-In" transform="translate(-912.000000, -220.000000)" stroke="#A0A9B2">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="input" transform="translate(30.000000, 119.000000)">
                    <g id="Group" transform="translate(416.000000, 22.000000)">
                        <g id="ico_email_login_form">
                            <rect id="Rectangle-path" x="0.5" y="0.0101176471" width="23" height="16.9411765" rx="2"></rect>
                            <polyline id="Shape" points="22.911 0.626352941 12 10.0689412 1.089 0.626352941"></polyline>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" autocomplete="off"
                               placeholder="Password *">
                               <i class="input-icon field-icon fa"><svg width="16px" viewBox="0 0 18 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Log-In" transform="translate(-918.000000, -307.000000)" stroke="#A0A9B2">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="input" transform="translate(30.000000, 209.000000)">
                    <g id="Group" transform="translate(422.000000, 18.000000)">
                        <g id="ico_pass_login_form">
                            <path d="M3.5,6 C3.5,2.96243388 5.96243388,0.5 9,0.5 C12.0375661,0.5 14.5,2.96243388 14.5,6 L14.5,9.5" id="Shape"></path>
                            <path d="M17.5,11.5 C17.5,10.3954305 16.6045695,9.5 15.5,9.5 L2.5,9.5 C1.3954305,9.5 0.5,10.3954305 0.5,11.5 L0.5,21.5 C0.5,22.6045695 1.3954305,23.5 2.5,23.5 L15.5,23.5 C16.6045695,23.5 17.5,22.6045695 17.5,21.5 L17.5,11.5 Z" id="Shape"></path>
                            <circle id="Oval" cx="9" cy="16.5" r="1.25"></circle>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                    </div>
                                            <div class="form-group">
                            <p class="f14 c-grey">Select User Type</p>
                            <label class="block" for="normal-user">
                                <input checked id="normal-user" type="radio" class="mr5" name="register_as"
                                       value="normal"> <span class="c-main" data-toggle="tooltip" data-placement="right"
                                       title="Used for booking services">Normal User</span>
                            </label>
                            <label class="block" for="partner-user">
                                <input id="partner-user" type="radio" class="mr5" name="register_as"
                                       value="partner">
                                <span class="c-main" data-toggle="tooltip" data-placement="right"
                                      title="Used for upload and booking services">Partner User</span>
                            </label>
                        </div>
                                        <div class="form-group st-icheck-item">
                        <label for="term">
                                                        <input id="term" type="checkbox" name="term"
                                   class="mr5"> I have read and accept the <a class="st-link" href="https://dividivitravel.com/?page_id=3">Terms and Privacy Policy</a>                            <span class="checkmark fcheckbox"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="form-submit"
                               value="Sign Up">
                    </div>
                    <div class="message-wrapper mt20"></div>
                    <div class="advanced">
                        <p class="text-center f14 c-grey">or continue with</p>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4">
                                                                    <a onclick="return false" href="#"
                                       class="btn_login_fb_link st_login_social_link" data-channel="facebook">
                                           <i class="input-icon field-icon fa"><svg width="100%" viewBox="0 0 140 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Log-In" transform="translate(-496.000000, -560.000000)">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="social" transform="translate(0.000000, 417.000000)">
                    <g id="fb" transform="translate(30.000000, 63.000000)">
                        <rect id="Rectangle-2" fill="#395899" x="0" y="0" width="140" height="40" rx="3"></rect>
                        <g transform="translate(26.000000, 9.000000)">
                            <text id="Facebook" font-family="Poppins-Medium, Poppins" font-size="14" font-weight="400" fill="#F9F9F9">
                                <tspan x="19" y="16">Facebook</tspan>
                            </text>
                            <g id="facebook-logo" transform="translate(0.000000, 3.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <path d="M8.24940206,0.00329896907 L6.19331959,0 C3.88338144,0 2.39059794,1.53154639 2.39059794,3.90202062 L2.39059794,5.7011134 L0.323298969,5.7011134 C0.144659794,5.7011134 0,5.84593814 0,6.02457732 L0,8.63125773 C0,8.80989691 0.144824742,8.9545567 0.323298969,8.9545567 L2.39059794,8.9545567 L2.39059794,15.5320412 C2.39059794,15.7106804 2.53525773,15.8553402 2.71389691,15.8553402 L5.41113402,15.8553402 C5.5897732,15.8553402 5.73443299,15.7105155 5.73443299,15.5320412 L5.73443299,8.9545567 L8.15158763,8.9545567 C8.3302268,8.9545567 8.4748866,8.80989691 8.4748866,8.63125773 L8.47587629,6.02457732 C8.47587629,5.93880412 8.44173196,5.85665979 8.38119588,5.79595876 C8.32065979,5.73525773 8.23818557,5.7011134 8.15241237,5.7011134 L5.73443299,5.7011134 L5.73443299,4.176 C5.73443299,3.44296907 5.9091134,3.07084536 6.864,3.07084536 L8.24907216,3.07035052 C8.42754639,3.07035052 8.57220619,2.92552577 8.57220619,2.74705155 L8.57220619,0.326597938 C8.57220619,0.14828866 8.42771134,0.00362886598 8.24940206,0.00329896907 Z" id="Shape"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                                    </a>
                                                            </div>
                            <div class="col-xs-4 col-sm-4">
                                                                    <a href="javascript: void(0)" id="st-google-signin3"
                                       class="btn_login_gg_link st_login_social_link" data-channel="google">
                                           <i class="input-icon field-icon fa"><svg width="100%" viewBox="0 0 140 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Log-In" transform="translate(-816.000000, -560.000000)">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="social" transform="translate(0.000000, 417.000000)">
                    <g id="g+" transform="translate(350.000000, 63.000000)">
                        <rect id="Rectangle-2" fill="#F34A38" x="0" y="0" width="140" height="40" rx="3"></rect>
                        <g id="Group-3" transform="translate(24.000000, 9.000000)" fill="#FFFFFF">
                            <g id="google-plus" transform="translate(10.000000, 3.000000)" fill-rule="nonzero">
                                <path d="M8.74974949,9.62441417 L12.6460216,9.62441417 C11.9621032,11.5580196 10.1098039,12.9443598 7.9412597,12.9283598 C5.3100216,12.9089312 3.13434813,10.804006 3.03219847,8.17467268 C2.92270187,5.3562237 5.18387194,3.02838696 7.97842977,3.02838696 C9.25619847,3.02838696 10.4222393,3.51524411 11.3013141,4.31301281 C11.5095318,4.50201962 11.8264842,4.5032169 12.0312733,4.31045499 L13.4623481,2.96357064 C13.6861304,2.75290397 13.6869468,2.39714887 13.4638175,2.18577472 C12.0696951,0.865012814 10.1995454,0.0417747189 8.13723249,0.00150261009 C3.73853861,-0.0843749409 0.0308379286,3.52210125 0.000198472791,7.92155703 C-0.0307130918,12.3540468 3.55312364,15.9568768 7.97842977,15.9568768 C12.2341577,15.9568768 15.7107291,12.6246863 15.9435998,8.42718968 C15.9498039,8.37456383 15.9538855,6.59600601 15.9538855,6.59600601 L8.74974949,6.59600601 C8.45445698,6.59600601 8.21511004,6.83535295 8.21511004,7.13064547 L8.21511004,9.08977472 C8.21511004,9.38506724 8.4545114,9.62441417 8.74974949,9.62441417 Z" id="Shape"></path>
                            </g>
                            <text id="Google" font-family="Poppins-Medium, Poppins" font-size="14" font-weight="400">
                                <tspan x="36" y="16">Google</tspan>
                            </text>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                                    </a>
                                    <!--<div id="st-google-signin3" class="btn_login_gg_link st_login_social_link"></div>-->

                                                            </div>
                            <div class="col-xs-4 col-sm-4">
                                                                    <a href="https://dividivitravel.com/social-login/twitter"
                                       onclick="return false"
                                       class="btn_login_tw_link st_login_social_link" data-channel="twitter">
                                           <i class="input-icon field-icon fa"><svg width="100%" viewBox="0 0 140 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Log-In" transform="translate(-656.000000, -560.000000)">
            <g id="login" transform="translate(466.000000, 80.000000)">
                <g id="social" transform="translate(0.000000, 417.000000)">
                    <g id="tt" transform="translate(190.000000, 63.000000)">
                        <rect id="Rectangle-2" fill="#03A9F4" x="0" y="0" width="140" height="40" rx="3"></rect>
                        <g id="Group-2" transform="translate(31.000000, 9.000000)" fill="#FFFFFF">
                            <text id="Twitter" font-family="Poppins-Medium, Poppins" font-size="14" font-weight="400">
                                <tspan x="30" y="16">Twitter</tspan>
                            </text>
                            <g id="twitter" transform="translate(0.000000, 3.000000)" fill-rule="nonzero">
                                <path d="M19.6923077,1.89415385 C18.96,2.21538462 18.1796923,2.42830769 17.3661538,2.53169231 C18.2030769,2.032 18.8418462,1.24676923 19.1421538,0.300307692 C18.3618462,0.765538462 17.5003077,1.09415385 16.5821538,1.27753846 C15.8412308,0.488615385 14.7852308,0 13.6332308,0 C11.3981538,0 9.59876923,1.81415385 9.59876923,4.03815385 C9.59876923,4.35815385 9.62584615,4.66584615 9.69230769,4.95876923 C6.336,4.79507692 3.36615385,3.18646154 1.37107692,0.736 C1.02276923,1.34030769 0.818461538,2.032 0.818461538,2.77661538 C0.818461538,4.17476923 1.53846154,5.41415385 2.61169231,6.13169231 C1.96307692,6.11938462 1.32676923,5.93107692 0.787692308,5.63446154 C0.787692308,5.64676923 0.787692308,5.66276923 0.787692308,5.67876923 C0.787692308,7.64061538 2.18707692,9.27015385 4.02215385,9.64553846 C3.69353846,9.73538462 3.33538462,9.77846154 2.96369231,9.77846154 C2.70523077,9.77846154 2.44430769,9.76369231 2.19938462,9.70953846 C2.72246154,11.3083077 4.20676923,12.4836923 5.97169231,12.5218462 C4.59815385,13.5963077 2.85415385,14.2436923 0.966153846,14.2436923 C0.635076923,14.2436923 0.317538462,14.2289231 -5.68434189e-14,14.1883077 C1.78830769,15.3415385 3.90769231,16 6.19323077,16 C13.6221538,16 17.6836923,9.84615385 17.6836923,4.512 C17.6836923,4.33353846 17.6775385,4.16123077 17.6689231,3.99015385 C18.4701538,3.42153846 19.1433846,2.71138462 19.6923077,1.89415385 Z" id="Shape"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>                                    </a>
                                                            </div>
                        </div>
                    </div>
                    <div class="mt20 c-grey f14 text-center">
                        Already have an account?                         <a href="" class="st-link open-login"
                           data-toggle="modal">Log In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>            <style>
                
                .st_1616163085{
                    background-image: url(https://dividivitravel.com/wp-content/uploads/2021/03/shutterstock_144112840-scaled.jpg) !important;
                }
        
                .st_1616163086{
                    height: 80px
                }
        .vc_custom_1592470064670{background-color: #f5f5f5 !important;}.vc_custom_1542265299369{background-color: #ffffff !important;}.vc_custom_1543220007372{margin-bottom: 20px !important;}.vc_custom_1543221092622{border-left-width: 3px !important;padding-left: 20px !important;border-left-color: #5191fa !important;border-left-style: solid !important;}.vc_custom_1543221080532{border-left-width: 3px !important;padding-left: 20px !important;border-left-color: #5191fa !important;border-left-style: solid !important;}.vc_custom_1544512778823{margin-bottom: 15px !important;border-left-width: 3px !important;padding-left: 20px !important;border-left-color: #5191fa !important;border-left-style: solid !important;}.vc_custom_1543220015251{margin-bottom: 20px !important;}.vc_custom_1543220022219{margin-bottom: 20px !important;}.vc_custom_1543220028834{margin-bottom: 20px !important;}            </style>
        
		    <style id="stassets_footer_css">

			    
		    </style>

		    <script type="text/html" id="wpb-modifications"></script>	<script type="text/javascript">
		(function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})()
	</script>
	<link rel='stylesheet' id='js_composer_front-css'  href='https://dividivitravel.com/wp-content/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all' />
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/visualcomposer/public/dist/front.bundle.js' id='vcv:assets:front:script-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/visualcomposer/public/dist/runtime.bundle.js' id='vcv:assets:runtime:script-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/hoverintent-js.min.js' id='hoverintent-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/admin-bar.min.js' id='admin-bar-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/dist/vendor/wp-polyfill.min.js' id='wp-polyfill-js'></script>
<script type='text/javascript' id='wp-polyfill-js-after'>
( 'fetch' in window ) || document.write( '<script src="https://dividivitravel.com/wp-includes/js/dist/vendor/wp-polyfill-fetch.min.js"></scr' + 'ipt>' );( document.contains ) || document.write( '<script src="https://dividivitravel.com/wp-includes/js/dist/vendor/wp-polyfill-node-contains.min.js"></scr' + 'ipt>' );( window.DOMRect ) || document.write( '<script src="https://dividivitravel.com/wp-includes/js/dist/vendor/wp-polyfill-dom-rect.min.js"></scr' + 'ipt>' );( window.URL && window.URL.prototype && window.URLSearchParams ) || document.write( '<script src="https://dividivitravel.com/wp-includes/js/dist/vendor/wp-polyfill-url.min.js"></scr' + 'ipt>' );( window.FormData && window.FormData.prototype.keys ) || document.write( '<script src="https://dividivitravel.com/wp-includes/js/dist/vendor/wp-polyfill-formdata.min.js"></scr' + 'ipt>' );( Element.prototype.matches && Element.prototype.closest ) || document.write( '<script src="https://dividivitravel.com/wp-includes/js/dist/vendor/wp-polyfill-element-closest.min.js"></scr' + 'ipt>' );
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/dist/i18n.min.js' id='wp-i18n-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/dist/vendor/lodash.min.js' id='lodash-js'></script>
<script type='text/javascript' id='lodash-js-after'>
window.lodash = _.noConflict();
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/dist/url.min.js' id='wp-url-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/dist/hooks.min.js' id='wp-hooks-js'></script>
<script type='text/javascript' id='wp-api-fetch-js-translations'>
( function( domain, translations ) {
	var localeData = translations.locale_data[ domain ] || translations.locale_data.messages;
	localeData[""].domain = domain;
	wp.i18n.setLocaleData( localeData, domain );
} )( "default", { "locale_data": { "messages": { "": {} } } } );
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/dist/api-fetch.min.js' id='wp-api-fetch-js'></script>
<script type='text/javascript' id='wp-api-fetch-js-after'>
wp.apiFetch.use( wp.apiFetch.createRootURLMiddleware( "https://dividivitravel.com/index.php?rest_route=/" ) );
wp.apiFetch.nonceMiddleware = wp.apiFetch.createNonceMiddleware( "00969496ea" );
wp.apiFetch.use( wp.apiFetch.nonceMiddleware );
wp.apiFetch.use( wp.apiFetch.mediaUploadMiddleware );
wp.apiFetch.nonceEndpoint = "https://dividivitravel.com/wp-admin/admin-ajax.php?action=rest-nonce";
</script>
<script type='text/javascript' id='contact-form-7-js-extra'>
/* <![CDATA[ */
var wpcf7 = [];
/* ]]> */
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/contact-form-7/includes/js/index.js' id='contact-form-7-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js' id='js-cookie-js'></script>
<script type='text/javascript' id='woocommerce-js-extra'>
/* <![CDATA[ */
var woocommerce_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%"};
/* ]]> */
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js' id='woocommerce-js'></script>
<script type='text/javascript' id='wc-cart-fragments-js-extra'>
/* <![CDATA[ */
var wc_cart_fragments_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%","cart_hash_key":"wc_cart_hash_6a6a1275f98dbf0e61b746c6fb14ca7c","fragment_name":"wc_fragments_6a6a1275f98dbf0e61b746c6fb14ca7c","request_timeout":"5000"};
/* ]]> */
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js' id='wc-cart-fragments-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/mapbox-custom.js' id='mapbox-custom-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/bootstrap.min.js' id='bootstrap-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/jquery.matchHeight.js' id='match-height-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/fotorama/fotorama.js' id='fotorama-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/ion.rangeSlider/js/ion-rangeSlider/ion.rangeSlider.js' id='ion-rangeslider-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/moment.min.js' id='moment-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/daterangepicker/daterangepicker.js' id='daterangepicker-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/jquery.nicescroll.min.js' id='nicescroll-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/sweetalert2.min.js' id='sweetalert2.min-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/markerclusterer.js' id='markerclusterer-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/select2.full.min.js' id='select2.full.min-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/mapbox/custom.js' id='custom-mapboxjs-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/send-message-owner.js' id='send-message-owner-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/flickity.pkgd.min.js' id='flickity.pkgd.min-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/owlcarousel/owl.carousel.min.js' id='owlcarousel-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/jquery.mb.YTPlayer.min.js' id='mb-YTPlayer-js'></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.1.3/jquery.mCustomScrollbar.concat.min.js' id='mCustomScrollbar-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/car-tranfer.js' id='car-tranfer-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/custom.js' id='custom-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/sin-tour.js' id='sin-tour-js-js'></script>
<script type='text/javascript' src='https://www.google.com/recaptcha/api.js?render=6LdDD30aAAAAAJg6TtYeWdo5pr2UySpO5EBAELQi&#038;ver=3.0' id='google-recaptcha-js'></script>
<script type='text/javascript' id='wpcf7-recaptcha-js-extra'>
/* <![CDATA[ */
var wpcf7_recaptcha = {"sitekey":"6LdDD30aAAAAAJg6TtYeWdo5pr2UySpO5EBAELQi","actions":{"homepage":"homepage","contactform":"contactform"}};
/* ]]> */
</script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/contact-form-7/modules/recaptcha/index.js' id='wpcf7-recaptcha-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-includes/js/wp-embed.min.js' id='wp-embed-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/themes/traveler/v2/js/mapbox/filter-hotel-mapbox.js' id='filter-hotel-js-js'></script>
<script type='text/javascript' src='https://dividivitravel.com/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js' id='wpb_composer_front_js-js'></script>
<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Añade aquí tu código JavaScript.

Si estás usando la biblioteca jQuery, entonces no olvides envolver tu código dentro de jQuery.ready() así:
 */ 
jQuery(document).ready(function( $ ){
  $
	$("#api1").click(function(){
		var location_name = $("#location_id").val();
      	var start = $("#start").val();
        var end = $("#end").val();
        var child_number = $("#child_number").val();
        var adult_number = $("#adult_number").val();
        var room_num_search =$("#room_num_search").val();
        //alert( $("#start").val());
      	 window.location.href = 'https://dividivitravel.com/?page_id=9708&location_name='+location_name+'&start='+start+'&end='+end+'&child='+child_number+'&adult='+adult_number+'&room='+room_num_search;
      
	});

});
</script>
<!-- end Simple Custom CSS and JS -->
	<script type="text/javascript">
		(function() {
			var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

				request = true;
	
			b[c] = b[c].replace( rcs, ' ' );
			// The customizer requires postMessage and CORS (if the site is cross domain).
			b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
		}());
	</script>
			<div id="wpadminbar" class="nojq nojs">
							<a class="screen-reader-shortcut" href="#wp-toolbar" tabindex="1">Skip to toolbar</a>
						<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Toolbar">
				<ul id='wp-admin-bar-root-default' class="ab-top-menu"><li id='wp-admin-bar-wp-logo' class="menupop"><a class='ab-item' aria-haspopup="true" href='https://dividivitravel.com/wp-admin/about.php'><span class="ab-icon"></span><span class="screen-reader-text">About WordPress</span></a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-wp-logo-default' class="ab-submenu"><li id='wp-admin-bar-about'><a class='ab-item' href='https://dividivitravel.com/wp-admin/about.php'>About WordPress</a></li></ul><ul id='wp-admin-bar-wp-logo-external' class="ab-sub-secondary ab-submenu"><li id='wp-admin-bar-wporg'><a class='ab-item' href='https://wordpress.org/'>WordPress.org</a></li><li id='wp-admin-bar-documentation'><a class='ab-item' href='https://codex.wordpress.org/'>Documentation</a></li><li id='wp-admin-bar-support-forums'><a class='ab-item' href='https://wordpress.org/support/'>Support</a></li><li id='wp-admin-bar-feedback'><a class='ab-item' href='https://wordpress.org/support/forum/requests-and-feedback'>Feedback</a></li></ul></div></li><li id='wp-admin-bar-site-name' class="menupop"><a class='ab-item' aria-haspopup="true" href='https://dividivitravel.com/wp-admin/'>WP-CLI</a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-site-name-default' class="ab-submenu"><li id='wp-admin-bar-dashboard'><a class='ab-item' href='https://dividivitravel.com/wp-admin/'>Dashboard</a></li></ul><ul id='wp-admin-bar-appearance' class="ab-submenu"><li id='wp-admin-bar-themes'><a class='ab-item' href='https://dividivitravel.com/wp-admin/themes.php'>Themes</a></li><li id='wp-admin-bar-widgets'><a class='ab-item' href='https://dividivitravel.com/wp-admin/widgets.php'>Widgets</a></li><li id='wp-admin-bar-menus'><a class='ab-item' href='https://dividivitravel.com/wp-admin/nav-menus.php'>Menus</a></li><li id='wp-admin-bar-background' class="hide-if-customize"><a class='ab-item' href='https://dividivitravel.com/wp-admin/themes.php?page=custom-background'>Background</a></li><li id='wp-admin-bar-header' class="hide-if-customize"><a class='ab-item' href='https://dividivitravel.com/wp-admin/themes.php?page=custom-header'>Header</a></li><li id='wp-admin-bar-ot-theme-options'><a class='ab-item' href='https://dividivitravel.com/wp-admin/admin.php?page=st_traveler_option'>Theme Options</a></li></ul></div></li><li id='wp-admin-bar-customize' class="hide-if-no-customize"><a class='ab-item' href='https://dividivitravel.com/wp-admin/customize.php?url=https%3A%2F%2Fdividivitravel.com%2F%3Fpage_id%3D7406'>Customize</a></li><li id='wp-admin-bar-updates'><a class='ab-item' href='https://dividivitravel.com/wp-admin/update-core.php' title='4 Plugin Updates, 3 Theme Updates'><span class="ab-icon"></span><span class="ab-label">7</span><span class="screen-reader-text">4 Plugin Updates, 3 Theme Updates</span></a></li><li id='wp-admin-bar-comments'><a class='ab-item' href='https://dividivitravel.com/wp-admin/edit-comments.php'><span class="ab-icon"></span><span class="ab-label awaiting-mod pending-count count-1" aria-hidden="true">1</span><span class="screen-reader-text comments-in-moderation-text">1 Comment in moderation</span></a></li><li id='wp-admin-bar-new-content' class="menupop"><a class='ab-item' aria-haspopup="true" href='https://dividivitravel.com/wp-admin/post-new.php'><span class="ab-icon"></span><span class="ab-label">New</span></a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-new-content-default' class="ab-submenu"><li id='wp-admin-bar-new-post' class="menupop"><a class='ab-item' aria-haspopup="true" href='https://dividivitravel.com/wp-admin/post-new.php'><span class="wp-admin-bar-arrow" aria-hidden="true"></span>Post</a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-new-post-default' class="ab-submenu"><li id='wp-admin-bar-add-new-post-new.php?post_type=post-vc'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=post&#038;vcv-action=frontend'>Add New with Visual Composer</a></li></ul></div></li><li id='wp-admin-bar-new-media'><a class='ab-item' href='https://dividivitravel.com/wp-admin/media-new.php'>Media</a></li><li id='wp-admin-bar-new-page' class="menupop"><a class='ab-item' aria-haspopup="true" href='https://dividivitravel.com/wp-admin/post-new.php?post_type=page'><span class="wp-admin-bar-arrow" aria-hidden="true"></span>Page</a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-new-page-default' class="ab-submenu"><li id='wp-admin-bar-add-new-post-new.php?post_type=page-vc'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=page&#038;vcv-action=frontend'>Add New with Visual Composer</a></li></ul></div></li><li id='wp-admin-bar-new-product'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=product'>Product</a></li><li id='wp-admin-bar-new-shop_order'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=shop_order'>Order</a></li><li id='wp-admin-bar-new-shop_coupon'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=shop_coupon'>Coupon</a></li><li id='wp-admin-bar-new-st_hotel'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=st_hotel'>Hotel</a></li><li id='wp-admin-bar-new-hotel_room'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=hotel_room'>Room</a></li><li id='wp-admin-bar-new-st_activity'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=st_activity'>Activity</a></li><li id='wp-admin-bar-new-st_tours'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=st_tours'>Tour</a></li><li id='wp-admin-bar-new-st_cars'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=st_cars'>Car</a></li><li id='wp-admin-bar-new-st_rental'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=st_rental'>Rental</a></li><li id='wp-admin-bar-new-custom-css-js'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=custom-css-js'>Custom Code</a></li><li id='wp-admin-bar-new-location'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=location'>Location</a></li><li id='wp-admin-bar-new-st_coupon_code'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post-new.php?post_type=st_coupon_code'>Coupon Code</a></li><li id='wp-admin-bar-new-user'><a class='ab-item' href='https://dividivitravel.com/wp-admin/user-new.php'>User</a></li></ul></div></li><li id='wp-admin-bar-edit'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post.php?post=7406&#038;action=edit'>Edit Page</a></li><li id='wp-admin-bar-Edit with Visual Composer'><a class='ab-item' href='https://dividivitravel.com/wp-admin/post.php?post=7406&#038;action=edit&#038;vcv-action=frontend&#038;vcv-source-id=7406'>Edit with Visual Composer</a></li><li id='wp-admin-bar-vc_inline-admin-bar-link' class="vc_inline-link"><a class='ab-item' href='https://dividivitravel.com/wp-admin/post.php?vc_action=vc_inline&#038;post_id=7406&#038;post_type=page'>Edit with WPBakery Page Builder</a></li></ul><ul id='wp-admin-bar-top-secondary' class="ab-top-secondary ab-top-menu"><li id='wp-admin-bar-search' class="admin-bar-search"><div class="ab-item ab-empty-item" tabindex="-1"><form action="https://dividivitravel.com/" method="get" id="adminbarsearch"><input class="adminbar-input" name="s" id="adminbar-search" type="text" value="" maxlength="150" /><label for="adminbar-search" class="screen-reader-text">Search</label><input type="submit" class="adminbar-button" value="Search"/></form></div></li><li id='wp-admin-bar-my-account' class="menupop with-avatar"><a class='ab-item' aria-haspopup="true" href='https://dividivitravel.com/wp-admin/profile.php'>Howdy, <span class="display-name">diviuser</span><img alt='' src='https://secure.gravatar.com/avatar/26b844af43daae0f79215929b23b8a9a?s=26&#038;d=mm&#038;r=g' srcset='https://secure.gravatar.com/avatar/26b844af43daae0f79215929b23b8a9a?s=52&#038;d=mm&#038;r=g 2x' class='avatar avatar-26 photo' height='26' width='26' loading='lazy'/></a><div class="ab-sub-wrapper"><ul id='wp-admin-bar-user-actions' class="ab-submenu"><li id='wp-admin-bar-user-info'><a class='ab-item' tabindex="-1" href='https://dividivitravel.com/wp-admin/profile.php'><img alt='' src='https://secure.gravatar.com/avatar/26b844af43daae0f79215929b23b8a9a?s=64&#038;d=mm&#038;r=g' srcset='https://secure.gravatar.com/avatar/26b844af43daae0f79215929b23b8a9a?s=128&#038;d=mm&#038;r=g 2x' class='avatar avatar-64 photo' height='64' width='64' loading='lazy'/><span class='display-name'>diviuser</span></a></li><li id='wp-admin-bar-edit-profile'><a class='ab-item' href='https://dividivitravel.com/wp-admin/profile.php'>Edit Profile</a></li><li id='wp-admin-bar-logout'><a class='ab-item' href='https://dividivitravel.com/wp-login.php?action=logout&#038;_wpnonce=d1265497df&#038;redirect_to=https%3A%2F%2Fdividivitravel.com%2F'>Log Out</a></li></ul></div></li></ul>			</div>
						<a class="screen-reader-shortcut" href="https://dividivitravel.com/wp-login.php?action=logout&#038;_wpnonce=d1265497df&#038;redirect_to=https%3A%2F%2Fdividivitravel.com%2F">Log Out</a>
					</div>

<script type="text/javascript" src="./wp-content/themes/traveler/js/compatible-wp/jquery/pagination.js"></script>
<script>

$(document).ready(function()
 {
   $("#tab").pagination({
   items: 8,
   contents: 'contents',
   previous: '«' ,
   next: '»',
   position: 'bottom',
   });
});


$(document).ready(function()
{
    $("input[id=One-way]").click(function () {    
        $(".field-return").hide();
    });

     $("input[id=Round-trip]").click(function () {    
        $(".field-return").show();
         $("#bflight").hide();
    });


  $(".item-content li").on("click", function(){
   $("#clase").html($(this).text()+"&nbsp<i class='fa fa-caret-down'></i>");
  
   //alert($(this).text());
       
  });

 $('#datepicker1').daterangepicker({
          timepicker: false,
          singleDatePicker: true,
          locale: {
             format: 'MM/DD/YYYY'
          }
         });

$('input[name="datepicker2"]').daterangepicker({

    singleDatePicker: true,
    timepicker: false,
    autoUpdateInput: true,
 });

 });

</script>
		</body>
</html>






