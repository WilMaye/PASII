<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\HorarioServiceInterface;
use App\Models\Horarios;
use App\Services\HorarioService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function hours(Request $request, HorarioServiceInterface $horarioServiceInterface){

        
        $rules = [
            'date' => 'required',
            'doctor_id' => 'required|exists:users,id'
        ];
        $this->validate($request, $rules);

        $date = $request->input('date');
       
        $doctorId = $request->input('doctor_id');

        return $horarioServiceInterface->getAvailableIntervals($date, $doctorId);
    }

    
}