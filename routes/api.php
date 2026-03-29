<?php

use App\Http\Controllers\Api\SkillTestController;
use Illuminate\Support\Facades\Route;

Route::get('skill-test-1', [SkillTestController::class, 'skillTest1']);
