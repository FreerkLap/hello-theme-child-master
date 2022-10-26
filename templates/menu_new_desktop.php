<!-- 
    Main menu for Sailspecials (desktop).
    PHP by Uteq, HTML/CSS/JS by MKBWatersport 
    Using alpine.js for interactivity.
-->

<div>
    <ul class="mkbws-products-menu">
        <?php foreach (get_mkb_wc_grouped_product_categories() as $category) : ?>

            <!-- Main menu item -->
            <li class="mkbws-products-menu-li" data-id="<?php echo $category->term_id; ?>" x-data="{ isTouched : false, subMenuOpen : false, mouseAtSubmenu : false, mouseAtMainmenu  : false, timeoutLeave : null, timeoutEnterSub : null, categoryLink : '<?php echo get_category_link($category->term_id); ?>', submenuClose() {this.subMenuOpen = false}}" @mouseenter="mouseAtMainmenu = true, timeoutEnterSub = setTimeout(() => {subMenuOpen = true}, 290), clearTimeout(timeoutLeave)" @mouseleave="mouseAtMainmenu = false, timeoutLeave = setTimeout(() => {submenuClose()}, 300), clearTimeout(timeoutEnterSub)" @touchstart.outside="isTouched = false, subMenuOpen = false" @touchstart="isTouched = true, subMenuOpen = true">
                <div class="mkbws-menu-main-cat-dropdown">
                    <a href="<?php echo get_category_link($category->term_id); ?>" class="menu-link menu-link-item" @touchstart.prevent="isTouched">
                        <div class="mkbws-main-menu-title">
                            <?php echo $category->name; ?>
                        </div>
                    </a>
                    <!-- Dropdown chevron -->
                    <i x-show="!subMenuOpen" class="fas fa-chevron-down" style="color: var(--e-global-color-47cd240); font-size: 10px;"></i>
                    <i x-show="subMenuOpen" class="fas fa-chevron-up" style="color: var(--e-global-color-47cd240); font-size: 10px;"></i>

                </div>

                <!-- Submenu elements -->
                <div x-cloak x-show="subMenuOpen" @mouseenter="mouseAtSubmenu = true, mouseAtMainmenu = false, clearTimeout(timeoutLeave)" @mouseleave="mouseAtSubmenu = false" class="subcategory-container" id="mkbws-submenu-container-<?php echo $category->term_id; ?>" data-id="submenu-<?php echo $category->term_id; ?>">
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

                        <div 
                            :class="subMenuOpen ? 'helpdesk-visible' : 'helpdesk-hidden' " 
                            class="helpdesk" 
                            x-data
                        >
                            <span class="helpdesk-header">
                                <img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/aartjan.jpeg" style="width: 40px; height: 40px; border-radius: 50%;" />
                                <h3 style="color: white; line-height: 1em; padding-top: 5px;">Hulp nodig?</h3>
                            </span>
                            <p x-show="$store.officeHours.storeIsOpen">
                                Onze klantenservice is <b style="color:lime;">bereikbaar</b>
                            </p>
                            <p x-show="!$store.officeHours.storeIsOpen">
                                We zijn er 
                                <b x-show="$store.officeHours.dayOfTheWeek >= 5 || $store.officeHours.dayOfTheWeek == 0">maandag</b>
                                <b x-show="$store.officeHours.dayOfTheWeek >= 1 && $store.officeHours.dayOfTheWeek < 5 && $store.officeHours.hourOfTheDay > 16">morgen</b>
                                <b x-show="($store.officeHours.dayOfTheWeek >= 1 || $store.officeHours.dayOfTheWeek <= 5) && $store.officeHours.hourOfTheDay < 9">vanmorgen</b>
                                weer vanaf <b>09:00 uur</b>
                            </p>
                            <ul class="helpdesk-list">
                                <li x-show="$store.officeHours.storeIsOpen" class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/telefoon-icon.svg" /> <a href="tel:+31757572600" id="helpdesk-call" target="_blank">075-7572600</a></li>
                                <li x-show="$store.officeHours.storeIsOpen" class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/chat-icon-wit.svg" /> <span onclick="Belco.open('chat')" id="helpdesk-chat">Chat starten </span></li>
                                <li x-show="$store.officeHours.storeIsOpen" class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/whatsapp-icon.svg" /> <a href="https://wa.me/31757572600" id="helpdesk-whatsapp" target="_blank">WhatsApp</a></li>
                                <li class="helpdesk-item"><img src="<?php echo home_url(); ?>/wp-content/themes/hello-theme-child-master/images/email-icon-wit.svg" /> <a href="mailto:info@sailspecials.nl" id="helpdesk-email" target="_blank">E-mail sturen</a></li>
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

    .mkbws-products-menu {
        font-family: var(--e-global-typography-text-font-family), proxima-nova, arial, sans-serif !important;
        z-index: 999;
    }

    ul.mkbws-products-menu {
        display: flex;
        align-items: stretch;
        flex-wrap: nowrap;
        padding-inline-start: 0;
        justify-content: flex-start;
        gap: 0px;
    }

    .mkbws-menu-main-cat-dropdown {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        gap: 0px;
        margin-top: auto;
        position: relative;
    }

    ul.subcategory {
        display: grid;
        background-color: var(--e-global-color-secondary);
        grid-gap: 10px;
        padding: 10px;
        margin: 0;
        grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
        width: 100%;
        grid-auto-rows: max-content;
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
        transition-delay: 0.1s;
        transition-duration: 0.3s;
        box-shadow: 0px 0px 0px -5px black;
    }

    li.subcategory-li:hover {
        box-shadow: 0px 3px 5px -5px black;
    }

    .subcategory-container {
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

    li.mkbws-products-menu-li {
        display: flex;
        list-style-type: none;
        padding: 5px 10px;
        background-color: var(--e-global-color-secondary);
        text-align: center;
    }

    li.mkbws-products-menu-li:hover {
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
        font-size: 15px;
        font-weight: bold;
        color: var(--e-global-color-text);
        font-family: var(--e-global-typography-6cbb609-font-family);
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

<script src="https://unpkg.com/alpinejs@3.10.4/dist/cdn.min.js" async></script>

<script type="application/javascript" async>
    var officeTimes = {
        dailyOpenFrom : 9,
        dailtOpenTo : 16,
        weeklyOpenFrom : 1,
        weeklyOpenTo : 5,
        currentDate : function() {return new Date()},
        currentDay : function() {return this.currentDate().getDay()},
        currentHour : function() {return this.currentDate().getHours()}
    }

    let isStoreOpen = function() {
        const isBetweenOpenDays = officeTimes.currentDay() >= officeTimes.weeklyOpenFrom && officeTimes.currentDay() <= officeTimes.weeklyOpenTo;
        const isBetweenOpenHours = officeTimes.currentHour() >= officeTimes.dailyOpenFrom && officeTimes.currentHour() <= officeTimes.dailtOpenTo;

        return (
            isBetweenOpenDays && isBetweenOpenHours )
    }

    document.addEventListener('alpine:init', () => {
        Alpine.store('officeHours', {
            storeIsOpen: isStoreOpen(),
            dayOfTheWeek : officeTimes.currentDay(),
            hourOfTheDay : officeTimes.currentHour(),
        })
    })
</script>