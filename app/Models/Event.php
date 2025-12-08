<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'date', 'location', 'status', 'event_type', 'is_paid', 'price', 'qris_image_path', 'certificate_template', 'google_form_link', 'whatsapp_group_link',
        'seo_title', 'seo_description', 'seo_jsonld',
        'cert_x', 'cert_y', 'cert_font_size', 'cert_color',
        'registration_start_date', 'registration_end_date'
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'price' => 'decimal:2',
        'registration_start_date' => 'datetime',
        'registration_end_date' => 'datetime',
    ];

    /**
     * Get the registrations for this event.
     */
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    /**
     * Get formatted date
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('d F Y');
    }

    /**
     * Check if event is upcoming
     */
    public function isUpcoming()
    {
        return $this->date >= now();
    }

    /**
     * Get registration count
     */
    public function getRegistrationCount()
    {
        return $this->registrations()->count();
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        if ($this->event_type === 'public') {
            return 'Event Publik';
        }
        return $this->is_paid && $this->price ? 'Rp ' . number_format($this->price, 0, ',', '.') : 'Gratis';
    }

    /**
     * Check if event is free
     */
    public function isFree()
    {
        return $this->event_type === 'free' || (!$this->is_paid || !$this->price || $this->price <= 0);
    }

    /**
     * Check if event is paid
     */
    public function isPaid()
    {
        return $this->event_type === 'paid';
    }

    /**
     * Check if registration is open
     */
    public function isRegistrationOpen()
    {
        $now = now();
        
        // If no registration dates set, check event status
        if (!$this->registration_start_date && !$this->registration_end_date) {
            return $this->status === 'active' && $this->isUpcoming();
        }
        
        // Check if within registration period
        $afterStart = !$this->registration_start_date || $now >= $this->registration_start_date;
        $beforeEnd = !$this->registration_end_date || $now <= $this->registration_end_date;
        
        return $this->status === 'active' && $afterStart && $beforeEnd;
    }

    /**
     * Check if registration has not started yet
     */
    public function isRegistrationNotStarted()
    {
        if (!$this->registration_start_date) {
            return false;
        }
        
        return now() < $this->registration_start_date;
    }

    /**
     * Check if registration has closed
     */
    public function isRegistrationClosed()
    {
        if (!$this->registration_end_date) {
            return $this->status !== 'active' || !$this->isUpcoming();
        }
        
        return now() > $this->registration_end_date || $this->status !== 'active';
    }

    /**
     * Get registration status message
     */
    public function getRegistrationStatusMessage()
    {
        if ($this->isRegistrationNotStarted()) {
            return 'Pendaftaran belum dibuka. Dibuka pada ' . $this->registration_start_date->format('d F Y, H:i');
        }
        
        if ($this->isRegistrationClosed()) {
            if ($this->registration_end_date && now() > $this->registration_end_date) {
                return 'Pendaftaran telah ditutup pada ' . $this->registration_end_date->format('d F Y, H:i');
            }
            return 'Pendaftaran telah ditutup';
        }
        
        if ($this->isRegistrationOpen()) {
            if ($this->registration_end_date) {
                return 'Pendaftaran dibuka sampai ' . $this->registration_end_date->format('d F Y, H:i');
            }
            return 'Pendaftaran dibuka';
        }
        
        return 'Pendaftaran tidak tersedia';
    }

    /**
     * Check if event is public
     */
    public function isPublic()
    {
        return $this->event_type === 'public';
    }

    /**
     * Get certificate URL
     */
    public function getCertificateUrlAttribute()
    {
        return $this->certificate_template ? asset('uploads/' . $this->certificate_template) : null;
    }

    /**
     * Get QRIS URL
     */
    public function getQrisUrlAttribute()
    {
        return $this->qris_image_path ? asset('uploads/' . $this->qris_image_path) : null;
    }

    /**
     * Get WhatsApp Group URL
     */
    public function getWhatsappGroupUrlAttribute()
    {
        return $this->whatsapp_group_link;
    }

    /**
     * Get image URL with automatic path fixing
     * Memastikan path gambar selalu benar, handle path yang tidak lengkap
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // Jika path sudah lengkap dengan folder events/
        if (str_contains($this->image, 'events/')) {
            return asset('uploads/' . $this->image);
        }

        // Jika path hanya nama file (tanpa folder), tambahkan events/
        if (!str_contains($this->image, '/')) {
            return asset('uploads/events/' . $this->image);
        }

        // Jika path sudah benar (ada folder lain), gunakan langsung
        return asset('uploads/' . $this->image);
    }

    /**
     * Get QRIS image URL with automatic path fixing
     */
    public function getQrisImageUrlAttribute()
    {
        if (!$this->qris_image_path) {
            return null;
        }

        // Jika path sudah lengkap dengan folder qris/
        if (str_contains($this->qris_image_path, 'qris/')) {
            return asset('uploads/' . $this->qris_image_path);
        }

        // Jika path hanya nama file (tanpa folder), tambahkan qris/
        if (!str_contains($this->qris_image_path, '/')) {
            return asset('uploads/qris/' . $this->qris_image_path);
        }

        // Jika path sudah benar (ada folder lain), gunakan langsung
        return asset('uploads/' . $this->qris_image_path);
    }
}
