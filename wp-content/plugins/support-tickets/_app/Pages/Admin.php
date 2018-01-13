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
    private $pages;

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
        $pages = [
            [
                'page_title' => 'Support Tickets Settings',
                'menu_title' => 'ST Settings',
                'capability' =>  'manage_options',
                'menu_slug' => 'support_tickets_settings',
                'callback' => function() { echo 'test'; },
                'icon_url' => 'dashicons-admin-tools',
                'position' => 110
            ],
            [
                'page_title' => 'Support Tickets',
                'menu_title' => 'Support Tickets',
                'capability' => 'manage_options',
                'menu_slug' => 'support_tickets',
                'callback' => function() { echo 'Support Tickets Page'; },
                'icon_url' => 'dashicons-tickets-alt',
                'position' => 6
            ]
        ];

        $this->settings->generatePages($pages)->bootstrap();
    }
}