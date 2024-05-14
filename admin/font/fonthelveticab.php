<?php
// Set the content type header to indicate that this is a font file
header('Content-Type: application/font-woff');

// Path to the Helvetica font file
$fontFile = 'path/to/helvetica-bold.woff';

// Check if the font file exists
if (file_exists($fontFile)) {
    // Output the font file
    readfile($fontFile);
} else {
    // Font file not found, return a 404 error
    header("HTTP/1.0 404 Not Found");
    echo "Font file not found.";
}
?>
