<?php
/**
 * @package Support Tickets
 */

namespace App\Api;

class Settings
{
    private $admin_pages = array();
    private $admin_subpages = array();

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
     * Generate a subpage along with an admin page.
     * @param string|null $title
     * @return $this
     */
    public function withSubPage(string $title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = [
            [
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => $admin_page['page_title'],
                'menu_title' => $admin_page['menu_title'],
                'capability' => $admin_page['capability'],
                'menu_slug' => $admin_page['menu_slug'],
                'callback' => function() { echo 'subpage'; }
            ]
        ];

        $this->admin_subpages = $subpage;

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

        foreach($this->admin_subpages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'],
                $page['menu_slug'], $page['callback']);
        }
    }
}