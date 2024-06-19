<?php
// upload.php

// Sprawdź, czy plik został przesłany
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar']) && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $targetDir = "Images/photos_user_" . $userId;
    
    // Sprawdź, czy folder użytkownika istnieje, jeśli nie - utwórz go
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    // Ścieżka docelowa pliku
    $targetFile = $targetDir . '/profileImage.png';
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Sprawdź, czy plik jest prawdziwym obrazem lub fałszywym obrazem
    $check = getimagesize($_FILES['avatar']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Sprawdź rozmiar pliku
    if ($_FILES['avatar']['size'] > 5000000) { // Limity rozmiaru pliku do 5MB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Zezwalaj tylko na określone formaty plików
    $fileExtension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
    if ($fileExtension != "jpg" && $fileExtension != "jpeg" && $fileExtension != "png" && $fileExtension != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Sprawdź, czy $uploadOk jest ustawione na 0 przez błąd
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // jeśli wszystko jest w porządku, spróbuj przesłać plik
    } else {
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
            echo "The file ". htmlspecialchars(basename($_FILES['avatar']['name'])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file uploaded or user ID not provided.";
}
?>
