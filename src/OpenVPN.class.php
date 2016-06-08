<?php

if(count(get_included_files()) ==1) exit("Direct access not permitted.");

// JSONWrapper is used because the router doesn't support json_decode
// https://boutell.com/scripts/jsonwrapper.html
require 'jsonwrapper/jsonwrapper.php';

/**
 * Wrapper for OpenVPN shell commands
 * @author Bradley Rosenfeld
 */
class OpenVPN {
	private $daemon = "openvpn";
	private $wait = 3;
	private $ip_check = "http://ip-api.com/json/";

	public function __construct() {
		exec("pgrep " . $this->daemon, $output, $return);
		// Check whether OpenVPN is started
		$this->started = ($return == 0);		
	}
	
	/**
	 * Start OpenVPN client
	 * @return boolean (whether the client has started)
	 */
	public function start() {
		if ($this->started) return true;
		exec("/etc/init.d/" . $this->daemon . " start", $output, $return);
		$this->started = ($return == 0);
		sleep($this->wait);
		return $this->started;
	}
	
	/**
	 * Stop OpenVPN client
	 * @return boolean (whether the client has stoppped)
	 */
	public function stop() {
		if (!$this->started) return true;
		exec("/etc/init.d/" . $this->daemon . " stop", $output, $return);
		$this->started = !($return == 0);
		sleep($this->wait);
		return !$this->started;
	}

	/**
	 * Get current IP and location
	 * @return array
	 */
	public function ip() {
		return json_decode(file_get_contents($this->ip_check));
	}
}
