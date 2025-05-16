<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Quotation;

use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'nama_perusahaan',
        'bidang_perusahaan',
        'no_telp',
        'alamat',
        'bidang_id',
        'location_id',
        'pic', 
        'nomor_telp_pic', 
        'akta', 
        'nib',
        'verified',
        'verification_token', // Tambahkan ini
        'status'             // Tambahkan ini
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["member", "admin", "distributor"][$value] ?? "member",
        );
    }


    public function bidangPerusahaan()
    {
        return $this->belongsTo(BidangPerusahaan::class, 'bidang_id');
    }

    public function userProduk()
    {
        return $this->hasMany(UserProduk::class, 'user_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    
    public function isVerifiedDistributor(): bool
    {
        return $this->type === 'distributor' && $this->verified;
    }
    
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}