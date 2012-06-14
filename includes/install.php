<?php

// function to create the DB / Options / Defaults					
function rcp_options_install() {
   global $wpdb;
  	global $rcp_db_name;
	global $rcp_db_version;
	global $rcp_discounts_db_name;
	global $rcp_discounts_db_version;
	global $rcp_payments_db_name;
	global $rcp_payments_db_version;

	// create the RCP subscription level database table
	if($wpdb->get_var("show tables like '$rcp_db_name'") != $rcp_db_name) 
	{
		$sql = "CREATE TABLE " . $rcp_db_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`description` longtext NOT NULL,
		`duration` tinyint NOT NULL,
		`duration_unit` tinytext NOT NULL,
		`price` tinytext NOT NULL,
		`list_order` mediumint NOT NULL,
		`level` mediumint NOT NULL,
		`status` tinytext NOT NULL,
		UNIQUE KEY id (id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
				
		add_option("rcp_db_version", $rcp_db_version);	
	}
	
	// create the RCP discounts database table
	if($wpdb->get_var("show tables like '$rcp_discounts_db_name'") != $rcp_discounts_db_name) 
	{
		$sql = "CREATE TABLE " . $rcp_discounts_db_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`description` longtext NOT NULL,
		`amount` tinytext NOT NULL,
		`unit` tinytext NOT NULL,
		`code` tinytext NOT NULL,
		`use_count` mediumint NOT NULL,
		`max_uses` mediumint NOT NULL,
		`status` tinytext NOT NULL,
		`expiration` mediumtext NOT NULL,
		UNIQUE KEY id (id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
				
		add_option("rcp_discounts_db_version", $rcp_discounts_db_version);	
	}
	
	// create the RCP payments database table
	if($wpdb->get_var("show tables like '$rcp_payments_db_name'") != $rcp_payments_db_name) 
	{
		$sql = "CREATE TABLE " . $rcp_payments_db_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`subscription` mediumtext NOT NULL,
		`date` datetime NOT NULL,
		`amount` mediumtext NOT NULL,
		`user_id` mediumint NOT NULL,
		`payment_type` tinytext NOT NULL,
		`subscription_key` mediumtext NOT NULL,
		UNIQUE KEY id (id)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
				
		add_option("rcp_payments_db_version", $rcp_payments_db_version);	
	}
}
// run the install scripts upon plugin activation
register_activation_hook(RCP_PLUGIN_FILE, 'rcp_options_install');