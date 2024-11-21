<?php

namespace App\Imports;

use App\Http\Controllers\TargetController;
use App\Models\TargetUnit;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class TargetImport implements ToCollection
{
    protected $controller;

    public function __construct(TargetController $controller)
    {
        $this->controller = $controller;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Insert into TargetUnit table
            $targetUnit = TargetUnit::create([
                'target_1' => $row['jan'],
                'target_2' => $row['feb'],
                'target_3' => $row['mar'],
                'target_4' => $row['apr'],
                'target_5' => $row['may'],
                'target_6' => $row['jun'],
                'target_7' => $row['jul'],
                'target_8' => $row['aug'],
                'target_9' => $row['sep'],
                'target_10' => $row['oct'],
                'target_11' => $row['nov'],
                'target_12' => $row['dec'],
                // Add other fields as necessary
            ]);

            // Insert into Target table with the new target unit ID
            $this->controller->storeTarget($row->toArray(), $targetUnit->id);
        }
    }
}
