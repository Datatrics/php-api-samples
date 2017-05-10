<?php

require_once(__DIR__."/vendor/autoload.php");

$apiKey = '';
$projectId = '';

$api = new Datatrics\API\Client($apiKey, $projectId);

$faker = Faker\Factory::create();
$faker->seed(0);

$contentItem = [
    "projectid" => $projectId,
    "itemid" => "content-0",
    'itemtype' => "product",
    'type' => "item",
    "source" => "MyWebshop",
    "item" => [
        "name" => $faker->sentence,
        "description" => $faker->sentence(10),
        "content" => $faker->paragraphs(3, true),
        "url" => $faker->url,
        "image" => $faker->imageUrl(),
        "sku" => $faker->word,
        "price" => $faker->randomNumber(2),
        "stock" => $faker->randomDigitNotNull
    ]
];
$contentItem = $api->Content->Create($contentItem);
echo "<pre>";
print_r($contentItem);
echo "</pre>";

$contentItems = [];
for ($i=0;$i<=10;$i++) {
    $faker->seed($i);
    $contentItems[] = [
        "projectid" => $projectId,
        "itemid" => "content-".$i,
        "itemtype" => "product",
        "type" => "item",
        "source" => "MyWebshop",
        "item" => [
            "name" => $faker->sentence,
            "description" => $faker->sentence(10),
            "content" => $faker->paragraphs(3, true),
            "url" => $faker->url,
            "image" => $faker->imageUrl(),
            "sku" => $faker->word,
            "price" => $faker->randomNumber(2),
            "stock" => $faker->randomDigitNotNull
        ]
    ];
}
$contentItems = $api->Content->Bulk($contentItems);
echo "<pre>";
print_r($contentItems);
echo "</pre>";
