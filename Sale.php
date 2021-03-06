<?php

require_once(__DIR__."/vendor/autoload.php");

require_once __DIR__.'/config.php';

$api = new Datatrics\API\Client($apiKey, $projectId);

$faker = Faker\Factory::create();
$faker->seed(0);

$sale = [
    "projectid" => $projectId,
    "conversionid" => "conversion-0",
    "objecttype" => "conversion",
    "source" => "MyWebshop",
    "conversion" => [
        "profileid" => "profile-0",
        "total" => $faker->randomNumber(2),
        "status" => "orderstate",
        "created" => date('Y-m-d H:i:s', $faker->unixTime),
        "updated" => date('Y-m-d H:i:s'),
        "items" => [
            [
                "itemid" => "content-0",
                "sku" => $faker->word,
                "name" => $faker->sentence,
                "quantity" => $faker->randomDigitNotNull,
                "price" => $faker->randomNumber(2),
                "total" => $faker->randomNumber(2)
            ]
        ]
    ]
];
$sale = $api->Sale->Create($sale);
echo "<pre>";
print_r($sale);
echo "</pre>";

$sales = [];
for ($i=1;$i<=10;$i++) {
    $faker->seed($i);
    $sales[] = [
        "projectid" => $projectId,
        "conversionid" => "conversion-".$i,
        "objecttype" => "conversion",
        "source" => "MyWebshop",
        "conversion" => [
            "profileid" => "profile-".$i,
            "total" => $faker->randomNumber(2),
            "status" => "orderstate",
            "created" => date('Y-m-d H:i:s', $faker->unixTime),
            "updated" => date('Y-m-d H:i:s'),
            "items" => [
                [
                    "itemid" => "content-".$i,
                    "sku" => $faker->word,
                    "name" => $faker->sentence,
                    "quantity" => $faker->randomDigitNotNull,
                    "price" => $faker->randomNumber(2),
                    "total" => $faker->randomNumber(2)
                ]
            ]
        ]
    ];
}
$sales = $api->Sale->Bulk($sales);
echo "<pre>";
print_r($sales);
echo "</pre>";
