<?php

/**
 * @package    WordPress
 * @subpackage Traveler
 * @since      1.0
 *
 * function
 *
 * Created by ShineTheme
 *
 */
if (!defined('ST_TEXTDOMAIN'))
    define('ST_TEXTDOMAIN', 'traveler');
if (!defined('ST_TRAVELER_VERSION')) {
    $theme = wp_get_theme();
    if ($theme->parent()) {
        $theme = $theme->parent();
    }
    define('ST_TRAVELER_VERSION', $theme->get('Version'));
}
define("ST_TRAVELER_DIR", get_template_directory());
define("ST_TRAVELER_URI", get_template_directory_uri());

global $st_check_session;

if (session_status() == PHP_SESSION_NONE) {
    $st_check_session = true;
    session_start([
        'read_and_close' => true,
    ]);
}

$status = load_theme_textdomain('traveler', get_stylesheet_directory() . '/language');

get_template_part('inc/class.traveler');
get_template_part('inc/extensions/st-vina-install-extension');

if (!class_exists("Abraham\TwitterOAuth\TwitterOAuth")) {
    include_once "vendor/autoload.php";
}
add_filter('http_request_args', 'st_check_request_api', 10, 2);

function st_check_request_api($parse, $url) {
    global $st_check_session;
    if ($st_check_session) {
        session_write_close();
    }

    return $parse;
}

add_filter('upload_mimes', 'traveler_upload_types', 1, 1);

function traveler_upload_types($mime_types) {
    $mime_types['svg'] = 'image/svg+xml';

    return $mime_types;
}

add_theme_support(
    'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
        )
);

add_action( 'rest_api_init', function() {

	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );

	add_filter( 'rest_pre_serve_request', initCors);
}, 15 );
//get_template_part('demo/landing_function');
//get_template_part('demo/demo_functions');
//get_template_part('quickview_demo/functions');
//get_template_part('user_demo/functions');


function shortcode_priceline() {

/**$curl = curl_init();
    $api_url = 'https://api-sandbox.rezserver.com/api/';
    $refid = '10068';
    $api_key = 'f8e4553f1837afa17047b7fdb9c6924a';

curl_setopt_array($curl, [
    CURLOPT_URL => $api_url."/shared/getBOF2.Downloads.Hotel.Hotels?format=json2&refid=".$refid."&api_key=".$api_key."&limit=2",
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
   $hotels = 'hotels';
   $array = json_decode($response, true);
  
   //var_dump($array);
  foreach($array as $producto => $detalles)
  {
	//echo "<h1> $producto </h1>";
 
    foreach($detalles as $indice => $valor)
	{
		//echo "<h2> $indice </h2>";

         foreach($valor as $hotel=> $valor2)
	     {
		  //echo "<p> $hotel:$valor2 </p>";
          if($hotel=="hotels"){
             foreach($valor2 as $array2){
               foreach($array2 as $val3=> $val4){
               echo "<p> $val3:$val4 </p>";
               }
             }
          }
            
	     }
	}
   }

}*/


$curl = curl_init();

    $api_url = 'https://api-sandbox.rezserver.com/api/';
    $refid = '10068';
    $api_key = 'f8e4553f1837afa17047b7fdb9c6924a';
    $city_id = '800049480';
    $check_in = $_GET["start"];
    $check_out = $_GET["end"];
    $rooms = $_GET["room"];
    $adults = $_GET["adult"];
    $children = $_GET["child"];

curl_setopt_array($curl, [
    CURLOPT_URL => $api_url."/hotel/getExpress.Results?format=json2&refid=".$refid."&api_key=".$api_key."&city_id=".$city_id."&check_in=".$check_in."&check_out=".$check_out."&rooms=".$rooms."&adults=".$adults."&children=".$children,
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
    $array = json_decode($response, true);
    //var_dump($array);
    foreach($array as $producto => $detalles){
      foreach($detalles as $clave => $valor){
         foreach($valor as $clave2=> $valor2){
              //echo "<p> $clave2:$valor2 </p>";
              if($clave2=="hotel_data"){
                 foreach($valor2 as $clave3){
                    foreach($clave3 as $clave4 => $valor3){
                    //echo "<p> $clave4:$valor3 </p>";
                       foreach($valor3 as $clave5 => $valor4){
                           //echo "<p> $clave5:$valor4 </p>";
                        }
                    }
                 }              
              }
         }
      }
    }
}
?>

<div class="row">
                <form action="" class="form" method="get">
                <div class="col-md-3 border-right">
                    <div class="form-group form-extra-field dropdown clearfix field-detination has-icon">
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
</svg></i>    <div class="dropdown" data-toggle="dropdown" id="dropdown-destination">
    <label>Destination</label>
        <div class="render">
                        <input type="text" touchend="stKeyupsmartSearch(this)" autocomplete="off" onkeyup="stKeyupsmartSearch(this)" id="location_name" name="location_name" value="" placeholder="Where are you going?">
        </div>
        
        <input type="hidden" name="location_id" value="">
    </div>
    <ul class="dropdown-menu" id="dropdown_destination" aria-labelledby="dropdown-destination" tabindex="1" style="overflow: hidden; outline: none;">
                                <li class="item" data-value="1957">
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
</svg></i>                            <span>United States</span></li>
                                            <li class="item" data-value="275">
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
</svg></i>                            <span>New York City, United States||10-14</span></li>
                                            <li class="item" data-value="1944">
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
</svg></i>                            <span>New Jersey, United States||900-961</span></li>
                                            <li class="item" data-value="1945">
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
</svg></i>                            <span>Philadelphia, New Jersey, United States||90001–90068, 90070–90084, 90086–90089, 90091, 90093–90097, 90099</span></li>
                                            <li class="item" data-value="1946">
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
</svg></i>                            <span>Delaware, New Jersey, United States||90001–90068, 90070–90084, 90086–90089, 90091, 90093–90097, 90099</span></li>
                                            <li class="item" data-value="1947">
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
</svg></i>                            <span>San Francisco, United States||899-899</span></li>
                                            <li class="item" data-value="284">
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
</svg></i>                            <span>Wilmington, San Francisco, United States</span></li>
                                            <li class="item" data-value="1952">
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
</svg></i>                            <span>Virginia, United States||220-246</span></li>
                                            <li class="item" data-value="282">
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
</svg></i>                            <span>Virginia Beach, Virginia, United States</span></li>
                                            <li class="item" data-value="7965">
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
</svg></i>                            <span>California, United States||900-961</span></li>
                                            <li class="item" data-value="7967">
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
</svg></i>                            <span>Los Angeles, United States</span></li>
                                            <li class="item" data-value="7970">
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
</svg></i>                            <span>Nevada, United States</span></li>
                        </ul>

</div>
                </div>
                <div class="col-md-3 border-right">
                    <div class="form-group form-date-field form-date-search clearfix  has-icon " data-format="MM/DD/YYYY">
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
</svg></i>    <div class="date-wrapper clearfix">
        <div class="check-in-wrapper">
            <label>Check In - Out</label>
            <div class="render check-in-render">mm/dd/yyyy</div><span> - </span><div class="render check-out-render">mm/dd/yyyy</div>
        </div>
    </div>
    <input type="hidden" class="check-in-input" value="" name="start" id="start">
    <input type="hidden" class="check-out-input" value="" name="end" id="end">
    <input type="text" class="check-in-out" value="18/03/2021 09:59 pm-19/03/2021 09:59 pm" name="date">
</div>                </div>
                <div class="col-md-3 border-right">
                    <div class="form-group form-extra-field dropdown clearfix field-guest  has-icon ">
    <i class="input-icon field-icon fa"><svg width="24px" height="24px" viewBox="0 0 24 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    
    <desc>Created with Sketch.</desc>
    <defs></defs>
    <g id="Hotel-layout" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Search_Result_1_Grid" transform="translate(-735.000000, -331.000000)" stroke="#A0A9B2">
            <g id="form_search_hotel_row" transform="translate(135.000000, 290.000000)">
                <g id="input" transform="translate(30.000000, 0.000000)">
                    <g id="guest" transform="translate(570.000000, 26.000000)">
                        <g id="ico_guest_search_box" transform="translate(0.000000, 15.000000)">
                            <g id="Light">
                                <path d="M0.5,17.5000001 C0.500000058,13.6340068 3.63400679,10.5000001 7.5,10.5000001 C11.3659932,10.5000001 14.4999999,13.6340068 14.5,17.5000001 L0.5,17.5000001 Z" id="Shape"></path>
                                <path d="M13.994,3.558 C15.1539911,4.33669999 16.5198779,4.75172347 17.917,4.75 C18.8777931,4.7508055 19.8286029,4.55513062 20.711,4.175" id="Shape"></path>
                                <path d="M13.26,2 C14.7525087,0.243845556 17.3729329,-0.0022836544 19.1663535,1.44523253 C20.9597741,2.89274871 21.2722437,5.50609244 19.8706501,7.3356268 C18.4690565,9.16516115 15.8644725,9.54377036 14,8.189 C13.8228021,8.05875218 13.655663,7.9153468 13.5,7.76" id="Shape"></path>
                                <path d="M14.5,10.79 C16.6186472,10.1605491 18.9100973,10.5678907 20.6820104,11.8889503 C22.4539234,13.21001 23.4984514,15.2898253 23.5,17.5 L17,17.5" id="Shape"></path>
                                <path d="M3.838,2.592 C5.87773146,4.7056567 9.0128387,5.33602311 11.711,4.175" id="Shape"></path>
                                <circle id="Oval" cx="7.5" cy="4.75" r="4.25"></circle>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></i>    <div class="dropdown" data-toggle="dropdown" id="dropdown-1">
        <label>Guests</label>
        <div class="render">
            <span class="adult" data-text="Adult" data-text-multi="Adults">1 Adult</span>
            -
            <span class="children" data-text="Child" data-text-multi="Children">0 Child</span>
        </div>
    </div>
    <ul class="dropdown-menu" aria-labelledby="dropdown-1">
        <li class="item">
            <label>Rooms</label>
            <div class="select-wrapper">
                <div class="st-number-wrapper">
                    <span class="next"><svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Tour_Detail_1" transform="translate(-1258.000000, -1077.000000)" stroke="#5E6D77" stroke-width="1.5">
            <g id="check-avai" transform="translate(1034.000000, 867.000000)">
                <g id="adults" transform="translate(0.000000, 184.000000)">
                    <g id="ico_add" transform="translate(225.000000, 27.000000)">
                        <path d="M0.5,8 L15.5,8" id="Shape"></path>
                        <path d="M8,0.5 L8,15.5" id="Shape"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></span><input type="text" id="room_num_search" name="room_num_search" value="1" class="form-control st-input-number" autocomplete="off" readonly="" data-min="1" data-max="20"><span class="prev"><svg width="18px" height="2px" viewBox="0 0 18 2" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Tour_Detail_1" transform="translate(-1180.000000, -1085.000000)" stroke="#5E6D77" stroke-width="1.5">
            <g id="check-avai" transform="translate(1034.000000, 867.000000)">
                <g id="adults" transform="translate(0.000000, 184.000000)">
                    <g id="ico_subtract" transform="translate(147.000000, 35.000000)">
                        <path d="M0.5,0.038 L15.5,0.038" id="Shape"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></span>
                </div>
            </div>
        </li>
        <li class="item">
            <label>Adults</label>
            <div class="select-wrapper">
                <div class="st-number-wrapper">
                    <span class="next"><svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Tour_Detail_1" transform="translate(-1258.000000, -1077.000000)" stroke="#5E6D77" stroke-width="1.5">
            <g id="check-avai" transform="translate(1034.000000, 867.000000)">
                <g id="adults" transform="translate(0.000000, 184.000000)">
                    <g id="ico_add" transform="translate(225.000000, 27.000000)">
                        <path d="M0.5,8 L15.5,8" id="Shape"></path>
                        <path d="M8,0.5 L8,15.5" id="Shape"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></span><input type="text" id="adult_number" name="adult_number" value="1" class="form-control st-input-number" autocomplete="off" readonly="" data-min="1" data-max="20"><span class="prev"><svg width="18px" height="2px" viewBox="0 0 18 2" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Tour_Detail_1" transform="translate(-1180.000000, -1085.000000)" stroke="#5E6D77" stroke-width="1.5">
            <g id="check-avai" transform="translate(1034.000000, 867.000000)">
                <g id="adults" transform="translate(0.000000, 184.000000)">
                    <g id="ico_subtract" transform="translate(147.000000, 35.000000)">
                        <path d="M0.5,0.038 L15.5,0.038" id="Shape"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></span>
                </div>
            </div>
        </li>
        <li class="item">
            <label>Children</label>
            <div class="select-wrapper">
                <div class="st-number-wrapper">
                    <span class="next"><svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Tour_Detail_1" transform="translate(-1258.000000, -1077.000000)" stroke="#5E6D77" stroke-width="1.5">
            <g id="check-avai" transform="translate(1034.000000, 867.000000)">
                <g id="adults" transform="translate(0.000000, 184.000000)">
                    <g id="ico_add" transform="translate(225.000000, 27.000000)">
                        <path d="M0.5,8 L15.5,8" id="Shape"></path>
                        <path d="M8,0.5 L8,15.5" id="Shape"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></span><input type="text" id="child_number" name="child_number" value="0" class="form-control st-input-number" autocomplete="off" readonly="" data-min="0" data-max="20"><span class="prev"><svg width="18px" height="2px" viewBox="0 0 18 2" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 49 (51002) - http://www.bohemiancoding.com/sketch -->
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Tour_Detail_1" transform="translate(-1180.000000, -1085.000000)" stroke="#5E6D77" stroke-width="1.5">
            <g id="check-avai" transform="translate(1034.000000, 867.000000)">
                <g id="adults" transform="translate(0.000000, 184.000000)">
                    <g id="ico_subtract" transform="translate(147.000000, 35.000000)">
                        <path d="M0.5,0.038 L15.5,0.038" id="Shape"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg></span>
                </div>
            </div>
        </li>
        <span class="hidden-lg hidden-md hidden-sm btn-close-guest-form">Close</span>
    </ul>
    <i class="fa fa-angle-down arrow"></i>
</div>                </div>
                <div class="col-md-3">
	                <div class="form-button">
    <div class="advance">
        <div class="form-group form-extra-field dropdown clearfix field-advance">
            <div class="dropdown" data-toggle="dropdown" id="dropdown-advance">
                                <label class="hidden-xs">Advance</label>
                <div class="render">
                    <span class="hidden-xs">More <i class="fa fa-caret-down"></i></span>
                    <span class="hidden-lg hidden-md hidden-sm">More option <i class="fa fa-caret-down"></i></span>
                </div>
                            </div>
            <div class="dropdown-menu" aria-labelledby="dropdown-advance">
                <div class="row">
                    <div class="col-lg-12">
                                                <div class="advance-item range-slider">
                            <div class="item-title">
                                <h4>Filter Price</h4>
                            </div>
                            <div class="item-content">
                                <span class="irs js-irs-0"><span class="irs"><span class="irs-line" tabindex="0"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min">0,00€</span><span class="irs-max">350,00€</span><span class="irs-from">0</span><span class="irs-to">0</span><span class="irs-single">0</span></span><span class="irs-grid"></span><span class="irs-bar"></span><span class="irs-shadow shadow-from"></span><span class="irs-shadow shadow-to"></span><span class="irs-slider from"></span><span class="irs-slider to"></span></span><input type="text" class="price_range irs-hidden-input" name="price_range" value="0;350" data-symbol="€" data-min="0" data-max="350" data-step="0" tabindex="-1" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="advance-item facilities st-icheck">
                                                        <div class="item-title">
                                <h4>Hotel Facilities</h4>                            </div>
                            <div class="item-content">
                                <div class="row">
                                    <div class="ovscroll" tabindex="1" style="overflow: hidden; outline: none;">
                                                                                            <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Air Conditioning<input type="checkbox" name="" value="16"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Airport Transport<input type="checkbox" name="" value="17"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Fitness Center<input type="checkbox" name="" value="21"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Flat Tv<input type="checkbox" name="" value="22"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Heater<input type="checkbox" name="" value="24"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Internet – Wifi<input type="checkbox" name="" value="25"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Parking<input type="checkbox" name="" value="27"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Pool<input type="checkbox" name="" value="28"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Restaurant<input type="checkbox" name="" value="31"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Smoking Room<input type="checkbox" name="" value="33"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Spa & Sauna<input type="checkbox" name="" value="34"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                                        <div class="col-lg-4 col-sm-6">
                                                        <div class="st-icheck-item">
                                                            <label>Washer & Dryer<input type="checkbox" name="" value="36"><span class="checkmark fcheckbox"></span>
                                                            </label></div>
                                                    </div>
                                                                                        </div>
                                </div>
                            </div>
                            <input type="hidden" class="data_taxonomy" name="taxonomy[hotel_facilities]" value="">
                        </div>
                    </div>
                </div>
            <div id="ascrail2000" class="nicescroll-rails nicescroll-rails-vr" style="width: 8px; z-index: 1000; cursor: default; position: absolute; top: 0px; left: 92px; height: 103px; display: none;"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 6px; height: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;"></div></div><div id="ascrail2000-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 8px; z-index: 1000; top: 95px; left: 0px; position: absolute; cursor: default; display: none;"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 6px; width: 0px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;"></div></div></div>
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-search" id="api1" "="">Search</button>
</div>
                </div>
                </form>
            </div>


<?php } 
add_shortcode('api-result-price', 'shortcode_priceline');

function ciudadesh(){
    global $wpdb;
    $inputt = $_POST['inputt'];
    $ciudades=$wpdb->get_results("SELECT * from wp_st_location_city where fullname LIKE '%$inputt%'");
    $html= " ";
    foreach ($ciudades as $ciudad) {
        $html=$html."<div><a class='suggest-element' id=".$ciudad->location_id."data=".$ciudad->name.">".$ciudad->fullname."</a></div>";

    }
    echo json_encode($ciudades);
    die();  
console.log($ciudades);  
}
add_action('wp_ajax_ciudades', 'ciudadesh');
add_action('wp_ajax_noprivciudades', 'ciudades');  

function aeropuertosf(){
    global $wpdb;
    $inputf = $_POST['inputf'];
    $airp = $wpdb->get_results("SELECT * from wp_st_airports where airport LIKE '%$inputf%' or city_name LIKE '%$inputf%'");
    $html= " ";
    echo json_encode($airp);
    die();  
console.log($airp);  
}
add_action('wp_ajax_aeropuertos', 'aeropuertosf');
add_action('wp_ajax_noprivaeropuertos', 'aeropuertos');  


?>


