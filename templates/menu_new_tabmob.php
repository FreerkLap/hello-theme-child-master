<!-- 
    Main menu for Sailspecials (mobile / tablet).
    PHP by Uteq, HTML/CSS/JS by MKBWatersport 
    Using alpine.js for interactivity.
-->
<div id="mobile-menu-site-wrapper" x-data="{mainMenu : false, subMenu : false}">
    <div id="mkbws-mobile-header-wrapper">
    <a href="<?php echo home_url(); ?>" style="width:200px;">
        <img width="200" height="auto" src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/sailspecials_liggend_wit.svg" 
            class="attachment-medium size-medium" 
            alt="watersportwinkel voor zeilers" 
            loading="lazy">
    </a>

    <form action="<?php echo home_url(); ?>" method="get" id="search_form_header" class="search-form-tablet ">
        <input type="text" name="s" placeholder="Wat zoek je?" id="live_search_header">
        <input type="hidden" name="post_type" value="product">
    </form>
    

    <div class="mkbws-mobile-header-menu-group">
        <a  href="<?php echo home_url(); ?>/my-account/" style="width:24px; height:24px;">
            <i class='fas fa-user-alt' style='font-size:24px; color:white;'></i>
        </a>

        <a  href="<?php echo home_url(); ?>/winkelwagen/" style="width:24px; height:24px;">
            <i class="fas fa-shopping-cart" style='font-size:24px; color:white;'></i>
        </a>

        <div id="mobile-menu" @click="mainMenu = !mainMenu, changeBelcoVis()" x-cloak>
            <div class="mobile-menu-main-btn" x-show="!mainMenu">    
                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z"/></svg>
            </div>        
            <div class="mobile-menu-main-btn" x-show="mainMenu">
            <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg>
            </div>
            <span>Menu</span>
        </div>
    </div>
    </div>
    
    <div id="mobile-menu-wrapper" x-show="mainMenu" x-cloak @click.prevent="mainMenu && !subMenu ? (mainMenu = false,  changeBelcoVis) : ''">
    </div>

    <div id="mkbws-products-menu-mobile" x-cloak x-show="mainMenu" x-transition:enter-start="submenu-slideout" x-transition:enter-end="submenu-slidein" x-transition:leave-start="submenu-slidein" x-transition:leave-end="submenu-slideout">
        <div class="mobile-menu-header">
            <span class="mobile-menu-back-title">
                <a href="<?php echo home_url(); ?>">
                    <i class="fas fa-chevron-left"></i>
                    Terug naar home
                </a>
            </span>

            <div @click.prevent="mainMenu = false, subMenu = false, changeBelcoVis()" style="cursor:pointer; padding:10px 10px 0px 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#777777" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/>
                </svg>
            </div>
        </div>
        <ul class="mkbws-products-menu-mobile">
            <?php foreach (get_mkb_wc_grouped_product_categories() as $category) : ?>

                <li class="mkbws-products-menu-mobile-li" data-id="<?php echo $category->term_id; ?>" x-data="{submenuOpen : false}" @click.self="submenuOpen = true, subMenu = true">
                    <div class="mkbws-menu-main-cat-dropdown-mobile" @click.prevent="submenuOpen = true, subMenu = true">
                        <a href="<?php echo get_category_link($category->term_id); ?>" class="menu-link menu-link-item">
                            <div class="mkbws-main-menu-title">
                                <img src="<?php echo $category->image[0]; ?>" width="50" height="50" style="margin-left: -20px;" alt="Categorie <?php echo $category->name; ?>" />
                                <?php echo $category->name; ?>
                            </div>
                        </a>

                        <i class="fas fa-chevron-right" style="margin-left: 10px; color:var(--e-global-color-secondary)"></i>

                    </div>

                    <div x-cloak x-show="submenuOpen" @click.outside="submenuOpen = false, subMenu = false" x-transition:enter-start="submenu-slideout" x-transition:enter-end="submenu-slidein" x-transition:leave-start="submenu-slidein" x-transition:leave-end="submenu-slideout" class="subcategory-mobile-container" id="mkbws-submenu-container-<?php echo $category->term_id; ?>" data-id="submenu-<?php echo $category->term_id; ?>">
                        <div class="mobile-menu-header" @click="submenuOpen = false, subMenu = false">
                            <span class="mobile-menu-back-title">
                                <i class="fas fa-chevron-left"></i>
                                Terug
                            </span>

                            <div style="cursor:pointer; padding:10px 10px 0px 10px;" class="mobile-menu-close-button" @click.prevent.stop="subMenu = false, submenuOpen = false, changeBelcoVis(), mainMenu = false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="#777777" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="submenu-content-container">
                            <ul class="subcategory-mobile">
                            <a href="<?php echo get_category_link($category->term_id); ?>">
                                <h3 style="font-size:20px;">
                                        <?php echo $category->name; ?>
                                </h3>
                            </a>

                                <?php foreach ($category->categories as $sub) : ?>
                                    <a href="<?php echo get_category_link($sub->term_id); ?>" class="subcategory-mobile-link" @click.stop="">
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
        <div class="mobile-menu-footer">
            <div>
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo home_url(); ?>/wp-content/uploads/2022/04/Home.svg" alt="Terug naar home" width="50px"></i> 
                </a>
            </div>
            <div @click="changeBelcoVis(), mainMenu = false, subMenu = false, Belco.open()" :class="$store.officeHours.storeIsOpen ? 'mkbws-mobile-menu-chat-icon office-open' : 'mkbws-mobile-menu-chat-icon office-closed'">
            <img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/chat-icon.svg" alt="Open chat" width="50px"></i> 
            </div>
            <div>
                <a href="<?php echo home_url(); ?>/winkelwagen">
                    <img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/winkelwagen-icon.svg" alt="Winkelwagen" width="50px"></i> 
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Mobile searchbar -->
<form action="<?php echo home_url(); ?>/zoekresultaten/" method="get" id="search_form_header" class="search-form-mobile">
        <input type="text" name="searchterm" placeholder="Wat zoek je?" id="live_search_header">
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

    #mobile-menu-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom:0 ;
        background-color: white;
        opacity: 50%;
        -webkit-filter: blur(5px);
        -moz-filter: blur(5px);
        -o-filter: blur(5px);
        -ms-filter: blur(5px);
        filter: blur(5px);
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
        position: relative;
    }

    .search-form-mobile input::placeholder, .search-form-tablet input::placeholder  {
        color: var(--e-global-color-text);
    }

    .search-form-tablet {
        position: relative;
        width: 100%;
    }

    .search-form-tablet:after {
        content: url('wp-content/themes/hello-theme-child-master/images/search-icon.svg');
        position: absolute;
        top: 10px;
        right: 5px;
    }

    .search-form-mobile:after {
        content: url('wp-content/themes/hello-theme-child-master/images/search-icon.svg');
        position: absolute;
        top: 20px;
        right: 20px;
    }
    
    .search-form-tablet input[type=date], .search-form-tablet input[type=email], .search-form-tablet input[type=number], .search-form-tablet input[type=password], .search-form-tablet input[type=search], .search-form-tablet input[type=tel], .search-form-tablet input[type=text], .search-form-tablet input[type=url], .search-form-tablet select, .search-form-tablet textarea,
    .search-form-mobile input[type=date], .search-form-mobile input[type=email], .search-form-mobile input[type=number], .search-form-mobile input[type=password], .search-form-mobile input[type=search], .search-form-mobile input[type=tel], .search-form-mobile input[type=text], .search-form-mobile input[type=url], .search-form-mobile select, .search-form-mobile textarea {
        width: 100%;
        border: 1px solid var(--e-global-color-text);
        border-radius: 5px;
        padding: 5px;
        font-size: 16px;
        font-weight: 600;
        color: var(--e-global-color-text);
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
        height: 100%;
        right: 0;
        width: 100%;
        max-width: 330px;
        background-color: var(--e-global-color-secondary);
        z-index: 2147483000;
    }

    @media screen and (min-width: 1191px) {
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
        padding: 0px 10px 0px 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        color: var(--e-global-color-primary);
        font-weight: 600;
    }

    .mobile-menu-back-title {
        font-size: 14px;
        text-transform: uppercase;
    }

    .mobile-menu-header a {
        font-weight: 600;

    }

    .mobile-menu-header .fas {
        color: var(--e-global-color-text);
    }    

    .mkbws-products-menu-mobile {
        font-family: var(--e-global-typography-text-font-family), proxima-nova, arial, sans-serif !important;
        overflow-y: scroll;
    }

    ul.mkbws-products-menu-mobile {
        display: flex;
        align-items: stretch;
        flex-wrap: nowrap;
        gap: 10px;
        flex-direction: column;
        padding: 10px;
        height: calc(100% - 150px);
        overflow-y: scroll;
        position: static;
    }

    .mkbws-menu-main-cat-dropdown-mobile {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0px;
        margin-top: auto;
        position: relative;
        padding: 10px 10px;
        align-items: center;
    }

    .mobile-menu-main-btn {
        margin-bottom: -5px;
    }

    ul.subcategory-mobile {
        display: flex;
        background-color: var(--e-global-color-secondary);
        padding: 10px;
        margin: 0;
        width: 100%;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: stretch;
        overflow-y: scroll;
        gap: 10px;
        z-index: 999;
        height: calc(100% - 150px);
    }

    .submenu-slideout {
        transform:translateX(100%);
        transition: transform .5s ease;
    }

    .submenu-slidein {
        transform: translateX(0%);
        transition: transform .5s ease;

    }

    ul.mkbws-products-menu-mobile h3 {
        color:var(--e-global-color-primary); 
        line-height: 1em; 
        padding: 0px 10px;
        margin: 0px;
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
    }

    .subcategory-mobile-container {
        background: var(--e-global-color-secondary);
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 100%;
        text-align: left;
        box-shadow: 0px 20px 25px -20px rgb(0 0 0 / 50%);
        z-index: 9999;
    }

    .submenu-content-container {
        height:100%;
    }

    .submenu-hidden {
        display: none;
    }

    li.mkbws-products-menu-mobile-li {
        display: flex;
        list-style-type: none;
        padding: 5px 10px;
        background-color: white;
        text-align: center;
        border-radius: 3px;
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
        color: var(--e-global-color-text);
    }

    .submenu-header-mobile {
        padding: 5px 20px;
        font-size: 14px;
    }

    .mkbws-debug {
        border: 1px solid lime;
    }

    .submenu-enter {
        transition-delay: 0ms;
        transition-duration: 0.2s;
        opacity: 100;
    }

    .submenu-leave {
        transition-delay: 500ms;
        transition-duration: 0.2s;
        opacity: 0;
    }

    .mobile-menu-footer {
        width: 100%;
        position: absolute;
        background-color: white;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        z-index: 999999;
        height: 100px;
        padding: 20px;
        bottom: 0;
    }

    .office-open::after {
        content: '';
        width: 10px;
        height: 10px;
        background-color: var( --e-global-color-accent );
        border-radius: 50%;
        position: absolute;
    }

    .office-closed::after {
        content: '';
        width: 10px;
        height: 10px;
        background-color: var(--e-global-color-ca4ec4b);
        border-radius:50%;
        position: absolute;
    }

    /* Adjustments for other plugins */
    .clerk-slider-nav {
        z-index: 10 !important;
    }
</style>

<script type="text/javascript" defer>
    let belcoVis = true
    let changeBelcoVis = function() {
        belcoVis = !belcoVis
        if (belcoVis == false) {
            const belcoContainer = document.getElementById('belco-container')
            belcoContainer.style.display = 'none';
        } else {
            const belcoContainer = document.getElementById('belco-container')
            belcoContainer.style.display = '';

        }
    }
</script>