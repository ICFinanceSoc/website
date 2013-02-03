<?php
namespace ICFS\Model;

class Page
{
	var $name, $exists, $data, $app;

	function __construct($app, $pageid) {
		$this->name = $pageid;
		$this->app = $app;

		if ($this->data = $app['db']->executeQuery("SELECT * FROM pages_content WHERE name = ?", array($pageid))->fetch()) {
			$this->exists = true;
		}
	}

	static function create($app, $data) {
		if (Page::checkName($app, $data['name'])) {
			$app['db']->executeQuery("INSERT INTO pages_content VALUES (?, ?, ?, null, NOW())", array(
	            $data['name'],
	            $data['title'],
	            $data['content']
	        ));
			return new Page($app, $data['name']);
		}
		
		return false;
	}
	// check if a page already exists in the database. Illegal returns false always, exception will not check for that page (unless illegal!)
	static function checkName($app, $newPageName, $illegal = array(), $exception = array())
	{
		$illegal[] = 'add'; // 'Add' should never be allowed!

		if (in_array($newPageName, $illegal))
			return false;
		if (in_array($newPageName, $exception))
			return true;
		if (!$app['db']->executeQuery("SELECT * FROM pages_content WHERE name = ?", array($newPageName))->fetch()) //if it does NOT exist
			return true;

		return false;
	}

	function canRename($newPageName)
	{
		return $this::checkName($this->app, $newPageName, array(), array($this->name));
	}

	function delete()
	{
		return $this->app['db']->executeQuery("DELETE FROM pages_content WHERE name = ?", array($this->name));
	}

	/* 
	** Updates according to $data
	** Data is assumed to be an array containing:
	**   name - The name of the page
	**   title - The title of the page
	**   content - ..
	**   owner - the person who is now editing the page
	**
	** The update is performed on $this.
	*/
	function update($data) {
		return $this->app['db']->executeUpdate("UPDATE pages_content SET name = ?, title = ?, content = ?, lastedit_who = ?, lastedit_when = NOW() WHERE name = ?", array(
            $data['name'],
            $data['title'],
            $data['content'],
            $data['owner'],
            $this->name
        ));
	}
}









