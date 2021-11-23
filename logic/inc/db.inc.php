<?php

	function get_mysqli()
	{
		$mysqli = new mysqli(MYSQL_DB_HOST, MYSQL_DB_USER, MYSQL_DB_PASSWORD, MYSQL_DB_NAME);
		if ($mysqli->connect_errno)
		{
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		
		return $mysqli;
	}
	function db_last_dist_time()
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT time_transferred FROM vault_transfers ORDER BY id DESC"));
		
		if(!$query)
			printf($db->error);
		
		$result = $query->fetch_object();
		return $result ? $result->time_transferred : FALSE;
	}
	function db_last_dist_nr()
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT count(id) as num FROM vault_transfers"));
		
		if(!$query)
			printf($db->error);
		
		$result = $query->fetch_object();
		return $result ? $result->num : 0;
	}
	function db_count_unpaid_distribution()
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT count(id) as total FROM distribution WHERE paid_out=%d", 0));
		
		$result = $query->fetch_object();
		return $result ? $result->total : 0;
	}
	
	
	/******** DISTRIBUTION PAGE ********/
	
	function db_recent_distributions()
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT * FROM vault_transfers ORDER BY id DESC LIMIT 25"));
		
		if(!$query)
			printf($db->error);
		
		$rows = FALSE;
		while($row = $query->fetch_array())
		{
			$rows[] = $row;
		}

		return $rows;
	}
	
	function db_recent_rewards()
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT * FROM distribution ORDER BY id DESC LIMIT 100"));
		
		if(!$query)
			printf($db->error);
		
		$rows = FALSE;
		while($row = $query->fetch_array())
		{
			$rows[] = $row;
		}

		return $rows;
	}
	
	
	/******** EMAIL INVITE PAGE ********/
	
	function db_insert_email_invite($email, $reward_key, $pickup_code, $inviter_address)
	{
		$db = get_mysqli();
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$result = $db->query(sprintf("INSERT INTO email_invites (email, reward_key, pickup_code, inviter_address, ip_inviter, time_invited) VALUES ('%s', '%s', '%s', '%s', '%s', %d)", mysqli_escape_string($db, $email), mysqli_escape_string($db, $reward_key), mysqli_escape_string($db, $pickup_code), mysqli_escape_string($db, $inviter_address), mysqli_escape_string($db, $ip), time()));
		if(!$result)
		{
			printf($db->error);
			die();
		}
		
		return $result;
	}
	function db_insert_reward_key($reward_key, $invited_by)
	{
		$db = get_mysqli();
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$result = $db->query(sprintf("INSERT INTO paw_reward_keys (reward_key, invited_by, time_created) VALUES ('%s', %d, %d)", mysqli_escape_string($db, $reward_key), mysqli_escape_string($db, $invited_by), time()));
		if(!$result)
		{
			printf($db->error);
			die();
		}
		
		return $result;
	}
	
	function db_last_email_invite($reward_key)
	{
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT time_invited FROM email_invites WHERE ip_inviter='%s' OR reward_key='%s' ORDER BY id DESC", mysqli_escape_string($db, $ip), mysqli_escape_string($db, $reward_key)));
		
		if(!$query)
			printf($db->error);
		
		$result = $query->fetch_object();
		return $result ? $result : FALSE;
	}
	function db_email_invited($email)
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT * FROM email_invites WHERE email='%s' ORDER BY id DESC", mysqli_escape_string($db, $email)));
		
		if(!$query)
			printf($db->error);
		
		$result = $query->fetch_object();
		return $result ? TRUE : FALSE;
	}
	function db_reward_key($reward_key)
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT * FROM paw_reward_keys WHERE reward_key='%s' ORDER BY id DESC", mysqli_escape_string($db, $reward_key)));
		
		if(!$query)
			printf($db->error);
		
		$result = $query->fetch_object();
		return $result ? $result : FALSE;
	}
	
	/** RECIVE PAW EMAIL INVITE **/
	
	function db_get_email_invite($pickup_code)
	{
		$db = get_mysqli();
		$query = $db->query(sprintf("SELECT * FROM email_invites WHERE pickup_code='%s' ORDER BY id DESC", mysqli_escape_string($db, $pickup_code)));
		
		if(!$query)
			printf($db->error);
		
		$result = $query->fetch_object();
		return $result ? $result : FALSE;
	}
	function db_set_email_picked_up($id, $address)
	{
		$db = get_mysqli();
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$result = $db->query(sprintf("UPDATE email_invites SET invitee_address='%s', ip_invitee='%s', time_picked_up=%d, picked_up=%d WHERE id=%d", mysqli_escape_string($db, $address), mysqli_escape_string($db, $ip), time(), 1, mysqli_escape_string($db, $id)));
		if(!$result)
		{
			printf($db->error);
			die();
		}
		
		return $result;
	}
?>