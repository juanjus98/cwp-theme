<?php
/**
 * Template part form
 *
 * @package BasherTheme
 */

// Obtener la página de contacto en el idioma actual
$contact_page_id = null;

if (function_exists('pll_get_post')) {
    // Si Polylang está activo, obtener la página de contacto en el idioma actual
    $contact_pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-contactus.php'
    ));

    if (!empty($contact_pages)) {
        foreach ($contact_pages as $page) {
            if ($translated_id = pll_get_post($page->ID)) {
                $contact_page_id = $translated_id;
                break;
            }
        }
    }
} else {
    // Si Polylang no está activo, buscar la página de contacto directamente
    $contact_pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-contactus.php'
    ));

    if (!empty($contact_pages)) {
        $contact_page_id = $contact_pages[0]->ID;
    }
}
// Obtener el título y el ID del formulario
$contact_title = $contact_page_id ? get_the_title($contact_page_id) : __('Contáctanos', 'BasherTheme');
$form_id = $contact_page_id ? carbon_get_post_meta($contact_page_id, 'crb_contact_form') : '';
?>
<section class="sec-form bg-image">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cont-desc">
                    <h2 class="header-2 text-white title-motion">
                        <?php echo esc_html($contact_title); ?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (!empty($form_id)) {
                    echo do_shortcode('[contact-form-7 id="' . esc_attr($form_id) . '"]');
                } else {
                    echo '<p class="text-white">' . esc_html__('No se ha seleccionado ningún formulario de contacto.', 'BasherTheme') . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>