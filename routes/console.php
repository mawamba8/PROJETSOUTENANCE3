<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\InsuranceClaim;

// (déjà là dans le stub de Laravel, ok)
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ===== Scheduler: bascule en "timeout" les demandes d'assurance échues =====
Schedule::call(function () {
    InsuranceClaim::where('status', 'pending')
        ->whereNotNull('response_due_at')
        ->where('response_due_at', '<', now())
        ->update(['status' => 'timeout']);
})->everyFifteenMinutes();
