<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    public function index()
    {
        return view('qr-code');
    }

    public function store(Request $request)
    {

        if ($request->hasFile('logo')) {
            $fileName = $request->file('logo')->store('events', ['disk' => 'my_files']);
        }
        $event = Event::create([
           'name' => $request->name,
           'company' => $request->company,
           'logo' => $fileName,
        ]);
//
//        QrCode::generate($event->id, $event->name);
//        QrCode::format('png');

        QrCode::size(500)
            ->format('png')
            ->generate($event->company, public_path('events/qrcode'. $event->id .'.png'));

        return back();
    }
}
