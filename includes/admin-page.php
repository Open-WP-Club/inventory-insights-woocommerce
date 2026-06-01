<?php

/**
 * Admin Page Functions
 * 
 * @package WooCommerce Inventory Insights
 */

// Prevent direct access
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Admin page content
 */
function wc_inventory_insights_admin_page()
{
?>
  <div class="wrap">
    <h1><?php _e('WooCommerce Inventory Insights', 'woocommerce-inventory-insights'); ?></h1>
    <p><?php _e('Monitor product stock levels by tags and attributes to help with wholesale ordering decisions.', 'woocommerce-inventory-insights'); ?></p>

    <!-- Recent Searches -->
    <div id="recent-searches-section" style="display: none;">
      <h3><?php _e('Recent Searches', 'woocommerce-inventory-insights'); ?></h3>
      <div class="recent-searches-controls">
        <select id="recent-searches-dropdown">
          <option value=""><?php _e('Select a recent search...', 'woocommerce-inventory-insights'); ?></option>
        </select>
        <button type="button" class="button" id="load-recent-search"><?php _e('Load Search', 'woocommerce-inventory-insights'); ?></button>
        <button type="button" class="button" id="clear-search-history"><?php _e('Clear History', 'woocommerce-inventory-insights'); ?></button>
        <button type="button" class="button button-primary" id="load-last-search">
          <?php _e('Load Last Search', 'woocommerce-inventory-insights'); ?>
        </button>
      </div>
      <div id="last-search-preview" class="last-search-preview"></div>
    </div>

    <div class="wc-inventory-insights-search-form">
      <form id="inventory-search-form">
        <table class="form-table">
          <tr>
            <th scope="row">
              <label for="filter_type"><?php _e('Filter Type', 'woocommerce-inventory-insights'); ?></label>
            </th>
            <td>
              <select id="filter_type" name="filter_type" required>
                <option value=""><?php _e('Select filter type...', 'woocommerce-inventory-insights'); ?></option>
                <option value="tags"><?php _e('Product Tags', 'woocommerce-inventory-insights'); ?></option>
                <option value="attributes"><?php _e('Product Attributes', 'woocommerce-inventory-insights'); ?></option>
              </select>
            </td>
          </tr>
          <tr id="filter_value_row" style="display: none;">
            <th scope="row">
              <label for="filter_value"><?php _e('Select Value', 'woocommerce-inventory-insights'); ?></label>
            </th>
            <td>
              <select id="filter_value" name="filter_value" required>
                <option value=""><?php _e('Select...', 'woocommerce-inventory-insights'); ?></option>
              </select>
            </td>
          </tr>
          <tr>
            <th scope="row">
              <label for="product_category"><?php _e('Product Category (Optional)', 'woocommerce-inventory-insights'); ?></label>
            </th>
            <td>
              <select id="product_category" name="product_category">
                <option value=""><?php _e('All Categories', 'woocommerce-inventory-insights'); ?></option>
              </select>
              <p class="description"><?php _e('Optional: Filter results by a specific product category. Categories will be filtered based on your selected tag/attribute.', 'woocommerce-inventory-insights'); ?></p>
            </td>
          </tr>
          <tr>
            <th scope="row">
              <label for="min_stock"><?php _e('Minimum Stock Threshold', 'woocommerce-inventory-insights'); ?></label>
            </th>
            <td>
              <input type="number" id="min_stock" name="min_stock" min="0" step="1" placeholder="<?php _e('Leave empty to show all products', 'woocommerce-inventory-insights'); ?>">
              <p class="description"><?php _e('Products with stock below this number will be shown. Leave empty to show all products with the selected tag/attribute.', 'woocommerce-inventory-insights'); ?></p>
            </td>
          </tr>
        </table>

        <p class="submit">
          <button type="submit" class="button button-primary" id="search-btn">
            <?php _e('Search Products', 'woocommerce-inventory-insights'); ?>
          </button>
        </p>
      </form>
    </div>

    <div id="search-results" style="display: none;">
      <div class="results-header">
        <div class="results-title-section">
          <h2><?php _e('Search Results', 'woocommerce-inventory-insights'); ?></h2>
          <span id="results-count" class="results-count"></span>
        </div>
        <div class="results-controls">
          <label for="sort-options"><?php _e('Sort by:', 'woocommerce-inventory-insights'); ?></label>
          <select id="sort-options" style="display: none;">
            <option value="stock_asc"><?php _e('Stock (Low to High)', 'woocommerce-inventory-insights'); ?></option>
            <option value="stock_desc"><?php _e('Stock (High to Low)', 'woocommerce-inventory-insights'); ?></option>
            <option value="name_asc"><?php _e('Product Name (A-Z)', 'woocommerce-inventory-insights'); ?></option>
            <option value="name_desc"><?php _e('Product Name (Z-A)', 'woocommerce-inventory-insights'); ?></option>
            <option value="sku_asc"><?php _e('SKU (A-Z)', 'woocommerce-inventory-insights'); ?></option>
            <option value="sku_desc"><?php _e('SKU (Z-A)', 'woocommerce-inventory-insights'); ?></option>
          </select>
          <div class="bulk-actions" style="display: none;">
            <button type="button" class="button" id="select-all-btn"><?php _e('Select All', 'woocommerce-inventory-insights'); ?></button>
            <button type="button" class="button" id="deselect-all-btn"><?php _e('Deselect All', 'woocommerce-inventory-insights'); ?></button>
            <button type="button" class="button" id="export-selected-btn"><?php _e('Export Selected', 'woocommerce-inventory-insights'); ?></button>
          </div>
          <button type="button" class="button" id="export-csv-btn" style="display: none;">
            <?php _e('Export All to CSV', 'woocommerce-inventory-insights'); ?>
          </button>
        </div>
      </div>
      <div id="results-content"></div>
    </div>
  </div>
<?php
}

