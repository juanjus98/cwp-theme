<?php

/**
 * WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Class WP_Bootstrap_Navwalker
 *
 * @extends Walker_Nav_Menu
 */
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu
{

    /**
     * Starts the list before the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        // Default class to add to the file.
        $classes = array('dropdown-menu');
        $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    /**
     * Starts the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $linkmod_classes = array();
        $icon_classes    = array();

        $classes = self::separate_linkmods_and_icons_from_classes($classes, $linkmod_classes, $icon_classes, $depth);

        $icon_class_string = join(' ', $icon_classes);

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        if (isset($args->has_children) && $args->has_children) {
            $classes[] = 'dropdown';
        }
        if (in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true)) {
            $classes[] = 'active';
        }

        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'nav-item';

        $classes = apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth);

        $class_names = join(' ', $classes);
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel']    = ! empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = ! empty($item->url) ? $item->url : '#';

        if (isset($args->has_children) && $args->has_children && 0 === $depth && $args->depth > 1) {
            $atts['href']          = '#';
            $atts['data-bs-toggle']   = 'dropdown';
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
            $atts['class']         = 'dropdown-toggle nav-link';
            $atts['id']            = 'menu-item-dropdown-' . $item->ID;
        } else {
            $atts['href'] = ! empty($item->url) ? $item->url : '#';
            if ($depth > 0) {
                $atts['class'] = 'dropdown-item';
            } else {
                $atts['class'] = 'nav-link';
            }
        }

        $atts = self::update_atts_for_linkmod_type($atts, $linkmod_classes);
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $linkmod_type = self::get_linkmod_type($linkmod_classes);

        $item_output = isset($args->before) ? $args->before : '';

        if ('' !== $linkmod_type) {
            $item_output .= self::linkmod_element_open($linkmod_type, $attributes);
        } else {
            $item_output .= '<a' . $attributes . '>';
        }

        $icon_html = '';
        if (! empty($icon_class_string)) {
            $icon_html = '<i class="' . esc_attr($icon_class_string) . '" aria-hidden="true"></i> ';
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        if (in_array('sr-only', $linkmod_classes, true)) {
            $title         = self::wrap_for_screen_reader($title);
            $keys_to_unset = array_keys($linkmod_classes, 'sr-only');
            foreach ($keys_to_unset as $k) {
                unset($linkmod_classes[$k]);
            }
        }

        $item_output .= isset($args->link_before) ? $args->link_before . $icon_html . $title . $args->link_after : '';

        if ('' !== $linkmod_type) {
            $item_output .= self::linkmod_element_close($linkmod_type, $attributes);
        } else {
            $item_output .= '</a>';
        }

        $item_output .= isset($args->after) ? $args->after : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a menu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     */
    public static function fallback($args)
    {
        if (current_user_can('edit_theme_options')) {

            $fallback_output = '';

            if (! empty($args['container'])) {
                $fallback_output .= '<' . esc_attr($args['container']);
                if (! empty($args['container_id'])) {
                    $fallback_output .= ' id="' . esc_attr($args['container_id']) . '"';
                }
                if (! empty($args['container_class'])) {
                    $fallback_output .= ' class="' . esc_attr($args['container_class']) . '"';
                }
                $fallback_output .= '>';
            }
            $fallback_output .= '<ul';
            if (! empty($args['menu_id'])) {
                $fallback_output .= ' id="' . esc_attr($args['menu_id']) . '"';
            }
            if (! empty($args['menu_class'])) {
                $fallback_output .= ' class="' . esc_attr($args['menu_class']) . '"';
            }
            $fallback_output .= '>';
            $fallback_output .= '<li><a href="' . esc_url(admin_url('nav-menus.php')) . '" title="' . esc_attr__('Add a menu', 'wp-bootstrap-navwalker') . '">' . esc_html__('Add a menu', 'wp-bootstrap-navwalker') . '</a></li>';
            $fallback_output .= '</ul>';
            if (! empty($args['container'])) {
                $fallback_output .= '</' . esc_attr($args['container']) . '>';
            }

            if (array_key_exists('echo', $args) && $args['echo']) {
                echo $fallback_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            } else {
                return $fallback_output;
            }
        }
    }

    /**
     * Find any custom linkmod or icon classes and store in their holder
     * arrays then remove them from the main classes array.
     *
     * Supported linkmods: .disabled, .dropdown-header, .dropdown-divider, .sr-only
     * Supported iconsets: Font Awesome 4/5, Glypicons
     *
     * NOTE: This accepts the linkmod and icon arrays by reference.
     *
     * @param array   $classes         an array of classes currently assigned to the item.
     * @param array   $linkmod_classes an array to hold linkmod classes.
     * @param array   $icon_classes    an array to hold icon classes.
     * @param integer $depth           an integer holding current depth level.
     *
     * @return array  $classes         a maybe modified array of classnames.
     */
    private function separate_linkmods_and_icons_from_classes($classes, &$linkmod_classes, &$icon_classes, $depth)
    {
        // Loop through $classes array to find linkmod or icon classes.
        foreach ($classes as $key => $class) {
            // If any special classes are found, store the class in it's
            // holder array and and unset the item from $classes.
            if (preg_match('/^disabled|^sr-only/i', $class)) {
                // Test for .disabled or .sr-only classes.
                $linkmod_classes[] = $class;
                unset($classes[$key]);
            } elseif (preg_match('/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class) && $depth > 0) {
                // Test for .dropdown-header or .dropdown-divider and a
                // depth greater than 0 - IE inside a dropdown.
                $linkmod_classes[] = $class;
                unset($classes[$key]);
            } elseif (preg_match('/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class)) {
                // Font Awesome.
                $icon_classes[] = $class;
                unset($classes[$key]);
            } elseif (preg_match('/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class)) {
                // Glyphicons.
                $icon_classes[] = $class;
                unset($classes[$key]);
            }
        }

        return $classes;
    }

    /**
     * Return a string containing a linkmod type and update $atts array
     * accordingly depending on the decided.
     *
     * @param array $linkmod_classes array of any link modifier classes.
     *
     * @return string                empty for default, a linkmod type string otherwise.
     */
    private function get_linkmod_type($linkmod_classes = array())
    {
        $linkmod_type = '';
        // Loop through array of linkmod classes to handle their $atts.
        if (! empty($linkmod_classes)) {
            foreach ($linkmod_classes as $link_class) {
                if (! empty($link_class)) {

                    // Check for special class types and set a flag for them.
                    if ('dropdown-header' === $link_class) {
                        $linkmod_type = 'dropdown-header';
                    } elseif ('dropdown-divider' === $link_class) {
                        $linkmod_type = 'dropdown-divider';
                    } elseif ('dropdown-item-text' === $link_class) {
                        $linkmod_type = 'dropdown-item-text';
                    }
                }
            }
        }
        return $linkmod_type;
    }

    /**
     * Update the attributes of a nav item depending on the limkmod classes.
     *
     * @param array $atts            array of atts for the current link in nav item.
     * @param array $linkmod_classes an array of classes that modify link or nav item behaviors or displays.
     *
     * @return array                 maybe updated array of attributes for item.
     */
    private function update_atts_for_linkmod_type($atts = array(), $linkmod_classes = array())
    {
        if (! empty($linkmod_classes)) {
            foreach ($linkmod_classes as $link_class) {
                if (! empty($link_class)) {
                    // Update $atts with a space and the extra classname...
                    // so long as it's not a sr-only class.
                    if ('sr-only' !== $link_class) {
                        $atts['class'] .= ' ' . esc_attr($link_class);
                    }
                    // Check for special class types we need additional handling for.
                    if ('disabled' === $link_class) {
                        // Convert link to '#' and unset open targets.
                        $atts['href'] = '#';
                        unset($atts['target']);
                    } elseif ('dropdown-header' === $link_class || 'dropdown-divider' === $link_class || 'dropdown-item-text' === $link_class) {
                        // Store a type flag and unset href and target.
                        unset($atts['href']);
                        unset($atts['target']);
                    }
                }
            }
        }
        return $atts;
    }

    /**
     * Wraps the passed text in a screen reader only class.
     *
     * @param string $text the string of text to be wrapped in a screen reader class.
     * @return string      the string wrapped in a span with the class.
     */
    private function wrap_for_screen_reader($text = '')
    {
        if ($text) {
            $text = '<span class="sr-only">' . $text . '</span>';
        }
        return $text;
    }

    /**
     * Returns the correct opening element and attributes for a linkmod.
     *
     * @param string $linkmod_type a sting containing a linkmod type flag.
     * @param string $attributes   a string of attributes to add to the element.
     *
     * @return string              a string with the openign tag for the element with attributes added.
     */
    private function linkmod_element_open($linkmod_type, $attributes = '')
    {
        $output = '';
        if ('dropdown-item-text' === $linkmod_type) {
            $output .= '<span class="dropdown-item-text"' . $attributes . '>';
        } elseif ('dropdown-header' === $linkmod_type) {
            // For a header use a span with the .h6 class instead of a real
            // header tag so that it doesn't confuse screen readers.
            $output .= '<span class="dropdown-header h6"' . $attributes . '>';
        } elseif ('dropdown-divider' === $linkmod_type) {
            // This is a divider.
            $output .= '<div class="dropdown-divider"' . $attributes . '>';
        }
        return $output;
    }

    /**
     * Return the correct closing tag for the linkmod element.
     *
     * @param string $linkmod_type a string containing a special linkmod type.
     *
     * @return string              a string with the closing tag for this linkmod type.
     */
    private function linkmod_element_close($linkmod_type)
    {
        $output = '';
        if ('dropdown-header' === $linkmod_type || 'dropdown-item-text' === $linkmod_type) {
            // For a header use a span with the .h6 class instead of a real
            // header tag so that it doesn't confuse screen readers.
            $output .= '</span>';
        } elseif ('dropdown-divider' === $linkmod_type) {
            // This is a divider.
            $output .= '</div>';
        }
        return $output;
    }
}