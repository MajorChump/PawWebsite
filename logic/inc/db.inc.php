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
?>