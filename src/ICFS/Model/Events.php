<?php

namespace ICFS\Model;

class Events {
	function __construct(&$app) {
		$this->table_name = "NGAP_EVENT";
		$this->app = $app;
	}

	function get($eventID) {
		$event = new EventObject($this->app, $eventID);
		if ($event->exists)
			return $event;
		return false;
	}

	function create($data) {
		$this->app['db']->insert($this->table_name, $data);
		return new EventObject($this->app, $this->app['db']->lastInsertId());
	}

	function filter($where = null, $order = null, $limit = null) {
		$where = ($where != null) ? " WHERE $where" : "";
		$order = ($order != null) ? " ORDER BY $order" : "";
		$limit = ($limit != null) ? " LIMIT $limit" : "";
		return $this->app['db']->fetchAll("SELECT * FROM " . $this->table_name . $where . $order . $limit);
	}

	function attending($eventid, $userid) {
		return sizeof($this->app['db']->fetchAll("SELECT * FROM attendance WHERE eventid = ? AND username = ?", array($eventid, $userid)));
	}

	function removeAttendance($eventid, $userid) {
		$this->app['db']->delete('attendance', array('eventid' => $eventid, 'username' => $userid));
	}

	function addAttendance($eventid, $userid) {
		$this->app['db']->insert('attendance', array('eventid' => $eventid, 'username' => $userid));
	}
}

class EventObject {
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
	}

	function update($data) {
		echo $this->app['db']->update($this->table_name, $data, array('eid' => $this->id));
	}
}




















