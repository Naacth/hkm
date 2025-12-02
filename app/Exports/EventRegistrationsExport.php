<?php

namespace App\Exports;

use App\Models\EventRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EventRegistrationsExport implements FromCollection, WithHeadings
{
    protected $eventId;

    public function __construct($eventId = null)
    {
        $this->eventId = $eventId;
    }

    public function collection()
    {
        if ($this->eventId) {
            return EventRegistration::where('event_id', $this->eventId)->get();
        } else {
            return EventRegistration::all();
        }
    }

    public function headings(): array
    {
        return [
            'ID',
            'Event ID',
            'User ID',
            'Registration Number',
            'Status',
            'Certificate Downloaded',
            'Created At',
            'Updated At',
        ];
    }
}
