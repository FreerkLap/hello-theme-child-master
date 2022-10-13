<div id="sailspecials-products-menu-<?php echo $display; ?>" class='elementor-shortcode'>
    <div class='sailspecials-products-menu-container'>

		<?php if ( $display == 'menu' ): ?>
            <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="sailspecials-products-menu-show">
                <svg xmlns="http://www.w3.org/2000/svg" class="chevron-down" style="width: 15px; height: 15px;"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>

                <svg xmlns="http://www.w3.org/2000/svg" class="chevron-up" style="width: 15px; height: 15px;"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                </svg>

                Alle producten
            </a>
		<?php endif; ?>

		<?php if ( $hide ?? false === true ): ?>
            <div class="backdrop"
                 style="<?php echo $display == 'menu' && is_front_page() ? 'display: none' : null; ?>"></div>
		<?php endif; ?>

		<?php if ( ! is_front_page() || $display == 'home' ): ?>
            <ul class="sailspecials-products-menu"
                style="<?php echo $display == 'menu' && is_front_page() ? 'display: none' : null; ?>">
                <li class="sailspecials-products-menu-li hide-md">
                    <a href="tel:+31757572600" class="menu-link">
                        <img width="50"
                             height="30"
                             src="/wp-content/uploads/2021/12/logo.png"
                             alt="Telefoonnumer"
                        /><span class="label">075-7572600</span>
                    </a>
                </li>

				<?php foreach ( get_mkb_wc_grouped_product_categories() as $category ): ?>

                    <li class="sailspecials-products-menu-li sailspecials-products-menu-li-with-submenu">
                        <div style="display: flex; align-items: center">
                            <a href="<?php echo get_category_link( $category->term_id ); ?>"
                               class="menu-link menu-link-item"
                            >
								<?php if ( $category->image[0] ): ?>
                                    <img src="<?php echo $category->image[0]; ?>"
                                         width="50"
                                         height="30"
                                         alt="Category <?php echo $category->name; ?>"
                                    />
								<?php endif; ?>

								<?php echo $category->name; ?>
                            </a>


                            <div class="chevron show-submenu"
                                 data-id="<?php echo $category->term_id; ?>">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="chevron-down"
                                     style="width: 25px; height: 25px; align-self: center; margin: 0 12.5px; display: inline-block; margin-top: 10px;"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>


                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="chevron-up"
                                     style='width: 25px; height: 25px; align-self: center; margin: 0 12.5px; display: none;'
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 15l7-7 7 7"/>
                                </svg>
                            </div>
                        </div>

                        <div class="category-submenu-container"
                             id="sailspecials-products-menu-submenu-container-<?php echo $category->term_id; ?>">

                            <h4 style="font-weight: bold;" class="show-md"><?php echo $category->name; ?></h4>

                            <ul class="category-submenu">
								<?php foreach ( $category->categories as $sub ): ?>
                                    <li class="category-submenu-li">
                                        <a href="<?php echo get_category_link( $sub->term_id ); ?>"
                                           class="category-submenu-link">
                                            <img src="<?php echo $sub->image[0]; ?>"
                                                 width="30"
                                                 height="30"
                                                 alt="Category <?php echo $sub->name; ?>"
                                            />
											<?php echo $sub->name; ?>
                                        </a>
                                    </li>
								<?php endforeach ?>
                            </ul>
                        </div>
                    </li>
				<?php endforeach ?>
                <li class="sailspecials-products-menu-li">
                    <a href="/shop" class="menu-link">
                        <img src="/wp-content/uploads/2018/02/bootuitrusting-100x60.png" width="50" height="30"/>
                        &gt; Alle producten
                    </a>
                </li>
            </ul>
		<?php endif; ?>

    </div>
	<?php if ( ! is_front_page() || $display == 'home' ): ?>
        <script>
            set_vh = function () {
                // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
                let vh = window.innerHeight * 0.01;
                // Then we set the value in the --vh custom property to the root of the document
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            };

            set_vh();

            jQuery(function () {

                let $button = jQuery('.js-show-mobile-menu');
                let $container = jQuery('#sailspecials-products-menu-<?php echo $display; ?>');
                let $originalContainerParent = $container.parent();
                let $menu = $container.find('.sailspecials-products-menu');
                let $userback = jQuery('.userback-button-container');
                let mobileMenuIsShown = false;

                jQuery(window).scroll(set_vh);
                jQuery(window).resize(set_vh);

                let show_mobile_menu = () => {
                    $container.find('.sailspecials-products-menu-show').hide();
                    $menu.css('display', 'flex');
                    $userback.hide();
                    $button.find('.close').css('display', 'inline-flex');
                    $button.find('.hamburger').css('display', 'none');
                    jQuery('body').css('overflow', 'hidden');

                    mobileMenuIsShown = true;
                };

                let hide_mobile_menu = () => {
                    $menu.css('display', 'none');
                    $userback.show();
                    $button.find('.close').css('display', 'none');
                    $button.find('.hamburger').css('display', 'inline-flex');
                    jQuery('body').css('overflow', 'auto');

                    // Moves menu back to the desktop position
                    if (window.innerWidth > 768) {
                        $container.find('.sailspecials-products-menu-show').show();
                        $container.appendTo($originalContainerParent);
                        $container.data('moved', false);
                        $menu.css('display', '');
			jQuery('.category-submenu-container').css('display', '');
                    }

                    mobileMenuIsShown = false;
                };

                let fix_mobile_menu_on_resize = function () {
                    if (window.innerWidth > 768 && mobileMenuIsShown) {
                        hide_mobile_menu();
                    }
                };

                jQuery(window).resize(fix_mobile_menu_on_resize);

                $button.on('click', () => {

                    // Moves menu to the mobile position
                    if (! $container.data('moved')) {
                        $container.appendTo('.elementor-location-header');
                        $container.data('moved', true);
                        $container.data('menu-display', $menu.css('display'));
                        $menu.css('display', 'none');
                    }

                    if ($menu.css('display') === 'none') {
                        show_mobile_menu();
                    } else {
                        hide_mobile_menu();
                    }
                });

                jQuery('.show-submenu').on('click', function (e) {
                    e.stopPropagation();

                    var id = jQuery(this).data('id');
                    var $container = jQuery('#sailspecials-products-menu-submenu-container-' + id);
                    var display = $container.css('display');

                    jQuery('.category-submenu-container').css('display', 'none');

                    if (display === 'flex') {
                        // Shows submenu
                        $container.css('display', 'none');
                        jQuery(this).find('.chevron-down').show();
                        jQuery(this).find('.chevron-up').hide();
                    } else {
                        // Hides submenu
                        $container.css('display', 'flex');
                        jQuery(this).find('.chevron-down').hide();
                        jQuery(this).find('.chevron-up').show();
                    }

                });
            })
        </script>
        <style>
            .hide-md {
                display: none;
            }

            .show-md {
                display: block;
            }

            @media only screen and (max-width: 768px) {
                .hide-md {
                    display: block;
                }

                .show-md {
                    display: none;
                }
            }

            .sailspecials-products-menu-container {
                position: relative;
                z-index: 10;
            }

            .sailspecials-products-menu-container:hover .sailspecials-products-menu {
                width: calc(100vw - 50px);
                max-width: 1135px;
            }

            .sailspecials-products-menu-li {
                width: 262px;
            }

            .sailspecials-products-menu-li-with-submenu:hover {
                width: calc(100vw - 50px);
                max-width: 1135px;
            }

            .sailspecials-products-menu .menu-link {
                position: relative;
                z-index: 10;
                text-decoration: none;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.67em;
                display: flex;
                padding: 7.5px 0;
                gap: 20px;
                align-items: center;
                border-top: 1px solid rgba(255, 255, 255, 0);
                border-bottom: 1px solid rgba(255, 255, 255, 0);
                width: 262px;
            }

            .sailspecials-products-menu:hover .menu-link {
                border-right: 1px solid #f0f0f0;
            }

            .sailspecials-products-menu .sailspecials-products-menu-li:hover .menu-link {
                font-size: 14px;
                font-weight: 400;
                line-height: 1.67em;
                border-top: 1px solid #f0f0f0;
                border-bottom: 1px solid #f0f0f0;
                border-right: 1px solid rgba(255, 255, 255, 0);
            }

            .category-submenu-container {
                display: none;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 5;
                width: calc(100vw - 50px);
                max-width: 1135px;
                padding-left: 285px;
                padding-top: 40px;
                min-height: 100%;
                box-sizing: border-box;
            }

            .category-submenu-link {
                display: flex;
                align-items: center;
                gap: 10px;
                width: 100%;
            }

            @media only screen and (min-width: 768px) {
                .sailspecials-products-menu-li:hover .category-submenu-container {
                    display: block;
                }
            }

            .category-submenu {
                display: flex;
                flex-wrap: wrap;
                column-gap: 20px;
                row-gap: 20px;
                align-content: start;
                padding-left: 0;
            }

            @media only screen and (max-width: 960px) {
                .category-submenu-li {
                    width: 29% !important;
                }
            }

            .category-submenu-li {
                width: 31.3%;
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 0.9em;
                font-weight: 400;
                line-height: 1.67em;
            }

            .category-submenu-li a {
                text-decoration: none;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.67em;
            }

            .category-submenu-li:hover a {
                font-size: 14px;
                line-height: 1.67em;
                font-weight: 400;
            }

            .sailspecials-products-menu-li a .chevron-right {
                display: block;
            }

            .category-submenu-container {
                background: white;
                padding-bottom: 20px;
            }

            .sailspecials-products-menu-container:hover .sailspecials-products-menu {
                display: flex;
                background: white;
            }

            .sailspecials-products-menu-container:hover > .backdrop {
                position: fixed;
                z-index: 1;
                background: rgba(0, 0, 0, 0.4);
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            .backdrop:hover {
                display: none;
                z-index: -1;
            }

            .sailspecials-products-menu {
                position: <?php echo $display == 'menu' ? 'absolute' : 'relative' ?>;
                z-index: 5;
                display: <?php echo $display == 'menu' ? 'none' : 'flex' ?>;
                padding-left: 0;
                flex-direction: column;
                box-sizing: content-box;
                box-shadow: 0 0 15px #e0e0e0;
                list-style: none;
                background: white;
                border-radius: 0 0 5px 5px;
                margin-top: <?php echo $display == 'menu' ? '20px' : '0' ?>;
            }

            .home .sailspecials-products-menu {
                background: white;
                box-shadow: none;
            }

            <?php if (! $display == 'menu'): ?>
            .sailspecials-products-menu:hover {
                width: 1135px;
            }

            <?php endif; ?>

            .show-submenu {
                display: none;
            }

            @media (max-width: 768px) {
                .sailspecials-products-menu {
                    width: 100% !important;
                    height: calc(100vh - <?php echo (is_admin_bar_showing() ? '150px' : '105px') ?>) !important;
                    height: calc(calc(var(--vh, 1vh) * 100) - <?php echo (is_admin_bar_showing() ? '150px' : '105px') ?>) !important;
                    position: fixed;
                    top: 0;
                    left: 0;
                    margin-top: <?php echo (is_admin_bar_showing() ? '150px' : '105px') ?>;
                    z-index: 10;
                    overflow: scroll;
                    overscroll-behavior: contain;
                    box-shadow: none;
                }

                .sailspecials-products-menu-li:hover {
                    background: #f1f1f1;
                }

                .sailspecials-products-menu-li {
                    border-top: 1px solid #ececec;
                    padding: 10px 0;
                }

                .sailspecials-products-menu-li,
                .sailspecials-products-menu-li a {
                    width: 100% !important;
		    z-index: 10;
                }

                .sailspecials-products-menu-li .chevron-down {
                    display: flex;
                    align-items: center;
                    width: 50px;
                    height: 100%;
                }

                .menu-link-item {
                    font-weight: 800 !important;
                }

                .category-submenu-container {
                    position: relative;
                    padding: 10px;
                    width: 100%;
                    border-top: 1px solid #ececec;
                    top: 10px;
                }

                .category-submenu-container .category-submenu {
                    display: flex;
                    flex-direction: column;
                    gap: 5px;
                    width: 100%;
                }

                .category-submenu-container .category-submenu-li {
                    width: 100% !important;
                    z-index: 10;
                }

                .category-submenu-link {
                    gap: 30px;
                    font-weight: normal;
                }

                .show-submenu {
                    display: block;
                }
            }

            .elementor-location-header {
                position: relative;
                z-index: 25;
            }
        </style>
	<?php endif; ?>
    <style>
        <?php if ($display == 'menu'): ?>
        .sailspecials-products-menu-container .sailspecials-products-menu-show {
            position: relative;
            z-index: 10;
            margin: 0 50px -20px 0;
            background: #f7f7f7;
            border-left: 1px solid #f0f0f0;
            border-right: 1px solid #f0f0f0;
            border-bottom: 3px solid #f7f7f7;
            text-decoration: none;
            padding: 20px 22px;
            border-top: none;
            border-radius: 0;
            color: var(--e-global-color-text);
            fill: var(--e-global-color-text);
            font-family: 'Sailspecials Font', proxima-nova, helvetica neue, arial, sans-serif;
            font-size: 18px;
            font-weight: 700;
            font-style: normal;
            line-height: 1em;
            letter-spacing: 1.5px;
            display: flex;
            gap: 10px;
            align-items: center;
            -webkit-appearance: initial;
        }

        .sailspecials-products-menu-container:hover .sailspecials-products-menu-show .chevron-down {
            display: none;
        }

        .sailspecials-products-menu-container:hover .sailspecials-products-menu-show .chevron-up {
            display: block;
        }

        .sailspecials-products-menu-container .sailspecials-products-menu-show .chevron-up {
            display: none;
        }

        .sailspecials-products-menu-container .sailspecials-products-menu-show:hover {
            color: var(--e-global-color-primary);
        }

        .sailspecials-products-menu-container:hover .sailspecials-products-menu-show {
            font-size: 18px;
            font-weight: 700;
            font-style: normal;
            line-height: 1em;
            letter-spacing: 1.5px;
            border-bottom: 3px solid var(--e-global-color-primary);
        }

        <?php endif; ?> /** Show menu */
    </style>
</div>
