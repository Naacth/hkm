<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Image Upload - HIMAKOM</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #1976d2;
            border-bottom: 3px solid #1976d2;
            padding-bottom: 10px;
        }
        h2 {
            color: #333;
            margin-top: 30px;
            background: #e3f2fd;
            padding: 10px;
            border-left: 4px solid #1976d2;
        }
        pre {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            border: 1px solid #ddd;
        }
        .success {
            color: #4caf50;
            font-weight: bold;
        }
        .error {
            color: #f44336;
            font-weight: bold;
        }
        .warning {
            color: #ff9800;
            font-weight: bold;
        }
        .info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid #2196f3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #1976d2;
            color: white;
        }
        table tr:hover {
            background: #f5f5f5;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-success {
            background: #4caf50;
            color: white;
        }
        .badge-error {
            background: #f44336;
            color: white;
        }
        .badge-warning {
            background: #ff9800;
            color: white;
        }
        img {
            max-width: 300px;
            border: 2px solid #ddd;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Debug Image Upload - HIMAKOM</h1>
        <p><strong>Waktu Check:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>

        <?php
        // Load Laravel environment
        $envPath = __DIR__ . '/../.env';
        $appUrl = 'NOT SET';
        
        if (file_exists($envPath)) {
            $envContent = file_get_contents($envPath);
            if (preg_match('/APP_URL=(.*)/', $envContent, $matches)) {
                $appUrl = trim($matches[1]);
            }
        }

        // Current URL
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $currentUrl = $protocol . "://" . $_SERVER['HTTP_HOST'];
        ?>

        <!-- 1. APP_URL Check -->
        <h2>1. ⚙️ Konfigurasi APP_URL</h2>
        <table>
            <tr>
                <th>Setting</th>
                <th>Value</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>APP_URL (.env)</td>
                <td><code><?php echo htmlspecialchars($appUrl); ?></code></td>
                <td>
                    <?php if ($appUrl === $currentUrl): ?>
                        <span class="badge badge-success">✓ MATCH</span>
                    <?php else: ?>
                        <span class="badge badge-error">✗ TIDAK MATCH</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Current URL</td>
                <td><code><?php echo htmlspecialchars($currentUrl); ?></code></td>
                <td>-</td>
            </tr>
        </table>

        <?php if ($appUrl !== $currentUrl): ?>
            <div class="info">
                <strong>⚠️ WARNING:</strong> APP_URL tidak sesuai dengan URL saat ini!<br>
                <strong>Solusi:</strong> Edit file <code>.env</code> dan ubah <code>APP_URL=<?php echo $currentUrl; ?></code>
            </div>
        <?php endif; ?>

        <!-- 2. Folder Structure Check -->
        <h2>2. 📁 Struktur Folder</h2>
        <?php
        $uploadsPath = __DIR__ . '/uploads';
        $folders = [
            'uploads' => $uploadsPath,
            'uploads/events' => $uploadsPath . '/events',
            'uploads/qris' => $uploadsPath . '/qris',
            'uploads/certificates' => $uploadsPath . '/certificates',
            'uploads/proof_of_payment' => $uploadsPath . '/proof_of_payment',
        ];
        ?>
        <table>
            <tr>
                <th>Folder</th>
                <th>Path</th>
                <th>Exists</th>
                <th>Writable</th>
                <th>Permission</th>
            </tr>
            <?php foreach ($folders as $name => $path): ?>
                <tr>
                    <td><code><?php echo $name; ?></code></td>
                    <td><code><?php echo $path; ?></code></td>
                    <td>
                        <?php if (file_exists($path)): ?>
                            <span class="badge badge-success">✓ YES</span>
                        <?php else: ?>
                            <span class="badge badge-error">✗ NO</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (file_exists($path) && is_writable($path)): ?>
                            <span class="badge badge-success">✓ YES</span>
                        <?php elseif (file_exists($path)): ?>
                            <span class="badge badge-error">✗ NO</span>
                        <?php else: ?>
                            <span class="badge badge-warning">N/A</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (file_exists($path)): ?>
                            <code><?php echo substr(sprintf('%o', fileperms($path)), -4); ?></code>
                        <?php else: ?>
                            <span class="badge badge-warning">N/A</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php
        $missingFolders = [];
        foreach ($folders as $name => $path) {
            if (!file_exists($path)) {
                $missingFolders[] = $name;
            }
        }
        if (!empty($missingFolders)):
        ?>
            <div class="info">
                <strong>⚠️ WARNING:</strong> Folder berikut tidak ditemukan:<br>
                <ul>
                    <?php foreach ($missingFolders as $folder): ?>
                        <li><code><?php echo $folder; ?></code></li>
                    <?php endforeach; ?>
                </ul>
                <strong>Solusi via SSH:</strong>
                <pre>cd public
mkdir -p uploads/events uploads/qris uploads/certificates uploads/proof_of_payment
chmod -R 775 uploads</pre>
            </div>
        <?php endif; ?>

        <!-- 3. Files in events/ -->
        <h2>3. 📷 File Gambar di events/</h2>
        <?php
        $eventsPath = $uploadsPath . '/events';
        if (file_exists($eventsPath)):
            $files = array_diff(scandir($eventsPath), ['.', '..']);
            if (count($files) > 0):
        ?>
            <table>
                <tr>
                    <th>Filename</th>
                    <th>Size</th>
                    <th>Modified</th>
                    <th>Preview</th>
                </tr>
                <?php foreach ($files as $file): 
                    $filePath = $eventsPath . '/' . $file;
                    if (is_file($filePath)):
                ?>
                    <tr>
                        <td><code><?php echo htmlspecialchars($file); ?></code></td>
                        <td><?php echo number_format(filesize($filePath) / 1024, 2); ?> KB</td>
                        <td><?php echo date('Y-m-d H:i:s', filemtime($filePath)); ?></td>
                        <td>
                            <a href="<?php echo $currentUrl . '/uploads/events/' . urlencode($file); ?>" target="_blank">
                                View
                            </a>
                        </td>
                    </tr>
                <?php 
                    endif;
                endforeach; ?>
            </table>
        <?php else: ?>
            <div class="info">
                <strong>ℹ️ INFO:</strong> Folder events/ kosong. Belum ada gambar yang di-upload.
            </div>
        <?php endif; ?>
        <?php else: ?>
            <div class="info">
                <strong>⚠️ WARNING:</strong> Folder <code>uploads/events/</code> tidak ditemukan!
            </div>
        <?php endif; ?>

        <!-- 4. Test Image URL -->
        <h2>4. 🖼️ Test Image URL</h2>
        <?php
        if (file_exists($eventsPath)):
            $files = array_diff(scandir($eventsPath), ['.', '..']);
            $imageFiles = array_filter($files, function($file) use ($eventsPath) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                return in_array($ext, ['jpg', 'jpeg', 'png', 'gif']) && is_file($eventsPath . '/' . $file);
            });
            
            if (count($imageFiles) > 0):
                $testImage = reset($imageFiles);
                $imageUrl = $currentUrl . '/uploads/events/' . urlencode($testImage);
        ?>
                <p><strong>Test Image:</strong> <code><?php echo htmlspecialchars($testImage); ?></code></p>
                <p><strong>URL:</strong> <a href="<?php echo $imageUrl; ?>" target="_blank"><?php echo htmlspecialchars($imageUrl); ?></a></p>
                <div>
                    <img src="<?php echo $imageUrl; ?>" 
                         alt="Test Image"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                    <div style="display:none; padding: 20px; background: #ffebee; border-radius: 5px; color: #c62828;">
                        <strong>❌ Gambar tidak bisa dimuat!</strong><br>
                        Kemungkinan penyebab:
                        <ul>
                            <li>Permission folder salah</li>
                            <li>File corrupt</li>
                            <li>.htaccess blocking</li>
                        </ul>
                    </div>
                </div>
        <?php
            else:
        ?>
                <div class="info">
                    <strong>ℹ️ INFO:</strong> Tidak ada file gambar (jpg, jpeg, png, gif) di folder events/ untuk di-test.
                </div>
        <?php
            endif;
        else:
        ?>
            <div class="info">
                <strong>⚠️ WARNING:</strong> Folder events/ tidak ada, tidak bisa test gambar.
            </div>
        <?php endif; ?>

        <!-- 5. Database Check -->
        <h2>5. 🗄️ Database Check (Events Table)</h2>
        <?php
        // Try to connect to database
        $dbConfigPath = __DIR__ . '/../config/database.php';
        $dbConnected = false;
        $events = [];

        if (file_exists($envPath)) {
            $envContent = file_get_contents($envPath);
            $dbHost = '';
            $dbName = '';
            $dbUser = '';
            $dbPass = '';

            if (preg_match('/DB_HOST=(.*)/', $envContent, $matches)) {
                $dbHost = trim($matches[1]);
            }
            if (preg_match('/DB_DATABASE=(.*)/', $envContent, $matches)) {
                $dbName = trim($matches[1]);
            }
            if (preg_match('/DB_USERNAME=(.*)/', $envContent, $matches)) {
                $dbUser = trim($matches[1]);
            }
            if (preg_match('/DB_PASSWORD=(.*)/', $envContent, $matches)) {
                $dbPass = trim($matches[1]);
            }

            try {
                $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbConnected = true;

                $stmt = $pdo->query("SELECT id, title, image FROM events ORDER BY id DESC LIMIT 10");
                $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo '<div class="info"><strong>⚠️ WARNING:</strong> Tidak bisa connect ke database: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }

        if ($dbConnected && count($events) > 0):
        ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image Path</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?php echo $event['id']; ?></td>
                        <td><?php echo htmlspecialchars(substr($event['title'], 0, 50)); ?></td>
                        <td><code><?php echo htmlspecialchars($event['image'] ?? 'NULL'); ?></code></td>
                        <td>
                            <?php
                            $imagePath = $event['image'];
                            if (empty($imagePath)) {
                                echo '<span class="badge badge-warning">NO IMAGE</span>';
                            } elseif (strpos($imagePath, 'storage/') === 0) {
                                echo '<span class="badge badge-error">❌ WRONG PATH (storage/)</span>';
                            } elseif (strpos($imagePath, '/uploads/') === 0) {
                                echo '<span class="badge badge-error">❌ WRONG PATH (/uploads/)</span>';
                            } elseif (strpos($imagePath, 'uploads/') === 0) {
                                echo '<span class="badge badge-error">❌ WRONG PATH (uploads/)</span>';
                            } elseif (strpos($imagePath, 'events/') === 0) {
                                $fullPath = $uploadsPath . '/' . $imagePath;
                                if (file_exists($fullPath)) {
                                    echo '<span class="badge badge-success">✓ CORRECT & EXISTS</span>';
                                } else {
                                    echo '<span class="badge badge-warning">⚠️ CORRECT BUT FILE NOT FOUND</span>';
                                }
                            } else {
                                echo '<span class="badge badge-warning">⚠️ UNKNOWN FORMAT</span>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?php
            // Check for wrong paths
            $wrongPaths = array_filter($events, function($event) {
                $path = $event['image'] ?? '';
                return !empty($path) && (
                    strpos($path, 'storage/') === 0 ||
                    strpos($path, '/uploads/') === 0 ||
                    strpos($path, 'uploads/') === 0
                );
            });

            if (count($wrongPaths) > 0):
            ?>
                <div class="info">
                    <strong>⚠️ WARNING:</strong> Ditemukan <?php echo count($wrongPaths); ?> event dengan path gambar yang salah!<br>
                    <strong>Solusi via SQL:</strong>
                    <pre>-- Hapus prefix 'storage/' jika ada
UPDATE events 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

-- Hapus prefix '/uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

-- Hapus prefix 'uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, 'uploads/', '') 
WHERE image LIKE 'uploads/%' AND image NOT LIKE 'events/%';</pre>
                </div>
            <?php endif; ?>

        <?php elseif ($dbConnected): ?>
            <div class="info">
                <strong>ℹ️ INFO:</strong> Tidak ada data event di database.
            </div>
        <?php else: ?>
            <div class="info">
                <strong>⚠️ WARNING:</strong> Tidak bisa connect ke database untuk check data events.
            </div>
        <?php endif; ?>

        <!-- 6. Recommendations -->
        <h2>6. 💡 Rekomendasi</h2>
        <div class="info">
            <h3>Langkah-langkah yang harus dilakukan:</h3>
            <ol>
                <?php if ($appUrl !== $currentUrl): ?>
                    <li class="error">✗ Fix APP_URL di file .env menjadi: <code><?php echo $currentUrl; ?></code></li>
                <?php else: ?>
                    <li class="success">✓ APP_URL sudah benar</li>
                <?php endif; ?>

                <?php if (!empty($missingFolders)): ?>
                    <li class="error">✗ Buat folder yang hilang: <?php echo implode(', ', $missingFolders); ?></li>
                <?php else: ?>
                    <li class="success">✓ Semua folder sudah ada</li>
                <?php endif; ?>

                <?php if (isset($wrongPaths) && count($wrongPaths) > 0): ?>
                    <li class="error">✗ Fix path gambar di database dengan SQL query di atas</li>
                <?php else: ?>
                    <li class="success">✓ Path gambar di database sudah benar</li>
                <?php endif; ?>

                <li>Clear cache Laravel:
                    <pre>php artisan config:clear
php artisan cache:clear
php artisan view:clear</pre>
                </li>

                <li>Test upload gambar baru via admin panel</li>
            </ol>
        </div>

        <hr style="margin: 30px 0;">
        <p style="text-align: center; color: #666;">
            <strong>HIMAKOM UYM</strong> - Debug Tool v1.0<br>
            <small>Setelah selesai debugging, hapus file ini untuk keamanan!</small>
        </p>
    </div>
</body>
</html>
