<?php

namespace ICFS\Model;

class Event {
	var $id, $exists;

	function __construct(&$app, $eventID) {
		$this->table_name = "NGAP_EVENT";
		$this->exists = false;

		$this->app = $app;
		$this->id = $eventID;

		if ($this->data = $app['db']->executeQuery("SELECT * FROM ".$this->table_name." WHERE eid = ?", array($eventID))->fetch()) {
			$this->exists = true;
		}
	}
}




















