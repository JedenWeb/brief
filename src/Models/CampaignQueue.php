<?php

namespace Brief\Models;

use Brief\Api;

/**
 * @author Pavel Jurásek
 */
class CampaignQueue
{

	/** @var int */
	private $id;

	/** @var string */
	private $name;

	/** @var string */
	private $processed;

	/** @var \DateTime */
	private $start;

	/** @var array */
	private $lists;

	/** @var array */
	private $excludes;


	/**
	 * @param Api $api
	 * @param \SimpleXMLElement $data
	 */
	public function __construct(Api $api, \SimpleXMLElement $data)
	{
		$this->id = (int) $data->id;
		$this->name = (string) $data->name;
		$this->processed = (string) $data->processed;
		$this->start = \DateTime::createFromFormat('Y-m-d H:i:s', (string) $data->start);
		$this->lists = (array) $data->contactlists->item;
		$this->excludes = (array) $data->excludedcontactlists->item;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getProcessed()
	{
		return $this->processed;
	}

	/**
	 * @return \DateTime
	 */
	public function getStart()
	{
		return $this->start;
	}

	/**
	 * @return array
	 */
	public function getLists()
	{
		return $this->lists;
	}

	/**
	 * @return array
	 */
	public function getExcludes()
	{
		return $this->excludes;
	}

}
