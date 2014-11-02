<?php
namespace ICFS\Model;

/**
 * @Entity @Table(name="ng_sponsors")
 **/
class Sponsors
{
    /** @Id @Column(type="integer") @GeneratedValue */
	protected $sid;

	/** @Column */
	protected $name;

	/** @Column(type="smallint") */
	protected $type;

	/** @Column(type="text") */
	protected $about;

	/** @Column */
	protected $logo;

	/** @Column */
	protected $url;

	function getId() {
		return $this->sid;
	}

	function getName() {
		return $this->name;
	}
	function setName($name) {
		if (strlen($name) < 2)
			return false;
		$this->name = $name;
		return true;
	}

	function getType() {
		return $this->type;
	}
	function setType($type) {
		if ($type > 4 || $type < 1)
			return false;
		$this->type = $type;
		return true;
	}

	function getAbout() {
		return $this->about;
	}
	function setAbout($about) {
		$this->about = $about;
		return true;
	}

	function getLogo() {
		return $this->logo;
	}
	function setLogo($logo) {
		if (strlen($logo) < 5)
			return false;
		$this->logo = $logo;
		return true;
	}

	function getUrl() {
		return $this->url;
	}
	function setUrl($url) {
		if (filter_var($url, FILTER_VALIDATE_URL) == false)
			return false;
		$this->url = $url;
		return true;
	}


	function update($data) {
		if (!$this->setName($data['name']))
			return "Sponsor names must be over one character!";
		if (!$this->setType($data['type']))
			return "Invalid sponsor type.";
		if (!$this->setUrl($data['url']))
			return "Invalid URL. Make sure you add http://";
		if (!$this->setLogo($data['logo']))
			return "Ensure the logo is set";
		if (!$this->setAbout($data['about']))
			return "Error with about.";
	}

}









