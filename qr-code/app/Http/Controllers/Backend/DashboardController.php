<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.index');
    }

    public function AllAppointments()
    {
        return AppointmentResource::collection(Appointment::all());
    }

    public function show(Appointment $appointment)
    {
        return response($appointment, Response::HTTP_OK);
    }
}
