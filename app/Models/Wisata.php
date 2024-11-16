<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'kategori_id',
        'harga_tiket_masuk',
        'jam_buka',
        'jam_tutup',
        'longitude',
        'latitude'
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getFormattedHargaTiketMasukAttribute()
    {
        return 'Rp ' . number_format($this->harga_tiket_masuk, 0, ',', '.');
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
