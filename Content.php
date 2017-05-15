<?php

require_once(__DIR__."/vendor/autoload.php");

require_once __DIR__.'/config.php';

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
        "stock" => $faker->randomDigitNotNull,
        "updated" => date('Y-m-d H:i:s'),
        "category" => [
            [
                'categoryid' => 'category-0',
                'name' => $faker->word
            ]
        ]
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
            "stock" => $faker->randomDigitNotNull,
            "updated" => date('Y-m-d H:i:s'),
            "category" => [
                [
                    'categoryid' => 'category-'.$i,
                    'name' => $faker->word
                ]
            ]
        ]
    ];
}
$contentItems = $api->Content->Bulk($contentItems);
echo "<pre>";
print_r($contentItems);
echo "</pre>";

$categoryItem = [
    "projectid" => $projectId,
    "itemid" => "category-0",
    'itemtype' => "category",
    'type' => "category",
    "source" => "MyWebshop",
    "item" => [
        "name" => $faker->sentence,
        "description" => $faker->sentence(10),
        "content" => $faker->paragraphs(3, true),
        "url" => $faker->url,
        "image" => $faker->imageUrl(),
        "updated" => date('Y-m-d H:i:s'),
    ]
];
$categoryItem = $api->Content->Create($categoryItem);
echo "<pre>";
print_r($categoryItem);
echo "</pre>";

$categoryItems = [];
for ($i=0;$i<=10;$i++) {
    $faker->seed($i);
    $categoryItems[] = [
        "projectid" => $projectId,
        "itemid" => "category-".$i,
        "itemtype" => "category",
        "type" => "category",
        "source" => "MyWebshop",
        "item" => [
            "name" => $faker->sentence,
            "description" => $faker->sentence(10),
            "content" => $faker->paragraphs(3, true),
            "url" => $faker->url,
            "image" => $faker->imageUrl(),
            "updated" => date('Y-m-d H:i:s'),
        ]
    ];
}
$categoryItems = $api->Content->Bulk($categoryItems, 'categories');
echo "<pre>";
print_r($categoryItems);
echo "</pre>";
