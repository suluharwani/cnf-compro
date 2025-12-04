<!DOCTYPE html>
<html lang="<?= $currentLang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/logo.png') ?>">
</head>
<body>
    <!-- Language Switcher (Top Right) -->
    <div class="language-switcher">
        <div class="container d-flex justify-content-end py-2">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-outline-secondary language-btn <?= $currentLang === 'en' ? 'active' : '' ?>" data-lang="en">
                    <i class="fas fa-globe me-1"></i> English
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary language-btn <?= $currentLang === 'id' ? 'active' : '' ?>" data-lang="id">
                    <i class="fas fa-globe me-1"></i> Indonesia
                </button>
            </div>
        </div>
    </div>