<?php

namespace App\Console\Commands;

use App\Services\CertificateGeneratorService;
use Illuminate\Console\Command;

class CleanupCertificatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'certificates:cleanup {--days=7 : Number of days old certificates to keep}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old generated certificates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        
        $this->info("Cleaning up certificates older than {$days} days...");
        
        $certificateGenerator = new CertificateGeneratorService();
        $certificateGenerator->cleanupOldCertificates($days);
        
        $this->info('Certificate cleanup completed successfully!');
    }
}
