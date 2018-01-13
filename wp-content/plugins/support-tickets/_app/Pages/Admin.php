<?php
/**
 * @package SupportTickets
 */

namespace App\Pages;

use App\Api\Settings;
use App\Bootstrap\Base;

class Admin extends Base
{
    public $settings;
    private $pages = array();

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->settings = new Settings();
    }

    /**
     * Bootstrap the Admin class.
     */
    public function bootstrap()
    {
        $this->settingsPage();
        $this->ticketsPage();

        $this->settings->generatePages([$this->pages])->bootstrap();
    }

    /**
     * Merge the new array with the existing pages array.
     * @param $page
     * @return array
     */
    private function addPage($page)
    {
        return $this->pages = array_merge($this->pages, $page);
    }

    /**
     * Generate the settings page.
     */
    private function settingsPage()
    {
        $this->addPage([
            'page_title' => 'Support Tickets Settings',
            'menu_title' => 'ST Settings',
            'capability' =>  'manage_options',
            'menu_slug' => 'support_tickets_settings',
            'callback' => function() { echo 'test'; },
            'icon_url' => 'dashicons-admin-tools',
            'position' => 110
        ]);
    }

    /**
     * Generate the tickets page.
     */
    private function ticketsPage()
    {
        $this->addPage([
            'page_title' => 'Support Tickets',
            'menu_title' => 'Support Tickets',
            'capability' => 'manage_options',
            'menu_slug' => 'support_tickets',
            'callback' => function() { echo 'Support Tickets Page'; },
            'icon_url' => 'dashicons-tickets-alt',
            'position' => 6
        ]);
    }
}