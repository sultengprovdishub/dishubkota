<?php

// Titik masuk Laravel untuk Vercel Serverless PHP Runtime
// Set document root ke folder public Laravel
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../public';

// Forward semua request ke public/index.php Laravel
require __DIR__ . '/../public/index.php';
