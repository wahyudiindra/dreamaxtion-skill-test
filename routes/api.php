<?php

use App\Http\Controllers\Api\SkillTestController;
use Illuminate\Support\Facades\Route;

Route::get('skill-test-1', [SkillTestController::class, 'skillTest1']);
Route::get('skill-test-2', [SkillTestController::class, 'skillTest2']);
Route::post('skill-test-3', [SkillTestController::class, 'totalPrice']);
