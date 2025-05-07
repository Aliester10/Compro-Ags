<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Quotation;
use Carbon\Carbon;
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
        'gender',
        'date_of_birth'
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
        'date_of_birth' => 'date',
    ];
    
    /**
     * Get the date of birth formatted without time.
     */
    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value ? Carbon::parse($value)->format('Y-m-d') : null;
            },
        );
    }
    
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["member", "admin", "distributor"][$value] ?? "member",
        );
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

    /**
     * Get the user's age based on date of birth.
     *
     * @return int|null
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? now()->diffInYears($this->date_of_birth) : null;
    }
}