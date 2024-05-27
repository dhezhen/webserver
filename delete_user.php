<?php
header("Content-Type: application/json");

include 'db_config.php';

// Memeriksa apakah metode yang digunakan adalah HTTP DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Mendapatkan data dari URL atau body permintaan
    parse_str(file_get_contents("php://input"), $_DELETE);

    // Validasi data
    if (!isset($_DELETE['userId'])) {
        die(json_encode(["error" => "Invalid input: userId is required"]));
    }

    $userId = $koneksi->real_escape_string($_DELETE['userId']);

    // Menyiapkan query DELETE
    $sql = "DELETE FROM users WHERE id = $userId";

    if ($koneksi->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "User deleted successfully"]);
    } else {
        echo json_encode(["error" => $koneksi->error]);
    }

    $koneksi->close();
} else {
    // Menyiapkan respons jika metode yang digunakan bukan DELETE
    echo json_encode(["error" => "Invalid request method"]);
}
?>
