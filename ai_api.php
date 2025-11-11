<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header('Content-Type: application/json; charset=utf-8');

$geminiKey = "AIzaSyBWV5WataV2uEc4mOc3MJ8h5m8dCuegqMs";

$input = json_decode(file_get_contents("php://input"), true);
$question = trim($input["message"] ?? "");

if (!$question) {
    echo json_encode(["reply" => "กรุณาพิมพ์คำถามก่อนค่ะ"]);
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$geminiKey";

$data = [
    "contents" => [
        [
            "parts" => [["text" => $question]]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
    CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE)
]);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
$reply = $result["candidates"][0]["content"]["parts"][0]["text"] ?? "ไม่สามารถตอบได้ในขณะนี้ค่ะ";

echo json_encode(["reply" => $reply], JSON_UNESCAPED_UNICODE);
?>
