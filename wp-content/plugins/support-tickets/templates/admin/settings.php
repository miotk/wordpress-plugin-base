<div class="wrap">
	<div class="container-fluid">
        <? settings_errors(); ?>

		<div class="row">
			<div class="col-sm-12 col-md-2">
				<ul class="list-group can-nav">
					<li class="list-group-item active list-group-item-action" data-target="general">General Settings</li>
					<li class="list-group-item list-group-item-action" data-target="url">URL Settings</li>
					<li class="list-group-item list-group-item-action" data-target="company">Company Settings</li>
					<li class="list-group-item list-group-item-action" data-target="appearance">Appearance Settings</li>
					<li class="list-group-item list-group-item-action" data-target="appearance">Documentation</li>
					<li class="list-group-item list-group-item-action" data-target="appearance">Check for Updates</li>
					<li class="list-group-item list-group-item-action" data-target="product">Product Key</li>
				</ul>
			</div>
			<div class="col-sm-12 col-md-10">
				<form action="options.php" method="post">
                    <?php
	                    settings_fields('support_ticket_plugin_settings');
	                    do_settings_sections('support_tickets_settings');
	                    submit_button();
                    ?>
				</form>
			</div>
		</div>
	</div>
</div>