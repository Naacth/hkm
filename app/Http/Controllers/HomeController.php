<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Produk;
use App\Models\Galeri;
use App\Models\About;
use App\Models\Divisi;
use App\Models\Kabinet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with dynamic data
     */
    public function index()
    {
        // Get latest events (limit 3)
        $latestEvents = Event::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get latest products (limit 6)
        $latestProducts = Produk::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Get latest gallery items (limit 6)
        $latestGallery = Galeri::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Get about information
        $about = About::latest()->first();

        // Get divisi data for stats
        $divisiCount = Divisi::count();
        $totalMembers = \App\Models\DivisiMember::count();

        // Get kabinet data
        $kabinet = Kabinet::latest()->first();

        // Get event statistics
        $totalEvents = Event::where('status', 'active')->count();
        $upcomingEvents = Event::where('status', 'active')
            ->where('date', '>=', now()->toDateString())
            ->count();

        return view('home', compact(
            'latestEvents',
            'latestProducts', 
            'latestGallery',
            'about',
            'divisiCount',
            'totalMembers',
            'kabinet',
            'totalEvents',
            'upcomingEvents'
        ));
    }
}
