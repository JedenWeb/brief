<?php

namespace Brief;

use Tracy\Debugger;

class Request {

	/** @var Api */
	public $api;

	/** @var XmlRequest */
	public $xmlRequest;

	/** @var int */
	public $timeout = 30;


	/**
	 * @param Api $api
	 */
	public function __construct(Api $api)
	{
		$this->api = $api;
		$this->xmlRequest = new XmlRequest($api);
	}

	public function setTimeout($timeout) {
		$this->timeout = $timeout;

		return $this;
	}

	public function setEndpoint($type, $method) {
		$this->xmlRequest->addChild('requesttype', $type);
		$this->xmlRequest->addChild('requestmethod', $method);

		return $this;
	}

	public function setXmlRequest($xmlRequest) {
		$this->xmlRequest = $xmlRequest;

		return $this;
	}

	/**
	 * @param array $array
	 */
	public function setDetails(array $array)
	{
		$this->xmlRequest->setDetails($array);

		return $this;
	}

	public function getResponse() {
		$curl = new \Curl\Curl();
		$curl->setHeader('Content-Type', 'text/xml; charset=UTF8');
		$curl->setTimeout($this->timeout);
		$response = $curl->post($this->api->apiUrl, $this->xmlRequest->asXml());

		if ($curl->curlError) {
			Debugger::log($this->xmlRequest->asXml(), 'brief');
			throw new Exceptions\CurlException($curl->curlErrorMessage, $curl->curlErrorCode);
		} elseif ($curl->httpError) {
			Debugger::log($this->xmlRequest->asXml(), 'brief');
			throw new Exceptions\HttpException($curl->httpErrorMessage, $curl->httpStatusCode);
		}

		return new Response($response);
	}

}
