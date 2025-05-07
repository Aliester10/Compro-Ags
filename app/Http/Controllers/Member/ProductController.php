<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\BidangPerusahaan;

class ProductController extends Controller
{
    /**
     * Menampilkan detail kategori
     */
    public function showCategory($id)
    {
        // Ambil data kategori
        $category = Kategori::findOrFail($id);
        
        // Ambil produk berdasarkan kategori
        $products = Produk::where('kategori_id', $id)
                         ->whereNull('sub_kategori_id')
                         ->get();
        
        // Ambil bidang perusahaan untuk sidebar
        $bidangPerusahaans = BidangPerusahaan::where('kategori_id', $id)->get();
        
        // Memeriksa jika ada produk
        if ($products->isEmpty() && $bidangPerusahaans->isNotEmpty()) {
            // Jika tidak ada produk di kategori utama, ambil produk dari bidang pertama
            $firstBidang = $bidangPerusahaans->first();
            $products = Produk::where('sub_kategori_id', $firstBidang->id)->get();
            
            // Set bidangPerusahaan aktif
            $activeBidang = $firstBidang;
            
            return view('Member.Product.category-detail', compact(
                'category', 
                'products', 
                'bidangPerusahaans',
                'activeBidang'
            ));
        }
        
        return view('Member.Product.category-detail', compact(
            'category', 
            'products', 
            'bidangPerusahaans'
        ));
    }
    
    /**
     * Menampilkan produk berdasarkan bidang perusahaan
     */
    public function showBidangPerusahaan($id)
    {
        // Ambil data bidang perusahaan
        $activeBidang = BidangPerusahaan::findOrFail($id);
        
        // Ambil kategori induk
        $category = Kategori::findOrFail($activeBidang->kategori_id);
        
        // Ambil produk berdasarkan bidang perusahaan
        $products = Produk::where('sub_kategori_id', $id)->get();
        
        // Ambil semua bidang perusahaan dengan kategori yang sama untuk sidebar
        $bidangPerusahaans = BidangPerusahaan::where('kategori_id', $category->id)->get();
        
        return view('Member.Product.category-detail', compact(
            'category', 
            'activeBidang', 
            'products', 
            'bidangPerusahaans'
        ));
    }
    /**
 * Menampilkan detail produk
 */
public function showProductDetail($id)
{
    // Ambil data produk
    $product = Produk::findOrFail($id);
    
    // Ambil data kategori
    $category = Kategori::findOrFail($product->kategori_id);
    
    // Ambil data bidang perusahaan jika produk memiliki sub_kategori_id
    $bidang = null;
    if ($product->sub_kategori_id) {
        $bidang = BidangPerusahaan::find($product->sub_kategori_id);
    }
    
    return view('Member.Product.product-detail', compact('product', 'category', 'bidang'));
}
}