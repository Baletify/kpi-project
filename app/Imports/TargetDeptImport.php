<?php

namespace App\Imports;

use App\Http\Controllers\TargetController;
use Illuminate\Http\Request;
use App\Models\Target;
use App\Models\TargetUnit;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class TargetDeptImport implements ToCollection, WithHeadingRow, WithSkipDuplicates
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

        $yearQuery = request()->input('year');
        $year = Carbon::parse($yearQuery . '-01-01')->startOfDay()->format('Y-m-d H:i:s');
        $department_id = request()->input('department_id');

        // dd($department_id);

        foreach ($rows as $row) {
            if ($row->filter()->isEmpty()) {
                break; // Stop the loop if the row is empty
            }
            // dd($row);
            $data = [
                'target_1' => $row['jan'],
                'target_2' => $row['feb'],
                'target_3' => $row['mar'],
                'target_4' => $row['apr'],
                'target_5' => $row['mei'],
                'target_6' => $row['jun'],
                'target_7' => $row['jul'],
                'target_8' => $row['agu'],
                'target_9' => $row['sep'],
                'target_10' => $row['okt'],
                'target_11' => $row['nov'],
                'target_12' => $row['des'],
            ];

            $targetUnit = TargetUnit::Create($data);
            // dd($targetUnit);
            // Insert into Target table with the new target unit ID
            $this->controller->storeTargetDept($row->toArray(), $targetUnit->id, $year, $department_id);
        }
        flash()->success('Targets successfully Imported');
    }
}
