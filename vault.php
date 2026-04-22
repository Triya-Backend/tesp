<?php
// Password simpel untuk local test (biar ga semua orang liat)
$pwd = '1234'; 

if (!isset($_GET['pwd']) || $_GET['pwd'] !== $pwd) {
    die('Akses ditolak. Tambahkan ?pwd=1234 di URL.');
}

$file = 'logs/vault.db';
echo "<h2>🧪 HASIL TANGKAPAN LOKAL</h2>";
echo "<pre style='background:black; color:#0f0; padding:10px;'>";

if (file_exists($file)) {
    echo htmlspecialchars(file_get_contents($file));
} else {
    echo "Belum ada data. Coba submit form dulu di index.html.";
}

echo "</pre>";

// Tombol Reset
if (isset($_POST['reset'])) {
    file_put_contents($file, '');
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<form method="post">
    <button name="reset" style="background:red; color:white;">HAPUS SEMUA DATA LOKAL</button>
</form>