<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socialmedia;
use App\Models\Sysconfig;
use App\Models\CompanySetting;
use App\Models\Milestone;
use App\Models\Certificate;
use App\Models\Gallery;
use App\Models\MailSetting;
use App\Models\Product;
use App\Models\Reference;
use App\Models\ReferenceDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    public function index()
    {
        $title = 'Home';
        $featuredProducts = Product::where('isactive', 'Y')
                                    ->where('isfeatured', 'Y')
                                    ->get();

        return view('home', compact('title', 'featuredProducts'));
    }

    public function about()
    {
        $location = Sysconfig::getValue('MAP_LOCATION');
        $milestones = Milestone::where('isactive', 'Y')
                                ->orderBy('milestone_date', 'desc')
                                ->get();
        $certificate = Certificate::where('isactive', 'Y')->get();

        return view('about', compact('location', 'milestones', 'certificate'));
    }

    public function career()
    {
        $socialLinks = Socialmedia::where('isactive', 'Y')->get();

        return view('career', compact('socialLinks'));
    }

    public function gallery()
    {
        $ref = Reference::where('name', 'Gallery Group')
        ->where('isactive', 'Y')
        ->first();

        $galleryGroups = [];
        if ($ref) {
            $galleryGroups = ReferenceDetail::where('references_id', $ref->id)
                ->where('isactive', 'Y')
                ->where('name', '!=', 'All')
                ->pluck('name', 'value')
                ->toArray();
        }

        $galleries = Gallery::where('isactive', 'Y')->get();

        return view('gallery', compact('galleries', 'galleryGroups'));
    }

    public function contact()
    {
        $company = CompanySetting::where('isactive', 'Y')->first();
        $location = Sysconfig::getValue('LOCATION');

        return view('contact', compact('company', 'location'));
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
