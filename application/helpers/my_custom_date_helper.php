<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Date Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/date_helper.html
 */

// ------------------------------------------------------------------------

	function timeToDecimal($time){
	   list($hour,$min, $sec) = explode(":",$time);
	   return round((float)($hour + ($min / 60)),2);
	}

	function decimalToTime($dec){
		$seconds = ($dec * 3600);
		$hours = floor($dec);
		$seconds -= $hours * 3600;
		$minutes = floor($seconds / 60);
		$seconds -= $minutes * 60;
		return lz($hours).":".lz($minutes).":".lz($seconds);
	}

	function lz($num){
		return (strlen($num) < 2) ? "0{$num}" : $num;
	}	
	
	function today($format = 'd/m/Y'){
		date_default_timezone_set("Asia/Kolkata");
		return date($format);
	}
	function getCurrentTimeStamp(){
		date_default_timezone_set("Asia/Kolkata");
		return date('H:i:s');
	}
	function todayTimeStamp(){
		date_default_timezone_set("Asia/Kolkata");
		return date('Y-m-d H:i:s');
	}
	function todayDateStamp(){
		date_default_timezone_set("Asia/Kolkata");
		return date('Y-m-d');
	}
	function DateToDateStamp($date){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format('Y-m-d');
	}
	function todayDateTimeString(){
		date_default_timezone_set("Asia/Kolkata");
		return date('d M, Y | H:i A');
	}
	function todayDateString(){
		date_default_timezone_set("Asia/Kolkata");
		return date('M d, Y');
	}
	function nowTime($format = 'H:i A'){
		date_default_timezone_set("Asia/Kolkata");
		return date($format);
	}
	function dateTimeToString($date){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format('d M, Y | h:i A');
	}
	function day($date){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format('d');
	}
	function month($date){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format('M');
	}
	function dateToString($date){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format('d M, Y');
	}
	function monthYearToString($date){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format('M, Y');
	}
	function epocTime($time){
		date_default_timezone_set("Asia/Kolkata");
		$myTime = new DateTime($time);
		return $myTime->format('h:i A');
	}
	function stringToDate($date, $format = 'Y-m-d H:i:s'){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format($format);
	}
	function daysFromToday($date){
		date_default_timezone_set("Asia/Kolkata");
		$today = date_create(todayDateStamp());
		$date = date_create(DateToDateStamp($date));
		$diff = date_diff($date,$today);
		return $diff->format("%R%a");
	}
	function dateDiff ($d1, $d2) {
		date_default_timezone_set("Asia/Kolkata");
		return round(abs(strtotime($d1)-strtotime($d2))/86400);
	}
	function daysBetweenDates($date1,$date2){
		date_default_timezone_set("Asia/Kolkata");
		$date1 = date_create(DateToDateStamp($date1));
		$date2 = date_create(DateToDateStamp($date2));
		$diff = date_diff($date1,$date2);
		return $diff->format("%a");
	}
	function secondsBetweenTime($time1,$time2){	
	    date_default_timezone_set("Asia/Kolkata");
		$time_1 = new DateTime($time1);
		$time_2 = new DateTime($time2);
		$diff = strtotime($time_1) - strtotime($time_2);
		return $diff;
	}
	function modifyDaysToDate($date, $operand, $days, $format ='Y-m-d H:i:s'){
		$dateObj = new DateTime($date);
		$dateObj->modify("$operand $days days");
		return $dateObj->format($format);
	}
	function mergeDateTime($date , $time, $format = 'Y-m-d H:i:s'){
		$string = $date." ".$time;
	}
	function convertToMySqlTimeStamp($date){
		date_default_timezone_set("Asia/Kolkata");
		$myDate = new DateTime($date);
		return $myDate->format('Y-m-d H:i:s');
	}
?>