<?php
/**
 * @package SupportTickets
 */

namespace App\Pages;

use App\Bootstrap\Base;

class Admin extends Base
{
    /**
     * Bootstrap the Admin class.
     */
    public function bootstrap()
    {
        add_action('admin_menu', [$this, 'add_admin_pages']);
    }

    /**
     * Add the admin menu pages with all of the content.
     */
    public function add_admin_pages()
    {
        add_menu_page('Support Tickets', 'Support Tickets', 'manage_options', 'support_tickets', [ $this, 'admin_index' ], 'dashicons-admin-tools', 110);
    }

    /**
     * Render the template linked to the admin page.
     */
    public function admin_index()
    {
        require_once $this->plugin_path . 'templates/admin.php';
    }
}