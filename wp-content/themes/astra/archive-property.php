<!-- Listing all properties and include filter form for search -->

<?php
get_header();
?>


<div class="property-page-header">

    <h1>Properties</h1>
    
    <!-- Filter Form -->
    <!-- Allowiung users to filter properties by location and max price -->
    <form method='get' action="" class="property-search-form">
        <input type="text" name="location" placeholder="Enter Location" value="<?php echo get_query_var('location'); ?>">
        <input type="number" name="max_price" placeholder="Max Price" value="<?php echo get_query_var('max_price') ?>">
        <button type="submit">Search</button>
    </form>
    
</div>


<?php
    // filter values
    $location = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : '';
    $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : '';

    // Custom Query Arguments
    $args = array(
        'post_type' => 'property',
        'posts_per_page' => -1, // Fetch all properties by default
        'meta_query' => array('relation' => 'AND'), // Default empty meta_query
    );

    // Apply location filter if provided
    if (!empty($location)) {
        $args['meta_query'][] = array(
            'key' => 'location',
            'value' => $location,
            'compare' => 'LIKE'
        );
    }

    // Apply max price filter if provided
    if (!empty($max_price)) {
        $args['meta_query'][] = array(
            'key' => 'price',
            'value' => $max_price,
            'type' => 'NUMERIC',
            'compare' => '<='
        );
    }
    
    // Run the query
    $property_query = new WP_Query($args);
    
    // Debugging: Check the number of posts
    echo '<p>Found ' . $property_query->found_posts . ' properties</p>';

    if ($property_query->have_posts()) :
        echo '<div class="containern">';
            while ($property_query->have_posts()) : $property_query->the_post();
            ?>
                <div class="property-card">
                    <h2><?php the_title(); ?></h2>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="property-image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <?php endif; ?>
                        <div class="property-details">
                            <div class="property-price">$<?php the_field('price'); ?></div>
                            <div class="property-location"><?php the_field('location'); ?></div>
                            <div class="property-size">Size: <?php the_field('size'); ?> sq ft</div>
                            <a href="<?php the_permalink(); ?>" class="property-link">View Details</a>
                        </div>
                        </div>
                        <?php
            endwhile;
            echo '</div>';
        else:
            echo '<p>No properties found matching your criteria.</p>';
        endif;


        wp_reset_postdata();
?>
<?php
get_footer();
?>
