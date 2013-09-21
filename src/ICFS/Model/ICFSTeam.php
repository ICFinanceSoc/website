<?php

namespace ICFS\Model;

class ICFSTeam {
	function __construct(&$app) {
		$this->table_name = "NGAP_team";
		$this->app = $app;
	}

	function getComittee($year) {
		return $this->app['db']->fetchAll("SELECT * FROM {$this->table_name} WHERE year = ? ORDER BY `rank` ASC", array($year));
	}

	function updateFromPost($year) {

            //var_dump($this->app['request']->request->all());

            $order = 1;

            foreach($this->app['request']->request->get('comittee') as $key=>$value) {
            	//check that it's valid
            	if (!(isset($value['img']) && isset($value['name']) && isset($value['position']) && isset($value['dept']) && isset($value['about'])))
            		echo "Missing data";
            	else {
            		//Let's save
            		// Is it new?
            		$old = $this->app['db']->fetchAssoc("SELECT * FROM {$this->table_name} WHERE id = ?", array($key));
            		if (!$old) {
            			if ($key == "__new" && strlen(implode($value)) > 5 ) { // id = __new (strlen = 5)
	            			$value['year'] = $year;
	            			$value['rank'] = $order;
	            			//var_dump($value);
            				$this->app['db']->insert($this->table_name, $value);
            			}
            		} else { //update 
            			$value['year'] = $year;
            			$value['rank'] = $order;
            			$this->app['db']->update($this->table_name, $value, array('id' => $key));
            		}
            	}

            	$order++;
            }
	}
}







