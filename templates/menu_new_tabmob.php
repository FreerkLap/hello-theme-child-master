<!-- 
    Main menu for Sailspecials (mobile / tablet).
    PHP by Uteq, HTML/CSS/JS by MKBWatersport 
    Using alpine.js for interactivity.
-->
<div id="mkbws-mobile-header-wrapper" x-data="mobileMenu">
    <a href="https://sailspecials-staging.local" style="width:200px;">
        <img width="200" height="auto" src="https://sailspecials-staging.local/wp-content/uploads/2021/09/sailspecials_liggend_wit.svg" 
            class="attachment-medium size-medium" 
            alt="watersportwinkel voor zeilers" 
            loading="lazy">
    </a>

    <form action="https://sailspecialsdev.local/" method="get" id="search_form_header" class="search-form-tablet">
        <input type="text" name="s" placeholder="Zoek een product" id="live_search_header">
        <input type="hidden" name="post_type" value="product">
    </form>

    <div class="mkbws-mobile-header-menu-group">
        <a  href="https://sailspecials-staging.local/my-account/" style="width:24px; height:24px;">
            <i class='fas fa-user-alt' style='font-size:24px; color:white;'></i>
        </a>

        <a  href="https://sailspecials-staging.local/winkelwagen/" style="width:24px; height:24px;">
            <i class="fas fa-shopping-cart" style='font-size:24px; color:white;'></i>
        </a>

        <div id="mobile-menu" @click="toggle">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z"/></svg>
            <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg>
            <span>Menu</span>
        </div>
    </div>
</div>

<div id="mkbws-products-menu-mobile" x-data="mobileMenu" x-show="open" x-cloak >
    <div class="mobile-menu-header">    
        <div @click.prevent="open = false" style="cursor:pointer; padding:10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/>
            </svg>
        </div>
    </div>
    <ul class="mkbws-products-menu-mobile">
        <?php foreach (get_mkb_wc_grouped_product_categories() as $category) : ?>

            <!-- Main menu item -->
            <li class="mkbws-products-menu-mobile-li" 
                data-id="<?php echo $category->term_id; ?>" 
                x-data="{ 
                    subMenuOpen : false, 
                    mouseAtSubmenu : false, 
                    mouseAtMainmenu  : false,
                    timeoutLeave : null,
                    timeoutEnterSub : null,
                    submenuClose() {
                                this.subMenuOpen = false
                        }
                    }" 
                @mouseenter="mouseAtMainmenu = true, timeoutEnterSub = setTimeout(() => {subMenuOpen = true}, 290), clearTimeout(timeoutLeave)"
                @mouseleave="mouseAtMainmenu = false, timeoutLeave = setTimeout(() => {submenuClose()}, 300), clearTimeout(timeoutEnterSub)"
            >
                <div class="mkbws-menu-main-cat-dropdown-mobile">
                    <a href="<?php echo get_category_link($category->term_id); ?>" class="menu-link menu-link-item">
                        <div class="mkbws-main-menu-title">
                            <?php echo $category->name; ?>
                        </div>
                    </a>

                    <!-- Dropdown chevron -->
                    <i class="fas fa-chevron-down"></i>

                </div>

                <!-- Submenu elements -->
                <div 
                    x-cloak
                    x-show="subMenuOpen"
                    @mouseenter="mouseAtSubmenu = true, mouseAtMainmenu = false, clearTimeout(timeoutLeave)" 
                    @mouseleave="mouseAtSubmenu = false"
                    class="subcategory-mobile-container" 
                    id="mkbws-submenu-container-<?php echo $category->term_id; ?>" 
                    data-id="submenu-<?php echo $category->term_id; ?>"
                >
                    <div class="submenu-header">
                        <span>
                            <a href="<?php echo home_url(); ?>">
                                <img src="<?php echo home_url(); ?>/wp-content/uploads/2022/04/Home.svg" alt="Home" width="15px"></i> Home</a>
                        </span>
                        <span>
                            <i class="fas fa-chevron-right"></i>
                            <a href="<?php echo get_category_link($category->term_id); ?>">
                                <?php echo $category->name; ?>
                            </a>
                        </span>
                    </div>

                    <div class="submenu-content-container">
                        <ul class="subcategory-mobile">
                            <?php foreach ($category->categories as $sub) : ?>
                                <a href="<?php echo get_category_link($sub->term_id); ?>" class="subcategory-mobile-link">
                                    <li class="subcategory-mobile-li">
                                        <img src="<?php echo $sub->image[0]; ?>" width="30" height="30" alt="Categorie <?php echo $sub->name; ?>" />
                                        <?php echo $sub->name; ?>
                                    </li>
                                </a>

                            <?php endforeach ?>
                        </ul>


                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>

<form action="https://sailspecialsdev.local/" method="get" id="search_form_header" class="search-form-mobile">
        <input type="text" name="s" placeholder="Zoek een product" id="live_search_header">
        <input type="hidden" name="post_type" value="product">
</form>

<style>
    [x-cloak] {
        display: none !important;
    }

    #mkbws-mobile-header-wrapper {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;
        width: 100%;
        padding: 10px;
        align-items: center;
        gap: 20px;
    }

    .mkbws-mobile-header-menu-group {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-end;
        gap: 30px;
        align-items: center;
    }

    #mkbws-mobile-menu-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        filter: blur(10px);
        z-index: 50;
    }

    .search-form-mobile {
        width: 100%;
        display: block;
        padding: 10px;
        background-color: var(--e-global-color-secondary);
    }

    .search-form-tablet {
        width: 100%;
    }


    @media screen and (min-width: 768px ) {
        .search-form-mobile {
            display: none;
        }
    }

    @media screen and (max-width: 767px ) {
        .search-form-tablet {
            display: none;
        }
    }

    #mkbws-products-menu-mobile {
       position: fixed;
       top: 0;
       left: 0;
       width: 80%;
       z-index: 999;
       height: 100vh;
       background-color: var(--e-global-color-secondary);

    }

    @media screen and (min-width: 1130px) {
        #mkbws-products-menu-mobile, .mobile-menu {
            display: none;
        }
    }

    #mobile-menu {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 0px;
        margin: auto 0;
    }

    #mobile-menu span {
        color: white;
        font-size: 10px;
        text-transform: uppercase;
        padding: 0;
        margin: 0;
        line-height: 1.1em;
    }

    #mobile-menu svg {
        filter: invert(100%) sepia(0%) saturate(7500%) hue-rotate(23deg) brightness(118%) contrast(118%);
    }

    .mobile-menu-header {
        width: 100%;
        padding: 20px;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }
    .mobile-menu-header div {
        cursor: pointer;
    }
    

    .mkbws-products-menu-mobile {
        font-family: var(--e-global-typography-text-font-family), proxima-nova, arial, sans-serif !important;
        z-index: 999;
        overflow-y: scroll;
    }

    ul.mkbws-products-menu-mobile {
        display: flex;
        align-items: stretch;
        flex-wrap: nowrap;
        padding-inline-start: 0;
        justify-content: flex-start;
        gap: 0px;
        flex-direction: column;
    }

    .mkbws-menu-main-cat-dropdown-mobile {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0px;
        margin-top: auto;
        position: relative;
        padding: 20px 10px;
    }

    ul.subcategory-mobile {
        display: grid;
        background-color: var(--e-global-color-secondary);
        grid-gap: 10px;
        padding: 10px;
        margin: 0;
        grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
        width: 100%;
        grid-auto-rows: max-content;
    }

    li.subcategory-mobile-li {
        width: 100%;
        list-style-type: none;
        padding: 10px;
        background-color: white;
        border-radius: 5px;
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        align-content: center;
        gap: 10px;
        font-size: 16px;
        transition-delay: 0.1s;
        transition-duration: 0.3s;
        box-shadow: 0px 0px 0px -5px black;
    }

    li.subcategory-mobile-li:hover {
        box-shadow: 0px 3px 10px -5px black;
    }

    .subcategory-mobile-container {
        background: white;
        display: block;
        position: absolute;
        left: 0;
        top:40px;
        width: 100%;
        text-align: left;
        box-shadow: 0px 20px 25px -20px rgb(0 0 0 / 50%);
    }

    .submenu-content-container {
        display: flex;
        flex-direction: row;
    }

    .helpdesk {
        width: 250px;
        padding: 10px 20px;
        background-color: var(--e-global-color-primary);
        color: white;
    }

    .helpdesk-visible {
        visibility: visible;
    }

    .helpdesk-hidden {
        visibility: hidden;
        transition-delay: 0.5s;
    }

    .helpdesk-header {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
    }

    .helpdesk-list {
        padding: 0;
    }

    .helpdesk-item,
    .helpdesk-item a {
        list-style-type: none;
        color: white;
        font-weight: 400;
    }

    .helpdesk-item span:hover,
    .helpdesk-item a:hover {
        color: lime;
        cursor: pointer;
        font-weight: 400;
    }

    .submenu-hidden {
        display: none;
    }

    li.mkbws-products-menu-mobile-li {
        display: flex;
        list-style-type: none;
        padding: 5px 10px;
        background-color: var(--e-global-color-secondary);
        text-align: center;
    }

    li.mkbws-products-menu-mobile-li:hover {
        list-style-type: none;
        padding: 5px 10px;
        background-color: white;
    }

    a.menu-link.menu-link-item {
        color: var(--e-global-color-text);
        font-weight: bold;
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

    .submenu-header {
        padding: 5px 20px;
        font-size: 14px;
    }

    .mkbws-debug {
        border: 1px solid lime;
    }

    .submenu-enter {
        transition-delay: 0ms;
        transition-duration: 0.5s;
        opacity: 100;
    }

    .submenu-leave {
        transition-delay: 500ms;
        transition-duration: 0.5s;
        opacity: 0;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        console.log("Alpine init");
        Alpine.data('mobileMenu', () => ({
            open: false,
            toggle() {
                console.log("Toggle from: ", this.open);
                this.open = ! this.open
            }
        }))
    })
</script>