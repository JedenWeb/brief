<?php

namespace Brief;

class Response {

	public $response;

	public function __construct($response) {
		$this->response = $response;
	}

	/**
	 * @return bool
	 */
	public function isOk()
	{
		return (string) $this->response->status === 'SUCCESS';
	}

	public function getData() {
		if (isset($this->response->data)) {
			return $this->response->data;
		}

		return false;
	}

	public function getString() {
		return new Data\DataString($this->getData());
	}

	public function getList() {
		return new Data\DataList($this->getData());
	}

	public function getModel($api, $model) {
		$class = "\\Brief\\Models\\" . $model;

		return new $class($api, $this->getData());
	}

}
