<?php
/**
*------------------------------------
* :: @package azad-guineapig
* :: @version 1.0.0
*------------------------------------
*/
get_header(); ?>

    <!-- MAIN SECTION BEGINS -->
    <section class="azad-section azad-home">
        <div class="azad-container">
            <div class="blog-container">

                <?php 
                    // if ( have_posts() ) : 
                        // get_template_part( 'template-parts/loop', get_post_format() );					
                    // else:
                        // get_template_part( 'template-parts/loop', 'none' );
                    // endif;
					
		?>			
<div class="js_filter">
<?php
$args = array(
	'post_type' => 'post',
	'post_per_page' => -1
);
$custom_query = new WP_Query( $args );
if($custom_query->have_posts()):
	while($custom_query->have_posts()): $custom_query->the_post();
		the_title('<h2>','</h2>');
	endwhile;
	wp_reset_postdata();
endif;
?>
</div>

<div class="categories">
	<ul>
		<li class="js-filter-item"><a href="<?php home_url(''); ?>">All</a></li>
		<?php
			$cat_args = array(
				// 'exclude' => array(1),
				// 'option_all' => 'all'
			);
			$categories = get_categories( $cat_args );
			foreach( $categories as $cat ){
				echo '<li class="js-filter-item"><a href="' . get_category_link($cat->term_id) . '" data-category="' . $cat->term_id . '">' . $cat->name . '</a></li>';
			}
		?>
	</ul>
</div>
			
			

            </div>
        </div>
    </section><!-- ends main section -->

<?php get_footer();