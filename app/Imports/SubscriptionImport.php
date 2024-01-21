<?php

namespace App\Imports;

use App\Models\Subscription;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Validators\Failure;
use Carbon\Carbon;
use Throwable;

class SubscriptionImport implements 
ToCollection, 
WithHeadingRow, 
WithValidation, 
WithBatchInserts,
SkipsEmptyRows
{
    use Importable; 
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $sDate   = Carbon::createFromFormat('Y-m-d', $row['start_date'])->toDateString();
            $eDate   = Carbon::createFromFormat('Y-m-d', $row['end_date'])->toDateString();
            $service = Subscription::create([
                'email'         => $row['email'],
                'start_date'    => $sDate,
                'end_date'      => $eDate
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.email'      => 'required|email|unique:subscriptions,email',
            '*.start_date' => ['required','regex:^([0-9]{4})[-]([0-9]{2})[-]([0-9]{2})$^'],
            '*.end_date'   => ['required','regex:^([0-9]{4})[-]([0-9]{2})[-]([0-9]{2})$^']
        ];
    }

    public function batchSize(): int
    {
        return 50;
    }
}
