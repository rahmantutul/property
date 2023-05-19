<?php

namespace App\Common;

use App\Models\OreGon;

class Store {

    public static function storeMetaData($metadata, $existingValues)
    {
        //if metadata does not exists into table then metadata store in the table.
        if (!in_array($metadata['url'], $existingValues)) {
            $data = OreGon::create([
                'name' => $metadata['name'],
                'url' => $metadata['url'],
                'status' => 1,
            ]);
        }
    }


}






















?>
