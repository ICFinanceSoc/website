<?php

namespace ICFS\Model;

class ICFSTeam {
	function __construct(&$app) {
		$this->table_name = "NGAP_team";
		$this->app = $app;
	}

	function getComittee($year) {
		return $this->app['db']->fetchAll("SELECT * FROM {$this->table_name} WHERE year = ? ORDER BY `order` ASC", array($year));
	}
}














