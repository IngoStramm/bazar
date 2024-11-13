<?php

add_filter('woocommerce_order_item_name', 'bazar_frontend_order_loja_product', 10, 2);

/**
 * bazar_frontend_order_loja_product
 * 
 * Adiciona a loja do produto após o nome do produto
 *
 * @param  string $item_name
 * @param  object $item
 * @return string
 */
function bazar_frontend_order_loja_product($item_name, $item)
{
    if (isset($item['product_id']) && $item['product_id']) {
        $post_id = $item['product_id'];
        $lojas =  get_the_terms($post_id, 'lojas');
        $item_name = $lojas ? $item_name . ' (' . $lojas[0]->name . ')' : $item_name;
    }
    return $item_name;
}

add_action('woocommerce_before_order_itemmeta', 'bazar_admin_order_loja_product', 10, 3);
/**
 * bazar_admin_order_loja_product
 * 
 * Exibe a loja do produto no formato de um item meta (tabela)
 *
 * @param  int $item_id
 * @param  array $item
 * @param  object $product
 * @return string
 */
function bazar_admin_order_loja_product($item_id, $item, $product)
{
    $post_id = $item['product_id'];
    $lojas =  get_the_terms($post_id, 'lojas');
    if ($lojas) {
        $output =   '<table cellspacing="0" class="display_meta">';
        $output .=      '<tr>';
        $output .=          '<th>' . __('Loja', 'bazar') . ':</th>';
        $output .=          '<td>' . $lojas[0]->name . '</td>';
        $output .=      '</th>';
        $output .=  '</table>';
        echo $output;
    }
}
