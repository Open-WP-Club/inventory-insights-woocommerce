<?php

/**
 * Helper Functions
 *
 * @package WooCommerce Inventory Insights
 */

// Prevent direct access
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Sanitize and validate minimum stock input
 *
 * @param mixed $input Raw input value
 * @return int|null Sanitized value or null
 */
function wc_inventory_insights_sanitize_min_stock($input)
{
  if ($input === '' || $input === null) {
    return null;
  }

  $value = intval($input);
  return $value >= 0 ? $value : null;
}

/**
 * Sanitize and validate product category input
 *
 * @param mixed $input Raw input value
 * @return int|null Sanitized category ID or null
 */
function wc_inventory_insights_sanitize_product_category($input)
{
  if ($input === '' || $input === null) {
    return null;
  }

  $value = intval($input);

  if ($value > 0) {
    $term = get_term($value, 'product_cat');
    if ($term && !is_wp_error($term)) {
      return $value;
    }
  }

  return null;
}

/**
 * Log debug message if WP_DEBUG is enabled
 *
 * @param string $message Debug message
 * @param mixed $data Additional data to log
 */
function wc_inventory_insights_debug_log($message, $data = null)
{
  if (defined('WP_DEBUG') && WP_DEBUG) {
    $log_message = '[WC Inventory Insights] ' . $message;
    if ($data !== null) {
      $log_message .= ' Data: ' . print_r($data, true);
    }
    error_log($log_message);
  }
}
