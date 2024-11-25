<?php

namespace App\Exports;

namespace App\Exports;

use App\Models\Ask;
use App\Models\Answer;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AskReportExport implements FromArray, WithHeadings
{
    protected $askId;

    public function __construct($askId)
    {
        $this->askId = $askId;
    }

    public function array(): array
    {
   
        $ask = Ask::find($this->askId);

        if (!$ask) {
            return []; 
        }


        $report = [];
        foreach ($ask->answers()->withCount('votings')->get() as $answer) {
            $report[] = [
                'Pregunta' => $ask->description, 
                'Respuesta' => $answer->description, 
                'Cantidad de Votos' => $answer->votings_count, 
            ];
        }

        return $report;
    }

    public function headings(): array
    {
        return [
            'Pregunta',
            'Respuesta',
            'Cantidad de Votos',
        ];
    }
}


