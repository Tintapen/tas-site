<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socialmedia;
use App\Models\Sysconfig;
use App\Models\CompanySetting;
use App\Models\Milestone;
use App\Models\Certificate;
use App\Models\MailSetting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    public function index()
    {
        $title = 'Home';
        return view('home', compact('title'));
    }

    public function about()
    {
        $socialLinks = Socialmedia::where('isactive', 'Y')->get();
        $mileStones = Milestone::where('isactive', 'Y')->get();
        $certificate = Certificate::where('isactive', 'Y')->get();

        return view('about', compact('socialLinks', 'mileStones', 'certificate'));
    }

    public function career()
    {
        $socialLinks = Socialmedia::where('isactive', 'Y')->get();

        return view('career', compact('socialLinks'));
    }

    public function contact()
    {
        $title = 'Contact';
        $company = CompanySetting::where('isactive', 'Y')->first();
        $location = Sysconfig::getValue('LOCATION');

        return view('contact', compact('title', 'company', 'location'));
    }

    public function sendContact(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
            ]);

            $toEmail = MailSetting::first()->from_address ?? 'admin@example.com';

            Mail::raw($request->message, function ($message) use ($request, $toEmail) {
                $message->to($toEmail)
                        ->from($request->email, $request->name)  // Menambahkan pengirim
                        ->subject($request->subject)
                        ->replyTo($request->email, $request->name);
            });

            return response('OK', 200);
        } catch (ValidationException $e) {
            return response($e->getMessage(), 422);
        }
    }
}
