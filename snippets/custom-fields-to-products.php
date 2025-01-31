<?php

/*
Add custom fields to product page in WooCommerce:

1. Install the Advanced Custom Fields (ACF) plugin (https://es.wordpress.org/plugins/advanced-custom-fields/).
2. Create a field group and add the fields you want to display on the product page.
3. Add the code to functions.php or from Code Snippets snippets (https://es.wordpress.org/plugins/code-snippets/).
*/

/* Add Font Awesome to WordPress */

function enqueue_font_awesome()
{
    wp_enqueue_style('font-awesome', 'https://jarchcompany.com/wp-content/font-awesome/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');



// Hooks the function `acf_producto` to the `woocommerce_product_meta_start` action. This action is triggered at the beginning of the product meta section in WooCommerce product pages.
add_action('woocommerce_product_meta_start', "acf_producto");

// Defines the function `acf_producto` that will be executed when the `woocommerce_product_meta_start` action is triggered.
function acf_producto()
{
    // Checks if the current page is a product page and the ACF (Advanced Custom Fields) plugin's `get_field` function exists.
    if (is_product() && function_exists('get_field')) {
        // Defines an associative array mapping field keys (from ACF) to their respective labels to be displayed on the product page.
        $fields = [
            /*Visual*/
            'tinta' => 'Tinta',
            'resolucion' => 'Resolución',
            'cabezal' => 'Cabezal',
            'cantidad_cabezales' => 'Cantidad cabezales',
            'picolitro' => 'Picolitro',
            'tamano_impresion' => 'Tamaño impresión',
            'color' => 'Color',

            /*Packing y Arquitectura*/
            'precision' => 'Precisión',
            'fuerza' => 'Fuerza',
            'velocidad' => 'Velocidad',
            'conexion' => 'Conexión',
            'panel_de_control' => 'Panel de control',
            'area_corte' => 'Área corte',
            'potencia' => 'Potencia',
            'temperatura' => 'Temperatura',

            /* Textil */
            'tinta_2' => 'Tinta',
            'resolucion_2' => 'Resolución',
            'cabezal_2' => 'Cabezal',
            'cantidad_cabezales_2' => 'Cantidad cabezales',
            'picolitro_2' => 'Picolitro',
            'tamano_impresion_2' => 'Tamaño impresión',
            'color_2' => 'Color',
            'velocidad_2' => 'Velocidad',
            'temperatura_2' => 'Temperatura',
            'potencia_2' => 'Potencia',

            /* Metalmecánica */
            'precision_2' => 'Precisión',
            'conexion_2' => 'Conexión',
            'area_corte_2' => 'Área corte',
            'potencia_2' => 'Potencia'

        ];

        // Iterates over each field defined in the `$fields` array.
        foreach ($fields as $field_key => $field_label) {
            // Retrieves the value of the current field using ACF's `get_field` function.
            $field_value = get_field($field_key);
            // Checks if the field has a value.
            if ($field_value) {
                // Outputs the field label and value in a paragraph tag.
                echo "<p><strong>$field_label: </strong>" . $field_value . "</p>";
            }
        }

        // Adds the link to download the technical sheet.
        $file = get_field('descargar_ficha_tecnica');
        if ($file) {
            $url = wp_get_attachment_url($file);
            /*echo '<p><a style=" font-weight: 600;">Ficha técnica: </a><a href="' . esc_html($url) . '" target="_blank" style="color: #00A0E0;" >Descargar</a></p>';*/

            echo '<p><a href="' . esc_html($url) . '" target="_blank"><button style="background-color: #ff0000d8; color: #fff; border: none; padding: 10px 20px; font-size: 13px; border-radius: 50px; cursor: pointer; font-weight: 500; text-transform: none;"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #ffffff;"></i> Descargar ficha técnica</button></a></p>';
        }
    }
}
