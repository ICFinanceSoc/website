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
		} //, UNIX_TIMESTAMP(starttime) as starttimeInt, UNIX_TIMESTAMP(endtime) as endtimeInt 
	}

	static function create($app, $data) {
		$app['db']->insert("NGAP_EVENT", $data);
		return new Event($app, $app['db']->lastInsertId());
	}

	function update($data) {
		echo $this->app['db']->update($this->table_name, $data, array('eid' => $this->id));
	}
}




















