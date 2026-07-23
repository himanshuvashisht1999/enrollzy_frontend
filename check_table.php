<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$columns = Schema::getColumnListing('mentor_profiles');
print_r($columns);

$firstRow = DB::table('mentor_profiles')->first();
print_r($firstRow);
