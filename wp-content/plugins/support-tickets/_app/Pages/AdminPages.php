<?php
/**
 * @package SupportTickets
 */

namespace App\Pages;

use App\Api\Callbacks\ManagerCallbacks;
use App\Api\Settings;
use App\Bootstrap\Base;
use App\Api\Callbacks\AdminCallbacks;
use App\Pages\Settings\Admin\EmailSettings;
use App\Pages\Sections\Admin\EmailSection;
use App\Pages\Fields\Admin\EmailFields;

class AdminPages extends Base
{
    public $settings;
    public $callbacks;
    public $callbacks_mngr;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->settings = new Settings();
        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();
    }

    /**
     * Bootstrap the Admin class.
     */
    public function bootstrap()
    {
        $this->setSettings()->setSections()->setFields();
        $this->settings->generatePages($this->getPages())->generateSubPages($this->getSubPages())->bootstrap();
    }

    /**
     * Get all of the admin pages.
     * @return array
     */
    private function getPages()
    {
        return [
            $this->settingsPage(),
            $this->ticketsPage()
        ];
    }

    /**
     * Get all of the admin sub pages.
     * @return array
     */
    private function getSubPages()
    {
        return [
          $this->settingsGeneralSubPage(),
          $this->settingsAppearanceSubPage()
        ];
    }

    /**
     * Generate the settings page.
     * @return array
     */
    private function settingsPage()
    {
        return [
            'page_title' => 'Support Tickets Settings',
            'menu_title' => 'ST Settings',
            'capability' =>  'manage_options',
            'menu_slug' => 'support_tickets_settings',
            'callback' => [$this->callbacks, 'adminSettingsPage'],
            'icon_url' => 'dashicons-admin-tools',
            'position' => 110
        ];
    }

    /**
     * Generate the sub page for the settings general page.
     * @return array
     */
    private function settingsGeneralSubPage()
    {
        return [
            'parent_slug' => 'support_tickets_settings',
            'page_title' => 'Support Ticket - General Settings',
            'menu_title' => 'General Settings',
            'capability' => 'manage_options',
            'menu_slug' => 'support_tickets_settings_general',
            'callback' => [ $this->callbacks, 'generalSettings' ]
        ];
    }

    /**
     * Generate the sub page for the settings appearance page.
     * @return array
     */
    private function settingsAppearanceSubPage()
    {
        return [
          'parent_slug' => 'support_tickets_settings',
          'page_title' => 'Support Ticket - Appearance Settings',
          'menu_title' => 'Appearance Settings',
          'capability' => 'manage_options',
          'menu_slug' => 'support_tickets_settings_appearance',
          'callback' => function () { echo 'Appearance Settings'; }
        ];
    }

    /**
     * Generate the tickets page.
     * @return array
     */
    private function ticketsPage()
    {
        return [
            'page_title' => 'Support Tickets',
            'menu_title' => 'Support Tickets',
            'capability' => 'manage_options',
            'menu_slug' => 'support_tickets',
            'callback' => function() { echo 'Support Tickets Page'; },
            'icon_url' => 'dashicons-tickets-alt',
            'position' => 6
        ];
    }

    /**
     * Set the settings for the admin pages.
     * @return $this
     */
    public function setSettings()
    {
        $args = [];

        foreach ($this->managers as $key => $value) {
            $args[] = [
                'option_group' => 'support_ticket_plugin_email_settings',
                'option_name' => $key,
                'callback' => [ $this->callbacks_mngr, 'editorField' ]
            ];
        }

        $this->settings->setSettings($args);
        return $this;
    }

    /**
     * Set the sections for the admin pages.
     * @return $this
     */
    public function setSections()
    {
        $email = new EmailSection();

        $args = [
            $email->bootstrap()
        ];

        $this->settings->setSections($args);
        return $this;
    }

    /**
     * Set the fields for the admin pages.
     * @return $this
     */
    public function setFields()
    {
        $args = [];

        foreach ($this->managers as $key => $value) {
            $args[] = [
                'id' => $key,
                'title' => $value,
                'callback' => [ $this->callbacks_mngr, 'editorField' ],
                'page' => 'support_tickets_settings',
                'section' => 'support_tickets_email_settings_index',
                'args' => [
                    'label_for' => $key
                ]
            ];
        }

        $this->settings->setFields($args);
        return $this;
    }
}