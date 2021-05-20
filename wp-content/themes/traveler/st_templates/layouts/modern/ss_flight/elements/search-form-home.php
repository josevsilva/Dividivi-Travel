<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Content search flight
 *
 * Created by ShineTheme
 *
 */

wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );
wp_enqueue_script('affilate-api.js');

$fields = array(
    array(
        'title' => esc_html__('Origin', 'traveler'),
        'name' => 'origin',
        'placeholder' => esc_html__('Origin', 'traveler'),
        'layout_col' => '6',
        'layout2_col' => '6',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Destination', 'traveler'),
        'name' => 'destination',
        'placeholder' => esc_html__('Destination', 'traveler'),
        'layout_col' => '6',
        'layout2_col' => '6',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Depart', 'traveler'),
        'name' => 'depart',
        'placeholder' => esc_html__('Depart date', 'traveler'),
        'layout_col' => '4',
        'layout2_col' => '4',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Return', 'traveler'),
        'name' => 'return',
        'placeholder' => esc_html__('Return date', 'traveler'),
        'layout_col' => '4',
        'layout2_col' => '4',
        'is_required' => 'off'
    )
);

$st_direction = !empty($st_direction) ? $st_direction : "horizontal";

if (!isset($field_size)) $field_size = '';
$class = '';
$id = 'id="sticky-nav"';
if(isset($in_tab)) {
    $class = 'in_tab';
    $id = '';
}
?> 
<?php $link = st()->get_option('custom_flight_search_link', ''); ?>
<style>
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

</style>
<div class="search-form hotel-search-form-home hotel-search-form <?php echo esc_attr($class); ?>" <?php echo ($id); ?>>
    <form role="search" method="get" class="search main-search ss-search-flights-link" autocomplete="off" action="" target="_blank">
        <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="row">
               <div class="col-lg-4 col-md-4" style="margin-top: 2%; padding-left: 10%;">
               <input class="form-check-input" type="radio" name="radios" id="Round-trip" value="option1" checked>
               <label class="form-check-label" for="exampleRadios1">
                Round-trip
               </label>
              </div> 
                <div class="col-lg-3 col-md-3" style="margin-top: 2%; padding-left: 6%; border-right: 1px solid #dfdfdf;">
               <input class="form-check-input" type="radio" name="radios" id="One-way" value="option2">
               <label class="form-check-label" for="exampleRadios2">
               One-way
               </label>
               </div> 
               <div class="col-lg-5 col-md-5" style="margin-top: 2%; border-right: 1px solid #dfdfdf;">
               <div class="row">
               <div class="col-lg-6 col-md-6">
                <div class="row">
                  <div class="col-lg-6 col-md-6"><label class="form-check-label">Adults</label></div> 
                  <div class="col-lg-6 col-md-6">
                <input type="text" id="num_adults" name="num_adults" value="1" class="form-control st-input-number" autocomplete="off" data-min="1" 
data-max="20" style="height: 25px !important; padding: 6px 10px !important;"></div> 
                </div>
                </div> 
             
                <div class="col-lg-6 col-md-6">
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
                        <?php echo TravelHelper::getNewIcon('ico_maps_search_box'); ?>
                        <?php echo st()->load_template('layouts/modern/ss_flight/search/field-origin'); ?>
                    </div>
                   <div class="item" id="destinationf"></div>
                    <div class="col-lg-4 col-md-4 field-destination" style="border-right: 0px;">
                        <?php echo st()->load_template('layouts/modern/ss_flight/search/field-destination'); ?>
                    </div>
                    <div class="item" id="destinationff"></div>
                    <div class="col-lg-3 col-md-3" style="border-right: 1px solid #dfdfdf;">
                    <div class="advance">
                     <div class="form-group form-extra-field dropdown clearfix field-advance" style="margin-left: -23px">
                         <div class="dropdown" data-toggle="dropdown" id="dropdown-advance">
                                <label class="hidden-xs">Cabin class</label>
                                <div class="render" style="margin-top: 7%;">
                                <span id="clase" class="hidden-xs" style="font-size: 15px !important;">Economy <i class="fa fa-caret-down"></i></span>
                               <span class="hidden-lg hidden-md hidden-sm">More option <i class="fa fa-caret-down"></i></span>
                    
                         </div>
                         </div>
                      <ul class="dropdown-menu" aria-labelledby="dropdown-advance" style="padding: 15px 15px !important; margin-left: -4px;">
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
                        <?php echo TravelHelper::getNewIcon('ico_calendar_search_box'); ?>
                        <?php echo st()->load_template('layouts/modern/ss_flight/search/field-depart'); ?>
                    </div>
                    <div class="col-lg-6 col-md-6 field-return">
                        <?php echo st()->load_template('layouts/modern/ss_flight/search/field-return'); ?>
                    </div>
                </div>
            </div>
            <?php

            $country = st()->get_option('ss_market_country', 'US');
            $currency = st()->get_option('ss_currency', 'USD');
            $locale = st()->get_option('ss_locale', 'en-US');
            $api_key = st()->get_option('ss_api_key','prtl674938798674');
            $api_key = substr($api_key,0,16);
            ?>
            <input type="hidden" class="skyscanner-search-flights-data" data-api="<?php echo esc_attr($api_key)?>" data-locale="<?php echo esc_attr($locale)?>" data-currency="<?php echo esc_attr($currency)?>" data-country="<?php echo esc_attr($country); ?>">
            <input type="hidden" name="apiKey" value="<?php echo esc_attr($api_key); ?>">
            <div class="col-lg-2 col-md-2 ss-button-submit">
                <div class="form-button">
                    <button class="btn btn-primary btn-search" id="bflight" type="submit" style="min-height: 60px; margin-top: 26%; width: 90%; margin-right: 8%;"><?php echo esc_html__('SEARCH', 'traveler'); ?></button>
                </div>
            </div>
        </div>
       <!-- <span class="api_info"><i class="fa fa-info-circle"></i> <?php /*echo esc_html__('Search flights API of ', 'traveler')*/?><a href="https://skyscanner.net" target="_blank"><?php /*echo __('Skyscanner ', 'traveler')*/?></a></span>-->
    </form>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $("input[id=One-way]").click(function () {    
        $(".field-return").hide();
    });

     $("input[id=Round-trip]").click(function () {    
        $(".field-return").show();
    });


  $(".item-content li").on("click", function(){
   $("#clase").html($(this).text()+"&nbsp<i class='fa fa-caret-down'></i>");
  
   //alert($(this).text());
       
  });



});
</script>



