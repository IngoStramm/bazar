<?php

add_shortcode('bazar_pct_price', 'bazar_discount_product_percentage_price');

/**
 * bazar_discount_product_percentage_price
 *
 * @param  array $atts
 * @return string
 */
function bazar_discount_product_percentage_price($atts)
{
    global $product;
    if (!$product) {
        return;
    }
    if (!$product->is_on_sale()) {
        return;
    }
    if ($product->is_type('simple')) {
        $max_percentage = (($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100;
    } elseif ($product->is_type('variable')) {
        $max_percentage = 0;
        foreach ($product->get_children() as $child_id) {
            $variation = wc_get_product($child_id);
            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();
            if ($price != 0 && ! empty($sale)) $percentage = ($price - $sale) / $price * 100;
            if ($percentage > $max_percentage) {
                $max_percentage = $percentage;
            }
        }
    }
    $max_percentage = $max_percentage ? round($max_percentage) .  '% OFF' : null;
    return $max_percentage;
}

function bazar_output_product_prices($min_price, $max_price)
{
    $output = '<p class="bazar-prodcut-price">';
    if ($min_price && $min_price > 0 && $min_price < $max_price) {
        $output .= '<del>' . wc_price($max_price) . '</del>';
        $output .= '<strong>' . wc_price($min_price) . '</strong>';
    } else {
        $output .= '<strong>' . wc_price($max_price) . '</strong>';
    }
    $output .= '</p>';
    return $output;
}

add_shortcode('bazar_regular_price', 'bazar_product_regular_price');

function bazar_product_regular_price($atts)
{
    global $product;
    if (!$product) {
        return;
    }
    $output = null;
    // Check if the product is a simple product
    if ($product->is_type('simple')) {
        // Return the regular price for a simple product
        $regular_price = wc_price($product->get_regular_price());
        $sale_price = wc_price($product->get_sale_price());
        $output = bazar_output_product_prices($regular_price, $sale_price);
    }
    // Check if the product is a variable product
    elseif ($product->is_type('variable')) {
        $regular_prices = [];

        // Loop through variations to get their regular prices
        foreach ($product->get_children() as $child_id) {
            $variation = wc_get_product($child_id);
            $regular_prices[] = $variation->get_regular_price();
            $sale_prices[] = $variation->get_sale_price();
        }
        $max_price = max($regular_prices);
        $min_price = min($sale_prices);
        // Return the array of regular prices for variations
        $output = bazar_output_product_prices($min_price, $max_price);
    }
    return $output;
}
