<?php get_header(); ?>



                        <?php
                                if(has_nav_menu('primary'))
                                    { wp_nav_menu(array(
                                        'theme_location'  => 'primary',
                                        'container'       => 'div',
                                        'menu_class'      => 'nav navbar-nav',
                                        'menu_id'         => 'primary',
                                        'echo'            => true,
                                        'fallback_cb'     => 'wp_page_menu',
                                        'before'          => '',
                                        'after'           => '',
                                        'link_before'     => '',
                                        'link_after'      => '',
                                        'depth'           => 0,
                                        'walker'          => new wp_bootstrap_navwalker()
                                    )); 
                                }
                            ?>
                   







 <?php get_footer(); ?>  
