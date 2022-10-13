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

                </div>

                <!-- Submenu elements -->
                <!-- <div x-cloak x-show="mouseOverMain" @mouseover="mouseOverSub = true" x-transition.opacity.duration.500ms class="subcategory-container mkbws-debug" id="mkbws-submenu-container-<?php echo $category->term_id; ?>" data-id="submenu-<?php echo $category->term_id; ?>"> -->
                <div class="subcategory-container mkbws-debug" id="mkbws-submenu-container-<?php echo $category->term_id; ?>" data-id="submenu-<?php echo $category->term_id; ?>">
                    <div class="submenu-header">
                        <span><a href="<?php echo home_url(); ?>"><img src="<?php echo home_url(); ?>/wp-content/uploads/2022/04/Home.svg" alt="Home" width="15px"></i> Home</a></span> <span><i class="fas fa-chevron-right"></i> <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></span>
                    </div>

                    <div class="submenu-content-container">
                        <ul class="subcategory">
                            <?php foreach ($category->categories as $sub) : ?>
                                <a href="<?php echo get_category_link($sub->term_id); ?>" class="subcategory-link">
                                    <li class="subcategory-li">
                                        <img src="<?php echo $sub->image[0]; ?>" width="30" height="30" alt="Categorie <?php echo $sub->name; ?>" />
                                        <?php echo $sub->name; ?>
                                    </li>
                                </a>

                            <?php endforeach ?>
                        </ul>

                        <div class="helpdesk" x-data>
                            <span class="helpdesk-header">
                                <img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/aartjan.jpeg" style="width: 40px; height: 40px; border-radius: 50%;" />
                                <h3 style="color: white; line-height: 1em; padding-top: 5px;">Hulp nodig?</h3>
                            </span>
                            <p>Onze klantenservice is <b x-if="$store.officeHours.isStoreOpen" style="color:lime;">bereikbaar</b> {$store.officeHours.isStoreOpen}</p>
                            <ul class="helpdesk-list">
                                <li class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/telefoon-icon.svg" /> <a href="tel:+31757572600" id="helpdesk-call" target="_blank">075-7572600</a></li>
                                <li class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/chat-icon.svg" /> <span onclick="Belco.open('chat')" id="helpdesk-chat">Chat starten </span></li>
                                <li class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/whatsapp-icon.svg" /> <a href="https://wa.me/31757572600" id="helpdesk-whatsapp" target="_blank">WhatsApp</a></li>
                                <li class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/email-icon.svg" /> <a href="mailto:info@sailspecials.nl" id="helpdesk-email" target="_blank">E-mail sturen</a></li>
                            </ul>

                        </div>
                    </div>
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

    ul.subcategory {
        display: grid;
        background-color: var(--e-global-color-secondary);
        grid-gap: 10px;
        padding: 10px;
        margin: 0;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        width: 100%;
    }

    li.subcategory-li {
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

    .subcategory-container {
        background: white;
        display: block;
        position: absolute;
        left: 0;
        width: 100%;
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

    .submenu-header {
        padding: 5px 20px;
        font-size: 14px;
    }

    .mkbws-debug {
        border: 1px solid lime;
    }
</style>

<script src="https://unpkg.com/alpinejs" defer></script>
<script type="application/javascript" defer>
    let isStoreOpen = function() {
        const dailyOpenFrom = 9
        const dailtOpenTo = 17
        const weeklyOpenFrom = 1
        const weeklyOpenTo = 5
        const currentDate = new Date();
        const currentDay = currentDate.getDay();
        const currentHour = currentDate.getHours();

        const isBetweenOpenDays = currentDay >= weeklyOpenFrom && currentDay <= weeklyOpenTo;
        const isBetweenOpenHours = currentHour >= dailyOpenFrom && currentHour <= dailtOpenTo;

        return isBetweenOpenDays && isBetweenOpenHours;
    };

    document.addEventListener('alpine:init', () => {
        Alpine.store('officeHours', {
            storeIsOpen: isStoreOpen(),

        })
    })
</script>