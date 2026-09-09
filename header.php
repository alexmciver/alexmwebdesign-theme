    <header class="site-header">
     <div class="container">
        <nav class="site-navigation">
        <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary-menu',
                        'menu_class'     => 'site-navigation__menu',
                    ) );
                    ?>
        </nav>
     </div>
    </header>