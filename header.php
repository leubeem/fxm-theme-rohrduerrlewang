<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="pre-header" style=background:#ddd;color:#333;padding:5px>
    <div class="container flex flex-wrap mx-auto items-center " style="gap:14px;align-items:center;">
		<a href="/schnellzugriff/">
		<div style="display:flex;gap:10px;align-items:center;">
			<img src="/wp-content/uploads/2023/06/Paomedia-Small-N-Flat-Pin.1024-150x150.png" width=23 alt="">
			Schnellzugriff		</div></a>


		<div class="max-md:hidden" style="flex:1">

		</div>
		<a href="mailto:homepage@rohr-duerrlewang.de" aria-label="E-Mail an homepage@rohr-duerrlewang.de">
		<div style="display:flex;gap:10px;align-items:center;">
		<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M2 20V4h20v16H2Zm10-7L4 8v10h16V8l-8 5Zm0-2l8-5H4l8 5ZM4 8V6v2Z"/></svg> homepage@rohr-duerrlewang.de
		</div></a>

		<a href="tel:0711742865" aria-label="Anrufen 0711 74 28 65">
		<div style="display:flex;gap:10px;align-items:center;">
<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M16 10.95v-3h-3v-2h3v-3h2v3h3v2h-3v3h-2ZM19.95 21q-3.225 0-6.288-1.425t-5.425-3.8q-2.362-2.375-3.8-5.438T3 4.05v-.525Q3 3.25 3.05 3H8.9l.925 5.025l-2.85 2.875q1.05 1.8 2.638 3.375T13.1 17l2.9-2.9l5 1v5.85q-.25.025-.525.038T19.95 21Z"/></svg>
		 0711 / 74 28 65</div></a>


		<form role="search" method="get" class="search-form max-md:hidden" style="display:flex;gap:3px;align-items:center;" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text">Search for:</span>
        <input type="search" class="search-field" style="padding:4px 10px;border-radius:4px" placeholder="Search…" value="<?php echo get_search_query(); ?>" name="s">
    </label>
    <button type="submit" class="search-submit"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.612 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3l-1.4 1.4ZM9.5 14q1.875 0 3.188-1.313T14 9.5q0-1.875-1.313-3.188T9.5 5Q7.625 5 6.312 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14Z"/></svg></button>
</form>
		
    </div>
</div>
	
<header class="header px-6 py-4">
    <div class="container lg:mx-auto flex items-center justify-between">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-xl font-semibold flex items-center gap-3">
            <?php
            $logo_id = get_option('fxwp_favicon');
            $logo_url = $logo_id ? wp_get_attachment_url($logo_id) : '';
            if ($logo_url) :
                ?>
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                     class="h-8 w-auto sm:h-10">
            <?php endif; ?>
            <div class="hidden lg:block site-title">
                <?php
                $site_title = get_bloginfo('name'); // Use get_bloginfo to get the title without echoing it
                // $site_title=wordwrap(bloginfo('name'), 27, "<br />\n&shy;");

                // Find the position of the first space
                $firstSpacePosition = strpos($site_title, ' ');

                // If there's a first space, find the position of the second space
                if ($firstSpacePosition !== false) {
                    $secondSpacePosition = strpos($site_title, ' ', $firstSpacePosition + 1);
                    if ($secondSpacePosition !== false) {
                        $site_title = substr_replace($site_title, "<br>", $secondSpacePosition, 1);
                    }
                }

                echo $site_title;
                ?>
            </div>
        </a>

        <div class="md:hidden">
            <button id="menu-button" class="h-8 w-8 fill-current" aria-label="<?php esc_attr_e('Menü', 'fxwp'); ?>"
                    aria-expanded="false" aria-controls="mobile-nav">
                <svg viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 6a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm1 5a1 1 0 100 2h12a1 1 0 100-2H4z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <nav id="main-nav" class="hidden md:block">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'menu_class' => 'header-menu',
                'container' => false
            ));
            ?>
        </nav>
    </div>

    <nav id="mobile-nav" class="hidden md:hidden mt-4">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'menu_class' => 'header-menu list-none ',
            'container' => false,
        ));
        ?>
    </nav>
</header>

<script>
    (function () {
        var btn = document.getElementById('menu-button');
        var nav = document.getElementById('mobile-nav');

        if (btn && nav) {
            btn.addEventListener('click', function () {
                var isHidden = nav.classList.toggle('hidden');
                btn.setAttribute('aria-expanded', isHidden ? 'false' : 'true');
            });
        }

        // Touch devices have no :hover, so give mobile sub-menus a tap toggle.
        if (nav) {
            nav.querySelectorAll('.menu-item-has-children').forEach(function (item) {
                var sub = item.querySelector(':scope > .sub-menu');
                var link = item.querySelector(':scope > a');
                if (!sub || !link) return;

                var toggle = document.createElement('button');
                toggle.type = 'button';
                toggle.className = 'submenu-toggle';
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Untermenü anzeigen');
                toggle.innerHTML = '<svg viewBox="0 0 20 20" width="16" height="16" aria-hidden="true"><path fill="currentColor" d="M5 7l5 5 5-5z"/></svg>';

                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    var open = sub.classList.toggle('submenu-open');
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    toggle.classList.toggle('submenu-toggle-open', open);
                });

                link.parentNode.insertBefore(toggle, link.nextSibling);
            });
        }
    })();
</script>
