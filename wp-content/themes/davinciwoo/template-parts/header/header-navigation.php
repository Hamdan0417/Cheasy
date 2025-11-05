<?php
/**
 * Primary navigation and mega menu layout inspired by AliExpress styling.
 */

$menu_locations   = get_nav_menu_locations();
$has_category_nav = has_nav_menu( 'slider_menu' );
$has_primary_nav  = has_nav_menu( 'top_menu' );

if ( ! $has_category_nav && ! $has_primary_nav ) {
    return;
}

$category_tree = [];

if ( $has_category_nav ) {
    $menu_id    = $menu_locations['slider_menu'] ?? 0;
    $menu_items = $menu_id ? wp_get_nav_menu_items( $menu_id ) : [];

    if ( $menu_items ) {
        $menu_nodes = [];

        foreach ( $menu_items as $menu_item ) {
            $menu_nodes[ $menu_item->ID ] = [
                'item'      => $menu_item,
                'children'  => [],
            ];
        }

        foreach ( $menu_nodes as $id => &$node ) {
            $parent_id = (int) $node['item']->menu_item_parent;

            if ( $parent_id && isset( $menu_nodes[ $parent_id ] ) ) {
                $menu_nodes[ $parent_id ]['children'][] =& $node;
            }
        }
        unset( $node );

        foreach ( $menu_nodes as $node ) {
            if ( (int) $node['item']->menu_item_parent === 0 ) {
                $category_tree[] = $node;
            }
        }
    }
}
?>
<div class="ali-navigation-bar">
    <div class="container">
        <div class="ali-navigation-bar__inner">
            <?php if ( $has_category_nav && ! empty( $category_tree ) ) : ?>
                <div class="ali-mega-menu" data-ali-mega-menu>
                    <button class="ali-mega-menu__toggle" type="button" data-ali-mega-toggle aria-expanded="false">
                        <span class="ali-mega-menu__toggle-icon" aria-hidden="true"><span></span></span>
                        <span class="ali-mega-menu__toggle-label"><?php esc_html_e( 'Browse categories', 'davinciwoo' ); ?></span>
                    </button>
                    <div class="ali-mega-menu__dropdown">
                        <ul class="ali-mega-menu__list" role="menubar">
                            <?php foreach ( $category_tree as $node ) :
                                $menu_item     = $node['item'];
                                $children      = $node['children'];
                                $has_children  = ! empty( $children );
                                $panel_id      = 'ali-mega-panel-' . absint( $menu_item->ID );
                                ?>
                                <li class="ali-mega-menu__item<?php echo $has_children ? ' has-children' : ''; ?>" role="none">
                                    <a class="ali-mega-menu__category-link" role="menuitem" href="<?php echo esc_url( $menu_item->url ?: '#' ); ?>"<?php echo $has_children ? ' aria-haspopup="true" aria-expanded="false" aria-controls="' . esc_attr( $panel_id ) . '"' : ''; ?>>
                                        <span><?php echo esc_html( $menu_item->title ); ?></span>
                                        <?php if ( $has_children ) : ?>
                                            <span class="ali-mega-menu__chevron" aria-hidden="true"></span>
                                        <?php endif; ?>
                                    </a>
                                    <?php if ( $has_children ) : ?>
                                        <div class="ali-mega-menu__panel" id="<?php echo esc_attr( $panel_id ); ?>" role="group" aria-label="<?php echo esc_attr( $menu_item->title ); ?>">
                                            <div class="ali-mega-menu__panel-inner">
                                                <?php foreach ( $children as $child_node ) :
                                                    $child_item     = $child_node['item'];
                                                    $grand_children = $child_node['children'];
                                                    ?>
                                                    <div class="ali-mega-menu__column">
                                                        <a class="ali-mega-menu__column-title" href="<?php echo esc_url( $child_item->url ?: '#' ); ?>">
                                                            <?php echo esc_html( $child_item->title ); ?>
                                                        </a>
                                                        <?php if ( ! empty( $grand_children ) ) : ?>
                                                            <ul class="ali-mega-menu__links">
                                                                <?php foreach ( $grand_children as $grandchild_node ) :
                                                                    $grandchild_item = $grandchild_node['item'];
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo esc_url( $grandchild_item->url ?: '#' ); ?>">
                                                                            <?php echo esc_html( $grandchild_item->title ); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $has_primary_nav ) : ?>
                <nav class="ali-top-links" aria-label="<?php esc_attr_e( 'Primary navigation', 'davinciwoo' ); ?>">
                    <?php
                    wp_nav_menu(
                        [
                            'theme_location' => 'top_menu',
                            'container'      => false,
                            'menu_class'     => 'ali-top-links__list',
                            'depth'          => 2,
                            'fallback_cb'    => false,
                        ]
                    );
                    ?>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>
