<?php
/**
 * Script untuk cek file gambar event yang hilang
 * Akses via: https://himakomuym.web.id/check-event-images.php
 * HAPUS FILE INI SETELAH SELESAI DEBUGGING!
 */

// Koneksi database (sesuaikan dengan konfigurasi hosting)
$host = 'localhost';
$dbname = 'your_database_name'; // GANTI dengan nama database
$username = 'your_username'; // GANTI dengan username database
$password = 'your_password'; // GANTI dengan password database

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Path folder uploads
$uploadsPath = __DIR__ . '/uploads/events/';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Event Images - HIMAKOM UYM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #1976d2;
            border-bottom: 2px solid #1976d2;
            padding-bottom: 10px;
        }
        .status {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #1976d2;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .file-exists {
            color: green;
            font-weight: bold;
        }
        .file-missing {
            color: red;
            font-weight: bold;
        }
        .path-correct {
            color: green;
        }
        .path-wrong {
            color: orange;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background: #e3f2fd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Check Event Images - HIMAKOM UYM</h1>
        
        <?php
        // Cek apakah folder uploads/events ada
        if (!is_dir($uploadsPath)) {
            echo '<div class="status error">';
            echo '❌ Folder uploads/events TIDAK ADA!<br>';
            echo 'Path: ' . $uploadsPath;
            echo '</div>';
            echo '<div class="status warning">';
            echo '💡 Solusi: Buat folder dengan command:<br>';
            echo '<code>mkdir -p ' . $uploadsPath . '</code>';
            echo '</div>';
            exit;
        }

        // Cek permission folder
        if (!is_writable($uploadsPath)) {
            echo '<div class="status warning">';
            echo '⚠️ Folder uploads/events tidak writable!<br>';
            echo 'Permission saat ini: ' . substr(sprintf('%o', fileperms($uploadsPath)), -4);
            echo '</div>';
        }

        // Ambil semua event dari database
        $stmt = $pdo->query("SELECT id, title, image FROM events WHERE image IS NOT NULL ORDER BY id DESC");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($events)) {
            echo '<div class="status warning">Tidak ada event dengan gambar di database.</div>';
            exit;
        }

        $total = count($events);
        $exists = 0;
        $missing = 0;
        $pathCorrect = 0;
        $pathWrong = 0;

        echo '<div class="summary">';
        echo '<strong>Total Event dengan Gambar:</strong> ' . $total;
        echo '</div>';

        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Title</th>';
        echo '<th>Path di DB</th>';
        echo '<th>Status Path</th>';
        echo '<th>File Lokal</th>';
        echo '<th>Status File</th>';
        echo '</tr>';

        foreach ($events as $event) {
            $imagePath = $event['image'];
            $pathStatus = '';
            $fileStatus = '';
            $fileExists = false;
            $isPathCorrect = false;

            // Cek format path
            if (strpos($imagePath, 'events/') === 0) {
                $isPathCorrect = true;
                $pathCorrect++;
                $pathStatus = '<span class="path-correct">✓ Benar (events/...)</span>';
            } else {
                $pathWrong++;
                $pathStatus = '<span class="path-wrong">✗ Salah (tanpa events/)</span>';
            }

            // Tentukan nama file yang harus dicari
            if (strpos($imagePath, 'events/') === 0) {
                $filename = basename($imagePath); // events/event-xxx.jpg -> event-xxx.jpg
            } else {
                $filename = basename($imagePath);
            }

            $filePath = $uploadsPath . $filename;

            // Cek apakah file ada
            if (file_exists($filePath)) {
                $fileExists = true;
                $exists++;
                $fileStatus = '<span class="file-exists">✓ Ada</span>';
            } else {
                $missing++;
                $fileStatus = '<span class="file-missing">✗ Tidak Ada</span>';
            }

            // Tampilkan baris tabel
            echo '<tr>';
            echo '<td>' . $event['id'] . '</td>';
            echo '<td>' . htmlspecialchars(substr($event['title'], 0, 50)) . '...</td>';
            echo '<td><code>' . htmlspecialchars($imagePath) . '</code></td>';
            echo '<td>' . $pathStatus . '</td>';
            echo '<td><code>' . htmlspecialchars($filename) . '</code></td>';
            echo '<td>' . $fileStatus . '</td>';
            echo '</tr>';
        }

        echo '</table>';

        // Summary
        echo '<div class="summary">';
        echo '<h3>📊 Ringkasan:</h3>';
        echo '<ul>';
        echo '<li><strong>Total Event:</strong> ' . $total . '</li>';
        echo '<li><strong>Path Benar:</strong> <span style="color:green">' . $pathCorrect . '</span></li>';
        echo '<li><strong>Path Salah:</strong> <span style="color:orange">' . $pathWrong . '</span></li>';
        echo '<li><strong>File Ada:</strong> <span style="color:green">' . $exists . '</span></li>';
        echo '<li><strong>File Hilang:</strong> <span style="color:red">' . $missing . '</span></li>';
        echo '</ul>';

        if ($missing > 0) {
            echo '<div class="status error">';
            echo '<strong>⚠️ PERINGATAN:</strong> Ada ' . $missing . ' file gambar yang hilang!<br>';
            echo 'File-file ini perlu di-upload ke hosting di folder: <code>public/uploads/events/</code>';
            echo '</div>';
        }

        if ($pathWrong > 0) {
            echo '<div class="status warning">';
            echo '<strong>💡 INFO:</strong> Ada ' . $pathWrong . ' path yang perlu diperbaiki di database.<br>';
            echo 'Jalankan script SQL: <code>FIX_EVENT_IMAGE_PATHS.sql</code>';
            echo '</div>';
        }

        if ($missing == 0 && $pathWrong == 0) {
            echo '<div class="status success">';
            echo '✅ Semua file gambar ada dan path sudah benar!';
            echo '</div>';
        }
        echo '</div>';

        // List file yang ada di folder
        echo '<div class="summary" style="margin-top: 20px;">';
        echo '<h3>📁 File yang Ada di Folder uploads/events/:</h3>';
        $files = scandir($uploadsPath);
        $imageFiles = array_filter($files, function($file) {
            return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });
        
        if (empty($imageFiles)) {
            echo '<p style="color:red;">Tidak ada file gambar di folder ini!</p>';
        } else {
            echo '<ul>';
            foreach ($imageFiles as $file) {
                echo '<li><code>' . htmlspecialchars($file) . '</code> (' . number_format(filesize($uploadsPath . $file) / 1024, 2) . ' KB)</li>';
            }
            echo '</ul>';
        }
        echo '</div>';

        // Instruksi
        echo '<div class="status warning" style="margin-top: 20px;">';
        echo '<strong>🔒 KEAMANAN:</strong> HAPUS file ini setelah selesai debugging!';
        echo '</div>';
        ?>
    </div>
</body>
</html>

