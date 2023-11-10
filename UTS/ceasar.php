<?php
function filter_password($password) {
    // Fungsi ini akan menyaring password untuk menghilangkan karakter non-alfabet
    $filtered_password = preg_replace("/[^a-zA-Z]/", "", $password);
    return $filtered_password;
}

function caesar_encrypt($text, $shift) {
    $encrypted_text = "";
    $text = strtolower($text);  // Ubah teks ke huruf kecil agar sesuai dengan indeks alfabet

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        
        if (ctype_alpha($char)) {
            // Tentukan apakah karakter adalah huruf besar atau huruf kecil
            $is_upper = ctype_upper($char);
            
            // Konversi karakter ke indeks dalam alfabet (0-25)
            $char_index = ord($char) - ord('a');
            
            // Geser karakter sesuai shift yang diberikan
            $char_index = ($char_index + $shift) % 26;
            
            // Konversi kembali ke karakter
            $encrypted_char = chr($char_index + ord('a'));
            
            // Jika karakter asli adalah huruf besar, maka ubah karakter yang dienkripsi menjadi huruf besar juga
            if ($is_upper) {
                $encrypted_char = strtoupper($encrypted_char);
            }
            
            $encrypted_text .= $encrypted_char;
        } else {
            // Jika karakter bukan huruf, tambahkan karakter aslinya
            $encrypted_text .= $char;
        }
    }

    return $encrypted_text;
}

function caesar_decrypt($encrypted_text, $shift) {
    $decrypted_text = "";
    $encrypted_text = strtolower($encrypted_text);  // Ubah teks terenkripsi ke huruf kecil

    for ($i = 0; $i < strlen($encrypted_text); $i++) {
        $char = $encrypted_text[$i];
        
        if (ctype_alpha($char)) {
            // Tentukan apakah karakter adalah huruf besar atau huruf kecil
            $is_upper = ctype_upper($char);
            
            // Konversi karakter ke indeks dalam alfabet (0-25)
            $char_index = ord($char) - ord('a');
            
            // Geser karakter kembali sesuai shift yang diberikan
            $char_index = ($char_index - $shift + 26) % 26; // Perhatikan +26 untuk menghindari hasil negatif
            
            // Konversi kembali ke karakter
            $decrypted_char = chr($char_index + ord('a'));
            
            // Jika karakter asli adalah huruf besar, maka ubah karakter yang didekripsi menjadi huruf besar juga
            if ($is_upper) {
                $decrypted_char = strtoupper($decrypted_char);
            }
            
            $decrypted_text .= $decrypted_char;
        } else {
            // Jika karakter bukan huruf, tambahkan karakter aslinya
            $decrypted_text .= $char;
        }
    }

    return $decrypted_text;
}

?>
