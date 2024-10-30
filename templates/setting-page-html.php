<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('تغییر لوگو وردپرس - تنظیمات', 'mlchanger_setting_page'); ?></h1>

    <form action="" method="POST" class="lc-form-inline">
        <button name="lc_reset_setting" type="submit" onclick="return lc_check_for_reset_setting()" class="page-title-action">بازگشت به تنظیمات پیشفرض</button>
        <?php wp_nonce_field('mlchanger_reset_setting', 'mlchanger_nonce'); ?>
    </form>
    <div class="metabox-holder has-right-sidebar" id="poststuff">

        <div id="post-body">
            <div id="post-body-content">


                <div class="postbox">
                    <h3>تنظیمات</h3>
                    <div class="inside">
                        <form method="POST" action="">
                            <table class='form-table'>
                                <tr valign="top">
                                    <th scope="row"> آدرس تصویر لوگو :</th>
                                    <td>
                                        <input type="text" class="lc-input text-left" name="mlchanger_img_url" value="<?php echo!empty(get_option('mlchanger_img_url')) ? get_option('mlchanger_img_url') : get_admin_url() . 'images/wordpress-logo.svg'; ?>" />
                                        <input id="upload_image_button" type="button" class="button" value="<?php _e('انتخاب یا آپلود تصویر'); ?>" />
                                        <input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option('media_selector_attachment_id'); ?>'>
                                    </td>

                                    <?php
                                    wp_enqueue_media();
                                    ?>
                                <div class='image-preview-wrapper lc-image-preview-wrapper'>
                                    <img id='image-preview' src='<?php echo wp_get_attachment_url(get_option('media_selector_attachment_id')); ?>' style="width:200px">
                                </div>
                                <?php
                                $my_saved_attachment_post_id = get_option('media_selector_attachment_id', 0);
                                ?>
                                <script type='text/javascript'>
                                    jQuery(document).ready(function ($) {
                                        // Uploading files
                                        var file_frame;
                                        var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                                        var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
                                        jQuery('#upload_image_button').on('click', function (event) {
                                            event.preventDefault();
                                            // If the media frame already exists, reopen it.
                                            if (file_frame) {
                                                // Set the post ID to what we want
                                                file_frame.uploader.uploader.param('post_id', set_to_post_id);
                                                // Open frame
                                                file_frame.open();
                                                return;
                                            } else {
                                                // Set the wp.media post id so the uploader grabs the ID we want when initialised
                                                wp.media.model.settings.post.id = set_to_post_id;
                                            }
                                            // Create the media frame.
                                            file_frame = wp.media.frames.file_frame = wp.media({
                                                title: 'انتخاب لوگو',
                                                button: {
                                                    text: 'استفاده از این تصویر',
                                                },
                                                multiple: false	// Set to true to allow multiple files to be selected
                                            });
                                            // When an image is selected, run a callback.
                                            file_frame.on('select', function () {
                                                // We set multiple to false so only get one image from the uploader
                                                attachment = file_frame.state().get('selection').first().toJSON();
                                                // Do something with attachment.id and/or attachment.url here
                                                $('#image-preview').attr('src', attachment.url).css('width', '200px');
                                                $('input[name="mlchanger_img_url"]').val(attachment.url);
                                                $('#image_attachment_id').val(attachment.id);
                                                $('input[name="mlchanger_img_width"]').val(attachment.width);
                                                $('input[name="mlchanger_img_height"]').val(attachment.height);
                                                // Restore the main post ID
                                                wp.media.model.settings.post.id = wp_media_post_id;
                                            });
                                            // Finally, open the modal
                                            file_frame.open();
                                        });
                                        // Restore the main ID when the add media button is pressed
                                        jQuery('a.add_media').on('click', function () {
                                            wp.media.model.settings.post.id = wp_media_post_id;
                                        });
                                    });

                                    function checkPhotoSize(which_size) {
                                        var image_source = document.getElementsByName('mlchanger_img_url');
                                        var img = new Image();
                                        img.onload = function () {
                                            if (which_size === 'width') {
                                                image_size = document.getElementsByName('mlchanger_img_width')[0].value;
                                                document.getElementsByName('mlchanger_img_height')[0].value = Math.round((this.height * image_size) / this.width);
                                            } else if (which_size === 'height') {
                                                image_size = document.getElementsByName('mlchanger_img_height')[0].value;
                                                document.getElementsByName('mlchanger_img_width')[0].value = Math.round((this.width * image_size) / this.height);

                                            }

//                                            alert(this.width + 'x' + this.height);

                                        };
                                        img.src = image_source[0].value;
                                    }
                                </script>


                                </tr>
                                <tr>
                                    <th scope="row"> طول لوگو :</th>
                                    <td>px <input type="text" class="lc-sm-input text-left" onkeyup="checkPhotoSize('width')" name="mlchanger_img_width" value="<?php echo!empty(get_option('mlchanger_img_width')) ? get_option('mlchanger_img_width') : '84'; ?>" /></td>
                                </tr>
                                <tr>
                                    <th scope="row"> عرض لوگو :</th>
                                    <td>px <input type="text" class="lc-sm-input text-left" onkeyup="checkPhotoSize('height')" name="mlchanger_img_height" value="<?php echo!empty(get_option('mlchanger_img_height')) ? get_option('mlchanger_img_height') : '84'; ?>" /></td>

                                </tr>
                                <tr valign="top">
                                    <th colspan="2">
                                        <hr>
                                    </th>
                                </tr>
                                <tr valign="top">
                                    <th scope="row">لینک لوگو : </th>
                                    <td><input type="text" class="lc-input text-left" name="mlchanger_link_url" value="<?= !empty(get_option('mlchanger_link_url')) ? get_option('mlchanger_link_url') : home_url() ?>"/></td>
                                </tr>
                                <tr valign="top">
                                    <th colspan="2">
                                        <hr>
                                    </th>
                                </tr>
                                <tr valign="top">
                                    <th scope="row">عنوان لوگو(صرفا در سئو کاربرد دارد) : </th>
                                    <td><input type="text" class="lc-input" name="mlchanger_img_title" value="<?= !empty(get_option('mlchanger_img_title')) ? get_option('mlchanger_img_title') : get_bloginfo('name') ?>"/></td>
                                </tr>
                                <tr valign="top">
                                    <th colspan="2">
                                        <hr>
                                    </th>
                                </tr>
                                <tr valign="top">
                                    <th scope="row">متن پیام در صفحه ورود : </th>
                                    <td><input
                                                <?php echo intval(get_option('mlchanger_custom_html_message_bool')) ? 'disabled' : '' ?> type="text" class="lc-input"
                                                id="mlchanger_login_message" name="mlchanger_login_message" 
                                                value="<?= !empty(get_option('mlchanger_login_message')) ? get_option('mlchanger_login_message') : '' ?>"/></td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">می خواهم کد HTML دلخواه خودم را نمایش دهم!</th>
                                    <td><input type="checkbox" name="mlchanger_custom_html_message_bool" id="mlchanger_custom_html_message"
                                     <?php echo intval(get_option('mlchanger_custom_html_message_bool')) ? 'checked' : '' ?> /></td>
                                </tr>

                                <tr valign="top" id="lc_custom_html_message_container" class="<?php echo intval(get_option('mlchanger_custom_html_message_bool')) ? '' : 'lc_display_none' ?>">
                                    <th scope="row">کد دلخواه HTML</th>
                                    <td>
                                        <textarea rows="5" cols="55" class="lc_custom_html_message" name="mlchanger_custom_html_message"><?php echo get_option('mlchanger_custom_html_message') ?></textarea>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th colspan="2">
                                        <hr>
                                    </th>
                                </tr>  
                                <tr valign="top">
                                    <th scope="row"> آیا آیکون وردپرس در navbar حذف گردد؟ (نیازمند ریفرش صفحه)</th>
                                    <td><input type="checkbox" name="mlchanger_navbar_icon" <?php echo intval(get_option('mlchanger_navbar_icon')) ? 'checked' : '' ?> /></td>
                                </tr>
                            </table>
                            <?php
                            wp_nonce_field('mlchanger_save_setting', 'mlchanger_nonce');
                            submit_button('ذخیره تنظیمات');
                            ?>
                        </form>
                    </div>

                </div>	
            </div>
        </div>
        <div class="inner-sidebar" id="side-info-column">
            <div class="postbox">
                <h3>وضعیت فعلی صفحه ورود</h3>
                <div class="inside lc-preview">
                    <a href="<?= !empty(get_option('mlchanger_link_url')) ? get_option('mlchanger_link_url') : home_url() ?>"><img style="width:100%;" src="<?php echo!empty(get_option('mlchanger_img_url')) ? get_option('mlchanger_img_url') : get_admin_url() . 'images/wordpress-logo.svg'; ?>" title="<?= !empty(get_option('mlchanger_img_title')) ? get_option('mlchanger_img_title') : get_bloginfo('name') ?>"></a>
                    <?php echo mlchanger_login_message() ?>
                    <p>
                        <i>اندازه واقعی لوگو به شرح زیر است:</i><br>
                        <i>طول: </i><b><?php echo !empty(get_option('mlchanger_img_width')) ? get_option('mlchanger_img_width') : '84'; ?></b>px<br>
                        <i>عرض: </i><b><?php echo !empty(get_option('mlchanger_img_height')) ? get_option('mlchanger_img_height') : '84'; ?></b>px
                    </p>
                </div>
            </div>
        </div>
    </div>


</div>