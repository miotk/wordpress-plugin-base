<?php
/**
 * @package SupportTicket
 */

namespace App;

final class App
{
    /**
     * Get all classes and stores the classes inside of an array.
     * @return array {list of classes}
     */
    private static function get()
    {
        return [
            Bootstrap\Activate::class,
            Bootstrap\Settings::class,
            Bootstrap\Enqueue::class,
            Pages\Admin::class
        ];
    }

    /**
     * Loop through the list of classes returned from get(), initialize them and call the bootstrap()
     * method if it exists.
     * @see get()
     * @see instantiate()
     */
    public static function bootstrap()
    {
        foreach (self::get() as $class) {
            $service = self::instantiate($class);
            method_exists($service, 'bootstrap') and $service->bootstrap();
        }
    }

    /**
     * Return a new instance of the class.
     * @param $class {the class from the services array}
     * @return mixed {new instance of the class}
     */
    private static function instantiate($class)
    {
        return new $class();
    }
}