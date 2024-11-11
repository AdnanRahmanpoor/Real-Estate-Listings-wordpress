<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();

?>

<div class="property-listing">
    <h1><?php the_title(); ?></h1>
    <!-- getting the custom fields value for CustomFields Plugin -->
    <div class="property-price">Price: $<?php the_field('price'); ?></div>
    <div class="property-location">Location: $<?php the_field('location'); ?></div>
    <div class="property-size">Size: $<?php the_field('size'); ?></div>
    <div class="property-description">$<?php the_content(); ?></div>
</div>

<?php
    endwhile;
endif;

get_footer();

?>