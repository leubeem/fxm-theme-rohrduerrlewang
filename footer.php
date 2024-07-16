<?php
$columns_content = array();
for ($i = 1; $i <= 4; $i++) {
    $column_content = get_theme_mod('fxwp_custom_section_column_' . $i, '');
    if (!empty($column_content)) {
        $columns_content[] = $column_content;
    }
}

if (!empty($columns_content)) :
    ?>
    <section class="pre-footer-section">
        <div class="flex flex-col container mx-auto gap-6 md:flex-row py-3 md:py-8">
            <?php foreach ($columns_content as $content) : ?>
                <div class="whitespace-pre-line p-4 flex-1 md:p-0 "><?php echo wp_kses_post($content); ?></div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>


<div class="pre-footer">
    <div class="container  mx-auto px-4">
        <?php
        wp_reset_postdata();
        $my_postid = 18;
        $content_post = get_post($my_postid);
        $content = $content_post->post_content;
        echo $content;

        wp_reset_postdata();
        // have the edit link
        edit_post_link(__('Edit', 'fxwp'), '<p>', '</p>', 18, 'post-edit-link');
        ?>
        <style>

            div.prose {
                max-width: 100% !important;
            }
            .wp-block-spacer {
                clear: both;
            }
            body .is-layout-flex {
                display: flex;
            }
            .wp-block-columns {
                flex-wrap: nowrap !important;
            }
            .wp-block-columns {
                align-items: normal !important;
                box-sizing: border-box;
            }
            .wp-block-columns:not(.is-not-stacked-on-mobile) > .wp-block-column {
                flex-basis: 0;
                flex-grow: 1;
            }
            body .is-layout-flex > * {
                margin: 0;
            }
            .wp-block-column {
                min-width: 0;
                overflow-wrap: break-word;
                word-break: break-word;
            }
            .wp-block-columns:not(.is-not-stacked-on-mobile) > .wp-block-column {
                flex-basis: 0;
                flex-grow: 1;
            }
            .has-text-align-center {
                text-align: center;
            }
            .has-text-align-left {
                text-align: left;
            }
            .has-text-align-right {
                text-align: right;
            }
            .wp-block-spacer {
                clear: both;
            }
            :where(.wp-block-columns) {
                margin-bottom: 1.75em;
            }
        </style>
    </div>
</div>

<footer>
    <div class="container mx-auto py-6 px-4">
        <nav class="footer-menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class' => 'footer-menu',
                'container' => false,
            ));
            ?>
        </nav>
        <p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
