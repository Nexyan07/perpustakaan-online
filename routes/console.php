<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('schedule:run', function () {
    $this->call('fines:check');
});

Artisan::command('cek:run', function () {
    $this->call('app:cek-denda');
});
