<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = [
            [
                'name' => 'Website Company Profile',
                'description' => 'Layanan pembuatan website company profile profesional dengan desain modern dan responsive.',
                'image' => 'produks/dlsjoXArxcw4wNZL1wiGm6hBdaBfOorC3yThGTDu.png',
                'price' => 2500000,
                'quality_guaranteed' => true,
                'periodic_support' => true,
                'support_24_7' => false,
                'features' => 'Responsive Design, SEO Optimized, Admin Panel, Contact Form',
                'whatsapp_link' => 'https://wa.me/6281234567890',
            ],
            [
                'name' => 'Aplikasi Mobile',
                'description' => 'Pengembangan aplikasi mobile untuk Android dan iOS dengan teknologi terbaru.',
                'image' => 'produks/IXCAGQSR3PMPqmYlBzDboiXvQrnQ4RiSx3ahDcqg.png',
                'price' => 5000000,
                'quality_guaranteed' => true,
                'periodic_support' => true,
                'support_24_7' => true,
                'features' => 'Cross Platform, Real-time Database, Push Notification, Offline Support',
                'whatsapp_link' => 'https://wa.me/6281234567890',
            ],
            [
                'name' => 'Sistem Informasi',
                'description' => 'Pengembangan sistem informasi custom sesuai kebutuhan bisnis Anda.',
                'image' => 'produks/TFSrAcuoL4H0TiBxOtiZ11sAIyN8VQkmoxiyAa0Z.png',
                'price' => 8000000,
                'quality_guaranteed' => true,
                'periodic_support' => true,
                'support_24_7' => true,
                'features' => 'Custom Development, Database Design, User Management, Reporting',
                'whatsapp_link' => 'https://wa.me/6281234567890',
            ],
            [
                'name' => 'E-commerce Platform',
                'description' => 'Platform e-commerce lengkap dengan payment gateway dan manajemen produk.',
                'image' => 'produks/XeisZXDlyCzXnNp38ugcMJ54aBrztVAaE5ZImqAS.png',
                'price' => 12000000,
                'quality_guaranteed' => true,
                'periodic_support' => true,
                'support_24_7' => true,
                'features' => 'Payment Gateway, Inventory Management, Order Tracking, Analytics',
                'whatsapp_link' => 'https://wa.me/6281234567890',
            ],
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
