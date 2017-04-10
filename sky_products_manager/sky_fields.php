<?php

function sky_add_custom_metabox(){
    add_meta_box(
        'sky_meta',
        'Product Specifications',
        'sky_meta_callback',
        'sky_products',
        'normal',
        'core'
    );
}

add_action('add_meta_boxes', 'sky_add_custom_metabox');

function sky_meta_callback($post){
    wp_nonce_field(basename(__FILE__), 'sky_products_nonce');
    $sky_stored_meta = get_post_meta($post->ID);
?>
<div>
    <div class="meta">
        <div class="meta-th">
            <label for="product-price">Price ($)</label>
        </div>
        <div class="meta-td">
            <input type="number" name="product-price" id="product-price" value="<?php if (!empty($sky_stored_meta['product-price'])) echo esc_attr($sky_stored_meta['product-price'][0]);?>"/>
        </div>
        <div class="meta-th">
            <label for="product-length">Length (mm)</label>
        </div>
        <div class="meta-td">
            <input type="number" name="product-length" id="product-length" value="<?php if (!empty($sky_stored_meta['product-length'])) echo esc_attr($sky_stored_meta['product-length'][0]);?>"/>
        </div>
        <div class="meta-th">
            <label for="product-width">Width (mm)</label>
        </div>
        <div class="meta-td">
            <input type="number" name="product-width" id="product-width" value="<?php if (!empty($sky_stored_meta['product-width'])) echo esc_attr($sky_stored_meta['product-width'][0]);?>"/>
        </div>
        <div class="meta-th">
            <label for="product-height">Height (mm)</label>
        </div>
        <div class="meta-td">
            <input type="number" name="product-height" id="product-height" value="<?php if (!empty($sky_stored_meta['product-height'])) echo esc_attr($sky_stored_meta['product-height'][0]);?>"/>
        </div>
        <div class="meta-th">
            <label for="product-weight">Weight (gm)</label>
        </div>
        <div class="meta-td">
            <input type="number" name="product-weight" id="product-weight" value="<?php if (!empty($sky_stored_meta['product-weight'])) echo esc_attr($sky_stored_meta['product-weight'][0]);?>"/>
        </div>
        <div class="meta-th">
            <label for="product-color">Color</label>
        </div>
        <div class="meta-td">
            <input type="text" name="product-color" id="product-color" value="<?php if (!empty($sky_stored_meta['product-color'])) echo esc_attr($sky_stored_meta['product-color'][0]);?>"/>
        </div>
    </div>
</div>
<?php
}

function sky_meta_save($post_id){
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['sky_products_nonce']) && wp_verify_nonce($_POST['sky_products_nonce'], basename(__FILE__))) ? 'true' : 'false';
    
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    if(isset($_POST['product-price'])){
        update_post_meta($post_id, 'product-price', sanitize_text_field($_POST['product-price']));
    }
    if(isset($_POST['product-length'])){
        update_post_meta($post_id, 'product-length', sanitize_text_field($_POST['product-length']));
    }
    if(isset($_POST['product-width'])){
        update_post_meta($post_id, 'product-width', sanitize_text_field($_POST['product-width']));
    }
    if(isset($_POST['product-height'])){
        update_post_meta($post_id, 'product-height', sanitize_text_field($_POST['product-height']));
    }
    if(isset($_POST['product-weight'])){
        update_post_meta($post_id, 'product-weight', sanitize_text_field($_POST['product-weight']));
    }
    if(isset($_POST['product-color'])){
        update_post_meta($post_id, 'product-color', sanitize_text_field($_POST['product-color']));
    }
}
add_action('save_post', 'sky_meta_save');