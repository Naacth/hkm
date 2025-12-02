<?php

namespace Database\Seeders;

use App\Models\EventRegistration;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first event
        $event = Event::first();
        
        if (!$event) {
            $this->command->info('No event found. Please create an event first.');
            return;
        }

        // Get or create a test user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $registrations = [
            [
                'user_id' => $user->id,
                'event_id' => $event->id,
                'registration_number' => EventRegistration::generateRegistrationNumber(),
                'status' => 'registered',
                'participant_name' => 'Ahmad Rizki',
                'participant_phone' => '081234567890',
                'participant_nim' => '2022001',
                'participant_kelas' => '3A',
                'participant_email' => 'ahmad@example.com',
                'notes' => 'Sangat tertarik dengan topik yang akan dibahas',
                'payment_status' => $event->is_paid ? 'pending' : 'paid',
                'payment_method' => $event->is_paid ? 'qris' : null,
            ],
            [
                'user_id' => $user->id,
                'event_id' => $event->id,
                'registration_number' => EventRegistration::generateRegistrationNumber(),
                'status' => 'confirmed',
                'participant_name' => 'Siti Nurhaliza',
                'participant_phone' => '081234567891',
                'participant_nim' => '2022002',
                'participant_kelas' => '3B',
                'participant_email' => 'siti@example.com',
                'notes' => 'Menunggu konfirmasi pembayaran',
                'payment_status' => $event->is_paid ? 'paid' : 'paid',
                'payment_method' => $event->is_paid ? 'offline' : null,
            ],
            [
                'user_id' => $user->id,
                'event_id' => $event->id,
                'registration_number' => EventRegistration::generateRegistrationNumber(),
                'status' => 'attended',
                'participant_name' => 'Budi Santoso',
                'participant_phone' => '081234567892',
                'participant_nim' => '2022003',
                'participant_kelas' => '2A',
                'participant_email' => 'budi@example.com',
                'notes' => 'Event yang sangat bermanfaat',
                'payment_status' => 'paid',
                'payment_method' => $event->is_paid ? 'qris' : null,
                'certificate_downloaded' => false,
            ],
            [
                'user_id' => $user->id,
                'event_id' => $event->id,
                'registration_number' => EventRegistration::generateRegistrationNumber(),
                'status' => 'attended',
                'participant_name' => 'Dewi Kartika',
                'participant_phone' => '081234567893',
                'participant_nim' => '2022004',
                'participant_kelas' => '2B',
                'participant_email' => 'dewi@example.com',
                'notes' => 'Terima kasih atas event yang luar biasa',
                'payment_status' => 'paid',
                'payment_method' => $event->is_paid ? 'offline' : null,
                'certificate_downloaded' => true,
            ],
            [
                'user_id' => $user->id,
                'event_id' => $event->id,
                'registration_number' => EventRegistration::generateRegistrationNumber(),
                'status' => 'cancelled',
                'participant_name' => 'Eko Prasetyo',
                'participant_phone' => '081234567894',
                'participant_nim' => '2022005',
                'participant_kelas' => '1A',
                'participant_email' => 'eko@example.com',
                'notes' => 'Tidak bisa hadir karena ada urusan mendadak',
                'payment_status' => 'failed',
                'payment_method' => $event->is_paid ? 'qris' : null,
            ],
        ];

        foreach ($registrations as $index => $registration) {
            // Generate unique registration number for each registration
            $registration['registration_number'] = EventRegistration::generateRegistrationNumber();
            
            // Add small delay to ensure different timestamps
            if ($index > 0) {
                sleep(1);
            }
            
            EventRegistration::create($registration);
        }
    }
}