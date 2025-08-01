<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Socialmedia;
use App\Models\Sysconfig;
use App\Models\CompanySetting;
use App\Models\Milestone;
use App\Models\Certificate;
use App\Models\Gallery;
use App\Models\Job;
use App\Models\Marketplace;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\Principal;
use App\Models\Product;
use App\Models\Reference;
use App\Models\ReferenceDetail;
use Illuminate\Support\Facades\DB;
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
        $marketPlaces = Marketplace::where('isactive', 'Y')
                                    ->whereHas('stores') // hanya yang punya store
                                    ->get();
        $portfolios = Portfolio::where('isactive', 'Y')
                                    ->get();

        return view('home', compact('title', 'featuredProducts', 'marketPlaces', 'portfolios'));
    }

    public function about()
    {
        $order = Sysconfig::getValue('ORDER_MILESTONE', 'asc');
        $location = Sysconfig::getValue('MAP_LOCATION');

        $milestones = Milestone::where('isactive', 'Y')
                                ->orderBy('milestone_date', $order)
                                ->get();
        $certificate = Certificate::where('isactive', 'Y')->get();

        return view('about', compact('location', 'milestones', 'certificate'));
    }

    public function career()
    {
        $limit = Sysconfig::getValue('PAGE_CAREER', 1);

        $job = Job::where('isactive', 'Y')
                    ->where('isexpired', 'N')
                    ->orderBy('created_at', 'asc')
                    ->take($limit)
                    ->get();
        return view('career', compact('job'));
    }

    public function showCareer($slug)
    {
        $job = Job::where('isactive', 'Y')
                    ->where('slug', $slug)
                    ->firstOrFail();
        return view('career_detail', compact('job'));
    }

    public function applyCareer(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email',
                'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
                'job_title' => 'required|string|max:255',
            ]);

            // Ambil email tujuan
            $toEmail = CompanySetting::first()->email_job ?? 'admin@example.com';

            Mail::raw(
                "Job Application\n\n" .
                "Name      : {$request->name}\n" .
                "Email     : {$request->email}\n" .
                "Date      : " . now()->format('d M Y H:i') . "\n\n" .
                "Please find the attached CV.",
                function ($message) use ($request, $toEmail) {
                    $message->to($toEmail)
                            ->from($request->email, $request->name)
                            ->subject('Job Application - ' . $request->job_title)
                            ->replyTo($request->email, $request->name);

                    if ($request->hasFile('cv')) {
                        $cv = $request->file('cv');
                        $filename = 'CV_' . str_replace(' ', '_', $request->name) . '.' . $cv->getClientOriginalExtension();

                        $message->attach($cv->getRealPath(), [
                            'as' => $filename,
                            'mime' => $cv->getMimeType(),
                        ]);
                    }
                }
            );

            return back()->with('success', 'Application sent successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send application: ' . $e->getMessage())->withInput();
        }
    }

    public function loadMoreJobs(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = Sysconfig::getValue('PAGE_CAREER', 1);

        $jobs = Job::where('isactive', 'Y')
                    ->where('isexpired', 'N')
                    ->orderBy('created_at', 'asc')
                    ->offset($offset)
                    ->take($limit)
                    ->get();

        return response()->json([
            'html' => view('layouts.career_cards_inline', compact('jobs'))->render(),
            'count' => $jobs->count(),
        ]);
    }

    public function product()
    {
        $principal = Principal::where('isactive', 'Y')
                    ->orderBy('order', 'asc')
                    ->get();
        return view('product', compact('principal'));
    }

    public function showProducts(Request $request, $slug)
    {
        $limit = Sysconfig::getValue('PAGE_PRODUCT', 1);

        $principal = Principal::where('slug', $slug)->where('isactive', 'Y')->firstOrFail();

        $rootIds = Category::where('principals_id', $principal->id)->pluck('id')->toArray();

        $allIds = $rootIds;

        // Rekursif cari semua turunannya
        Category::getAllChildCategories($rootIds, $allIds);

        // Ambil semua kategori berdasarkan id yang terkumpul
        $categoryIds = Category::whereIn('id', $allIds)->pluck('id');

        $categories = Category::where('principals_id', $principal->id)
                        ->where('level', 1)
                        ->with('childrenRecursive')
                        ->get();

        $search = $request->query('q');
        $selectedCategoryName = $request->query('category');

        $selectedCategory = null;
        $categoryPath = [];
        $filterCategoryIds = $categoryIds; // Default semua kategori principal

        if ($selectedCategoryName) {
            $selectedCategory = Category::where('name', $selectedCategoryName)->first();

            if ($selectedCategory) {
                // Bangun chain parent ke root
                $current = $selectedCategory;
                while ($current) {
                    $categoryPath[] = $current;
                    $current = $current->parent;
                }
                $categoryPath = array_reverse($categoryPath);

                // Ambil semua anak-anak + dia sendiri
                $childIds = [];
                Category::getAllChildCategories([$selectedCategory->id], $childIds);
                $filterCategoryIds = array_merge([$selectedCategory->id], $childIds);
            }
        }

        $products = Product::where('isactive', 'Y')
            ->whereIn('categories_id', $filterCategoryIds)
            ->when($search, fn ($q) => $q->where('name', 'like', "%$search%"))
            ->with('category')
            ->paginate($limit)
            ->withQueryString();

        return view('product_principals', [
            'principal' => $principal,
            'products' => $products,
            'categoriesTree' => $categories,
            'categoryPath' => $categoryPath, // array urutan parent -> child
            'selectedCategoryName' => $selectedCategoryName,
            'search' => $search,
        ]);
    }

    public function news()
    {
        $limit = Sysconfig::getValue('PAGE_NEWS', 1);
        $news = News::where('isactive', 'Y')
                    ->latest()
                    ->paginate($limit);

        return view('news', compact('news'));
    }

    public function showNews($slug)
    {
        $news = News::where('isactive', 'Y')
                    ->where('slug', $slug)
                    ->firstOrFail();
        return view('news_detail', compact('news'));
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

            $toEmail = CompanySetting::first()->email ?? 'admin@example.com';

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
