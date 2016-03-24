<?php

namespace Brief\Models;

/**
 * @author Pavel Jurásek
 */
class Sender
{

	/** @var string */
	private $name;

	/** @var string */
	private $email;

	/** @var string|NULL */
	private $replyTo;


	/**
	 * @param string $name
	 * @param string $email
	 * @param string|NULL $replyTo
	 */
	public function __construct($name, $email, $replyTo = NULL)
	{
		$this->name = $name;
		$this->email = $email;
		$this->replyTo = $replyTo ?: $email;
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
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return string|NULL
	 */
	public function getReplyTo()
	{
		return $this->replyTo;
	}

}
