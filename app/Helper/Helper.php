<?php

namespace App\Helper;

use App\Models\Kasmsk;

class Helper
{
    public static function generateId()
    {
        $items = Kasmsk::latest('id')->first();

        $yearsMonth = date('Y');

        if (!$items) {
            $uniqueCode = "KM/" . substr($yearsMonth, -2) . date('m') . "/0001";
        } else {
            // $items = $items->last();
            $items = substr($items->nobukti, -4) + 1;
            $items = sprintf("%04d", $items);
            $uniqueCode = "KM/" . substr($yearsMonth, -2) . date('m') . "/" . $items;
        }

        return $uniqueCode;
    }

    public static function generateKasMsk()
    {
        $items = Kasmsk::latest('id')->first();

        if (!$items) {
            $kasmskUnique = "KM000001";
        } else {
            $item_kasMasuk = substr($items->kasmsk, -4) + 1;
            $path_kas = sprintf("%06d", $item_kasMasuk);
            $kasmskUnique = "KM" . $path_kas;
        }
    }
}
