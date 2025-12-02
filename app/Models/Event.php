<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'date', 'location', 'status', 'event_type', 'is_paid', 'price', 'qris_image_path', 'certificate_template', 'google_form_link', 'whatsapp_group_link',
        'seo_title', 'seo_description', 'seo_jsonld',
        'cert_x', 'cert_y', 'cert_font_size', 'cert_color'
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'price' => 'decimal:2',
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
}
