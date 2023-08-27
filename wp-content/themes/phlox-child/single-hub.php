<?php
get_header();

while (have_posts()) :
    the_post();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <h1> Pleeeeeeeeeeeeeeeeeeee</h1>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

        </main>
    </div>

<?php endwhile;

get_footer();
