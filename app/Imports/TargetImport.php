<?php

namespace App\Imports;

use App\Http\Controllers\TargetController;
use App\Models\Target;
use App\Models\TargetUnit;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class TargetImport implements ToCollection, WithHeadingRow, WithSkipDuplicates
{
    protected $controller;

    public function __construct(TargetController $controller)
    {
        $this->controller = $controller;
    }

    public function headingRow(): int
    {
        return 5;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isEmpty()) {
                break; // Stop the loop if the row is empty
            }
            $targetUnit = TargetUnit::create([
                'target_1' => $row['jan'],
                'target_2' => $row['feb'],
                'target_3' => $row['mar'],
                'target_4' => $row['apr'],
                'target_5' => $row['may'],
                'target_6' => $row['jun'],
                'target_7' => $row['jul'] ?? null,
                'target_8' => $row['aug'] ?? null,
                'target_9' => $row['sep'] ?? null,
                'target_10' => $row['oct'] ?? null,
                'target_11' => $row['nov'] ?? null,
                'target_12' => $row['dec'] ?? null,
                // Add other fields as necessary
            ]);


            // Insert into Target table with the new target unit ID
            $this->controller->storeTarget($row->toArray(), $targetUnit->id);
        }
    }
}
