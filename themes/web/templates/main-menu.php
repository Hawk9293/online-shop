<div class="banner-top">
    <div class="container">
        <?php
        // свой класс построения меню:
        class walker_menu extends Walker_Nav_Menu {

            // add classes to ul sub-menus
            function start_lvl( &$output, $depth = 0, $args = array() ) {
                // depth dependent classes
                $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
                $display_depth = ( $depth + 1); // because it counts the first submenu as 0
                $classes = array(
                    'dropdown-menu',
                    ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
                    ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
                    'menu-depth-' . $display_depth
                );
                $class_names = implode( ' ', $classes );

                // build html
                $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
            }

            // add main/sub classes to li's and links
            function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
                global $wp_query;
                $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

                // depth dependent classes
                $depth_classes = array(
                    ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
                    ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
                    ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
                    'menu-item-depth-' . $depth
                );
                $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

                // passed classes
                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

                // build html
                $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="dropdown">';

                // link attributes
                $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
                $attributes .= ' class="dropdown-toggle" data-toggle="dropdown" ';

                $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                    $args->before,
                    $attributes,
                    $args->link_before,
                    apply_filters( 'the_title', $item->title, $item->ID ),
                    $args->link_after,
                    $args->after
                );

                // build html
                $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
        }
        ?>



        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo">
                    <h1><a href="index.php"><span>E</span> -Shop</a></h1>
                </div>
            </div>
            <!--/.navbar-header-->
            <?php
            wp_nav_menu([
                'theme_location'  => 'header_menu',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'menu_class' => 'nav navbar-nav',
                'walker' => new walker_menu,
            ]);
            ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Men <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="multi-column-dropdown">
                                        <h6>NEW IN</h6>
                                        <li><a href="products.html">New In Clothing</a></li>
                                        <li><a href="products.html">New In Bags</a></li>
                                        <li><a href="products.html">New In Shoes</a></li>
                                        <li><a href="products.html">New In Watches</a></li>
                                        <li><a href="products.html">New In Grooming</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="multi-column-dropdown">
                                        <h6>CLOTHING</h6>
                                        <li><a href="products.html">Polos & Tees</a></li>
                                        <li><a href="products.html">Casual Shirts</a></li>
                                        <li><a href="products.html">Casual Trousers</a></li>
                                        <li><a href="products.html">Jeans</a></li>
                                        <li><a href="products.html">Shorts & 3/4th</a></li>
                                        <li><a href="products.html">Formal Shirts</a></li>
                                        <li><a href="products.html">Formal Trousers</a></li>
                                        <li><a href="products.html">Suits & Blazers</a></li>
                                        <li><a href="products.html">Track Wear</a></li>
                                        <li><a href="products.html">Inner Wear</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="multi-column-dropdown">
                                        <h6>WATCHES</h6>
                                        <li><a href="products.html">Analog</a></li>
                                        <li><a href="products.html">Chronograph</a></li>
                                        <li><a href="products.html">Digital</a></li>
                                        <li><a href="products.html">Watch Cases</a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">women <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <ul class="multi-column-dropdown">
                                        <h6>NEW IN</h6>
                                        <li><a href="products.html">New In Clothing</a></li>
                                        <li><a href="products.html">New In Bags</a></li>
                                        <li><a href="products.html">New In Shoes</a></li>
                                        <li><a href="products.html">New In Watches</a></li>
                                        <li><a href="products.html">New In Beauty</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="multi-column-dropdown">
                                        <h6>CLOTHING</h6>
                                        <li><a href="products.html">Polos & Tees</a></li>
                                        <li><a href="products.html">Casual Shirts</a></li>
                                        <li><a href="products.html">Casual Trousers</a></li>
                                        <li><a href="products.html">Jeans</a></li>
                                        <li><a href="products.html">Shorts & 3/4th</a></li>
                                        <li><a href="products.html">Formal Shirts</a></li>
                                        <li><a href="products.html">Formal Trousers</a></li>
                                        <li><a href="products.html">Suits & Blazers</a></li>
                                        <li><a href="products.html">Track Wear</a></li>
                                        <li><a href="products.html">Inner Wear</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="multi-column-dropdown">
                                        <h6>WATCHES</h6>
                                        <li><a href="products.html">Analog</a></li>
                                        <li><a href="products.html">Chronograph</a></li>
                                        <li><a href="products.html">Digital</a></li>
                                        <li><a href="products.html">Watch Cases</a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">kids <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-column columns-2">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="multi-column-dropdown">
                                        <h6>NEW IN</h6>
                                        <li><a href="products.html">New In Boys Clothing</a></li>
                                        <li><a href="products.html">New In Girls Clothing</a></li>
                                        <li><a href="products.html">New In Boys Shoes</a></li>
                                        <li><a href="products.html">New In Girls Shoes</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="multi-column-dropdown">
                                        <h6>ACCESSORIES</h6>
                                        <li><a href="products.html">Bags</a></li>
                                        <li><a href="products.html">Watches</a></li>
                                        <li><a href="products.html">Sun Glasses</a></li>
                                        <li><a href="products.html">Jewellery</a></li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </ul>
                    </li>
                    <li><a href="typography.html">TYPO</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
                </ul>
            </div>
            <!--/.navbar-collapse-->
        </nav>
        <!--/.navbar-->
    </div>
</div>