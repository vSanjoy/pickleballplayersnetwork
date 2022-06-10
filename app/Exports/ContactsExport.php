<?php
/*****************************************************/
# Class name    : ContactsExport
# Purpose       : Excel generate
/*****************************************************/

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ContactsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /*
        * Function name : headings
        * Purpose       : To add heading
        * Input Params  : 
        * Return Value  : 
    */
    public function headings(): array
    {
        return [
            trans('custom_admin.label_name'),
            trans('custom_admin.label_email'),
            trans('custom_admin.label_subject'),
            trans('custom_admin.label_message'),
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::select('name','email','subject','message')->get();
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:Z1';   // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
            },
        ];
    }

}
