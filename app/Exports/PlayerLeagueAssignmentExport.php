<?php
/*****************************************************/
# Company Name      :
# Author            :
# Created Date      :
# Page/Class name   : PlayerLeagueAssignmentExport
# Purpose           : Excel generate
/*****************************************************/

namespace App\Exports;

use App\Models\PlayerLeagueAssignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PlayerLeagueAssignmentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $id;

    public function __construct($id) {
        $this->id = $id;
    }

    /*
        * Function name : headings
        * Purpose       : To add heading
        * Author        : 
        * Created Date  : 
        * Modified Date : 
        * Input Params  : 
        * Return Value  : 
    */
    public function headings(): array
    {
        return [
            trans('custom_admin.label_name'),
            trans('custom_admin.label_email'),
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(PlayerLeagueAssignment::getRecordsToExport($this->id));
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:Z1';   // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

}
