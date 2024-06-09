<?php

global $wpdb;


$sql = "SELECT * FROM `wp_term_taxonomy` tt INNER JOIN `wp_terms` t on t.term_id = tt.term_id WHERE tt.`taxonomy` IN ('epkb_post_type_1_category','epkb_post_type_1_tag');";

$res =   $wpdb->get_results($sql);

?>
<div>
    <?php require_once __DIR__ . '/../layouts/searcher.php'; ?>
    <div class="bdsa-content">
        <div class="bdsa-navbar">
            <div class="bdsa-navbar-content">
                <h3>Categorías</h3>
                <ul>
                    <?php
                    foreach ($res as $key => $value) {
                        if ($value->taxonomy == 'epkb_post_type_1_category') {
                            echo "<li> <input type=\"checkbox\" class=\"categories\" name=\"categories[]\" value=\"" . $value->term_id . "\" onchange=\"getResults()\" />" . $value->name . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="bdsa-navbar-content">
                <h3>Etiquetas</h3>
                <ul>
                    <?php
                    foreach ($res as $key => $value) {
                        if ($value->taxonomy == 'epkb_post_type_1_tag') {
                            echo "<li> <input type=\"checkbox\" class=\"tags\" name=\"tags[]\" value=\"" . $value->term_id . "\" onchange=\"getResults()\" /> " . $value->name . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div id="bdsa-preview-response" class="bdsa-preview"> 
            <?php require_once __DIR__ . '/../shortcode-parts/search-advance-result.php'; ?>
        </div>
    </div>
</div>