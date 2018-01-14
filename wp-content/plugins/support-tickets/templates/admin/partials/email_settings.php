<?php
    settings_fields('support_ticket_plugin_email_settings');
    do_settings_sections('support_tickets_settings');
    submit_button();