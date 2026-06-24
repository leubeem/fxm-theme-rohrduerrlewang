<?php
get_header(); ?>

    <main id="main" class="site-main  container mx-auto">
        <section class="error-404 not-found py-10 text-center">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Seite konnte nicht gefunden werden', 'fxwp'); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p class="text-lg"><?php esc_html_e('Es sieht so aus, als ob wir nicht finden konnten, wonach Sie gesucht haben. ', 'fxwp'); ?></p>
                <img src="/wp-content/uploads/2023/06/akira-hojo-_86u_Y0oAaM-unsplash-scaled.jpg" width="800"
                     class="my-9 mx-auto block">
            </div><!-- .page-content -->
        </section><!-- .error-404 -->
    </main><!-- #main -->

<?php
get_footer();
