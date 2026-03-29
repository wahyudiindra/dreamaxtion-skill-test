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

    public function skillTest2()
    {
        // Urutkan array dibawah ini dari yang terkecil sampai terbesar dengan menggunakan perulangan dan kondisi (jangan menggunakan sorting function dari bahasa pemrograman)
        // Array = [9,3,7,8,2,6,1,4,10,2,2,3]

        // - Define input = [9,3,7,8,2,6,1,4,10,2,2,3]
        // - Define $len = length of input
        // - Loop input as $i
        //      - Loop as $j (0 to $len -$i - 1)
        //          - Check  arr[j] > arr[j+1]
        //              - set temp = arr[j]
        //              - set arr[j] = arr[j+1]
        //              - set arr[j+1] = temp
        //      - End loop as $j
        // - End loop input  as $i
        // - return input after sorted asc

        $input = [9, 3, 7, 8, 2, 6, 1, 4, 10, 2, 2, 3];
        $len = count($input);
        for ($i = 0; $i < $len; $i++) {
            for ($j = 0; $j < $len - $i - 1; $j++) {
                if ($input[$j] > $input[$j + 1]) {
                    $temp = $input[$j];
                    $input[$j] = $input[$j + 1];
                    $input[$j + 1] = $temp;
                }
            }
        }
        return $input;
    }
}
