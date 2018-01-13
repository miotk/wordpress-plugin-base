<?php
/**
 * @package SupportTickets
 */

namespace App\Bootstrap;

class Settings extends Base
{
    /**
     * Bootstrap the settings class.
     */
    public function bootstrap()
    {
        add_filter('plugin_action_links_' . $this->plugin, [$this, 'settingsLinks']);
    }

    public function settingsLinks($links)
    {
        $link = '<a href="admin.php?page=support_tickets">Settings</a>';
        array_push($links, $link);
        return $links;
    }
}