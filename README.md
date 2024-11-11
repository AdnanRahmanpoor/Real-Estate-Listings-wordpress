# Real Estate Property Listing Website using WordPress

This project is a **Real Estate Property Listing Website** built using **WordPress**. It showcases properties with dynamic filtering and custom styling. The website includes a **hero section** on the main page and displays properties in **custom cards** with key details like location, price, and a link to the individual property page in listing page.

## Features

- **Property Listings**: Display of properties in a card layout with details such as title, location, price, and a link to view more.
- **Filtering**: A form that allows users to filter properties by location and price. The filtering dynamically updates the displayed properties.
- **Responsive Design**: The website is mobile-friendly with a grid layout that adjusts based on the screen size, displaying a maximum of 3 properties per row.
- **WordPress Customization**: The site is built on the **Astra theme**, with custom modifications to support the real estate listing and filtering functionality.

## Screenshots
!['main-page.png'](main-page.png)
!['listings.png'](listings.png)

## What I Did

1. **WordPress Theme Customization**: I customized the Astra theme, adjusting its layout, structure, and functionality to suit the real estate property listing website requirements.
   
2. **Property Card Layout**: I created a custom layout for each property, ensuring it displays essential details such as title, location, price, and a link to more information.

3. **Property Filtering**: A dynamic filtering form was added to let users filter properties based on location and price. The filtering leverages **meta_query** in WordPress to search the custom fields associated with properties.

4. **Responsive Grid Layout**: The property cards are displayed in a grid format with a maximum of 3 cards per row, which adapts to different screen sizes, providing a user-friendly interface across devices.

5. **Custom CSS**: I wrote custom CSS to control the layout, spacing, and responsiveness of the site, including specific styles for the property cards and filter form.

## What I Learned

- **WordPress Theme Customization**: I deepened my understanding of WordPress theme customization by modifying the Astra theme using PHP and CSS.
  
- **WordPress Querying**: I learned how to utilize **WP_Query** and **meta_query** to filter posts dynamically based on custom fields, such as price and location.

- **Responsive Design Principles**: I learned how to implement a responsive design using CSS Grid, ensuring the layout adjusts appropriately on different devices.

- **PHP and WordPress Development**: I gained experience in working with WordPress’s backend, including handling custom fields and integrating dynamic content.

## How to Run the Project Locally

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/AdnanRahmanpoor/real-estate-listing.git
   ```

2. Set up a local WordPress installation (e.g., using **XAMPP**, **Local by Flywheel**, or **MAMP**).

3. Upload the theme files into the `wp-content/themes/` directory of your local WordPress installation.

4. In the WordPress dashboard, activate the newly uploaded theme.

5. Configure the custom fields for properties (e.g., **Location** and **Price**) using the **Advanced Custom Fields (ACF)** plugin or by adding custom fields directly in the WordPress editor.

6. View the site locally by navigating to your WordPress instance and inspecting the property listings and filtering functionality.

To highlight the custom code and files you've modified for your WordPress project, you can add a section to your `README.md` that specifically mentions these customizations. Here’s an updated section to include in your `README.md` to showcase your work:

### What I Customized

Below are the files and sections where I made custom modifications:

#### 1. **Theme Customizations**

   - **`style.css`**: Customized the styles for the homepage and property listing page. Added custom CSS for the layout of the **hero section** and **property cards**.
     - **Custom Styles**: Modified the layout to display properties in a **grid format** with a maximum of 3 cards per row.
     - **Hero Section**: Customized the hero section to be the full-width banner on the homepage.

   - **`functions.php`**: Added custom functionality for displaying properties using custom fields.
     - **Custom Meta Fields**: Included the properties' custom fields for **location** and **price** using `get_post_meta()`.

#### 2. **Custom Property Listing and Filtering**

   - **`page-properties.php`** (or another page template depending on the theme setup):
     - Created a **property listing page** that displays all properties.
     - Added **filtering functionality** by allowing users to filter properties based on **location** and **price**.
     - Used `WP_Query` with **meta_query** to fetch properties based on the selected filter criteria.
     
     **Code Example**:
     ```php
     <?php
         // Custom Query for properties
         $args = array(
             'post_type' => 'property',
             'posts_per_page' => -1, // Fetch all properties
             'meta_query' => array(
                 'relation' => 'AND',
                 array(
                     'key' => 'location',
                     'value' => $location,
                     'compare' => 'LIKE'
                 ),
                 array(
                     'key' => 'price',
                     'value' => $max_price,
                     'type' => 'NUMERIC',
                     'compare' => '<='
                 ),
             ),
         );
         $property_query = new WP_Query($args);

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
     ```

#### 3. **Custom Post Type: Property**

   - Created a **Custom Post Type (CPT)** for `property`:
     - The **properties** are created as a custom post type so that each listing has its own dedicated entry.
     - Used custom fields to store **location** and **price** information.
     
     **Code Example**:
     ```php
     function register_property_post_type() {
         $args = array(
             'public' => true,
             'label'  => 'Properties',
             'supports' => array( 'title', 'editor', 'custom-fields' ),
             'has_archive' => true,
         );
         register_post_type( 'property', $args );
     }
     add_action( 'init', 'register_property_post_type' );
     ```

#### 4. **Custom Property Card Layout**

   - **HTML & CSS** for property cards:
     - Modified the display of properties using custom cards that show the **property title**, **location**, **price**, and a **link to view details**.
     - **CSS Grid** was used to create a responsive card layout with a maximum of **3 cards per row**.
     
     **Code Example**:
     ```css
     .property-card {
         border: 1px solid #ddd;
         padding: 15px;
         margin: 10px;
         text-align: center;
         background-color: #f9f9f9;
     }
     
     .property-card h2 {
         font-size: 1.5em;
         margin-bottom: 10px;
     }
     
     .property-listing {
         display: grid;
         grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
         gap: 20px;
     }
     ```

#### 5. **Hero Section Customization**

   - **`front-page.php`**: Customized the homepage to display a **hero section** at the top with the main title and introduction to the real estate listings.
     
     **Code Example**:
     ```php
     <div class="hero-section">
         <h1>Welcome to Our Real Estate Listings</h1>
         <p>Browse through a variety of properties available for sale.</p>
     </div>
     ```

#### 6. **WordPress Plugins Used**

   - **Secure Custom Fields (SCF)**: Used to create and manage custom fields for properties (e.g., location, price).
