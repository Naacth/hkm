<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'registration_number',
        'status',
        'participant_name',
        'participant_email',
        'participant_phone',
        'participant_nim',
        'participant_kelas',
        'notes',
        'payment_status',
        'payment_method',
        'proof_of_payment_image_path',
        'certificate_downloaded',
        'certificate_path',
        'voucher_code',
        'voucher_discount_percent',
        'discount_amount',
        'final_price',
    ];

    protected $casts = [
        'certificate_downloaded' => 'boolean',
        'discount_amount' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    /**
     * Get the user that owns the registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event that was registered.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Generate unique registration number
     */
    public static function generateRegistrationNumber()
    {
        $prefix = 'REG';
        $date = now()->format('Ymd');
        $lastRegistration = self::whereDate('created_at', today())->latest()->first();
        
        if ($lastRegistration) {
            $lastNumber = intval(substr($lastRegistration->registration_number, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $date . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'registered' => 'bg-info',
            'confirmed' => 'bg-success',
            'paid' => 'bg-warning',
            'attended' => 'bg-primary',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        return match($this->status) {
            'registered' => 'Terdaftar',
            'confirmed' => 'Dikonfirmasi',
            'paid' => 'Sudah Bayar',
            'attended' => 'Hadir',
            'cancelled' => 'Dibatalkan',
            default => 'Unknown',
        };
    }

    /**
     * Get payment status badge class
     */
    public function getPaymentStatusBadgeClass()
    {
        return match($this->payment_status) {
            'pending' => 'bg-warning',
            'paid' => 'bg-success',
            'failed' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    /**
     * Get payment status label
     */
    public function getPaymentStatusLabel()
    {
        return match($this->payment_status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Gagal',
            default => 'Unknown',
        };
    }

    /**
     * Check if can download certificate
     */
    public function canDownloadCertificate()
    {
        // Allow download if status is 'attended' or 'paid'
        if (!in_array($this->status, ['attended', 'paid'])) {
            return false;
        }

        // Check if manual certificate exists or template exists
        return $this->certificate_path || $this->event->certificate_template;
    }

    /**
     * Mark certificate as downloaded
     */
    public function markCertificateAsDownloaded()
    {
        $this->update(['certificate_downloaded' => true]);
    }

    /**
     * Check if registration is paid (confirmed and payment is paid)
     */
    public function isPaid()
    {
        return $this->status === 'confirmed' && $this->payment_status === 'paid';
    }

    /**
     * Check if can access WhatsApp group (only for paid participants)
     */
    public function canAccessWhatsAppGroup()
    {
        // For free events, all participants can access
        if ($this->event->isFree()) {
            return true;
        }
        
        // For paid events, only paid participants can access
        return $this->isPaid();
    }

    /**
     * Get effective status considering payment status
     */
    public function getEffectiveStatus()
    {
        // If status is explicitly set to 'paid', return 'paid'
        if ($this->status === 'paid') {
            return 'paid';
        }
        
        // If status is 'confirmed' and payment is 'paid', return 'paid'
        if ($this->isPaid()) {
            return 'paid';
        }
        
        return $this->status;
    }

    /**
     * Get effective status label
     */
    public function getEffectiveStatusLabel()
    {
        return match($this->getEffectiveStatus()) {
            'registered' => 'Terdaftar',
            'confirmed' => 'Dikonfirmasi',
            'paid' => 'Sudah Bayar',
            'attended' => 'Hadir',
            'cancelled' => 'Dibatalkan',
            default => 'Unknown',
        };
    }

    /**
     * Get effective status badge class
     */
    public function getEffectiveStatusBadgeClass()
    {
        return match($this->getEffectiveStatus()) {
            'registered' => 'bg-info',
            'confirmed' => 'bg-success',
            'paid' => 'bg-warning',
            'attended' => 'bg-primary',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary',
        };
    }
}
