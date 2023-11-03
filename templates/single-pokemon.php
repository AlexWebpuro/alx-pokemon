<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="wrapper" id="single-wrapper">
	<div class="" id="content" tabindex="-1">
		<div class="row">
            <main class="site-main" id="main">
                <div class="pokedex">
                    <?php
                    while ( have_posts() ):
                        the_post();
                        $post_id = get_the_ID();
                        
                        $weight = get_post_meta( $post_id, '_pokemon_weight', true )
                                    ? get_post_meta( $post_id, '_pokemon_weight', true )
                                    :  __('No data found!', 'alex_monroy' );

                        $types = get_post_meta( $post_id, '_pokemon_type', true )
                        ? get_post_meta( $post_id, '_pokemon_type', true )
                        :  __('No data found!', 'alex_monroy' );

                        $pokedex_old_index = get_post_meta( $post_id, '_pokemon_pokedex_orlder_number', true )
                        ? get_post_meta( $post_id, '_pokemon_pokedex_orlder_number', true )
                        :  __('No data found!', 'alex_monroy' );

                        $pokedex_new_index = get_post_meta( $post_id, '_pokemon_pokedex_recent_number', true )
                        ? get_post_meta( $post_id, '_pokemon_pokedex_recent_number', true )
                        :  __('No data found!', 'alex_monroy' );

                        // echo the_post_thumbnail();
                        
                        ?>
                        <main class="container">
                        <div class="row p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
                            <div class="col col-lg-6 px-0">
                                <?php the_post_thumbnail() ?>
                            </div>
                            <div class="col col-lg-6 px-0 d-flex flex-column justify-content-center">
                                <h1 class="display-4 fst-italic pokemon__title"><?php the_title() ?></h1>
                                <!-- <h1 class="display-4 fst-italic pokemon__title">Pokemon</h1> -->
                                <p class="lead my-3"><?php the_content() ?></p>

                                <div class="card mb-4">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Weight: </strong><?php echo $weight ?></li>
                                        <li class="list-group-item"><strong>Pokedex number: </strong> <?php echo $pokedex_new_index ?> </li>
                                        <li class="list-group-item" id="pokedex_old_number" style="display: none;"><strong>Pokedex old number: </strong> </li>
                                    </ul>
                                </div>

                                <nav class="blog-pagination" aria-label="Pagination">
                                    <?php foreach( $types as $type ): ?>
                                        <a class="btn btn-outline-primary rounded-pill mr-2" href="#"><?php echo $type ?></a>
                                    <?php endforeach ?>
                                    <!-- <a class="btn btn-outline-secondary rounded-pill" aria-disabled="true">Newer</a> -->
                                </nav>
                                <form action="" id="form">
                                    <input type="hidden" name="action" value="pokedex">
                                    <input type="hidden" name="post_id", value="<?php echo $post_id ?>">
                                    <button class="pokemon__id mt-4 btn btn-primary btn-lg btn-block">Get the Pokedex ID.</button>
                                </form>
                                <!-- <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></p> -->
                            </div>
                        </div>

                        </main>
                        <?php
                    endwhile; ?>
                </div>

            </main>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
