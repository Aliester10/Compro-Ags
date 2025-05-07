<?php

namespace App\Http\Controllers\Member\Meta;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetaMemberController extends Controller
{
    public function showMeta()
{
    // Retrieve all active meta records based on the current date
    $metas = Meta::where('start_date', '<=', now())
                  ->where('end_date', '>=', now())
                  ->get();

    return view('Member.Meta.index', compact('metas'));
}

public function showMetaBySlug($slug)
    {
        // Retrieve the meta entry based on the slug
        $meta = Meta::where('slug', $slug)->firstOrFail();

        return view('Member.Meta.show', compact('meta'));
    }

    public function getActiveMetas()
{
    // Mengambil semua meta yang aktif berdasarkan start_date dan end_date
    $activeMetas = Meta::where('start_date', '<=', now())
                        ->where('end_date', '>=', now())
                        ->get();

    return $activeMetas;
}

}
