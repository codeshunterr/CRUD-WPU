<?php
require 'function.php';

if (isset($_GET['submitblasting'])) {
    $kotatable = $_GET['table'];
    $desa = $_GET['desa'];

    $data = query("SELECT nama,no_telp FROM $kotatable WHERE desa = '$desa'");

    foreach ($data as $row) {
        $nama = $row["nama"];
        $notelp = $row["no_telp"];
        $send = "$notelp|$nama|,";
        $token = "pS_@WIWYpZpiF0G#KQsM";
        $target = "$send";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => 'test blasting {name} kontod',
                'delay' => '5-10',
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
