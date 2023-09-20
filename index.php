<?php
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main container mx-auto">


            <?php
			
			if (isset($_GET['s']) && !empty($_GET['s'])) {
?>
			<form role="search" style="padding: 40px 0" id="bigsearch" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text">Suche nach:</span>
        <input style="width: 80%" type="search" class="search-field" placeholder="Suchbegriff eingeben..." value="<?php echo get_search_query(); ?>" name="s">
    </label>
    <button type="submit" class="search-submit">Suchen</button>


<?php
if (isset($_GET['s']) && !empty($_GET['s'])) {
    $args = array(
        's' => $_GET['s'], // Add search query
        'post_type' => 'page',
        'posts_per_page' => -1,
    );

    $pages_query = new WP_Query($args);

    if ($pages_query->have_posts()) {
        while ($pages_query->have_posts()) {
            $pages_query->the_post();
            echo "<a class=result href='".get_permalink(get_the_ID())."'>";
            the_title('<h2 class="text-lg font-bold">', '</h2>');
            the_excerpt();
            echo "</a>";
        }
    } else {
        echo '<br><br>Keine Suchergebnisse gefunden.<br>';
    }

    wp_reset_postdata();
}
?>


</form>
<style>
	#bigsearch .result {
		padding:10px 20px;
		border:1px solid #ccc;
		margin-top:10px;display:block;
		border-radius:5px;
	}
	#bigsearch .result:hover {
		background:#eee
	}
#bigsearch .search-form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

#bigsearch .search-field {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

#bigsearch .search-submit {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

#bigsearch .search-submit:hover {
    background-color: #0056b3;
}
</style>

			<?php
			} else {
            if (have_posts()) :

                if (is_home() && !is_front_page()) :
                    ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php
                endif;

                the_post();
                if (!is_home() && !is_front_page()) :
                    breadcrumb();
                    echo "<h1 class=' post-title    '>" . get_the_title() . "</h1>";
                endif;
                get_template_part('template-parts/content', get_post_type());
                the_posts_navigation();

            else :

                get_template_part('template-parts/content', 'none');

            endif;}
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
