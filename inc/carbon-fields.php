<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action('carbon_fields_register_fields', 'create_frontpage_fields');
function create_frontpage_fields()
{
    // Front page and B Content template
    Container::make('post_meta', __('Configuración Hero'))
        ->where('post_type', '=', 'page')
        ->where(function ($condition) {
            $condition->or_where('post_id', '=', get_option('page_on_front'))
                ->or_where('post_template', '=', 'page-b-content.php');
        })
        ->add_tab(__('Contenido'), array(
            Field::make('text', 'hero_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('textarea', 'hero_subtitle', 'Subtítulo Hero')
                ->set_attribute('maxLength', 160)
                ->set_help_text('Máximo 160 caracteres')
                ->set_attribute('data-maxchars', '160')
        ))
        ->add_tab(__('Imágenes'), array(
            Field::make('image', 'hero_image_des', 'Desktop')
                ->set_required(true)
                ->set_help_text('Dimensiones: 1920x1080px')
                ->set_attribute('data-dimensions', '1920x1080'),
            Field::make('image', 'hero_image_rsp', 'Responsive')
                ->set_required(true)
                ->set_help_text('Dimensiones: 768x1024px')
                ->set_attribute('data-dimensions', '768x1024')
        ))
        ->add_tab(__('Botón'), array(
            Field::make('text', 'hero_cta_text', 'Texto CTA')
                ->set_required(true)
                ->set_attribute('maxLength', 20)
                ->set_help_text('Máximo 20 caracteres')
                ->set_attribute('data-maxchars', '20'),
            Field::make('text', 'hero_cta_url', 'Url CTA')
                ->set_required(true)
                ->set_attribute('type', 'url')
                ->set_help_text('Incluir https://')
                ->set_attribute('data-format', 'url'),
            Field::make('select', 'hero_cta_target', 'Abrir enlace en')
                ->add_options(array(
                    '_self' => 'Misma ventana',
                    '_blank' => 'Nueva ventana'
                ))
                ->set_default_value('_self')
        ));

    // Sections configure
    Container::make('post_meta', __('Configuración de secciones'))
        ->where('post_type', '=', 'page')
        ->where('post_id', '=', get_option('page_on_front'))
        ->add_tab(__('Sección servicios'), array(
            Field::make('select', 'services_section_active', 'Estado de la sección')
                ->add_options(array(
                    'inactive' => 'Desactivado',
                    'active' => 'Activado'
                ))
                ->set_default_value('active'),
            Field::make('text', 'services_section_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('text', 'services_section_subtitle', 'Subtítulo')
                ->set_attribute('maxLength', 60)
                ->set_help_text('Máximo 60 caracteres')
                ->set_attribute('data-maxchars', '60'),
            Field::make('textarea', 'services_section_description', 'Descripción')
                ->set_attribute('maxLength', 200)
                ->set_help_text('Máximo 200 caracteres')
                ->set_attribute('data-maxchars', '200')
        ))
        ->add_tab(__('Sección talentos'), array(
            Field::make('select', 'talents_section_active', 'Estado de la sección')
                ->add_options(array(
                    'inactive' => 'Desactivado',
                    'active' => 'Activado'
                ))
                ->set_default_value('active'),
            Field::make('text', 'talents_section_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('text', 'talents_section_subtitle', 'Subtítulo')
                ->set_attribute('maxLength', 60)
                ->set_help_text('Máximo 60 caracteres')
                ->set_attribute('data-maxchars', '60'),
            Field::make('textarea', 'talents_section_description', 'Descripción')
                ->set_attribute('maxLength', 200)
                ->set_help_text('Máximo 200 caracteres')
                ->set_attribute('data-maxchars', '200')
        ))
        ->add_tab(__('Sección slider 1'), array(
            Field::make('select', 'slider1_section_active', 'Estado de la sección')
                ->add_options(array(
                    'inactive' => 'Desactivado',
                    'active' => 'Activado'
                ))
                ->set_default_value('active'),
            Field::make('text', 'slider1_section_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('text', 'slider1_section_subtitle', 'Subtítulo')
                ->set_attribute('maxLength', 60)
                ->set_help_text('Máximo 60 caracteres')
                ->set_attribute('data-maxchars', '60'),
            Field::make('textarea', 'slider1_section_description', 'Descripción')
                ->set_attribute('maxLength', 200)
                ->set_help_text('Máximo 200 caracteres')
                ->set_attribute('data-maxchars', '200')
        ))
        ->add_tab(__('Sección slider 2'), array(
            Field::make('select', 'slider2_section_active', 'Estado de la sección')
                ->add_options(array(
                    'inactive' => 'Desactivado',
                    'active' => 'Activado'
                ))
                ->set_default_value('active'),
            Field::make('text', 'slider2_section_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('text', 'slider2_section_subtitle', 'Subtítulo')
                ->set_attribute('maxLength', 60)
                ->set_help_text('Máximo 60 caracteres')
                ->set_attribute('data-maxchars', '60'),
            Field::make('textarea', 'slider2_section_description', 'Descripción')
                ->set_attribute('maxLength', 200)
                ->set_help_text('Máximo 200 caracteres')
                ->set_attribute('data-maxchars', '200')
        ));

    // Post type service
    Container::make('post_meta', __('Configuración Servicio'))
        ->where('post_type', '=', 'service')
        ->add_tab(__('Card'), array(
            Field::make('text', 'service_card_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 60)
                ->set_help_text('Máximo 60 caracteres')
                ->set_attribute('data-maxchars', '60'),
            Field::make('textarea', 'service_card_description', 'Descripción')
                ->set_attribute('maxLength', 100)
                ->set_help_text('Máximo 100 caracteres')
                ->set_attribute('data-maxchars', '100'),
            Field::make('image', 'service_card_image', 'Imagen')
                ->set_required(true)
                ->set_help_text('Dimensiones: 214x420px')
                ->set_attribute('data-dimensions', '214x420'),
            Field::make('select', 'service_card_featured', 'Destacar')
                ->add_options(array(
                    'no' => 'No',
                    'yes' => 'Si'
                ))
                ->set_default_value('no'),
            Field::make('text', 'service_card_order', 'Orden')
                ->set_attribute('type', 'number')
                ->set_attribute('min', '0')
                ->set_attribute('data-type', 'numeric')
                ->set_default_value('0')
        ));

    // Post type client
    Container::make('post_meta', __('Configuración Cliente'))
        ->where('post_type', '=', 'client')
        ->add_tab(__('Card'), array(
            Field::make('text', 'client_card_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('textarea', 'client_card_description', 'Descripción')
                ->set_attribute('maxLength', 100)
                ->set_help_text('Máximo 100 caracteres')
                ->set_attribute('data-maxchars', '100'),
            Field::make('image', 'client_card_image', 'Logo')
                ->set_required(true)
                ->set_help_text('Dimensiones: 190x62px')
                ->set_attribute('data-dimensions', '190x62'),
            Field::make('select', 'client_card_featured', 'Destacar')
                ->add_options(array(
                    'no' => 'No',
                    'yes' => 'Si'
                ))
                ->set_default_value('no'),
            Field::make('text', 'client_card_order', 'Orden')
                ->set_attribute('type', 'number')
                ->set_attribute('min', '0')
                ->set_attribute('data-type', 'numeric')
                ->set_default_value('0')
        ));

    // Post type talent
    Container::make('post_meta', __('Configuración Talento'))
        ->where('post_type', '=', 'talent')
        ->add_tab(__('Card'), array(
            Field::make('text', 'talent_card_title', 'Nombre')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('textarea', 'talent_card_description', 'Descripción')
                ->set_attribute('maxLength', 100)
                ->set_help_text('Máximo 100 caracteres')
                ->set_attribute('data-maxchars', '100'),
            Field::make('image', 'talent_card_image', 'Foto')
                ->set_required(true)
                ->set_help_text('Dimensiones: 268x420px')
                ->set_attribute('data-dimensions', '268x420'),
            Field::make('select', 'talent_card_featured', 'Destacar')
                ->add_options(array(
                    'no' => 'No',
                    'yes' => 'Si'
                ))
                ->set_default_value('no'),
            Field::make('text', 'talent_card_order', 'Orden')
                ->set_attribute('type', 'number')
                ->set_attribute('min', '0')
                ->set_attribute('data-type', 'numeric')
                ->set_default_value('0')
        ));

    // Post type slider
    Container::make('post_meta', 'Configuración Slider')
        ->where('post_type', '=', 'slider')
        ->add_tab('Card', array(
            Field::make('select', 'slider_card_type', 'Tipo')
                ->set_required(true)
                ->add_options(array(
                    'image' => 'Imagen',
                    'text' => 'Texto'
                ))
                ->set_default_value('image'),
            Field::make('text', 'slider_card_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('textarea', 'slider_card_description', 'Descripción')
                ->set_attribute('maxLength', 500)
                ->set_attribute('data-maxchars', '500'),
            Field::make('image', 'slider_card_image', 'Imagen')
                ->set_help_text('Dimensiones: 710x488px')
                ->set_attribute('data-dimensions', '710x488'),
            Field::make('image', 'slider_card_logo', 'Logo'),
            Field::make('select', 'slider_card_featured', 'Destacar')
                ->add_options(array(
                    'no' => 'No',
                    'yes' => 'Si'
                ))
                ->set_default_value('no'),
            Field::make('text', 'slider_card_order', 'Orden')
                ->set_attribute('type', 'number')
                ->set_attribute('min', '0')
                ->set_attribute('data-type', 'numeric')
                ->set_default_value('0')
        ));

    // Sección Cards
    Container::make('post_meta', __('Sección Cards'))
        ->where('post_type', '=', 'page')
        ->where(function ($condition) {
            $condition->or_where('post_template', '=', 'page-services.php')
                ->or_where('post_template', '=', 'page-b-content.php')->or_where('post_template', '=', 'page-workus.php');
        })
        ->add_tab(__('Información'), array(
            Field::make('text', 'services_title', __('Título'))
                ->set_required(true)
                ->set_help_text('Este campo es obligatorio'),
            Field::make('textarea', 'services_description', __('Descripción'))
                ->set_help_text('Este campo es opcional')
        ))
        ->add_tab(__('Cards'), array(
            Field::make('complex', 'services_cards', __('Cards'))
                ->add_fields(array(
                    Field::make('text', 'card_title', __('Título'))
                        ->set_required(true)
                        ->set_help_text('Este campo es obligatorio'),
                    Field::make('textarea', 'card_description', __('Descripción'))
                        ->set_help_text('Este campo es opcional'),
                    Field::make('image', 'card_image', __('Imagen'))
                        ->set_value_type('id')
                        ->set_help_text('Selecciona una imagen para el card')
                ))
                ->set_max(10)
                ->set_layout('grid')
                ->set_header_template('<%- card_title %>')
        ));

    // Sección FAQs
    Container::make('post_meta', __('Sección FAQs'))
        ->where('post_template', '=', 'page-services.php')
        ->add_tab(__('Información'), array(
            Field::make('text', 'faqs_title', __('Título'))
                ->set_required(true)
                ->set_help_text('Este campo es obligatorio'),
            Field::make('textarea', 'faqs_description', __('Descripción'))
                ->set_help_text('Este campo es opcional')
        ))
        ->add_tab(__('Preguntas'), array(
            Field::make('complex', 'faqs_items', __('Preguntas Frecuentes'))
                ->add_fields(array(
                    Field::make('text', 'faq_question', __('Pregunta'))
                        ->set_required(true)
                        ->set_help_text('Escribe la pregunta'),
                    Field::make('textarea', 'faq_answer', __('Respuesta'))
                        ->set_required(true)
                        ->set_help_text('Escribe la respuesta')
                ))
                ->set_max(20) // Aumentado a 20 FAQs
                ->set_layout('grid')
                ->set_header_template('<%- faq_question %>')
        ));

    // Sección Logos
    Container::make('post_meta', __('Sección Logos'))
        ->where('post_template', '=', 'page-b-content.php')
        ->add_tab(__('Información'), array(
            Field::make('text', 'logos_title', __('Título'))
                ->set_required(true)
                ->set_help_text('Este campo es obligatorio'),
            Field::make('textarea', 'logos_description', __('Descripción'))
                ->set_help_text('Este campo es opcional')
        ))
        ->add_tab(__('Logos'), array(
            Field::make('complex', 'logos_items', __('Logos'))
                ->add_fields(array(
                    Field::make('text', 'logo_name', __('Nombre del Logo'))
                        ->set_required(true)
                        ->set_help_text('Este campo es obligatorio. Será usado como texto alternativo.'),
                    Field::make('image', 'logo_image', __('Imagen del Logo'))
                        ->set_required(true)
                        ->set_value_type('id')
                        ->set_help_text('Dimensiones recomendadas: 200x100px'),
                    Field::make('text', 'logo_url', __('URL'))
                        ->set_attribute('type', 'url')
                        ->set_help_text('Opcional. URL del sitio web del logo.')
                ))
                ->set_max(4) // Limitamos a un máximo de 4 logos
                ->set_layout('grid')
                ->set_header_template('<%- logo_name %>')
        ));

    // Sección Jumbotron
    Container::make('post_meta', __('Sección Jumbotron'))
        ->where('post_type', '=', 'page')
        ->where('post_template', '=', 'page-b-content.php')
        ->add_tab(__('Contenido'), array(
            Field::make('text', 'jumbotron_title', 'Título')
                ->set_required(true)
                ->set_attribute('maxLength', 40)
                ->set_help_text('Máximo 40 caracteres')
                ->set_attribute('data-maxchars', '40'),
            Field::make('textarea', 'jumbotron_subtitle', 'Subtítulo Jumbotron')
                ->set_attribute('maxLength', 500)
                ->set_help_text('Máximo 500 caracteres')
                ->set_attribute('data-maxchars', '500')
        ))

        ->add_tab(__('Botón'), array(
            Field::make('text', 'jumbotron_cta_text', 'Texto CTA')
                ->set_required(true)
                ->set_attribute('maxLength', 20)
                ->set_help_text('Máximo 20 caracteres')
                ->set_attribute('data-maxchars', '20'),
            Field::make('text', 'jumbotron_cta_url', 'Url CTA')
                ->set_required(true)
                ->set_attribute('type', 'url')
                ->set_help_text('Incluir https://')
                ->set_attribute('data-format', 'url'),
            Field::make('select', 'jumbotron_cta_target', 'Abrir enlace en')
                ->add_options(array(
                    '_self' => 'Misma ventana',
                    '_blank' => 'Nueva ventana'
                ))
                ->set_default_value('_self')
        ));

    //Sección Iconos
    Container::make('post_meta', __('Sección Iconos'))
        ->where('post_type', '=', 'page')
        ->where(function ($condition) {
            $condition->or_where('post_template', '=', 'page-services.php')
                ->or_where('post_template', '=', 'page-b-content.php')
                ->or_where('post_template', '=', 'page-workus.php');
        })
        ->add_tab(__('Información'), array(
            Field::make('text', 'icons_title', __('Título'))
                ->set_required(true)
                ->set_help_text('Este campo es obligatorio'),
            Field::make('textarea', 'icons_description', __('Descripción'))
                ->set_help_text('Este campo es opcional'),
            Field::make('image', 'icons_image', __('Imagen'))
                ->set_value_type('id')
                ->set_help_text('Selecciona una imagen')
        ))
        ->add_tab(__('Iconos'), array(
            Field::make('complex', 'icons_items', __('Iconos'))
                ->add_fields(array(
                    Field::make('text', 'icon_title', __('Título'))
                        ->set_required(true)
                        ->set_help_text('Este campo es obligatorio'),
                    Field::make('textarea', 'icon_description', __('Descripción'))
                        ->set_help_text('Este campo es opcional'),
                    Field::make('image', 'icon_image', __('Imagen'))
                        ->set_value_type('id')
                        ->set_help_text('Selecciona una imagen para el icono')
                ))
                ->set_max(6)
                ->set_layout('grid')
                ->set_header_template('<%- icon_title %>')
        ))
        ->add_tab(__('Botón'), array(
            Field::make('text', 'icons_button_title', __('Título'))
                ->set_help_text('Este campo es opcional'),
            Field::make('textarea', 'icons_button_description', __('Descripción'))
                ->set_help_text('Este campo es opcional'),
            Field::make('text', 'icons_cta_text', 'Texto CTA')
                ->set_attribute('maxLength', 20)
                ->set_help_text('Máximo 20 caracteres. Este campo es opcional')
                ->set_attribute('data-maxchars', '20'),
            Field::make('text', 'icons_cta_url', 'Url CTA')
                ->set_attribute('type', 'url')
                ->set_help_text('Incluir https://. Este campo es opcional')
                ->set_attribute('data-format', 'url'),
            Field::make('select', 'icons_cta_target', 'Abrir enlace en')
                ->add_options(array(
                    '_self' => 'Misma ventana',
                    '_blank' => 'Nueva ventana'
                ))
                ->set_default_value('_self')
        ));

    // Contact page
    Container::make('post_meta', __('Formulario'))
        ->where('post_type', '=', 'page')
        ->where('post_template', '=', 'page-contactus.php')
        ->add_fields(array(
            Field::make('select', 'crb_contact_form', __('Seleccionar Formulario'))
                ->set_options('get_contact_form7_list')
                ->set_help_text('Selecciona el formulario de Contact Form 7 que deseas mostrar en esta página')
        ));
}
