<?php

/**
 * Fired during plugin activation
 *
 * @link https://websweetstudio.com
 * @since 1.0.0
 *
 * @package Custom_Plugin
 * @subpackage Custom_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 1.0.0
 * @package Custom_Plugin
 * @subpackage Custom_Plugin/includes
 * @author Aditya K
 */

//KOLOM CEK RESI
// Menambahkan kolom khusus ke jenis pos cekresi:
add_filter('manage_cekresi_posts_columns', 'set_custom_edit_cekresi_columns');
function set_custom_edit_cekresi_columns($columns)
{
    unset($columns['author']);
    $columns['informasi_pengirim'] = __('Informasi Pengirim', 'your_text_domain');
    $columns['informasi_penerima'] = __('Informasi Penerima', 'your_text_domain');

    return $columns;
}

// Menambahkan data ke kolom khusus untuk jenis pos cekresi:
add_action('manage_cekresi_posts_custom_column', 'custom_cekresi_column', 10, 2);
function custom_cekresi_column($column, $post_id)
{
    switch ($column) {
        case 'informasi_pengirim':
            $nama_pengirim = get_post_meta($post_id, 'nama_pengirim', true);
            $alamat_pengirim = get_post_meta($post_id, 'alamat_pengirim', true);
            $no_hp_pengirim = get_post_meta($post_id, 'no_hp_pengirim', true);

            // Mengonversi ke Sentence Case
            $nama_pengirim = ucfirst(strtolower($nama_pengirim));
            $alamat_pengirim = ucfirst(strtolower($alamat_pengirim));
            $no_hp_pengirim = ucfirst(strtolower($no_hp_pengirim));

            // Menampilkan hasil jika nilai tidak kosong
            echo "Nama Pengirim: $nama_pengirim<br>Alamat Pengirim: $alamat_pengirim<br>No. HP Pengirim: $no_hp_pengirim";
            break;
        case 'informasi_penerima':
            $nama_penerima = get_post_meta($post_id, 'nama_penerima', true);
            $alamat_penerima = get_post_meta($post_id, 'alamat_penerima', true);
            $no_hp_penerima = get_post_meta($post_id, 'no_hp_penerima', true);

            // Mengonversi ke Sentence Case
            $nama_penerima = ucfirst(strtolower($nama_penerima));
            $alamat_penerima = ucfirst(strtolower($alamat_penerima));
            $no_hp_penerima = ucfirst(strtolower($no_hp_penerima));

            // Menampilkan hasil jika nilai tidak kosong
            echo "Nama Penerima: $nama_penerima<br>Alamat Penerima: $alamat_penerima<br>No. HP Penerima: $no_hp_penerima";
            break;
        case 'ongkir':
            $ongkir = get_post_meta($post_id, 'tarif', true);
            echo ucfirst(strtolower($ongkir));
            break;
    }
}



//KOLOM ONGKIR
// Menambahkan kolom khusus ke jenis pos ongkir:
add_filter('manage_ongkir_posts_columns', 'set_custom_edit_ongkir_columns');
function set_custom_edit_ongkir_columns($columns)
{
    unset($columns['author']);
    $columns['asal'] = __('Informasi Dari / Asal', 'your_text_domain');
    $columns['tujuan'] = __('Informasi Tujuan', 'your_text_domain');
    $columns['ongkir'] = __('Informasi Ongkir', 'your_text_domain');

    return $columns;
}

// Menambahkan data ke kolom khusus untuk jenis pos ongkir:
add_action('manage_ongkir_posts_custom_column', 'custom_ongkir_column', 10, 2);
function custom_ongkir_column($column, $post_id)
{
    switch ($column) {
        case 'asal':
            $alamat_dari = get_post_meta($post_id, 'alamat_dari', true);

            // Mengonversi ke Sentence Case
            $alamat_dari = ucfirst(strtolower($alamat_dari));

            // Menampilkan hasil jika nilai tidak kosong
            echo $alamat_dari;
            break;
        case 'tujuan':
            $alamat_tujuan = get_post_meta($post_id, 'alamat_tujuan', true);

            // Mengonversi ke Sentence Case
            $alamat_tujuan = ucfirst(strtolower($alamat_tujuan));

            // Menampilkan hasil
            echo $alamat_tujuan;
            break;
        case 'ongkir':
            $ongkir = get_post_meta($post_id, 'tarif', true);
            $ongkir = $ongkir != '' ? number_format($ongkir, 0, ',', '.') : '-';
            echo 'Rp ' . $ongkir;
            break;
    }
}


//KOLOM ABSENSI
// Menambahkan kolom khusus ke jenis pos absensi:
add_filter('manage_absensi_posts_columns', 'set_custom_edit_absensi_columns');
function set_custom_edit_absensi_columns($columns)
{
    unset($columns['author']);
    $columns['user_id'] = __('Nama', 'your_text_domain');
    $columns['shift'] = __('Shift', 'your_text_domain');
    $columns['checkin'] = __('Check In', 'your_text_domain');
    $columns['checkout'] = __('Check Out', 'your_text_domain');
    $columns['location'] = __('Location', 'your_text_domain');
    $columns['catatan'] = __('Catatan', 'your_text_domain');

    return $columns;
}

// Menambahkan data ke kolom khusus untuk jenis pos absensi:
add_action('manage_absensi_posts_custom_column', 'custom_absensi_column', 10, 2);
function custom_absensi_column($column, $post_id)
{
    switch ($column) {
        case 'user_id':
            $user_id = get_post_meta($post_id, 'user_id', true);
            $user = get_user_by('id', $user_id);
            echo $user->first_name . ' ' . $user->last_name;
            break;
        case 'shift':
            $shift = get_post_meta($post_id, 'shift', true);
            echo ucfirst(strtolower($shift));
            break;
        case 'checkin':
            $checkin = get_post_meta($post_id, 'checkin', true);
            echo $checkin != '' ? date('d-m-Y H:i:s', (int)$checkin) : '-';
            break;
        case 'checkout':
            $checkout = get_post_meta($post_id, 'checkout', true);
            echo $checkout != '' ? date('d-m-Y H:i:s', (int)$checkout) : '-';
            break;
        case 'location':
            $latitude = get_post_meta($post_id, 'latitude', true);
            $longitude = get_post_meta($post_id, 'longitude', true);
            echo $latitude . ',' . $longitude;
            break;
        case 'catatan':
            $catatan = get_post_meta($post_id, 'catatan', true);
            echo $catatan;
            break;
    }
}
