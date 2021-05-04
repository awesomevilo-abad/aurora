jQuery(document).ready(function($){
	
	//open popup
	$('.cd-popup-trigger').on('click', function(event){
		var id = this.id;
		event.preventDefault();
		$('#cd'+id).show();
	});
	
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
			var id = this.id;
			event.preventDefault();
			$('#'+id).hide();
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });
});