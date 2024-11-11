jQuery(document).ready(function () {
    new DataTable('#my-books-table');

    // add new book form
    jQuery("#add-new-form").validate({
        submitHandler: function () {
            var postdata = "action=my_book_action&param=savedata&" + jQuery('#add-new-form').serialize();
            jQuery.post(data.ajax_url, postdata, function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html: data.message
                    });
                }
            })
        }
    });

    // add Student form
    jQuery('#add-student-form').validate({
        submitHandler: function () {
            var postdata = "action=my_book_action&param=savestudent&" + jQuery('#add-student-form').serialize();
            jQuery.post(data.ajax_url, postdata, function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html: data.message
                    });
                }
            })
        }
    })

    // add author form
    jQuery('#add-author-form').validate({
        submitHandler: function () {
            var postdata = "action=my_book_action&param=saveauthor&" + jQuery('#add-author-form').serialize();
            jQuery.post(data.ajax_url, postdata, function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html: data.message
                    });
                }
            })
        }
    })

    // edit author form
    jQuery('#edit-author-form').validate({
        submitHandler: function () {
            var postdata = "action=my_book_action&param=editauthor&" + jQuery('#edit-author-form').serialize();
            jQuery.post(data.ajax_url, postdata, function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html: data.message
                    });
                }
            })
        }
    })


    jQuery('#edit-form').validate({
        submitHandler: function () {
            var postdata = "action=my_book_action&param=editdata&" + jQuery('#edit-form').serialize();
            jQuery.post(data.ajax_url, postdata, function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status == 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html: data.message
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1300)
                }
            })

        }
    });

    jQuery(document).on('click', '.deleteBtn', function () {
        var book_id = jQuery(this).attr('data-id');
        var postdata = "action=my_book_action&param=deleteBook&id=" + book_id;
        jQuery.post(data.ajax_url, postdata, function (response) {
            console.log(response);
            var data = jQuery.parseJSON(response);
            if (data.status == 1) {
                jQuery.notifyBar({
                    cssClass: "success",
                    html: data.message
                });
                setTimeout(function () {
                    location.reload();
                }, 1300)
            }
        })
    })

    // login button

    jQuery(document).ready(function (jQuery) {
        jQuery('.enroll-button').on('click', function () {
            // Get the book ID from the button attribute
            var book_id = jQuery(this).attr('data-book-id');

            // Prepare the AJAX data as an object
            var postdata = {
                action: 'my_book_action',
                param: 'addenroll',
                id: book_id
            };

            // Perform the AJAX request
            jQuery.post(data.ajax_url, postdata, function (response) {
                // Parse the response if it's not automatically parsed
                var responseData = typeof response === 'object' ? response : jQuery.parseJSON(response);

                if (responseData.status === 1) {
                    jQuery.notifyBar({
                        cssClass: "success",
                        html: responseData.message
                    });
                }
            });
        });
    });


    // Handle image upload using wp.media library
    jQuery('#btnimage').on('click', function () {
        var images = wp.media({
            title: 'Upload Image',
            multiple: true
        }).open().on("select", function () {

            // Get the selected image from the media library
            var uploadImage = images.state().get('selection').first();
            var selectedImage = uploadImage.toJSON().url;

            // Display the selected image in an HTML element with id="showImage"
            jQuery('#show_image').html("<img src='" + selectedImage + "'/>");
            jQuery('#book_image').val(selectedImage);
        });
    });

});