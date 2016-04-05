<?php

require __DIR__ . '/../bootstrap.php';

use Brief\XmlRequest;

/** @var \Mockery\Mock $api */
$api = Mockery::mock(\Brief\Api::class);
$api->username = 'abc';
$api->usertoken = 'xyz';

$xmlRequest = new XmlRequest($api);

$xmlRequest->setDetails([
	'emailaddress' => 'a@b.cz',
	'name' => 'John',
	'surname' => 'Doe',
	'contactliststatuses' => [
		[
			'id' => 4,
			'status' => 'confirmed',
		],
		[
			'id' => 6,
			'status' => 'confirmed',
		],
	],
]);

$expected = '<?xml version="1.0"?>
<xmlrequest><username>abc</username><usertoken>xyz</usertoken><details><emailaddress>a@b.cz</emailaddress><name>John</name><surname>Doe</surname><contactliststatuses><item><id>4</id><status>confirmed</status></item><item><id>6</id><status>confirmed</status></item></contactliststatuses></details></xmlrequest>
';

\Tester\Assert::same($expected, $xmlRequest->asXml());


$xmlRequest = new XmlRequest($api);

$xmlRequest->setDetails([
	'id' => 1,
]);

$expected = '<?xml version="1.0"?>
<xmlrequest><username>abc</username><usertoken>xyz</usertoken><details><id>1</id></details></xmlrequest>
';

\Tester\Assert::same($expected, $xmlRequest->asXml());
