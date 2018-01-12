<?php
/**
 * @package SupportTickets
 */

/*
 * Plugin Name: Support Tickets
 * Plugin URI: https://plugin.miotk.io/support-tickets
 * Description: <strong>Support Tickets</strong> allows your Wordpress website to receive and handle support tickets from your customers!
 * Author: Miotk Limited
 * Author URI: https://miotk.io
 * License: GPLv2 or later
 * Text Domain: support-ticket
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// Check that the plugin is being accessed properly.
!defined('ABSPATH') || !function_exists('add_action') and die;

// If the autoload file exists. Require it in.
file_exists(dirname(__FILE__) . '/vendor/autoload.php') and require_once dirname(__FILE__) . '/vendor/autoload.php';

// Activate the Support Tickets plugin and register the activation hook.
function activatePlugin() {
    \App\Bootstrap\Activate::activate();
}
register_activation_hook(__FILE__, 'activatePlugin');

// Deactivate the Support Tickets plugin and register the deactivation hook.
function deactivatePlugin() {
    \App\Bootstrap\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivatePlugin');

// If the App\App class exists then run the bootstrap method.
class_exists('App\\App') and App\App::bootstrap();
