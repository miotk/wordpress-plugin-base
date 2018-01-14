<?php
/**
 * @package SupportTickets
 */

use App\Api\Callbacks\ManagerCallbacks;

class EmailSettings
{
    private $managers;
    private $callback;

    /**
     * EmailSettings constructor.
     * Assign the managers
     */
    public function __construct()
    {
        $this->callback = new ManagerCallbacks();

        $this->managers = [
            'st_email_to_customer' => 'The email content that will be sent to the customer when a ticket is submitted',
            'st_email_success_content' => 'The email content that will be sent to the customer when a ticket is resolved or completed',
            'st_email_status_content' => 'The email content that will be sent to the customer when a status of a ticket has changed',
            'st_email_agenda_content' => 'The email content that will be sent to an agent when a ticket has been assigned to them'
        ];
    }

    public function bootstrap()
    {

    }

    private function setSections()
    {

    }

    private function setFields()
    {
        $args = [];

        foreach ($this->managers as $key => $value) {
            $args[] = [
                'option_group' => 'support_ticket_plugin_email_settings',
                'option_name' => $key,
                'callback' => [ $this->callback, 'editorField' ]
            ];
        }

        
    }
}