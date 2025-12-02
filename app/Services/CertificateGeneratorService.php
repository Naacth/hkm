<?php

namespace App\Services;

use App\Models\EventRegistration;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Storage;

class CertificateGeneratorService
{
    protected $imageManager;
    /** @var string|null */
    private $fontPath = null;

    public function __construct()
    {
        // Check available extensions
        if (extension_loaded('imagick')) {
            try {
                $this->imageManager = new ImageManager(new \Intervention\Image\Drivers\Imagick\Driver());
                \Log::info('Using Imagick driver');
            } catch (\Exception $e) {
                \Log::error('Imagick driver failed: ' . $e->getMessage());
                $this->imageManager = null;
            }
        } elseif (extension_loaded('gd')) {
            try {
                $this->imageManager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                \Log::info('Using GD driver');
            } catch (\Exception $e) {
                \Log::error('GD driver failed: ' . $e->getMessage());
                $this->imageManager = null;
            }
        } else {
            \Log::error('No image processing extensions available');
            $this->imageManager = null;
        }
        
        $this->fontPath = $this->resolveFontPath();
    }

    /**
     * Generate personalized certificate for a registration
     */
    public function generateCertificate(EventRegistration $registration)
    {
        $event = $registration->event;
        
        if (!$event->certificate_template) {
            throw new \Exception('Template sertifikat tidak ditemukan untuk event ini.');
        }

        // Load the certificate template
        $templatePath = public_path('uploads/' . $event->certificate_template);
        
        if (!file_exists($templatePath)) {
            throw new \Exception('File template sertifikat tidak ditemukan.');
        }

        // Check if image manager is available
        if (!$this->imageManager) {
            throw new \Exception('Tidak ada ekstensi image processing yang tersedia. Silakan install GD atau Imagick extension.');
        }

        // Create image from template
        $image = $this->imageManager->read($templatePath);
        
        // Get image dimensions
        $width = $image->width();
        $height = $image->height();

        // Define text properties
        $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta';
        $eventTitle = $event->title;
        $eventDate = $event->getFormattedDateAttribute();
        $location = $event->location;

        // Log for debugging
        \Log::info('Certificate generation started', [
            'registration_id' => $registration->id,
            'participant_name' => $participantName,
            'user_name' => $registration->user->name ?? 'NULL',
            'event_title' => $eventTitle,
            'image_width' => $width,
            'image_height' => $height,
            'template_path' => $templatePath
        ]);

        // Calculate font sizes based on image dimensions (make them much larger)
        $nameFontSize = max(80, intval($width / 12)); // Much larger font for name
        $eventFontSize = max(40, intval($width / 20));
        $dateFontSize = max(32, intval($width / 25));
        $locationFontSize = max(28, intval($width / 30));

        // Define colors (very dark for better visibility)
        $textColor = '#000000'; // Pure black for maximum visibility
        $eventColor = '#000000'; // Also black for consistency

        // Add participant name with multiple approaches for testing
        try {
            // Ensure participant name is not empty
            if (empty($participantName) || trim($participantName) === '') {
                $participantName = 'Peserta Event';
            }
            
            \Log::info('Adding participant name to certificate', [
                'final_participant_name' => $participantName,
                'font_size' => $nameFontSize,
                'position_x' => $width / 2,
                'position_y' => $height * 0.4,
                'font_path' => $this->fontPath
            ]);
            
            // Method 1: Simple text with large font - try without font first
            try {
                $image->text($participantName, $width / 2, $height * 0.35, function ($font) use ($nameFontSize, $textColor) {
                    $font->size($nameFontSize);
                    $font->color($textColor);
                    $font->align('center');
                    $font->valign('middle');
                });
                \Log::info('Text added without custom font');
            } catch (\Exception $e) {
                \Log::error('Error adding text without font: ' . $e->getMessage());
                
                // Try with font if available
                if ($this->fontPath) {
                    try {
                        $image->text($participantName, $width / 2, $height * 0.35, function ($font) use ($nameFontSize, $textColor) {
                            $font->filename($this->fontPath);
                            $font->size($nameFontSize);
                            $font->color($textColor);
                            $font->align('center');
                            $font->valign('middle');
                        });
                        \Log::info('Text added with custom font');
                    } catch (\Exception $e2) {
                        \Log::error('Error adding text with font: ' . $e2->getMessage());
                    }
                }
            }
            
            // Method 2: Add a background rectangle for visibility (skip for now)
            // Note: drawRectangle method has different syntax in newer versions
            \Log::info('Skipping background rectangle for compatibility');
            
        } catch (\Exception $e) {
            \Log::error('Error adding participant name: ' . $e->getMessage());
        }

        // Add event title
        $image->text($eventTitle, $width / 2, $height * 0.5, function ($font) use ($eventFontSize, $eventColor) {
            if ($this->fontPath) {
                $font->filename($this->fontPath);
            }
            $font->size($eventFontSize);
            $font->color($eventColor);
            $font->align('center');
            $font->valign('middle');
        });

        // Add event date
        $image->text($eventDate, $width / 2, $height * 0.6, function ($font) use ($dateFontSize, $textColor) {
            if ($this->fontPath) {
                $font->filename($this->fontPath);
            }
            $font->size($dateFontSize);
            $font->color($textColor);
            $font->align('center');
            $font->valign('middle');
        });

        // Add location
        $image->text($location, $width / 2, $height * 0.7, function ($font) use ($locationFontSize, $textColor) {
            if ($this->fontPath) {
                $font->filename($this->fontPath);
            }
            $font->size($locationFontSize);
            $font->color($textColor);
            $font->align('center');
            $font->valign('middle');
        });

        // Generate unique filename
        $filename = 'certificate_' . $registration->id . '_' . time() . '.png';
        $certificatePath = 'certificates/generated/' . $filename;

        // Save the generated certificate
        $image->save(public_path('uploads/' . $certificatePath));

        // Log success
        \Log::info('Certificate generated successfully', [
            'path' => $certificatePath,
            'filename' => $filename
        ]);

        return $certificatePath;
    }

    /**
     * Generate certificate using basic PHP GD functions as fallback
     */
    public function generateCertificateBasic(EventRegistration $registration)
    {
        $event = $registration->event;
        
        if (!$event->certificate_template) {
            throw new \Exception('Template sertifikat tidak ditemukan untuk event ini.');
        }

        $templatePath = public_path('uploads/' . $event->certificate_template);
        
        if (!file_exists($templatePath)) {
            throw new \Exception('File template sertifikat tidak ditemukan.');
        }

        // Check if GD extension is available
        if (!extension_loaded('gd')) {
            throw new \Exception('GD extension tidak tersedia. Silakan install GD extension untuk PHP.');
        }

        // Get participant name
        $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta Event';
        
        // Get file extension to determine type
        $fileExtension = strtolower(pathinfo($templatePath, PATHINFO_EXTENSION));
        
        // Load template image based on extension
        $image = null;
        $width = 0;
        $height = 0;
        
        switch ($fileExtension) {
            case 'jpg':
            case 'jpeg':
                if (function_exists('imagecreatefromjpeg')) {
                    $image = imagecreatefromjpeg($templatePath);
                } else {
                    throw new \Exception('Fungsi imagecreatefromjpeg tidak tersedia.');
                }
                break;
            case 'png':
                if (function_exists('imagecreatefrompng')) {
                    $image = imagecreatefrompng($templatePath);
                } else {
                    throw new \Exception('Fungsi imagecreatefrompng tidak tersedia.');
                }
                break;
            case 'gif':
                if (function_exists('imagecreatefromgif')) {
                    $image = imagecreatefromgif($templatePath);
                } else {
                    throw new \Exception('Fungsi imagecreatefromgif tidak tersedia.');
                }
                break;
            case 'pdf':
                // For PDF, we'll create a simple image with text
                $image = $this->createImageFromPDF($templatePath, $participantName, $event);
                break;
            default:
                throw new \Exception('Format file tidak didukung: ' . $fileExtension . '. Hanya mendukung JPG, JPEG, PNG, GIF, dan PDF.');
        }

        if (!$image) {
            throw new \Exception('Gagal memuat template gambar.');
        }

        // Get image dimensions
        $width = imagesx($image);
        $height = imagesy($image);

        // Define colors
        $textColor = imagecolorallocate($image, 0, 0, 0); // Black
        $bgColor = imagecolorallocate($image, 255, 255, 255); // White

        // Calculate font size - make it much larger
        $fontSize = max(40, intval($width / 15));
        $smallFontSize = max(20, intval($width / 25));
        
        // Add text using basic GD functions
        $textX = $width / 2;
        $textY = $height * 0.35;
        
        // Center the text
        $textWidth = strlen($participantName) * $fontSize * 0.6; // Approximate width
        $textX = ($width - $textWidth) / 2;

        // Add participant name with larger font
        imagestring($image, 5, $textX, $textY, $participantName, $textColor);

        // Add event title
        $eventTitle = $event->title;
        $eventY = $height * 0.5;
        $eventWidth = strlen($eventTitle) * $smallFontSize * 0.5;
        $eventX = ($width - $eventWidth) / 2;
        imagestring($image, 4, $eventX, $eventY, $eventTitle, $textColor);

        // Add event date
        $eventDate = $event->getFormattedDateAttribute();
        $dateY = $height * 0.6;
        $dateWidth = strlen($eventDate) * $smallFontSize * 0.4;
        $dateX = ($width - $dateWidth) / 2;
        imagestring($image, 3, $dateX, $dateY, $eventDate, $textColor);

        // Add location if available
        if ($event->location) {
            $locationY = $height * 0.7;
            $locationWidth = strlen($event->location) * $smallFontSize * 0.4;
            $locationX = ($width - $locationWidth) / 2;
            imagestring($image, 3, $locationX, $locationY, $event->location, $textColor);
        }

        // Generate filename and save
        $filename = 'certificate_' . $registration->id . '_' . time() . '.png';
        $certificatePath = 'certificates/generated/' . $filename;
        $fullPath = public_path('uploads/' . $certificatePath);

        // Ensure directory exists
        $dir = dirname($fullPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Save as PNG
        imagepng($image, $fullPath);
        imagedestroy($image);

        \Log::info('Basic certificate generated', [
            'path' => $certificatePath,
            'participant_name' => $participantName,
            'file_extension' => $fileExtension
        ]);

        return $certificatePath;
    }

    /**
     * Create image from PDF template (simple fallback)
     */
    private function createImageFromPDF($pdfPath, $participantName, $event)
    {
        // For PDF, create a simple certificate image
        $width = 800;
        $height = 600;
        
        // Create a white background
        $image = imagecreate($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        
        // Fill with white background
        imagefill($image, 0, 0, $white);
        
        // Add border
        imagerectangle($image, 10, 10, $width - 10, $height - 10, $black);
        
        // Add title
        imagestring($image, 5, $width / 2 - 100, 50, 'SERTIFIKAT', $black);
        
        // Add participant name
        imagestring($image, 4, $width / 2 - (strlen($participantName) * 6), 200, $participantName, $black);
        
        // Add event title
        imagestring($image, 3, $width / 2 - (strlen($event->title) * 4), 300, $event->title, $black);
        
        // Add date
        $date = $event->getFormattedDateAttribute();
        imagestring($image, 2, $width / 2 - (strlen($date) * 3), 400, $date, $black);
        
        return $image;
    }

    /**
     * Generate certificate with automatic optimal positioning
     */
    public function generateCertificateWithAutoPositioning(EventRegistration $registration)
    {
        $event = $registration->event;
        $user = $registration->user;
        
        // Get participant name with fallback
        $participantName = $registration->participant_name ?: $user->name ?: 'Peserta Event';
        
        // Ensure participant name is not empty
        if (empty(trim($participantName))) {
            $participantName = 'Peserta Event';
        }

        $templatePath = public_path('uploads/' . $event->certificate_template);

        if (!file_exists($templatePath)) {
            throw new \Exception('Template sertifikat tidak ditemukan: ' . $templatePath);
        }

        if (!$this->imageManager) {
            \Log::warning('ImageManager not available, using basic method');
            return $this->generateCertificateBasic($registration);
        }

        try {
            $image = $this->imageManager->read($templatePath);
            
            // Calculate optimal positions for different text elements
            $namePosition = $this->calculateOptimalTextPosition($templatePath, $participantName, 64);
            $eventPosition = $this->calculateOptimalTextPosition($templatePath, $event->title, 32);
            
            // Adjust event title position to be below name
            $eventPosition['y'] = $namePosition['y'] + 80;
            $eventPosition['fontSize'] = max(24, $namePosition['fontSize'] * 0.6);

            \Log::info('Auto-positioning certificate generation', [
                'registration_id' => $registration->id,
                'participant_name' => $participantName,
                'name_position' => $namePosition,
                'event_position' => $eventPosition
            ]);

            // Add participant name with optimal positioning
            $image->text($participantName, $namePosition['x'], $namePosition['y'], function ($font) use ($namePosition) {
                if ($this->fontPath) {
                    $font->filename($this->fontPath);
                }
                $font->size($namePosition['fontSize']);
                $font->color('#003399');
                $font->align('center');
                $font->valign('middle');
            });

            // Add event title with optimal positioning
            $image->text($event->title, $eventPosition['x'], $eventPosition['y'], function ($font) use ($eventPosition) {
                if ($this->fontPath) {
                    $font->filename($this->fontPath);
                }
                $font->size($eventPosition['fontSize']);
                $font->color('#666666');
                $font->align('center');
                $font->valign('middle');
            });

            // Add date if available
            if ($event->date) {
                $dateText = \Carbon\Carbon::parse($event->date)->format('d F Y');
                $datePosition = [
                    'x' => $eventPosition['x'],
                    'y' => $eventPosition['y'] + 50,
                    'fontSize' => max(18, $eventPosition['fontSize'] * 0.7)
                ];
                
                $image->text($dateText, $datePosition['x'], $datePosition['y'], function ($font) use ($datePosition) {
                    if ($this->fontPath) {
                        $font->filename($this->fontPath);
                    }
                    $font->size($datePosition['fontSize']);
                    $font->color('#888888');
                    $font->align('center');
                    $font->valign('middle');
                });
            }

            // Save the certificate
            $filename = 'certificate_auto_' . $registration->id . '_' . time() . '.png';
            $savePath = 'certificates/generated/' . $filename;
            $fullPath = public_path('uploads/' . $savePath);

            // Ensure directory exists
            $directory = dirname($fullPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->save($fullPath);

            \Log::info('Auto-positioned certificate generated successfully', [
                'registration_id' => $registration->id,
                'filename' => $filename,
                'path' => $savePath
            ]);

            return $savePath;

        } catch (\Exception $e) {
            \Log::error('Auto-positioned certificate generation failed: ' . $e->getMessage());
            return $this->generateCertificateBasic($registration);
        }
    }

    /**
     * Generate certificate with custom positioning
     */
    public function generateCertificateWithCustomPositioning(EventRegistration $registration, array $positions = [])
    {
        $event = $registration->event;
        
        if (!$event->certificate_template) {
            throw new \Exception('Template sertifikat tidak ditemukan untuk event ini.');
        }

        $templatePath = public_path('uploads/' . $event->certificate_template);
        
        if (!file_exists($templatePath)) {
            throw new \Exception('File template sertifikat tidak ditemukan.');
        }

        $image = $this->imageManager->read($templatePath);
        $width = $image->width();
        $height = $image->height();

        // Default positions (as percentages of image dimensions)
        $defaultPositions = [
            'name' => ['x' => 0.5, 'y' => 0.4, 'size' => 0.04], // 4% of width
            'event' => ['x' => 0.5, 'y' => 0.5, 'size' => 0.03], // 3% of width
            'date' => ['x' => 0.5, 'y' => 0.6, 'size' => 0.025], // 2.5% of width
            'location' => ['x' => 0.5, 'y' => 0.65, 'size' => 0.02], // 2% of width
        ];

        $positions = array_merge($defaultPositions, $positions);

        $textColor = '#1a365d';

        // Add participant name
        if (isset($positions['name'])) {
            $pos = $positions['name'];
            $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta Event';
            
            // Ensure participant name is not empty
            if (empty($participantName) || trim($participantName) === '') {
                $participantName = 'Peserta Event';
            }
            
            $image->text($participantName, 
                $width * $pos['x'], 
                $height * $pos['y'], 
                function ($font) use ($pos, $width, $textColor) {
                    if ($this->fontPath) {
                        $font->filename($this->fontPath);
                    }
                    $font->size(intval($width * $pos['size']));
                    $font->color($textColor);
                    $font->align('center');
                    $font->valign('middle');
                }
            );
        }

        // Add event title
        if (isset($positions['event'])) {
            $pos = $positions['event'];
            $image->text($event->title, 
                $width * $pos['x'], 
                $height * $pos['y'], 
                function ($font) use ($pos, $width, $textColor) {
                    if ($this->fontPath) {
                        $font->filename($this->fontPath);
                    }
                    $font->size(intval($width * $pos['size']));
                    $font->color($textColor);
                    $font->align('center');
                    $font->valign('middle');
                }
            );
        }

        // Add event date
        if (isset($positions['date'])) {
            $pos = $positions['date'];
            $image->text($event->getFormattedDateAttribute(), 
                $width * $pos['x'], 
                $height * $pos['y'], 
                function ($font) use ($pos, $width, $textColor) {
                    if ($this->fontPath) {
                        $font->filename($this->fontPath);
                    }
                    $font->size(intval($width * $pos['size']));
                    $font->color($textColor);
                    $font->align('center');
                    $font->valign('middle');
                }
            );
        }

        // Add location
        if (isset($positions['location'])) {
            $pos = $positions['location'];
            $image->text($event->location, 
                $width * $pos['x'], 
                $height * $pos['y'], 
                function ($font) use ($pos, $width, $textColor) {
                    if ($this->fontPath) {
                        $font->filename($this->fontPath);
                    }
                    $font->size(intval($width * $pos['size']));
                    $font->color($textColor);
                    $font->align('center');
                    $font->valign('middle');
                }
            );
        }

        // Generate unique filename
        $filename = 'certificate_' . $registration->id . '_' . time() . '.png';
        $certificatePath = 'certificates/generated/' . $filename;

        // Save the generated certificate
        $image->save(public_path('uploads/' . $certificatePath));

        return $certificatePath;
    }

    /**
     * Clean up old generated certificates
     */
    public function cleanupOldCertificates($daysOld = 7)
    {
        $directory = public_path('uploads/certificates/generated/');
        
        if (!is_dir($directory)) {
            return;
        }

        $files = glob($directory . '*');
        $cutoffTime = time() - ($daysOld * 24 * 60 * 60);

        foreach ($files as $file) {
            if (is_file($file) && filemtime($file) < $cutoffTime) {
                unlink($file);
            }
        }
    }

    /**
     * Test method to debug font issues
     */
    public function testFontGeneration(EventRegistration $registration)
    {
        $event = $registration->event;
        
        if (!$event->certificate_template) {
            throw new \Exception('Template sertifikat tidak ditemukan untuk event ini.');
        }

        $templatePath = public_path('uploads/' . $event->certificate_template);
        
        if (!file_exists($templatePath)) {
            throw new \Exception('File template sertifikat tidak ditemukan.');
        }

        // Check if image manager is available
        if (!$this->imageManager) {
            \Log::warning('ImageManager not available, using basic method for test');
            return $this->generateCertificateBasic($registration);
        }

        try {
            $image = $this->imageManager->read($templatePath);
            $width = $image->width();
            $height = $image->height();

            // Test with simple text and larger font
            $participantName = $registration->participant_name ?: $registration->user->name ?: 'Peserta Event';
            $testText = "TEST: " . $participantName;
            
            \Log::info('Test certificate generation', [
                'participant_name' => $participantName,
                'test_text' => $testText,
                'image_width' => $width,
                'image_height' => $height
            ]);
            
            // Try with very large font and bright color
            $image->text($testText, $width / 2, $height / 2, function ($font) {
                if ($this->fontPath) {
                    $font->filename($this->fontPath);
                }
                $font->size(72); // Very large font
                $font->color('#FF0000'); // Bright red for visibility
                $font->align('center');
                $font->valign('middle');
            });
            
            // Add a second test text
            $image->text("Nama: " . $participantName, $width / 2, $height / 2 + 100, function ($font) {
                if ($this->fontPath) {
                    $font->filename($this->fontPath);
                }
                $font->size(48);
                $font->color('#0000FF'); // Blue
                $font->align('center');
                $font->valign('middle');
            });

            // Generate test filename
            $filename = 'test_certificate_' . $registration->id . '_' . time() . '.png';
            $certificatePath = 'certificates/generated/' . $filename;

            // Save the test certificate
            $image->save(public_path('uploads/' . $certificatePath));

            \Log::info('Test certificate saved', ['path' => $certificatePath]);

            return $certificatePath;
        } catch (\Exception $e) {
            \Log::error('Advanced test certificate generation failed: ' . $e->getMessage());
            \Log::info('Falling back to basic method for test');
            return $this->generateCertificateBasic($registration);
        }
    }

    /**
     * Try to resolve a system font path for GD text rendering
     */
    private function resolveFontPath(): ?string
    {
        $candidates = [
            'C:\\Windows\\Fonts\\arial.ttf',
            'C:\\Windows\\Fonts\\calibri.ttf',
            'C:\\Windows\\Fonts\\times.ttf',
            'C:\\Windows\\Fonts\\verdana.ttf',
            '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
            '/System/Library/Fonts/Supplemental/Arial.ttf',
            base_path('resources/fonts/arial.ttf'),
        ];
        foreach ($candidates as $path) {
            if (is_file($path)) {
                \Log::info('Font found', ['path' => $path]);
                return $path;
            }
        }
        \Log::warning('No font found, using default');
        return null; // Let Intervention default if none found
    }

    /**
     * Auto-calculate optimal text position based on template analysis
     */
    private function calculateOptimalTextPosition($templatePath, $text, $fontSize = 64)
    {
        try {
            if (!$this->imageManager) {
                // Fallback positions if no image manager
                return [
                    'x' => 400,
                    'y' => 300,
                    'fontSize' => $fontSize
                ];
            }

            $image = $this->imageManager->read($templatePath);
            $width = $image->width();
            $height = $image->height();

            // Analyze template to find best position
            // Look for areas with less content (lighter colors)
            $centerX = intval($width / 2);
            $centerY = intval($height / 2);

            // Define search zones (common certificate text areas)
            $searchZones = [
                // Center area (most common)
                ['x' => $centerX, 'y' => intval($height * 0.5), 'priority' => 1],
                // Lower center (common for names)
                ['x' => $centerX, 'y' => intval($height * 0.6), 'priority' => 2],
                // Upper center (alternative)
                ['x' => $centerX, 'y' => intval($height * 0.4), 'priority' => 3],
                // Slightly lower
                ['x' => $centerX, 'y' => intval($height * 0.65), 'priority' => 4],
            ];

            // Calculate optimal font size based on image dimensions and text length
            $baseSize = max(32, min(120, intval($width / (strlen($text) * 0.8))));
            $optimalFontSize = max($fontSize, $baseSize);

            // Find the best position by checking each zone
            $bestPosition = $searchZones[0]; // Default to center
            
            foreach ($searchZones as $zone) {
                // Simple heuristic: prefer positions that are not too close to edges
                $edgeDistance = min($zone['x'], $width - $zone['x'], $zone['y'], $height - $zone['y']);
                if ($edgeDistance > 100) { // At least 100px from edges
                    $bestPosition = $zone;
                    break;
                }
            }

            return [
                'x' => $bestPosition['x'],
                'y' => $bestPosition['y'],
                'fontSize' => $optimalFontSize
            ];

        } catch (\Exception $e) {
            \Log::error('Error calculating optimal text position: ' . $e->getMessage());
            // Return safe defaults
            return [
                'x' => 400,
                'y' => 300,
                'fontSize' => $fontSize
            ];
        }
    }

    /**
     * Generate certificate with only participant name (custom positioning)
     */
    public function generateCertificateNameOnly(EventRegistration $registration, $customX = null, $customY = null, $fontSize = null, $color = '#003399')
    {
        $event = $registration->event;
        $user = $registration->user;
        
        // Get participant name with fallback
        $participantName = $registration->participant_name ?: $user->name ?: 'Peserta Event';
        
        // Ensure participant name is not empty
        if (empty(trim($participantName))) {
            $participantName = 'Peserta Event';
        }

        $templatePath = public_path('uploads/' . $event->certificate_template);

        if (!file_exists($templatePath)) {
            throw new \Exception('Template sertifikat tidak ditemukan: ' . $templatePath);
        }

        // Check if image manager is available
        if (!$this->imageManager) {
            \Log::warning('ImageManager not available, using basic method for name-only certificate');
            return $this->generateCertificateNameOnlyBasic($registration, $customX, $customY, $fontSize, $color);
        }

        try {
            $image = $this->imageManager->read($templatePath);
            $width = $image->width();
            $height = $image->height();

            // Use event settings if custom settings are not provided
            $finalX = $customX ?? $event->cert_x;
            $finalY = $customY ?? $event->cert_y;
            $finalFontSize = $fontSize ?? $event->cert_font_size;
            $finalColor = $color !== '#003399' ? $color : ($event->cert_color ?? '#003399');

            // Use auto-positioning if no custom position provided (either via args or event settings)
            if ($finalX === null || $finalY === null) {
                $optimalPosition = $this->calculateOptimalTextPosition($templatePath, $participantName, $finalFontSize);
                $x = $finalX ?? $optimalPosition['x'];
                $y = $finalY ?? $optimalPosition['y'];
                $nameFontSize = $finalFontSize ?? $optimalPosition['fontSize'];
            } else {
                // Convert custom positioning to integers and validate
                $x = intval($finalX);
                $y = intval($finalY);
                $nameFontSize = $finalFontSize ? intval($finalFontSize) : max(64, intval($width / 12));
            }
            
            // Ensure values are within reasonable bounds
            $x = max(0, min($width, $x));
            $y = max(0, min($height, $y));
            $nameFontSize = max(12, min(200, $nameFontSize));

            \Log::info('Generating certificate with name only', [
                'registration_id' => $registration->id,
                'participant_name' => $participantName,
                'template_path' => $templatePath,
                'image_width' => $width,
                'image_height' => $height,
                'custom_x' => $customX,
                'custom_y' => $customY,
                'font_size' => $fontSize,
                'color' => $color,
                'final_x' => $x,
                'final_y' => $y,
                'final_font_size' => $nameFontSize
            ]);

            // Add only participant name with custom positioning
            $image->text($participantName, $x, $y, function ($font) use ($nameFontSize, $finalColor) {
                if ($this->fontPath) {
                    $font->filename($this->fontPath);
                }
                $font->size($nameFontSize);
                $font->color($finalColor);
                $font->align('center');
                $font->valign('middle');
            });

            // Generate unique filename
            $filename = 'certificate_name_only_' . $registration->id . '_' . time() . '.png';
            $certificatePath = 'certificates/generated/' . $filename;
            $fullPath = public_path('uploads/' . $certificatePath);

            // Ensure directory exists
            $directory = dirname($fullPath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->save($fullPath);

            \Log::info('Certificate generated with name only', [
                'certificate_path' => $certificatePath,
                'participant_name' => $participantName,
                'position' => "x: $x, y: $y",
                'font_size' => $nameFontSize
            ]);

            return $certificatePath;

        } catch (\Exception $e) {
            \Log::error('Advanced name-only certificate generation failed: ' . $e->getMessage());
            return $this->generateCertificateNameOnlyBasic($registration, $customX, $customY, $fontSize, $color);
        }
    }

    /**
     * Generate certificate with only participant name using basic GD functions
     */
    public function generateCertificateNameOnlyBasic(EventRegistration $registration, $customX = null, $customY = null, $fontSize = null, $color = '#003399')
    {
        $event = $registration->event;
        $user = $registration->user;
        
        // Get participant name with fallback
        $participantName = $registration->participant_name ?: $user->name ?: 'Peserta Event';
        
        // Ensure participant name is not empty
        if (empty(trim($participantName))) {
            $participantName = 'Peserta Event';
        }

        $templatePath = public_path('uploads/' . $event->certificate_template);

        if (!file_exists($templatePath)) {
            throw new \Exception('Template sertifikat tidak ditemukan: ' . $templatePath);
        }

        // Check if GD extension is available
        if (!extension_loaded('gd')) {
            throw new \Exception('GD extension tidak tersedia. Silakan install GD extension untuk PHP.');
        }

        // Get file extension to determine type
        $fileExtension = strtolower(pathinfo($templatePath, PATHINFO_EXTENSION));
        
        // Load template image based on extension
        $image = null;
        $width = 0;
        $height = 0;
        
        switch ($fileExtension) {
            case 'jpg':
            case 'jpeg':
                if (function_exists('imagecreatefromjpeg')) {
                    $image = imagecreatefromjpeg($templatePath);
                } else {
                    throw new \Exception('Fungsi imagecreatefromjpeg tidak tersedia.');
                }
                break;
            case 'png':
                if (function_exists('imagecreatefrompng')) {
                    $image = imagecreatefrompng($templatePath);
                } else {
                    throw new \Exception('Fungsi imagecreatefrompng tidak tersedia.');
                }
                break;
            case 'gif':
                if (function_exists('imagecreatefromgif')) {
                    $image = imagecreatefromgif($templatePath);
                } else {
                    throw new \Exception('Fungsi imagecreatefromgif tidak tersedia.');
                }
                break;
            case 'pdf':
                // For PDF, create a simple image with text
                $image = $this->createImageFromPDF($templatePath, $participantName, $event);
                break;
            default:
                throw new \Exception('Format file tidak didukung: ' . $fileExtension . '. Hanya mendukung JPG, JPEG, PNG, GIF, dan PDF.');
        }

        if (!$image) {
            throw new \Exception('Gagal memuat template gambar.');
        }

        // Get image dimensions
        $width = imagesx($image);
        $height = imagesy($image);

        // Parse color
        $colorRgb = $this->hexToRgb($color);
        $textColor = imagecolorallocate($image, $colorRgb['r'], $colorRgb['g'], $colorRgb['b']);

        // Convert custom positioning to integers and validate
        $x = $customX ? intval($customX) : intval($width / 2);
        $y = $customY ? intval($customY) : intval($height * 0.5);
        $nameFontSize = $fontSize ? intval($fontSize) : max(64, intval($width / 12));
        
        // Ensure values are within reasonable bounds
        $x = max(0, min($width, $x));
        $y = max(0, min($height, $y));
        $nameFontSize = max(12, min(200, $nameFontSize));

        // Calculate text position for centering (approximate)
        $textWidth = strlen($participantName) * ($nameFontSize / 4); // Rough approximation
        $textX = max(0, $x - ($textWidth / 2));

        // Add only participant name using basic GD functions
        imagestring($image, 5, $textX, $y, $participantName, $textColor);

        // Generate unique filename
        $filename = 'certificate_name_only_' . $registration->id . '_' . time() . '.png';
        $certificatePath = 'certificates/generated/' . $filename;
        $fullPath = public_path('uploads/' . $certificatePath);

        // Ensure directory exists
        $directory = dirname($fullPath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Save as PNG
        imagepng($image, $fullPath);
        imagedestroy($image);

        \Log::info('Basic certificate generated with name only', [
            'certificate_path' => $certificatePath,
            'participant_name' => $participantName,
            'position' => "x: $x, y: $y",
            'font_size' => $nameFontSize
        ]);

        return $certificatePath;
    }

    /**
     * Generate certificates for all attended registrations in batch
     * Saves certificate paths to database and creates ZIP archive
     */
    public function generateBatchCertificates($eventId, $customX = null, $customY = null, $fontSize = null, $color = '#003399')
    {
        $event = \App\Models\Event::findOrFail($eventId);
        
        // Get all attended registrations
        $registrations = \App\Models\EventRegistration::where('event_id', $eventId)
            ->where('status', 'attended')
            ->get();

        if ($registrations->isEmpty()) {
            throw new \Exception('Tidak ada peserta dengan status "attended" untuk event ini.');
        }

        $generatedCertificates = [];
        $failedCertificates = [];
        $zipFilename = 'certificates_' . $event->id . '_' . time() . '.zip';
        $zipPath = public_path('uploads/certificates/batch/' . $zipFilename);

        // Ensure batch directory exists
        $batchDir = public_path('uploads/certificates/batch');
        if (!is_dir($batchDir)) {
            mkdir($batchDir, 0755, true);
        }

        // Create ZIP archive
        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new \Exception('Gagal membuat file ZIP.');
        }

        \Log::info('Starting batch certificate generation', [
            'event_id' => $eventId,
            'total_registrations' => $registrations->count(),
            'custom_params' => compact('customX', 'customY', 'fontSize', 'color')
        ]);

        // Use event settings if custom settings are not provided
        $finalX = $customX ?? $event->cert_x;
        $finalY = $customY ?? $event->cert_y;
        $finalFontSize = $fontSize ?? $event->cert_font_size;
        $finalColor = $color !== '#003399' ? $color : ($event->cert_color ?? '#003399');

        foreach ($registrations as $registration) {
            try {
                // Generate certificate with custom positioning
                $certificatePath = $this->generateCertificateNameOnly(
                    $registration,
                    $finalX,
                    $finalY,
                    $finalFontSize,
                    $finalColor
                );

                // Save certificate path to database
                $registration->certificate_path = $certificatePath;
                $registration->save();

                // Add to ZIP
                $fullPath = public_path('uploads/' . $certificatePath);
                if (file_exists($fullPath)) {
                    $participantName = $registration->participant_name ?: $registration->user->name;
                    $zipEntryName = $this->sanitizeFilename($participantName) . '_' . $registration->id . '.png';
                    $zip->addFile($fullPath, $zipEntryName);
                    
                    $generatedCertificates[] = [
                        'registration_id' => $registration->id,
                        'participant_name' => $participantName,
                        'certificate_path' => $certificatePath
                    ];
                } else {
                    throw new \Exception('File sertifikat tidak ditemukan setelah generate.');
                }

            } catch (\Exception $e) {
                \Log::error('Failed to generate certificate in batch', [
                    'registration_id' => $registration->id,
                    'error' => $e->getMessage()
                ]);
                
                $failedCertificates[] = [
                    'registration_id' => $registration->id,
                    'participant_name' => $registration->participant_name ?: $registration->user->name,
                    'error' => $e->getMessage()
                ];
            }
        }

        $zip->close();

        \Log::info('Batch certificate generation completed', [
            'event_id' => $eventId,
            'total_generated' => count($generatedCertificates),
            'total_failed' => count($failedCertificates),
            'zip_path' => $zipPath
        ]);

        return [
            'success' => true,
            'total_registrations' => $registrations->count(),
            'generated' => count($generatedCertificates),
            'failed' => count($failedCertificates),
            'certificates' => $generatedCertificates,
            'failed_certificates' => $failedCertificates,
            'zip_filename' => $zipFilename,
            'zip_path' => 'certificates/batch/' . $zipFilename
        ];
    }

    /**
     * Sanitize filename for safe file system usage
     */
    private function sanitizeFilename($filename)
    {
        // Remove special characters and spaces
        $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $filename);
        // Remove multiple underscores
        $filename = preg_replace('/_+/', '_', $filename);
        // Trim underscores from ends
        $filename = trim($filename, '_');
        // Limit length
        return substr($filename, 0, 50);
    }

    /**
     * Convert hex color to RGB
     */
    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2))
        ];
    }
}

