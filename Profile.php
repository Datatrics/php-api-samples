<?php

require_once(__DIR__."/vendor/autoload.php");

require_once __DIR__.'/config.php';

$api = new Datatrics\API\Client($apiKey, $projectId);

$genders = ['male', 'female'];
$gender = $genders[mt_rand(0, count($genders) - 1)];

$faker = Faker\Factory::create();
$faker->seed(0);

$profile = [
    "projectid" => $projectId,
    "profileid" => "profile-0",
    "source" => "MyWebshop",
    "profile" => [
        "created" => date('Y-m-d H:i:s', $faker->unixTime),
        "updated" => date('Y-m-d H:i:s'),
        "company" => $faker->company,
        "dateofbirth" => $faker->date(),
        "firstname" => $faker->firstName,
        "lastname" => $faker->lastName,
        "zip" => $faker->postcode,
        "city" => $faker->city,
        "country" => $faker->country,
        "address" => $faker->streetAddress,
        "phone" => $faker->phoneNumber,
        "nationality" => $faker->country,
        "mobile" => $faker->format('e164PhoneNumber'),
        "title" => $faker->title,
        "prefix" => $faker->suffix,
        "email" => $faker->safeEmail,
        "lang" => $faker->languageCode,
        "gender" => $gender
    ]
];
$profile = $api->Profile->Create($profile);
echo "<pre>";
print_r($profile);
echo "</pre>";

$profiles = [];
for ($i=1;$i<=10;$i++) {
    $faker->seed($i);
    $profiles[] = [
        "projectid" => $projectId,
        "profileid" => "profile-".$i,
        "objecttype" => "profile",
        "source" => "MyWebshop",
        "profile" => [
            "created" => date('Y-m-d H:i:s', $faker->unixTime),
            "updated" => date('Y-m-d H:i:s'),
            "company" => $faker->company,
            "dateofbirth" => $faker->date(),
            "firstname" => $faker->firstName,
            "lastname" => $faker->lastName,
            "zip" => $faker->postcode,
            "city" => $faker->city,
            "country" => $faker->country,
            "address" => $faker->streetAddress,
            "phone" => $faker->phoneNumber,
            "nationality" => $faker->country,
            "mobile" => $faker->format('e164PhoneNumber'),
            "title" => $faker->title,
            "prefix" => $faker->suffix,
            "email" => $faker->safeEmail,
            "lang" => $faker->languageCode,
            "gender" => $gender
        ]
    ];
}
$profiles = $api->Profile->Bulk($profiles);
echo "<pre>";
print_r($profiles);
echo "</pre>";
