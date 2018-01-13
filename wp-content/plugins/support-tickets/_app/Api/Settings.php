<?php
/**
 * @package Support Tickets
 */

namespace App\Api;

class Settings
{
    private $admin_pages = array();

    /**
     * Bootstrap the App\Api\Settings class.
     */
    public function bootstrap()
    {
        if (!empty($this->admin_pages)) {
            add_action('admin_menu', [ $this, 'addAdminMenu' ]);
        }
    }

    /**
     * Generate the admin pages.
     * @param array $pages
     * @return $this
     */
    public function generatePages(array $pages)
    {
        $this->admin_pages = $pages;

        return $this;
    }

    /**
     * Loop through all of the pages and generate the menu page using the add_menu_page function.
     * @see add_menu_page()
     */
    public function addAdminMenu()
    {
        foreach($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'],
                          $page['callback'], $page['icon_url'], $page['position']);
        }
    }
}