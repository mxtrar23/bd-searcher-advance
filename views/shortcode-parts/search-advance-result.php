<?php
    global $wpdb;
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
   $upload_dir   = wp_upload_dir();
   // echo '<img srcset=".'.esc_attr( wp_get_attachment_image_srcset(2986, array( 400, 200 )) ).'"/><br>';
    $sql = "SELECT 
        p.Id,
        p.post_title,
        p.post_date,
        p.post_excerpt,
        p.post_name,
        p.post_modified,
        p.guid,
        (SELECT u.user_nicename FROM `wp_users` u WHERE u.ID = p.post_author ) as `name_author`,
        (SELECT `meta_value` FROM `wp_postmeta` WHERE `post_id` = (SELECT `meta_value` FROM `wp_postmeta` WHERE `post_id` = p.ID and `meta_key` = '_thumbnail_id') and meta_key = '_wp_attached_file') as attached_file,
        (SELECT GROUP_CONCAT(name) as name FROM `wp_terms` WHERE `term_id` in (SELECT term_id FROM `wp_term_taxonomy` WHERE `term_id` IN (SELECT term_taxonomy_id FROM `wp_term_relationships` WHERE `object_id` = p.ID) and taxonomy in ('epkb_post_type_1_category'))) as category,
        (SELECT GROUP_CONCAT(name) as name FROM `wp_terms` WHERE `term_id` in (SELECT term_id FROM `wp_term_taxonomy` WHERE `term_id` IN (SELECT term_taxonomy_id FROM `wp_term_relationships` WHERE `object_id` = p.ID) and taxonomy in ('epkb_post_type_1_tag'))) as tags
    FROM `wp_posts` p WHERE p.`post_type` = 'epkb_post_type_1' and p.`post_status` = 'publish' order by p.`ID` desc limit 5;";

    $result = $wpdb->get_results($sql);

    foreach ($result as $key => $value) {
        echo "
        <div class=\"bdsa-post\">
            <h2> Title: ".$value->post_title."</h2>";
            if (!is_null($value->attached_file)) {
                echo "<img src=\"".$upload_dir['baseurl'].'/'.$value->attached_file."\" style=\"max-width: 120px;\" />";
            }

            echo "
            <div class=\"bdsa-post-detail\">
                <p> Date: ".$value->post_date."</p>
                <p> Excerpt: ".$value->post_excerpt."</p>
                <p> Name: ".$value->post_name."</p>
                <p> Modified: ".$value->post_modified."</p>
                <p> Guid: ".$value->guid."</p>
                <p> Author: ".$value->name_author."</p>
                <p> Attached file: ".$value->attached_file."</p>
                <p> name author: ".$value->name_author."</p>
                <p> category: ".$value->category."</p>
                <p> tags: ".$value->tags."</p>
            </div>

        </div>
        ";
    }

?>