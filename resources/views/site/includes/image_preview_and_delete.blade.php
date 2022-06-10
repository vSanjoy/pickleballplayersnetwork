<script type="text/javascript">
$(".upload-image").change(function () {
	var imagePreviewId = $(this).attr('id');
    imagePreview(this, imagePreviewId);
});
function imagePreview(input, imagePreviewId) {
    if (input.files && input.files[0]) {
		if (input.files[0].size > {{config('global.MAX_UPLOAD_IMAGE_SIZE')}}) {
			toastr.error("@lang('custom_admin.error_max_size_image')", "@lang('custom_admin.message_error')!");
		} else {
			var fileName = input.files[0].name;
			var extension = fileName.substring(fileName.lastIndexOf('.') + 1);		
			if (extension == 'jpeg' || extension == 'JPEG' || extension == 'jpg' || extension == 'JPG' || extension == 'gif' || extension == 'png' || extension == 'bmp') {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#image_holder_'+imagePreviewId).html('<img id="image_preview" class="mt-2" style="display: none;" />');
					$('#'+imagePreviewId+'_preview + div').remove();

					$('#'+imagePreviewId+'_preview').after('<div class="image-preview-holder" id="image_holder_'+imagePreviewId+'"><img src="'+e.target.result+'" class="image-preview-border" width="100" height="90"/><span class="delete-preview-image" data-cid="'+imagePreviewId+'"><i class="fa fa-trash"></i></span></div>');
				};
				reader.readAsDataURL(input.files[0]);
			} else {
				$('#'+imagePreviewId).val('');
				$('#'+imagePreviewId+'_preview + img').remove();
				toastr.error("@lang('custom_admin.error_image')", "@lang('custom_admin.message_error')!");
			}
		}
    } else {
		toastr.error("@lang('custom_admin.error_image')", "@lang('custom_admin.message_error')!");
	}
}
$(document).on('click', '.delete-preview-image', function() {
	var imageInputId = $(this).data('cid');
	$('#'+imageInputId).val('');
	$('#'+imageInputId+'_preview + div').remove();
	$('#image_holder_'+imageInputId).html('');
});

// Delete uploaded image
$(document).on('click', '.delete-uploaded-preview-image', function() {
	var websiteLink = $('#website_link').val();
	Swal.fire({
            text: 'Are you sure to delete the photo?',
            type: 'warning',
            allowOutsideClick: false,
            confirmButtonColor: '#c8fe0a',
			confirmButtonTextColor: "#000000",
            cancelButtonColor: '#000000',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
			// html: true,
  			className: 'swal-back',
        }).then((result) => {
            if (result.value) {
                $('.preloader').show();
				var deleteProfileImageUrl = websiteLink + '/users/ajax-delete-profile-image';
				$.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: deleteProfileImageUrl,
                    method: 'POST',
                    data: {
						dbField: $(this).data('dbfield')
					},
                    success: function (response) {
                        $('.preloader').hide();
                        if (response.type == 'success') {
							$('#image_holder_profile_pic').remove();
                            toastr.success(response.message, response.title+'!');
                        } else if (response.type == 'warning') {
                            toastr.warning(response.message, response.title+'!');
                        } else {
                            toastr.error(response.message, response.title+'!');
                        }
                    }
                });
			}
		});
});
</script>