<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(HorarioServiceInterface $horarioServiceInterface){
        $specialties = Specialty::all();

        $date = old('scheduled_date');
        $doctorId = old('doctor_id'); // Cambié 'doctorId' por 'doctor_id' para que coincida con el nombre del campo

        if ($date && $doctorId) {
            $intervals = $horarioServiceInterface->getAvailableIntervals($date, $doctorId);
        } else {
            $intervals = null; // Cambié 'inervals' por 'intervals' para mantener la consistencia
        }

        return view('appointments.create', compact('specialties', 'intervals'));
    }

    public function store(Request $request) {
        $rules = [
            'scheduled_date' => 'required|date_format:m/d/Y', // Asegúrate de validar la fecha
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialties,id'
        ];

        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora válida para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Debe poner sus síntomas.',
            'scheduled_date.required' => 'Debe seleccionar una fecha válida para su cita.',
            'scheduled_date.date_format' => 'El formato de la fecha debe ser mm/dd/yyyy.',
        ];

        $this->validate($request, $rules, $messages);

        $data = $request->only([
            'scheduled_date', 
            'scheduled_time',
            'type', 
            'description',
            'doctor_id',
            'specialty_id'
        ]);

        // Convertir la fecha y hora al formato requerido
        $data['scheduled_date'] = Carbon::createFromFormat('m/d/Y', $data['scheduled_date'])->format('Y-m-d');
        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        $data['patient_id'] = auth()->id();

        // Crear la cita
        Appointment::create($data);

        $notification = 'La cita se ha realizado correctamente.';
        return back()->with(compact('notification'));
    }
}
