<?php

/* Get pages from NGAP instead of admin */

class NGAPAweosmeToAdminShit {
	function __construct($db) {
		$this->db = $db;
	}

	function EchoIfClassDefaultSaysYes($page, $echo = false) {
		if ($echo === false) return false;
		// No error checks!
		$row = $this->db->query("SELECT * FROM pages_content WHERE name = '" . $this->db->escape_string($page) . "'")->fetch_assoc();
		return $row['content'];
	}
}