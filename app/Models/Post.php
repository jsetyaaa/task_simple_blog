<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
        'published_at',
    ];

    protected $dates = ['published_at']; // Agar bisa menggunakan fitur waktu seperti ->isFuture()

    // Relasi Tabel Post ke Tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk menampilkan post yang sudah terbit (bukan draft atau future)
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where(function ($query) {
                         $query->whereNull('published_at')->orWhere('published_at', '<=', now());
                     });
    }

    // Apakah post ini dijadwalkan?
    public function isScheduled(): bool
    {
        return $this->status === 'scheduled' && $this->published_at && $this->published_at->isFuture();
    }

    // Apakah post ini masih draft?
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    // Apakah post ini sudah published dan waktunya sudah lewat?
    public function isPublished(): bool
    {
        return $this->status === 'published' && (!$this->published_at || $this->published_at->isPast());
    }
}
