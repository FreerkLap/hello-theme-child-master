<div id="mkbws-products-menu" class='elementor-shortcode'>
    <ul class="mkbws-products-menu">
        <?php foreach (get_mkb_wc_grouped_product_categories() as $category) : ?>

            <!-- Main menu item -->
            <li class="mkbws-products-menu-li mkbws-debug" data-id="<?php echo $category->term_id; ?>" x-data="{ mouseOverSub : false, mouseOverMain  : false}" @mouseenter="mouseOverMain = true" @mouseleave="mouseOverMain = false">
                <div class="mkbws-menu-main-cat-dropdown">
                    <a href="<?php echo get_category_link($category->term_id); ?>" class="menu-link menu-link-item">
                        <div class="mkbws-main-menu-title">
                            <?php echo $category->name; ?>
                        </div>
                    </a>

                    <!-- Dropdown chevron -->
                    <i class="fas fa-chevron-down"></i>
                    <p>Main: <span x-text="mouseOverMain"></span></p>
                    <p>Sub: <span x-text="mouseOverSub"></span></p>


                </div>

                <!-- Submenu elements -->
                <div x-cloak x-show="mouseOverMain" @mouseover="mouseOverSub = true" x-transition.opacity.duration.500ms class="subcategory-container mkbws-debug" id="mkbws-submenu-container-<?php echo $category->term_id; ?>" data-id="submenu-<?php echo $category->term_id; ?>">

                    <h4><?php echo $category->name; ?></h4>

                    <ul class="subcategory">
                        <?php foreach ($category->categories as $sub) : ?>
                            <li class="subcategory-li">
                                <a href="<?php echo get_category_link($sub->term_id); ?>" class="subcategory-link">
                                    <img src="<?php echo $sub->image[0]; ?>" width="30" height="30" alt="Categorie <?php echo $sub->name; ?>" />
                                    <?php echo $sub->name; ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </li>
        <?php endforeach ?>
    </ul>

</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    ul.mkbws-products-menu {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        padding-inline-start: 0;
        justify-content: space-between;
        gap: 5px;
        margin: 10px auto;
    }

    .mkbws-menu-main-cat-dropdown {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-wrap: nowrap;
        gap: 0px;
    }

    .subcategory {}

    .submenu-hidden {
        display: none;
    }

    li.mkbws-products-menu-li {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .mkbws-main-menu-title {
        display: flex;
        flex-direction: row;
        align-items: center;
        align-content: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 500;
    }

    .subcategory-container {
        background: white;
        display: block;
        position: absolute;
        left: 0;
        width: 100%;
    }

    .mkbws-debug {
        border: 1px solid lime;
    }
</style>

<script type="application/javascript">
    function enterSubMenu(e, menuID) {
        e.preventDefault();
        const currentSubMenu = document.getElementById(`mkbws-submenu-container-${menuID}`)
        console.log(currentSubmenu);
    }
</script>
<script src="https://unpkg.com/alpinejs" defer></script>

<!-- style="width: 25px; height: 25px; align-self: center; margin: 0 12.5px; display: inline-block; margin-top: 10px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" -->