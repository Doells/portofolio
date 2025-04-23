<?php
// Include the database connection
include('config.php');

// Collect form data
$username = $_POST["username"];
$plain_password = $_POST["password"];

// Prepare SQL query
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $encrypted_password = $row['password'];
    $encryption_type = $row['encryption_type'];

    // Check if the password matches based on the encryption type
    if (($encryption_type == 'caesar' && caesarEncrypt($plain_password) == $encrypted_password) || 
        ($encryption_type == 'hill' && hillEncrypt($plain_password) == $encrypted_password)) {
        echo "Login successful!";
    } else {
        echo "Invalid credentials!";
    }
} else {
    echo "No user found!";
}

// Close connection
$conn->close();

// Caesar Cipher Encryption Function
function caesarEncrypt($str, $shift = 3) {
    return preg_replace_callback('/[a-zA-Z]/', function($matches) use ($shift) {
        $char = $matches[0];
        $base = ctype_upper($char) ? 'A' : 'a';
        return chr((ord($char) - ord($base) + $shift) % 26 + ord($base));
    }, $str);
}

// Hill Cipher Encryption Function
function hillEncrypt($text) {
    $key = [[3, 3], [2, 5]];
    $text = strtolower(preg_replace('/[^a-z]/', '', $text));
    if (strlen($text) % 2 !== 0) $text .= 'x'; // Padding
    $result = '';

    for ($i = 0; $i < strlen($text); $i += 2) {
        $pair = str_split(substr($text, $i, 2));
        $x = ord($pair[0]) - 97;
        $y = ord($pair[1]) - 97;
        $encryptedX = ($key[0][0] * $x + $key[0][1] * $y) % 26;
        $encryptedY = ($key[1][0] * $x + $key[1][1] * $y) % 26;
        $result .= chr($encryptedX + 97) . chr($encryptedY + 97);
    }
    return $result;
}
?>
