<?php


	// NODE COMMUNICATION
	function node_curl ($post) {

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, NODE_ADDRESS);
		curl_setopt($ch, CURLOPT_HEADER, 1); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-length: '.strlen($post)));

		$output = curl_exec($ch);
		if (curl_errno($ch)) {
			var_dump(curl_error($ch));
		}
		curl_close($ch);
		
		return $output;
	}
	// NODE RPC
	function node_get_balance($account)
	{
		$post = '{"action": "account_balance", "account":"'.$account.'"}';
		$balance = json_decode(node_curl($post));
		
		return $balance;
	}
	
	
?>