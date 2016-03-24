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

		$segment = (int) $data->segment_id;

		$this->id = (int)    $data->id;
		$this->name = (string) $data->name;
		$this->segment_id = $segment ?: NULL;
	}

	public function getContacts() {
		return $this->api->contactListsGetContacts($this->id);
	}

}
