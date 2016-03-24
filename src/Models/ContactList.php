<?php

namespace Brief\Models;

class ContactList extends \Brief\Model {

	/** @var int */
	public $id;

	/** @var string */
	public $name;

	/** @var int|NULL */
	public $segment_id;


	public function __construct($api, $data)
	{
		parent::__construct($api);

		$this->id = (int)    $data->id;
		$this->name = (string) $data->name;
		$this->segment_id = $data->segment_id instanceof \SimpleXMLElement ? NULL : (int) $data->segment_id;
	}

	public function getContacts() {
		return $this->api->contactListsGetContacts($this->id);
	}

}
