<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socialmedia;
use App\Models\Milestone;
use App\Models\Certificate;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
        $socialLinks = Socialmedia::all();
        return view('overview', compact('socialLinks'));
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
}
