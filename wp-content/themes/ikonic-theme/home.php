<?php
/**
 * Template Name: Home
 *
 * This template is used for the static front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ikonic_Theme
 */

get_header();

?>

<main id="primary" class="site-main">

    <header class="page-header">
        <h1 class="page-title"><?php single_post_title(); ?></h1>
    </header>

    

    <?php
    $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

    $args = array(
        'post_type'      => 'projects',
        'posts_per_page' => 6,
        'paged'          => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) : 
    
    ?>
      <div class="project-archive">
    <?php

        while ($query->have_posts()) :
            $query->the_post();

            get_template_part('template-parts/content', 'projects');

        endwhile;
    ?>
    </div>
    <?php

        // Display pagination
        echo '<div class="pagination">';
        echo paginate_links(array(
            'total'    => $query->max_num_pages,
            'current'  => max(1, get_query_var('page')),
        ));
        echo '</div>';

        wp_reset_postdata();

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
get_footer();
?>
