<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class SkillTestController extends Controller
{
    public function skillTest1()
    {
        // - Define input = "aaabbcccddeddbzaa"
        // - Define Map data
        // - Loop input
        //     - Set Map data
        // - End loop input
        // - Sorting map data asc
        // - return Map data as string

        $input = "aaabbcccddeddbzaa";
        $mappedData = collect();
        $len = strlen($input);

        for ($i = 0; $i < $len; $i++) {
            $char = $input[$i];
            if ($mappedData->has($char)) {
                $mappedData->put($char, $mappedData->get($char) + 1);
            } else {
                $mappedData->put($char, 1);
            }
        }
        return $mappedData->sortKeys()->map(function ($val, $key) {
            if ($val > 1) {
                return $key . $val;
            }

            return $key;
        })->join("");
    }
}
