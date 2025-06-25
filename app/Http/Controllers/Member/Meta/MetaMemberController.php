<?php

namespace App\Http\Controllers\Member\Meta;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    
    // Method untuk mengambil detail artikel yang dibutuhkan oleh pop-up
    public function getArticleDetail($id)
    {
        try {
            // Mendapatkan data artikel utama
            $article = DB::table('meta')
                ->where('id', $id)
                ->first();
                
            if (!$article) {
                Log::error("Article with ID $id not found");
                return response()->json(['error' => 'Artikel tidak ditemukan'], 404);
            }
            
            // Lengkapi URL gambar dengan path yang benar jika perlu
            if ($article->image && !str_starts_with($article->image, 'http')) {
                $article->image = asset($article->image);
            }
            
            // Mendapatkan sub-artikel (jika ada)
            $subArticles = DB::table('sub_meta')
                ->where('meta_id', $id)
                ->get();
                
            // Log untuk debugging
            Log::info("Found " . count($subArticles) . " sub-articles for meta ID $id");
                
            // Mendapatkan gambar untuk setiap sub-artikel
            foreach ($subArticles as $subArticle) {
                // Lengkapi URL gambar sub_meta jika ada
                if ($subArticle->image && !str_starts_with($subArticle->image, 'http')) {
                    $subArticle->image = asset($subArticle->image);
                }
                
                // Cek jika tabel sub_meta_images ada
                try {
                    $subArticle->images = DB::table('sub_meta_images')
                        ->where('sub_meta_id', $subArticle->id)
                        ->get();
                        
                    // Log jumlah gambar yang ditemukan
                    Log::info("Found " . count($subArticle->images) . " images for sub-meta ID " . $subArticle->id);
                    
                    // Lengkapi URL gambar dengan path yang benar jika perlu
                    foreach ($subArticle->images as $image) {
                        if ($image->image && !str_starts_with($image->image, 'http')) {
                            $image->image = asset($image->image);
                        }
                    }
                } catch (\Exception $e) {
                    // Jika tabelnya tidak ada, set images sebagai array kosong
                    Log::warning("Error getting sub_meta_images: " . $e->getMessage());
                    $subArticle->images = [];
                }
            }
            
            return response()->json([
                'article' => $article,
                'subArticles' => $subArticles
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getArticleDetail: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}