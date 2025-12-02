<?php

namespace App\Console\Commands;

use App\Models\EventRegistration;
use App\Services\CertificateGeneratorService;
use Illuminate\Console\Command;

class TestCertificateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'certificate:test {registration_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test certificate generation for debugging';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $registrationId = $this->argument('registration_id');
        
        $registration = EventRegistration::with('event')->find($registrationId);
        
        if (!$registration) {
            $this->error("Registration with ID {$registrationId} not found.");
            return;
        }

        $this->info("Testing certificate generation for: {$registration->participant_name}");
        $this->info("Event: {$registration->event->title}");
        $this->info("Template: " . ($registration->event->certificate_template ?: 'No template'));

        if (!$registration->event->certificate_template) {
            $this->error("No certificate template found for this event.");
            return;
        }

        try {
            $certificateGenerator = new CertificateGeneratorService();
            
            // Test font generation
            $this->info("Generating test certificate...");
            $testPath = $certificateGenerator->testFontGeneration($registration);
            
            $this->info("Test certificate generated: storage/app/public/{$testPath}");
            $this->info("You can view it at: http://127.0.0.1:8000/storage/{$testPath}");
            
            // Test normal generation
            $this->info("Generating normal certificate...");
            $normalPath = $certificateGenerator->generateCertificate($registration);
            
            $this->info("Normal certificate generated: storage/app/public/{$normalPath}");
            $this->info("You can view it at: http://127.0.0.1:8000/storage/{$normalPath}");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }
}
