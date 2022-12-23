<?php

namespace App\Http\Controllers;

use App\Mail\CertificateMail;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CertificateController extends Controller
{
    public function showCertificateForm()
    {
        return view('uploadCertificate');
    }

    public function submitCertificateForm(Request $request)
    {
        $data = $request->except('certificate');

        if ($request->hasFile('certificate')) {
            $path = $request->file('certificate')->store('certificates', ['disk' => 'my_files']);
            $data['certificate'] = $path;
        }

        $certificate = Certificate::create($data);

        $pdf = $this->createPDF($certificate->id);

        Mail::to('moazzaq@gmail.com')->queue(new CertificateMail($data, $pdf));

        return redirect()->back();
    }

    public function show($id)
    {
        $item = Certificate::find($id);
        return view('show', compact('item'));
    }

    public function createPDF($id)
    {
        $data = Certificate::find($id)->toArray();

        return $pdf = PDF::loadView('myPDF', compact('data'))->output();
        return $pdf->download(rand(1,10).'.certificate.pdf');
    }
}





