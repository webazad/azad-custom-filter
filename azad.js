;(function($){
    $(document).ready(function(){
		$(document).on('click','.js-filter-item > a',function(e){
			e.preventDefault();
			
			var category = $(this).data('category');
			
			$.ajax({
				url: AZAD_JOBS.url,
				type: 'POST',
				data: {
					action: 'filter',
					category: category
				},
				success: function(response){
					$('.js_filter').html(response);
					console.log(AZAD_JOBS.success);
					// console.log(sortList.sortable('toArray').toString());
					// animation.hide();
					// if(true === response.success){
						// pageTitle.after('<div id="message" class="updated below"><p>' + AZAD_JOBS.success + '</p></div>');
					// }else{
						// pageTitle.after('<div id="message" class="error below"><p>' + AZAD_JOBS.failure + '</p></div>');
					// }
				},
				error: function(error){
					// $('div#message').remove();
					// animation.hide();
					// pageTitle.after('<div id="message" class="error below"><p>' + AZAD_JOBS.failure + '</p></div>');
				}
			});
		});
        // var sortList = $('ul#custom-type-list');
        // var animation = $('#loading-animation');
        // var pageTitle = $('div h1');
        // sortList.sortable({
            // update: function(event,ui){
                // animation.show();
                // $.ajax({
                    // url: 'ajaxurl',
                    // url: AZAD_JOBS.url,
                    // type: 'POST',
                    // dataType: 'json',
                    // data: {
                        // action: 'save_sort',
                        // order: sortList.sortable('toArray'),
                        // security: AZAD_JOBS.security
                    // },
                    // success: function(response){
                        // $('div#message').remove();
                        console.log('Success');
                        // console.log(sortList.sortable('toArray').toString());
                        // animation.hide();
                        // if(true === response.success){
                            // pageTitle.after('<div id="message" class="updated below"><p>' + AZAD_JOBS.success + '</p></div>');
                        // }else{
                            // pageTitle.after('<div id="message" class="error below"><p>' + AZAD_JOBS.failure + '</p></div>');
                        // }
                    // },
                    // error: function(error){
                        // $('div#message').remove();
                        // animation.hide();
                        // pageTitle.after('<div id="message" class="error below"><p>' + AZAD_JOBS.failure + '</p></div>');
                    // }
                // });
            // }
        // });
    });
})(jQuery);