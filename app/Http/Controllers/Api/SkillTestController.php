<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function totalPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'itemType' => 'required|string|in:A,B',
            'totalItem' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error validation data!',
                'errors'  => $validator->errors()
            ], 422);
        }
        // Harga untuk tipe barang A adalah Rp. 99.900,-.
        // Jika membeli dalam jumlah lebih dari 50 maka akan mendapatkan diskon 5%
        // jika membeli di hari Senin atau Kamis maka akan mendapatkan diskon tambahan sebesar 10%.
        // Harga untuk tipe barang B adalah Rp. 49.900,-.
        // Jika membeli barang dalam jumlah lebih dari 100 maka akan mendapatkan diskon 10%
        // jika membeli di hari Jumat maka akan mendapat diskon tambahan 5%.

        /*
            define totalPrice = 0
            define totalDiscount = 0
            IF item A
                totalPrice = 99900 * totalItem
                IF totalItem > 50
                    totalDiscount += totalPrice * 0.05
                IF date == "Senin" || "Kamis"
                    totalDiscount += totalPrice * 0.1
            ELSE
                totalPrice = 49900 * totalItem
                IF totalItem > 100
                    totalDiscount += totalPrice * 0.1
                IF date == "Jumat"
                    totalDiscount += totalPrice * 0.05
        */

        $itemType = $request->itemType;
        $totalItem = $request->totalItem;
        $date = now()->setTimezone('+07:00');

        $totalPrice = 0;
        $totalDiscount = 0;
        if ($itemType == "A") {
            $totalPrice =  99900 * $totalItem;
            if ($totalItem > 50) {
                $totalDiscount += $totalPrice * 0.05;
            }
            if ($date->isMonday() || $date->isThursday()) {
                $totalDiscount += $totalPrice * 0.1;
            }
        } else {
            $totalPrice =  49900 * $totalItem;
            if ($totalItem > 100) {
                $totalDiscount += $totalPrice * 0.1;
            }
            if ($date->isFriday()) {
                $totalDiscount += $totalPrice * 0.05;
            }
        }
        return $totalPrice - $totalDiscount;
    }
}
