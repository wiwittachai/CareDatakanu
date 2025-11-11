<?php
header('Content-Type: application/json; charset=utf-8');

// กำหนด API Key (เช่น Gemini)
$geminiKey = "AIzaSyBWV5WataV2uEc4mOc3MJ8h5m8dCuegqMs";

// รับข้อความที่ส่งมาจากเว็บ InfinityFree
$input = json_decode(file_get_contents("php://input"), true);
$question = trim($input["message"] ?? "");

// เรียก Gemini API
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$geminiKey";

$data = [
    "contents" => [[
        "parts" => [["text" => $question]]
    ]]
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

