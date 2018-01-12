<?php
/**
 * @package SupportTickets
 */

namespace App\Bootstrap;

class Enqueue extends Base
{

    /**
     * Bootstrap the Enqueue class.
     */
    public function bootstrap()
    {
        add_action('admin_enqueue_scripts', [ $this, 'enqueue']);
    }

    /**
     * Enqueue all of the styles and scripts.
     */
    public function enqueue()
    {
        $this->enqueueStyles(array([
            'name' => 'main_styles',
            'file_name' => 'style.css'
        ]));

        $this->enqueueScripts(array([
            'name' => 'main_js',
            'file_name' => 'script.js'
        ]));
    }

    /**
     * Loop through the styles in the given array.
     * Enqueue styles on each of the items that are within the array.
     * @param $styles
     */
    private function enqueueStyles($styles)
    {
        foreach ($styles as $style) {
            wp_enqueue_style($style['name'], $this->plugin_url . '/assets/css/' . $style['file_name']);
        }
    }

    /**
     * Loop through the scripts in the given array.
     * Enqueue scripts on each of the items that are within the array.
     * @param $scripts
     */
    private function enqueueScripts($scripts)
    {
        foreach ($scripts as $script) {
            wp_enqueue_style($script['name'], $this->plugin_url . '/assets/js/' . $script['file_name']);
        }
    }
}