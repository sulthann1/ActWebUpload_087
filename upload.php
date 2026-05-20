<?php
$target_dir = "uploads/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if(isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    
    
    if (file_exists($target_file)) {
        echo "<script>alert('Maaf, berkas sudah ada.'); window.location.href='index.html';</script>";
        $uploadOk = 0;
    }

    
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<script>alert('Maaf, berkas terlalu besar (Maks 500KB).'); window.location.href='index.html';</script>";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            
            header("Location: lihat_file.php");
            exit();
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah.'); window.location.href='index.html';</script>";
        }
    }
}
?>