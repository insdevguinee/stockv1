<?php

namespace App\Exports;

use App\Entre;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class sortieExport implements FromCollection,ShouldAutoSize,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $min, string $max)
    {
        $this->min = $min;
        $this->max = $max;
    }


    public function collection()
    {
  		$entres = Entre::sortie()->whereBetween('date_ajout', [$this->min, $this->max])->orderBy('date_ajout','asc')->get();
        $data_array[] = ['MATERIELS','QTE' ,'CLIENT', 'UTILISATION', 'N°BON','DATE'];
        foreach($entres as $data){
            $data_array[]=[
                'MATERIELS'=> @$data->materiel->name,
                'QTE'=> - @$data->quantite,
                'CLIENTS'=> $data->fournisseur,
                'UTILISATIONS'=> $data->motif,
                'N°BON'=> $data->nfacture,
                'DATE'=> $data->date_ajout,
            ];
        }
        return collect($data_array);
    }


    public function title(): string
    {
        return 'sortie';
    }
}
