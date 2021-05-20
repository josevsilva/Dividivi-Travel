<?php
    $enable_tree = st()->get_option( 'bc_show_location_tree', 'off' );
    $location_id = STInput::get( 'location_id', '' );
    $location_name = STInput::get( 'location_name', '' );
    if(empty($location_name)){
        if(!empty($location_id)){
            $location_name = get_the_title($location_id);
        }
    }
   
?>
<style>

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

</style>
<div class="form-group form-extra-field dropdown clearfix field-detination <?php if ( $has_icon ) echo 'has-icon' ?>">
    <?php
        if ( $has_icon ) {
            echo TravelHelper::getNewIcon('ico_maps_search_box');
        }
    ?>
 <div class="dropdown" data-toggle="dropdown" id="dropdown-destination">
    <label><?php echo __( 'Destination', 'traveler' ); ?></label>
        <div class="render">
            <?php
                if(empty($location_name)) {
                    $placeholder = __('Where are you going?', 'traveler');
                }else{
                    $placeholder = esc_html($location_name);
                }
            ?>
            <input type="text" touchend="stKeyupsmartSearch(this)" autocomplete = "off" onkeyup="stKeyupsmartSearch(this.value)" id="location_name" name="location_name" placeholder = "<?php echo esc_attr($placeholder);?>" />
        </div>
        
        <input type="hidden" id="location_id" name="location_id"/>
    </div>

</div>
<div class="item" id="destinationn"></div>


