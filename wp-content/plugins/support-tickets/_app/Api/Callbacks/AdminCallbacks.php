<?php
/**
 * @package SupportTickets
 */

namespace App\Api\Callbacks;

use App\Bootstrap\Base;

class AdminCallbacks extends Base
{
    /**
     * Show the admin settings template when general settings callback is called.
     * @return mixed
     */
    public function adminSettingsPage()
    {
        return require_once $this->plugin_path . '/templates/admin/settings.php';
    }

    /**
     * Show the input field
     */
    public function supportTicketsTextExample()
    {
        echo '<input type="text" placeholder="Text Example" class="regular-text" name="text_example" value="' . esc_attr(get_option('text_example')) . '"/>';
    }
}