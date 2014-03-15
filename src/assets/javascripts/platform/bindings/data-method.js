/**
 * Restfulize any hyperlinks that contain a data-method attribute by
 * creating a mini form with the specified method and adding a trigger
 * within the link.
 *
 * Ex:
 *     <a href="post/1" data-method="delete">destroy</a>
 *     // Will trigger the route Route::delete('post/(:id)')
 *
 */
$(function()
{
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_token' value='"+$('meta[name="csrf-token"]').attr('content')+"'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .removeAttr('href')
    .attr('style','cursor:pointer;')
    .on('click', function() {
    	var self = $(this);

    	bootbox.confirm('Are you sure you wish to remove this record?', function(confirmed) {
			if (confirmed) {
				self.find('form').submit();
			}
        });
    });
});