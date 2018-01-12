<?php
/**
 * @package SupportTickets
 */

namespace App\Bootstrap;

class Settings
{
    /**
     * Bootstrap the settings class.
     */
    public function bootstrap()
    {
        add_filter('plugin_action_links_' . PLUGIN, [$this, 'settingsLinks']);
    }

    public function settingsLinks($links)
    {
        $link = '<a href="admin.php?page=support_tickets">Settings</a>';
        array_push($links, $link);
        return $links;
    }
}