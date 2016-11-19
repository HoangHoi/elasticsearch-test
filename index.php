<?php
use Elasticsearch\ClientBuilder;
require 'vendor/autoload.php';

//$hosts = [
//    // This is effectively equal to: "https://username:password!#$?*abc@foo.com:9200/"
//    [
//        'host' => 'localhost',
//        'port' => '9200',
//        'scheme' => 'http',
////        'user' => 'username',
////        'pass' => 'password!#$?*abc'
//    ],
//];
$client = ClientBuilder::create()
        ->setHosts(['http://localhost:9300'])
//        ->setRetries(12)
        ->build();

$params = [
    'index' => 'my_index',
    'body' => [
        'settings' => [
            'number_of_shards' => 3,
            'number_of_replicas' => 2
        ],
        'mappings' => [
            'my_type' => [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => [
                    'first_name' => [
                        'type' => 'string',
                        'analyzer' => 'standard'
                    ],
                    'age' => [
                        'type' => 'integer'
                    ]
                ]
            ]
        ]
    ]
];


// Create the index with mappings and settings now
$response = $client->indices()->create($params);