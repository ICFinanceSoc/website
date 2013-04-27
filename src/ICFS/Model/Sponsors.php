<?php
namespace ICFS\Model;

class Sponsors
{
	function __construct($app) {
		$this->app = $app;
	}

	function all() {
		return $this->app['db']->fetchAll('SELECT * FROM NGAP_sponsors');
	}

	function add($data){
		unset($data['sid']);

		if ($this->app['db']->insert('NGAP_sponsors', $data))
			return $this->app['db']->lastInsertId();
		else
			return false;
	}

	function update($data){
		$sid = $data['sid'];

		unset($data['sid']);

		$this->app['db']->update('NGAP_sponsors', $data, array('sid' => $sid));

		return $sid;
	}

	function fetch($id) {
		return $this->app['db']->executeQuery('SELECT * FROM NGAP_sponsors WHERE sid = ?', array($id))->fetch();
	}
}









