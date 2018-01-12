<?php
/**
 * @package SupportTickets
 */

namespace App\Bootstrap;

class Deactivate
{
    /**
     * Flush the rewrite rules on deactivation of the Support Tickets plugin.
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}