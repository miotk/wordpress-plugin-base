<?php
/**
 * @package SupportTickets
 */

namespace App\Api\Callbacks;

use App\Bootstrap\Base;

class ManagerCallbacks extends Base
{
    public function sanitizeCheckbox($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function sanitizeSelect($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function sanitizeInput($input)
    {
        return sanitize_text_field($input);
    }

    public function editorField(array $args)
    {
        wp_editor(get_option($args['label_for']), get_option($args['label_for']), [
            'quicktags' => array( 'buttons' => 'strong,em,del,ul,ol,li,close' )
        ]);
    }

    public function adminSectionManager()
    {
        echo 'Manage the features of Support Tickets by toggling options from the list below.';
    }

    public function emailSectionManager()
    {
        echo 'Manage the email features of Support Tickets.';
    }

    public function checkboxField(array $args)
    {
        echo '<div class="' . $args['class'] . '"><input type="checkbox" id="' . $args['label_for'] . '" name="' . $args['label_for'] . '" class="' . $args['class'] . '" value="1" ' . (get_option($args['label_for']) ? 'checked' : '')  . '/><label for="'. $args['label_for'] .'"><div></div></label></div>';
    }

    public function defaultUser($args)
    {
        echo '<select class="form-control" name="' . $args['label_for'] . '">';

        echo '<option value="0">No Default User</option>';

        foreach( get_users() as $user) {
            $selected = '';

            if (get_option($args['label_for']) == $user->ID) {
                $selected = 'selected';
            }

            echo '<option ' . $selected . ' value="' . $user->ID . '">' . $user->user_login . '</option>';
        }
        echo '</select>';
    }
}