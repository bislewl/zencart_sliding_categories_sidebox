<?php

/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
 */
$content = "";

$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
$content .= '<ul>';


$categories_tab_query = "SELECT c.categories_id, cd.categories_name FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id = cd.categories_id AND c.parent_id= '0' AND cd.language_id='" . (int) $_SESSION['languages_id'] . "' AND c.categories_status='1' ORDER BY c.sort_order, cd.categories_name;";
$categories_tab = $db->Execute($categories_tab_query);

$cPath = explode('_', $_GET['cPath']);
while (!$categories_tab->EOF) {

    $subcategories_tab_query = "SELECT c.categories_id, cd.categories_name FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id=cd.categories_id AND c.parent_id= '" . (int) $categories_tab->fields['categories_id'] . "' AND cd.language_id='" . (int) $_SESSION['languages_id'] . "' AND c.categories_status='1' ORDER BY c.sort_order, cd.categories_name;";
    $subcategories_tab = $db->Execute($subcategories_tab_query);
    // currently selected category
    $dropdownmenu_current = (($categories_tab->fields['categories_id'] == current($cPath)) || ($categories_tab->fields['categories_id'] == 55 && $_GET['main_page'] == FILENAME_BEST_SELLERS) ? ' ddmCurrent' : '');
    $content .= '<li' . ($subcategories_tab->RecordCount() > 0 ? ' class="has-sub' . $dropdownmenu_current . '"' : '') . '>';
    //echo '<a class="category-top" href="'.zen_href_link(FILENAME_DEFAULT,'cPath=' . (int)$categories_tab->fields['categories_id']).'">'; 
    $content .= '<a class="category-top" href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int) $categories_tab->fields['categories_id']) . '">';
    $content .= htmlentities($categories_tab->fields['categories_name'], ENT_QUOTES, 'UTF-8');
    $content .= '</a>' . "\n";
    //echo '</a>' . "\n";

    if ($subcategories_tab->RecordCount() > 0) {
        $content .= '<ul>' . "\n";

        while (!$subcategories_tab->EOF) {

            $cPath_new = zen_get_path($subcategories_tab->fields['categories_id']);
            $cPath_new = str_replace('=0_', '=', $cPath_new);
            $cPath_new = "cPath=" . $subcategories_tab->fields['categories_id'];
            $content .= '<li>' . '<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . htmlentities($subcategories_tab->fields['categories_name'], ENT_QUOTES, 'UTF-8') . '</a></li>' . "\n";
            $subcategories_tab->MoveNext();
        }
        $content .= '</ul>' . "\n";
    }
    $products_tab_query = "SELECT p.`products_id`, pd.`products_name`, pd.`language_id` FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd WHERE p.`master_categories_id`='" . (int) $categories_tab->fields['categories_id'] . "' AND p.`products_id`=pd.`products_id` AND p.products_status='1' AND pd.`language_id`='" . (int) $_SESSION['languages_id'] . "' ORDER BY p.`products_sort_order`;";
    $products_tab = $db->Execute($products_tab_query);
    if ($products_tab->RecordCount() > 0) {
        $content .= '<ul>' . "\n";
        while (!$products_tab->EOF) {
            $cPath_new = zen_get_path($categories->fields['categories_id']);
            $cPath_new = str_replace('=0_', '=', $cPath_new);
            $content .= '<li>' . '<a href="' . zen_href_link(zen_get_info_page($products_tab->fields['products_id']), $cPath_new . '&products_id=' . $products_tab->fields['products_id']) . '">' . htmlentities($products_tab->fields['products_name']) . '</a></li>' . "\n";
            $products_tab->MoveNext();
        }
        $content .= '</ul>' . "\n";
    }
    $content .= '</li>' . "\n";

    $categories_tab->MoveNext();
}

$content .= '</ul>';
$content .= '</div>';
