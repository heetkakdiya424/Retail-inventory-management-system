<?php
require 'vendor/autoload.php'; // Include the Google Cloud SDK

use Google\Cloud\Speech\V1\SpeechClient;

// Check if the request is a POST request with audio data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['audio'])) {
    // Initialize the SpeechClient
    $speech = new SpeechClient();

    // Path to the audio file (temporary location)
    $audioFile = $_FILES['audio']['tmp_name'];

    // Define the language code (e.g., 'en-US' for US English)
    $languageCode = 'en-US';

    try {
        // Perform speech recognition
        $response = $speech->recognize(
            fopen($audioFile, 'r'),
            [
                'languageCode' => $languageCode,
            ]
        );

        // Process and display the transcribed text
        foreach ($response->results() as $result) {
            echo 'Transcript: ' . $result->alternatives()[0]['transcript'] . PHP_EOL;
        }
    } finally {
        // Clean up
        $speech->close();
    }
} else {
    echo 'Invalid request';
}
