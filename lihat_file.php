<?php
$target_dir = "uploads/";


if (isset($_GET['hapus'])) {
    $file_to_delete = basename($_GET['hapus']);
    if (file_exists($target_dir . $file_to_delete)) {
        unlink($target_dir . $file_to_delete);
    }
    
    header("Location: lihat_file.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Berkas Terunggah</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #a5b4fc;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            margin: 0;
        }
        .card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 800px;
        }
        h3 { margin-top: 0; color: #333; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px; color: #666; font-weight: normal; border-bottom: 2px solid #ddd; font-size: 14px; }
        td { padding: 15px 12px; vertical-align: middle; border-bottom: 1px solid #eaeaea; color: #444; font-size: 14px; }
        
        .preview-img { max-width: 40px; max-height: 40px; border-radius: 6px; object-fit: cover; }
        .file-icon { font-size: 24px; }
        .badge-tipe { 
            background: #e0e7ff; color: #4f46e5; padding: 4px 10px; 
            border-radius: 6px; font-weight: bold; font-size: 12px; 
        }
        
        
        .aksi-container {
            display: flex;
            gap: 8px; 
        }

       
        .btn-unduh {
            background: transparent; color: #10b981; border: 1px solid #10b981; 
            padding: 6px 15px; border-radius: 6px; cursor: pointer; 
            text-decoration: none; font-size: 12px; font-weight: 500;
            transition: 0.2s;
        }
        .btn-unduh:hover { background: #d1fae5; }

        
        .btn-hapus {
            background: transparent; color: #e11d48; border: 1px solid #e11d48; 
            padding: 6px 15px; border-radius: 6px; cursor: pointer; 
            text-decoration: none; font-size: 12px; font-weight: 500;
            transition: 0.2s;
        }
        .btn-hapus:hover { background: #fee2e2; }
        
        .btn-kembali {
            margin-top: 30px; background: rgba(255,255,255,0.7); color: #555;
            padding: 10px 20px; border-radius: 10px; text-decoration: none;
            font-size: 14px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: 0.2s;
        }
        .btn-kembali:hover { background: white; }
    </style>
</head>
<body>

<div class="card">
    <h3>Daftar Berkas yang Diunggah</h3>
    
    <table>
        <tr>
            <th>Pratinjau</th>
            <th>Nama Berkas</th>
            <th>Tipe</th>
            <th>Ukuran</th>
            <th>Aksi</th>
        </tr>
        
        <?php
        if (file_exists($target_dir)) {
            $files = scandir($target_dir);
            $imageExtensions = array("jpg", "jpeg", "png", "gif", "webp", "svg");

            foreach($files as $file) {
                if($file !== "." && $file !== "..") {
                    $filePath = $target_dir . $file;
                    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    
                    
                    $fileSizeKB = round(filesize($filePath) / 1024, 2); 
                    
                   
                    if (in_array($fileExtension, $imageExtensions)) {
                        $preview = "<img src='$filePath' class='preview-img' alt='preview'>";
                    } else {
                        $preview = "<span class='file-icon'>📄</span>";
                    }

                    echo "<tr>";
                    echo "<td>$preview</td>";
                    echo "<td><strong>$file</strong></td>";
                    echo "<td><span class='badge-tipe'>" . strtoupper($fileExtension) . "</span></td>";
                    echo "<td>" . $fileSizeKB . " KB</td>";
                    
                    
                    echo "<td>
                            <div class='aksi-container'>
                                <a href='$filePath' download='$file' class='btn-unduh'>Unduh</a>
                                <a href='lihat_file.php?hapus=" . urlencode($file) . "' class='btn-hapus' onclick='return confirm(\"Yakin ingin menghapus berkas ini?\")'>Hapus</a>
                            </div>
                          </td>";
                    echo "</tr>";
                }
            }
        }
        ?>
    </table>
</div>

<a href="index.html" class="btn-kembali">Unggah File Baru</a>

</body>
</html>