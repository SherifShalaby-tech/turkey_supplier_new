<?php


use App\Models\Setting;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$this->factory->define(Setting::class, function (Faker $faker) {
    return [
        'company_name' => "site name",
        'company_phone' => "address",
        'company_address' => "999999999",
        'email' => "test@test.com",
        'city' => "city",
        'facebook' => "www.facebook.com",
        'linkedin' => "www.linkedin.com",
        'phone' => "999999999",
        'logo' => "logo-invoices.jpg",
        'icon' => "icon-invoices.jpg",
    ];
});
