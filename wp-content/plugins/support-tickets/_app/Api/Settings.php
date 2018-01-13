<?php
/**
 * @package Support Tickets
 */

namespace App\Api;

class Settings
{
    private $admin_pages = array();
    private $admin_sub_pages = array();
    private $settings = array();
    private $sections = array();
    private $fields = array();

    /**
     * Bootstrap the App\Api\Settings class.
     */
    public function bootstrap()
    {
        if (!empty($this->admin_pages)) {
            add_action('admin_menu', [ $this, 'addAdminMenu' ]);
        }

        if (!empty($this->settings)) {
            add_action('admin_init', [ $this, 'registerCustomFields' ]);
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
     * Generate the admin sub pages.
     * @param array $sub_pages
     * @return $this
     */
    public function generateSubPages(array $sub_pages) {
        $this->admin_sub_pages = array_merge($this->admin_sub_pages, $sub_pages);
        return $this;
    }

    /**
     * Generate a sub page along with an admin page.
     * @param string|null $title
     * @return $this
     */
    public function withSubPage(string $title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $sub_page = [
            [
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => ($title) ? $title : $admin_page['menu_title'],
                'menu_title' => $admin_page['menu_title'],
                'capability' => $admin_page['capability'],
                'menu_slug' => $admin_page['menu_slug'],
                'callback' => function() { echo 'subpage'; }
            ]
        ];

        $this->admin_sub_pages = $sub_page;

        return $this;
    }

    /**
     * Add both the admin pages and sub pages to the admin menu.
     */
    public function addAdminMenu()
    {
        $this->addAdminPages();
        $this->addAdminSubPages();
    }

    /**
     * Loop through all of the admin pages and generate the menu page using add_menu_page.
     * @see add_menu_page()
     */
    private function addAdminPages()
    {
        foreach($this->admin_pages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'],
                $page['callback'], $page['icon_url'], $page['position']);
        }
    }

    /**
     * Loop through all of the admin sub pages and generate the menu page using add_menu_page.
     * @see add_submenu_page()
     */
    private function addAdminSubPages()
    {
        foreach($this->admin_sub_pages as $page) {
            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'],
                $page['menu_slug'], $page['callback']);
        }
    }

    /**
     * Register all of the custom fields.
     * @see registerSettings()
     * @see addSettingsSection()
     * @see addSettingsField()
     */
    public function registerCustomFields()
    {
        $this->registerSettings();
        $this->addSettingsSection();
        $this->addSettingsFields();
    }

    /**
     * Set the settings.
     * @param array $settings
     * @return $this
     */
    public function setSettings(array $settings)
    {
        $this->settings = $settings;
        return $this;
    }

    /**
     * Set the setting sections.
     * @param array $sections
     * @return $this
     */
    public function setSections(array $sections)
    {
        $this->sections = $sections;
        return $this;
    }

    /**
     * Set the setting fields.
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Loop through all of the settings and register them.
     */
    private function registerSettings()
    {
        foreach($this->settings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], isset($setting['callback']) ? $setting['callback'] : '');
        }
    }

    /**
     * Loop through all of the settings sections and add them.
     */
    private function addSettingsSection()
    {
        foreach($this->sections as $section) {
            add_settings_section($section['id'], $section['title'], isset($section['callback']) ? $section['callback'] : '', $section['page']);
        }
    }

    /**
     * Loop through all of the setting field and add them.
     */
    private function addSettingsFields()
    {
        foreach($this->fields as $field) {
            add_settings_field($field['id'], $field['title'], isset($field['callback']) ? $field['callback'] : '', $field['page'], $field['section'], isset($field['args']) ? $field['args'] : '');
        }
    }
}