<?php
namespace Paw;

class Utils
{
    public static function ordinal($number)
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
            return $number . 'th';
        }

        return $number. $ends[$number % 10];
    }

    public static function getCurrentRewardAmount()
    {
        $balance = node_get_balance(PAW_DISTRIBUTION_ACCOUNT);
        if ($balance === null || isset($balance->error)) {
            return DISTRIBUTION_AMOUNT_PER_CYCLE;
        }

        if (floatval(\Paw\Helper::raw2den($balance->balance, 'PAW')) < DISTRIBUTION_AMOUNT_PER_CYCLE) {
            return DISTRIBUTION_AMOUNT_PER_CYCLE;
        }

        return floatval(\Paw\Helper::raw2den($balance->balance, 'PAW'));
    }

    public static function getNextDistTime($lastDist)
    {
        if ($lastDist === FALSE) {
            return DISTRIBUTION_CYCLE;
        }

        if ($lastDist + (DISTRIBUTION_CYCLE * 60) < time()) {
            return DISTRIBUTION_CYCLE;
        }

        $timeUntilNext = ($lastDist + (DISTRIBUTION_CYCLE * 60)) - time();
        if($timeUntilNext < 60)
            return '<1';

        return floor($timeUntilNext / 60);
    }

    public static function validPawAddress($address)
    {
        /** The regex pattern for validating the address. */
        return preg_match('/^paw_[13]{1}[13456789abcdefghijkmnopqrstuwxyz]{59}$/', $address) === 1;
    }

    public static function getTimeAgo($time)
    {
        // get seconds ago
        $vSeconds = strtotime('now') - $time;

        // set unit labels
        $aUnitLabels = array('year','month','week','day','hour','minute','second');

        // set unit values
        $aUnitValues = array(
            floor($vSeconds / 31536000),
            floor(($vSeconds % 31536000) / 2592000),
            floor(($vSeconds % 2592000) / 604800),
            floor(($vSeconds % 604800) / 86400),
            floor(($vSeconds % 86400) / 3600),
            floor(($vSeconds % 3600) / 60),
            floor($vSeconds % 60),
        );

        // initiate array (for array_slice)
        $aUnitPairs = array();

        // loop concatenating unit value to its label
        for($i=0;$i<count($aUnitLabels);$i++){

            // pair up if greater than zero
            $vStr  = $aUnitValues[$i]>0 ? $aUnitValues[$i].' '.$aUnitValues[$i] : '';

            // grammar for plural/singular (should always be a positive number)
            $vStr .= $aUnitValues[$i]>1 ? 's' : '';

            // only add to array if not empty/zero
            if($vStr!='') $aUnitPairs[] = $vStr;
        }

        // take first item of array (round up to largest unit)
        $vReturnStr = $aUnitPairs[0].' ago';

        // return
        return $vReturnStr;
    }

    public static function randSha1($length)
    {
        $max = ceil($length / 40);
        $random = '';
        for ($i = 0; $i < $max; $i ++) {
            $random .= sha1(microtime(true).mt_rand(10000,90000));
        }
        return substr($random, 0, $length);
    }
}