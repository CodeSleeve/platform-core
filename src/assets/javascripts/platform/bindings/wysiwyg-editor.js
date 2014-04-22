$(function()
{
	/**
	 * Handle uploading a single photo
	 *
	 */
	function uploadPhoto(photo)
	{
		var data = new FormData();

		data.append("photo", photo);

		return $.ajax(
		{
			data: data,
			type: "POST",
			url: "photo",
			cache: false,
			contentType: false,
			processData: false
		});
	}

	/**
	 * Handle image uploads via the wysiwyg
	 *
	 */
	function onImageUpload(photos, editor, welEditable)
	{
		$.each(photos, function(index, photo)
		{
			uploadPhoto(photo).done(function(response) {

				editor.insertImage(welEditable, response.url);

			}).fail(function(response, xhr, code)
			{
				console.warn('failure', response, xhr, code);
				alert('Failed to upload image.');
			});

		});
	}

	/**
	 * bootstrap the wysiwyg on the page
	 *
	 */
    $('.wysiwyg-editor').each(function(index, item)
    {
		var element = $(item);

		element.summernote({
			height: 300,
			tabsize: 2,
			codemirror: {
				theme: 'monokai'
			},

			onImageUpload: onImageUpload
		});

		// when the form is submitted make sure to populate
		// the nearest hidden content area for our FORM
		$('.platform-form-submit-btn').on('click', function(e)
		{
			$('#platform-wysiwyg-form').submit();
		});

	    element.closest('#platform-wysiwyg-form').on('submit', function (e)
	    {
	    	var input = element.prev('[data-wysiwyg-hidden="content"]');
	        input.val(element.code());
    	});
    });
});