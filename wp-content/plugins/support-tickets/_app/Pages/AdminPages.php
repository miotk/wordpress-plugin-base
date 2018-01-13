<?php
/**
 * @package SupportTickets
 */

namespace App\Pages;

use App\Api\Callbacks\ManagerCallbacks;
use App\Api\Settings;
use App\Bootstrap\Base;
use App\Api\Callbacks\AdminCallbacks;

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
        $args = [
            [
                'option_group' => 'support_ticket_plugin_settings',
                'option_name' => 'st_email_on_user_entry',
                'option_callback' => [ $this->callbacks_mngr, 'sanitizeCheckbox' ]
            ],
            [
                'option_group' => 'support_ticket_plugin_settings',
                'option_name' => 'st_user_roles',
                'option_callback' => [ $this->callbacks_mngr, 'selectSanitize' ]
            ],
            [
                'option_group' => 'support_ticket_plugin_settings',
                'option_name' => 'st_default_user',
                'option_callback' => [ $this->callbacks_mngr, 'selectSanitize' ]
            ],
            [
                'option_group' => 'support_ticket_plugin_settings',
                'option_name' => 'st_elapsed_time',
                'option_callback' => [ $this->callbacks_mngr, 'sanitizeCheckbox' ]
            ],
            [
                'option_group' => 'support_ticket_plugin_settings',
                'option_name' => 'st_user_view_only',
                'option_callback' => [ $this->callbacks_mngr, 'sanitizeCheckbox' ]
            ]
        ];

        $this->settings->setSettings($args);
        return $this;
    }

    /**
     * Set the sections for the admin pages.
     * @return $this
     */
    public function setSections()
    {
        $args = [
            [
                'id' => 'support_tickets_admin_index',
                'title' => 'Support Ticket Settings Manager',
                'callback' => [ $this->callbacks_mngr, 'adminSectionManager' ],
                'page' => 'support_tickets_settings'
            ]
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
        $args = [
            [
                'id' => 'st_email_on_user_entry',
                'title' => 'Email customer when ticket has been received',
                'callback' => [ $this->callbacks_mngr, 'checkboxField'],
                'page' => 'support_tickets_settings',
                'section' => 'support_tickets_admin_index',
                'args' => [
                    'label_for' => 'st_email_on_user_entry',
                    'class' => 'ui-toggle'
                ]
            ],
            [
                'id' => 'st_user_roles',
                'title' => 'Only allow users to see their own tickets',
                'callback' => [ $this->callbacks_mngr, 'checkboxField'],
                'page' => 'support_tickets_settings',
                'section' => 'support_tickets_admin_index',
                'args' => [
                    'label_for' => 'st_user_roles',
                    'class' => 'ui-toggle'
                ]
            ],
            [
                'id' => 'st_elapsed_time',
                'title' => 'Show elapsed time on tickets',
                'callback' => [ $this->callbacks_mngr, 'checkboxField'],
                'page' => 'support_tickets_settings',
                'section' => 'support_tickets_admin_index',
                'args' => [
                    'label_for' => 'st_elapsed_time',
                    'class' => 'ui-toggle'
                ]
            ],
            [
                'id' => 'st_default_user',
                'title' => 'Set default user all tickets should go to',
                'callback' => [ $this->callbacks_mngr, 'defaultUser'],
                'page' => 'support_tickets_settings',
                'section' => 'support_tickets_admin_index',
                'args' => [
                    'label_for' => 'st_default_user',
                    'class' => 'ui-toggle'
                ]
            ]
        ];

        $this->settings->setFields($args);
        return $this;
    }
}