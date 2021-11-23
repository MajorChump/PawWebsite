<?php

	function ordinal($number)
	{
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if ((($number % 100) >= 11) && (($number%100) <= 13))
			return $number. 'th';
		else
			return $number. $ends[$number % 10];
	}
	
	function getCurrentRewardAmount()
	{
		$balance = node_get_balance(PAW_DISTRIBUTION_ACCOUNT);
		if($balance === null || isset($balance->error))
			return DISTRIBUTION_AMOUNT_PER_CYCLE;
		if(floatval(PawHelper::raw2den($balance->balance, 'PAW')) < DISTRIBUTION_AMOUNT_PER_CYCLE)
			return DISTRIBUTION_AMOUNT_PER_CYCLE;
		
		return floatval(PawHelper::raw2den($balance->balance, 'PAW'));
	}
	
	function getNextDistTime($last_dist)
	{
		if($last_dist === FALSE)
			return DISTRIBUTION_CYCLE;
		
		if($last_dist + (DISTRIBUTION_CYCLE * 60) < time()) // Distribution overdue
			return DISTRIBUTION_CYCLE;
		
		$time_until_next = ($last_dist + (DISTRIBUTION_CYCLE * 60)) - time();
		if($time_until_next < 60)
			return '<1';

		return floor($time_until_next / 60);
	}
	function valid_paw_address($address)
	{
		/** The regex pattern for validating the address. */
		return preg_match('/^paw_[13]{1}[13456789abcdefghijkmnopqrstuwxyz]{59}$/', $address) === 1;
	}
	function getTimeAgo($time)
	{
		// get seconds ago
		$v_Seconds = strtotime('now') - $time;

		// set unit labels
		$a_UnitLabels = array('year','month','week','day','hour','minute','second');

		// set unit values
		$a_UnitValues = array(
		floor($v_Seconds / 31536000),
		floor(($v_Seconds % 31536000) / 2592000),
		floor(($v_Seconds % 2592000) / 604800),
		floor(($v_Seconds % 604800) / 86400),
		floor(($v_Seconds % 86400) / 3600),
		floor(($v_Seconds % 3600) / 60),
		floor($v_Seconds % 60),
		); 

		// initiate array (for array_slice)
		$a_UnitPairs = array();

		// loop concatenating unit value to its label
		for($i=0;$i<count($a_UnitLabels);$i++){

			// pair up if greater than zero
			$v_Str  = $a_UnitValues[$i]>0 ? $a_UnitValues[$i].' '.$a_UnitLabels[$i] : '';

			// grammar for plural/singular (should always be a positive number)
			$v_Str .= $a_UnitValues[$i]>1 ? 's' : '';

			// only add to array if not empty/zero
			if($v_Str!='') $a_UnitPairs[] = $v_Str;
		}

		// take first item of array (round up to largest unit)
		$v_ReturnStr = $a_UnitPairs[0].' ago';

		// return
		return $v_ReturnStr;

	}
	function rand_sha1($length)
	{
		$max = ceil($length / 40);
		$random = '';
		for ($i = 0; $i < $max; $i ++) {
			$random .= sha1(microtime(true).mt_rand(10000,90000));
		}
		return substr($random, 0, $length);
	}
	
	
	// -------------- EMAIL INVITES --------------
	function distributor_curl ($post) {

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, API_DISTRIBUTOR);
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
	function distributor_send_email_reward($address, $reference, $target, $additional_data = '')
	{
		$post = sprintf('{"action": "%s", "target":"%s", "address": "%s", "reference":"%s", "platform":"%s", "additional_data":"%s", "auth": "%s"}', 'insertReward', $target, $address, $reference, 1, str_replace('"', '\"', $additional_data), API_DISTRIBUTOR_KEY);
		$result = distributor_curl($post);
		
		return json_decode($result);
	}
	
	
	
	
	class PawHelperException extends Exception{}
	class PawHelper
	{
		// *
		// *  Constants
		// *
		
		const RAWS = [
			'unano' =>                '1000000000000000000',
			'mnano' =>             '1000000000000000000000',
			 'nano' =>          '1000000000000000000000000',
			'knano' =>       '1000000000000000000000000000',
			'Mnano' =>    '1000000000000000000000000000000',
			 'NANO' =>    '1000000000000000000000000000000',
			 'PAW' =>    '1000000000000000000000000000000',
			'Gnano' => '1000000000000000000000000000000000'
		];
		
		const PREAMBLE_HEX = '0000000000000000000000000000000000000000000000000000000000000006';
		const EMPTY32_HEX  = '0000000000000000000000000000000000000000000000000000000000000000';
		const HARDENED     =  0x80000000;
		   
		
		// *
		// *  Denomination to raw
		// *
		
		public static function den2raw($amount, string $denomination): string
		{
			if (!array_key_exists($denomination, self::RAWS)) {
				throw new PawHelperException("Invalid denomination: $denomination");
			}
			
			$raw_to_denomination = self::RAWS[$denomination];
			
			if ($amount == 0) {
				return '0';
			}
			
			if (strpos($amount, '.')) {
				$dot_pos = strpos($amount, '.');
				$number_len = strlen($amount) - 1;
				$raw_to_denomination = substr($raw_to_denomination, 0, -($number_len - $dot_pos));
			}
			
			$amount = str_replace('.', '', $amount) . str_replace('1', '', $raw_to_denomination);
			
			// Remove useless zeros from left
			while (substr($amount, 0, 1) == '0') {
				$amount = substr($amount, 1);
			}
			
			return $amount;
		}


		// *
		// *  Raw to denomination
		// *
		
		public static function raw2den(string $amount, string $denomination): string
		{
			if (!array_key_exists($denomination, self::RAWS)) {
				throw new PawHelperException("Invalid denomination: $denomination");
			}
			
			$raw_to_denomination = self::RAWS[$denomination];
			
			if ($amount == '0') {
				return 0;
			}
			
			$prefix_lenght = 39 - strlen($amount);
			
			$i = 0;
			
			while ($i < $prefix_lenght) {
				$amount = '0' . $amount;
				$i++;
			}
			
			$amount = substr_replace($amount, '.', -(strlen($raw_to_denomination)-1), 0);
		
			// Remove useless zeroes from left
			while (substr($amount, 0, 1) == '0' && substr($amount, 1, 1) != '.') {
				$amount = substr($amount, 1);
			}
		
			// Remove useless decimals
			while (substr($amount, -1) == '0') {
				$amount = substr($amount, 0, -1);
			}
			
			// Remove dot if all decimals are zeros
			if (substr($amount, -1) == '.') {
				$amount = substr($amount, 0, -1);
			}
		
			return $amount;
		}
		
		
		// *
		// *  Denomination to denomination
		// *
		
		public static function den2den($amount, string $denomination_from, string $denomination_to): string
		{
			if (!array_key_exists($denomination_from, self::RAWS)) {
				throw new PawHelperException("Invalid source denomination: $denomination_from");
			}
			if (!array_key_exists($denomination_to, self::RAWS)) {
				throw new PawHelperException("Invalid target denomination: $denomination_to");
			}
			
			$raw = self::den2raw($amount, $denomination_from);
			
			return self::raw2den($raw, $denomination_to);
		}
	}
	
?>