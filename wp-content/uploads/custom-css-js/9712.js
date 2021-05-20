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
        var price_range =$("#price_range").val();
       
      	 window.location.href = 'https://dividivitravel.com/?page_id=9708&location_name='+location_name+'&start='+start+'&end='+end+'&child='+child_number+'&adult='+adult_number+'&room='+room_num_search+'&price_range='+price_range;
      
	});
  
    $("#bflight").click(function(){
        var origin = $("#airport_id").val();
        var destinattion = $("#airport_iddest").val();
        var cclass = $("#clase").text();
        var departm = $("#departm").val();
        var adults = $("#num_adults").val();
        var childs = $("#num_child").val();
        if($('input:radio[name=radios]:checked').val() == "option1"){
          var returnn = $("#returnn").val();
          window.location.href = 'https://dividivitravel.com/?page_id=9771&origin='+origin+'&destinattion='+destinattion+'&cclass='+cclass+'&departm='+departm+'&returnn='+returnn+'&adults='+adults+'&childs='+childs;
         }else{
           window.location.href = 'https://dividivitravel.com/?page_id=9771&origin='+origin+'&destinattion='+destinattion+'&cclass='+cclass+'&departm='+departm+'&adults='+adults+'&childs='+childs;
         }
      
      
   });

});
</script>
<!-- end Simple Custom CSS and JS -->
