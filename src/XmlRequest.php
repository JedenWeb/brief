<?php

namespace Brief;

class XmlRequest {

	/** @var Api */
	public $api;

	/** @var \SimpleXMLElement */
	public $xml;


	/**
	 * @param Api $api
	 */
	public function __construct(Api $api)
	{
		$this->api = $api;

		$this->xml = new \SimpleXMLElement('<xmlrequest/>');
		$this->xml->addChild('username', $this->api->username);
		$this->xml->addChild('usertoken', $this->api->usertoken);
	}

	/**
	 * @param array $array
	 *
	 * @return $this
	 */
	public function setDetails(array $array) {
		$details = $this->addChild('details');
		$this->mapXmlNodes($details, $array);

		return $this;
	}

	/**
	 * @param \SimpleXMLElement $parent
	 * @param $array
	 */
	private function mapXmlNodes(\SimpleXMLElement $parent, $array)
	{
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$child = $parent->addChild($key);
				$k = key($value);

				if (is_integer($k)) {
					foreach ($value as $v) {
						$this->mapXmlNodes($child->addChild('item'), $v);
					}
				} else {
					$this->mapXmlNodes($child, $value);
				}
			} else {
				$parent->addChild($key, $value);
			}
		}
	}

	public function addChild($name, $value = null) {
		return $this->xml->addChild($name, $value);
	}

	public function asXml() {
		if (!isset($this->xml->details)) {
			$this->xml->addChild('details');
		}

		$xml = $this->xml->asXml();
		$xml = html_entity_decode($xml, ENT_NOQUOTES, 'UTF-8');

		return $xml;
	}

}
