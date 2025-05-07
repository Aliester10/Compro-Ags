<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Helpers\TranslateHelper;
use App\Models\Activity;
use App\Models\AfterSales;
use App\Models\BrandPartner;
use App\Models\CompanyParameter;
use App\Models\Kategori;
use App\Models\Monitoring;
use App\Models\Slider;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produks = Produk::take(6)->get();
        $sliders = Slider::all();
        $company = CompanyParameter::first();
        
        // Mengambil tipe brand partner yang valid dari database
        $brands = BrandPartner::where('type', 'brand')->get();
        $ecommerces = BrandPartner::where('type', 'ecommerce')->get();
        $principals = BrandPartner::where('type', 'principal')->get();
        $distributors = BrandPartner::where('type', 'distributor')->get();
        
        $categories = Kategori::all();
        
        $locale = app()->getLocale();
        
        foreach ($sliders as $slider) {
            $slider->title = TranslateHelper::translate($slider->title, $locale);
            $slider->button_text = TranslateHelper::translate($slider->button_text, $locale);
            $slider->description = TranslateHelper::translate($slider->description, $locale);
        }
        
        if ($company) {
            $company->sejarah_singkat = TranslateHelper::translate($company->sejarah_singkat, $locale);
        }
        
        return view('home', compact(
            'produks', 
            'sliders', 
            'company', 
            'brands', 
            'principals', 
            'categories', 
            'ecommerces',
            'distributors'
        ));
    }

    public function dashboard()
    {
        // Fetch daily visitor data
        $visitorData = Visitor::selectRaw('DATE(created_at) as date, COUNT(*) as total_visits')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Prepare data for the chart
        $dates = $visitorData->pluck('date')->toArray();
        $visits = $visitorData->pluck('total_visits')->toArray();

        $totalMembers = User::where('type', 'member')->count();
        $totalProducts = Produk::count();
        $totalMonitoredProducts = Monitoring::count();
        $totalActivities = Activity::count();
        $totalTickets = AfterSales::count();
        $totalDistributors = User::where('type', 2)->count();

        // Menghitung total untuk setiap jenis brand partner
        $totalBrands = BrandPartner::where('type', 'brand')->count();
        $totalEcommerces = BrandPartner::where('type', 'ecommerce')->count();
        $totalPrincipals = BrandPartner::where('type', 'principal')->count();
        $totalDistributorPartners = BrandPartner::where('type', 'distributor')->count();

        return view('dashboard', compact(
            'dates', 
            'visits', 
            'totalMembers', 
            'totalProducts', 
            'totalMonitoredProducts', 
            'totalActivities', 
            'totalTickets', 
            'totalDistributors',
            'totalBrands',
            'totalEcommerces',
            'totalPrincipals',
            'totalDistributorPartners'
        ));
    }

    public function about()
    {
        $company = CompanyParameter::first();
        
        // Mengambil tipe brand partner yang valid untuk halaman about
        $brands = BrandPartner::where('type', 'brand')->get();
        $principals = BrandPartner::where('type', 'principal')->get();
        $distributors = BrandPartner::where('type', 'distributor')->get();
        $ecommerces = BrandPartner::where('type', 'ecommerce')->get();

        $locale = app()->getLocale();

        if ($company) {
            $company->sejarah_singkat = TranslateHelper::translate($company->sejarah_singkat, $locale);
            $company->visi = TranslateHelper::translate($company->visi, $locale);
            $company->misi = TranslateHelper::translate($company->misi, $locale);
        }

        return view('Member.About.about', compact(
            'company', 
            'brands', 
            'principals',
            'distributors',
            'ecommerces'
        ));
    }
}