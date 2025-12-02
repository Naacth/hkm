<?php

namespace App\Console\Commands;

use App\Models\EventRegistration;
use Illuminate\Console\Command;

class FixPaymentStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:fix-status {--dry-run : Show what would be changed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix inconsistent payment status in event registrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        if ($isDryRun) {
            $this->info('DRY RUN MODE - No changes will be made');
        }

        $this->info('Checking for inconsistent payment status...');

        // Find registrations with status 'paid' but payment_status not 'paid'
        $inconsistentPaid = EventRegistration::where('status', 'paid')
            ->where('payment_status', '!=', 'paid')
            ->get();

        if ($inconsistentPaid->count() > 0) {
            $this->warn("Found {$inconsistentPaid->count()} registrations with status 'paid' but payment_status not 'paid':");
            
            foreach ($inconsistentPaid as $registration) {
                $this->line("- ID: {$registration->id}, Name: {$registration->participant_name}, Payment Status: {$registration->payment_status}");
                
                if (!$isDryRun) {
                    $registration->update(['payment_status' => 'paid']);
                }
            }
            
            if (!$isDryRun) {
                $this->info("Updated {$inconsistentPaid->count()} registrations to have payment_status = 'paid'");
            }
        }

        // Find registrations with status 'cancelled' but payment_status not 'failed'
        $inconsistentCancelled = EventRegistration::where('status', 'cancelled')
            ->where('payment_status', '!=', 'failed')
            ->get();

        if ($inconsistentCancelled->count() > 0) {
            $this->warn("Found {$inconsistentCancelled->count()} registrations with status 'cancelled' but payment_status not 'failed':");
            
            foreach ($inconsistentCancelled as $registration) {
                $this->line("- ID: {$registration->id}, Name: {$registration->participant_name}, Payment Status: {$registration->payment_status}");
                
                if (!$isDryRun) {
                    $registration->update(['payment_status' => 'failed']);
                }
            }
            
            if (!$isDryRun) {
                $this->info("Updated {$inconsistentCancelled->count()} registrations to have payment_status = 'failed'");
            }
        }

        if ($inconsistentPaid->count() === 0 && $inconsistentCancelled->count() === 0) {
            $this->info('No inconsistent payment status found. All registrations are consistent!');
        }

        if ($isDryRun) {
            $this->info('DRY RUN COMPLETED - Run without --dry-run to apply changes');
        } else {
            $this->info('Payment status fix completed successfully!');
        }
    }
}
