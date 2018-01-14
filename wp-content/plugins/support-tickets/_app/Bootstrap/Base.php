<?php
/**
 * @package SupportTickets
 */

namespace App\Bootstrap;

class Base
{
    public $plugin_path;
    public $plugin_url;
    public $plugin;
    public $managers = array();

    /**
     * Base constructor.
     */
    public function __construct()
    {
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)) . '/support-tickets.php';

        $this->managers = [
            'st_email_to_customer' => 'Content that will be sent to the customer when a ticket is submitted',
            'st_email_success_content' => 'Content that will be sent to the customer when a ticket is resolved',
            'st_email_status_content' => 'Content that will be sent to the customer when a status of a ticket has changed',
            'st_email_agenda_content' => 'Content that will be sent to an agent when they get assigned to a ticket'
        ];
    }
}