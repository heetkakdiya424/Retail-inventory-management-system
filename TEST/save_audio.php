<?php
$targetPath = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "hello";
    $audioBlob = $_FILES["audio"]["tmp_name"];
    $audioName = $_FILES["audio"]["name"];

    // Define the directory where you want to save the audio file.
    $uploadDirectory = "uploads/";

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $targetPath = $uploadDirectory . $audioName;

    if (move_uploaded_file($audioBlob, $targetPath)) {
        echo $targetPath;
    } else {
        echo "Error saving the audio file.";
    }
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// replace with your API token
$YOUR_API_TOKEN = "777f62cd3a0e4d348a5e0482315a373c";

// URL of the file to transcribe
$FILE_URL = $targetPath;

// You can also transcribe a local file by passing in a file path
// $FILE_URL = './path/to/file.mp3';

// AssemblyAI transcript endpoint (where we submit the file)
$transcript_endpoint = "https://api.assemblyai.com/v2/transcript";

// Request parameters 
$data = array(
    "audio_url" => $FILE_URL // You can also use a URL to an audio or video file on the web
);

// HTTP request headers
$headers = array(
    "authorization: 777f62cd3a0e4d348a5e0482315a373c",
    "content-type: application/json"
);

// submit for transcription via HTTP request
$curl = curl_init($transcript_endpoint);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

$response = json_decode($response, true);

curl_close($curl);

# polling for transcription completion
$transcript_id = $response['id'];
$polling_endpoint = "https://api.assemblyai.com/v2/transcript/" . $transcript_id;

while (true) {
    $polling_response = curl_init($polling_endpoint);

    curl_setopt($polling_response, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($polling_response, CURLOPT_RETURNTRANSFER, true);

    $transcription_result = json_decode(curl_exec($polling_response), true);

    if ($transcription_result['status'] === "completed") {
        echo json_encode($transcription_result);
        break;
    } else if ($transcription_result['status'] === "error") {
        throw new Exception("Transcription failed: " . $transcription_result['error']);
    } else {
        sleep(3);
    }
}
