    </div><!-- #content -->

    <footer class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <?php if (is_active_sidebar('footer-1')): ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="site-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
                <p><?php
                    printf(
                        esc_html__('Powered by %s', 'my-custom-theme'),
                        '<a href="https://wordpress.org">WordPress</a>'
                    );
                ?></p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
