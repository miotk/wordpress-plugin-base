<?php
/**
 * @package SupportTickets
 */

namespace App\Bootstrap;

class Activate
{
    /**
     * Flush the rewrite rules on activation of the Support Tickets plugin.
     */
    public static function activate()
    {
        flush_rewrite_rules();
    }
}