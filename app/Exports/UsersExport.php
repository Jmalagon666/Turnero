<?php

namespace App\Exports;

use App\Models\User;
use App\Models\informacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView , ShouldAutoSize{
    /**
    * @return \Illuminate\Support\Collection
    */
/*     public function collection()
    {
        return User::all();
    } */

    public function view(): View
    {
        return view('turnero.exportUsers',[
            'info'=> informacion::all()
        ]);
    }


}
