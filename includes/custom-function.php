<?php

/**
 * Masukkan semua function tambahan disini
 *
 * @link       https://websweetstudio.com
 * @since      1.0.0
 *
 * @package    Custom_Plugin
 * @subpackage Custom_Plugin/includes
 */

function get_post_by_awb()
{
    global $post;
    $awb_number = isset($_POST['awbNumber']) ? sanitize_text_field($_POST['awbNumber']) : '';

    // Cari post berdasarkan judul (nomor AWB)
    $post = get_page_by_title($awb_number, OBJECT, 'cekresi');

    if ($post) {
?>
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-dark" id="modalResiLabel"><b><?php echo get_the_title($post); ?></b></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center text-dark" id="modalResiBody">
            <div class="text-start">
                <?php
                // Mengambil nilai meta dengan ID 'tanggal_status_date' dan 'tanggal_status_time'
                $tanggal_status = get_post_meta($post->ID, 'tanggal_status', true);
                // print_r($tanggal_status);
                $tanggal_status = date('d-m-Y H:i', $tanggal_status);
                // $tanggal_status = date('d-m-Y H:i', strtotime($tanggal_status));

                // Tampilkan nilai meta dengan format yang diinginkan
                echo '<div class="text-end"><span class="badge bg-primary">' . $tanggal_status . ' WIB</span></div>';
                ?>
                <small>From</small>
                <div class="row">
                    <div class="col-md-4">
                        <small>Nama Pengirim</small>
                        <?php
                        // Mengambil nilai meta dengan ID 'nama_pengirim'
                        $nama_pengirim = get_post_meta($post->ID, 'nama_pengirim', true);

                        // Tampilkan nilai meta jika ada
                        echo '<div><b>' . $nama_pengirim . '</b></div>';
                        ?>
                    </div>
                    <div class="col-md-4">
                        <small>Alamat Pengirim</small>
                        <?php
                        // Mengambil nilai meta dengan ID 'nama_pengirim'
                        $alamat_pengirim = get_post_meta($post->ID, 'alamat_pengirim', true);

                        // Tampilkan nilai meta jika ada
                        echo '<div><b>' . $alamat_pengirim . '</b></div>';
                        ?>
                    </div>
                    <div class="col-md-4">
                        <small>Nomor HP Pengirim</small>
                        <?php
                        // Mengambil nilai meta dengan ID 'nama_pengirim'
                        $no_hp_pengirim = get_post_meta($post->ID, 'no_hp_pengirim', true);

                        // Tampilkan nilai meta jika ada
                        echo '<div><b>' . $no_hp_pengirim . '</b></div>';
                        ?>
                    </div>
                </div>
                <br>
                <small>To</small>
                <div class="row">
                    <div class="col-md-4">
                        <small>Nama Penerima</small>
                        <?php
                        // Mengambil nilai meta dengan ID 'nama_penerima'
                        $nama_penerima = get_post_meta($post->ID, 'nama_penerima', true);

                        // Tampilkan nilai meta jika ada
                        echo '<div><b>' . $nama_penerima . '</b></div>';
                        ?>
                    </div>
                    <div class="col-md-4">
                        <small>Alamat Penerima</small>
                        <?php
                        // Mengambil nilai meta dengan ID 'alamat_penerima'
                        $alamat_penerima = get_post_meta($post->ID, 'alamat_penerima', true);

                        // Tampilkan nilai meta jika ada
                        echo '<div><b>' . $alamat_penerima . '</b></div>';
                        ?>
                    </div>
                    <div class="col-md-4">
                        <small>Nomor HP Penerima</small>
                        <?php
                        // Mengambil nilai meta dengan ID 'no_hp_penerima'
                        $no_hp_penerima = get_post_meta($post->ID, 'no_hp_penerima', true);

                        // Tampilkan nilai meta jika ada
                        echo '<div><b>' . $no_hp_penerima . '</b></div>';
                        ?>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-start">
                <?php
                $status_pengiriman = get_post_meta($post->ID, 'yourprefix_group_status_pengiriman', true);
                // print_r($status_pengiriman);
                ?>
                <table class="table caption-top table-bordered">
                    <caption>Daftar status pengiriman pengguna</caption>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($status_pengiriman as $status) {
                            // Konversi timestamp ke format "d-m-Y H:i"
                            $tanggal_status = date('d-m-Y H:i', $status['tanggal']);

                            // Tampilkan baris pertama
                            echo '<tr><td><b>' . $tanggal_status . '<b></td><td><b>' . $status['status'] . '</b></td></tr>';

                            // Tampilkan baris kedua
                            echo '<tr><td></td><td>' . $status['catatan'] . '</td></tr>';

                            // Tampilkan baris ketiga
                            echo '<tr><td class="border-0"></td><td class="border-0"></td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    <?php
    } else {
    ?>
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalResiLabel">Data tidak ditemukan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center" id="modalResiBody">
            Masukan nomor AWB yang benar
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    <?php
    }

    wp_die(); // Penting untuk mengakhiri eksekusi dan mengembalikan respons ke JavaScript
}

add_action('wp_ajax_get_post_by_awb', 'get_post_by_awb');
add_action('wp_ajax_nopriv_get_post_by_awb', 'get_post_by_awb');

// Fungsi untuk mengambil nilai field secara otomatis
function ambil_nilai_otomatis()
{
    // Buat nomor acak 4 digit
    $random_number = sprintf('%04d', mt_rand(0, 9999));
    // Bangun format nilai field
    $nilai_field = "#ED-" . $random_number . date('U');
    // Kembalikan nilai sebagai respons Ajax
    wp_send_json_success($nilai_field);
}
// Tambahkan action hook untuk menangani request Ajax
add_action('wp_ajax_ambil_nilai_otomatis', 'ambil_nilai_otomatis');



// functions.php atau file PHP lainnya
add_action('wp_ajax_get_ongkir', 'get_ongkir_data');
add_action('wp_ajax_nopriv_get_ongkir', 'get_ongkir_data');

function get_ongkir_data()
{
    // Ambil data dari permintaan Ajax
    $dari = sanitize_text_field($_POST['dari']);
    $tujuan = sanitize_text_field($_POST['tujuan']);
    $berat = intval($_POST['berat']);

    // Lakukan sesuatu dengan data ini, misalnya, hitung ongkir
    $ongkir = hitung_ongkir($dari, $tujuan, $berat);

    // Kembalikan data sebagai respons Ajax
    echo $ongkir;

    // Pastikan untuk menghentikan eksekusi setelah memberikan respons
    wp_die();
}

function hitung_ongkir($dari, $tujuan, $berat)
{
    // Lakukan perhitungan ongkir berdasarkan data yang diterima
    // Implementasikan logika perhitungan ongkir sesuai kebutuhan Anda

    // Ambil post dengan post type 'ongkir' dan kondisi post meta
    $args = array(
        'post_type' => 'ongkir',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'alamat_dari',
                'value' => $dari,
                'compare' => '=',
            ),
            array(
                'key' => 'alamat_tujuan',
                'value' => $tujuan,
                'compare' => '=',
            ),
        ),
    );

    $ongkir_query = get_posts($args);

    if ($ongkir_query) {
        // Jika ditemukan, ambil nilai post meta yang sesuai
        $ongkir_value = get_post_meta($ongkir_query[0]->ID, 'tarif', true);
        $ongkir_value = $ongkir_value * $berat;

        // Lakukan sesuatu dengan nilai post meta, misalnya, tampilkan atau hitung total ongkir
        $ongkir = 'Rp ' . number_format($ongkir_value, 0, ',', '.');
    } else {
        // Jika tidak ditemukan, berikan nilai default
        $ongkir = 'Rp 10,000';
    }

    return $ongkir;
}


// Fungsi untuk menambahkan shortcode dan menangani logika absensi
function absensi_shortcode()
{
    ob_start();

    // Mendapatkan nilai shift dari cookie
    $selectedShift = isset($_COOKIE['selectedShift']) ? $_COOKIE['selectedShift'] : '';
    $sifts = ['pagi', 'malam'];
    $user_id = get_current_user_id();
    $post_title = $user_id . ' - ' . date('Y-m-d');
    $sudah_ada = get_post_id_by_title($post_title);
    $checkin = get_post_meta($sudah_ada, 'checkin', true);
    $checkout = get_post_meta($sudah_ada, 'checkout', true);
    $disable_checkin = $sudah_ada && $checkin != '' ? 'disabled' : '';
    $disable_checkout = $sudah_ada ? '' : 'disabled';
    ?>

    <div>
        <?php if (!$sudah_ada) {
        ?>
            <div class="pilih-shift">
                <select class="form-select mb-3" id="shiftDropdown">
                    <option value="">-- Pilih Shift --</option>
                    <?php
                    foreach ($sifts as $sift) {
                        $selected = $selectedShift === $sift ? 'selected' : '';
                        echo '<option value="' . $sift . '" ' . $selected . '>Shift ' . ucfirst($sift) . '</option>';
                    }
                    ?>
                </select>
            </div>

        <?php
        }

        if ($checkout != '') {
            echo '<div class="text-center">Terima kasih telah menyelesaikan tugas hari ini! Selamat pulang kerja, semoga perjalanan pulang aman. Istirahat yang baik dan sampai jumpa besok!</div>';
        } else {
        ?>
            <button class="btn btn-success" id="checkInBtn" <?php echo $disable_checkin; ?>>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                </svg>
                Check-in
            </button>
            <button class="btn btn-danger" id="checkOutBtn" <?php echo $disable_checkout; ?>>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15zM11 2h.5a.5.5 0 0 1 .5.5V15h-1zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                </svg>
                Check-out
            </button>
        <?php
        }
        ?>

    </div>

<?php
    return ob_get_clean();
}

// Mendaftarkan shortcode
add_shortcode('absensi', 'absensi_shortcode');

// Fungsi untuk menangani logika absensi dan menyimpan data di post type
add_action('wp_ajax_handle_absen', 'handle_absen_callback');
add_action('wp_ajax_nopriv_handle_absen', 'handle_absen_callback');

function handle_absen_callback()
{
    //set timezone jakarta
    date_default_timezone_set('Asia/Jakarta');
    if (isset($_POST['shift'], $_POST['action_type'], $_POST['latitude'], $_POST['longitude'])) {
        $shift = sanitize_text_field($_POST['shift']);
        $action_type = sanitize_text_field($_POST['action_type']);
        $latitude = sanitize_text_field($_POST['latitude']);
        $longitude = sanitize_text_field($_POST['longitude']);
        // Mendapatkan data user yang sedang login
        $user_id = get_current_user_id();
        $post_title = $user_id . ' - ' . date('Y-m-d');



        $sudah_ada = get_post_id_by_title($post_title);
        if ($sudah_ada) {
            $post_id = $sudah_ada;
        } else {
            $post_id = wp_insert_post(array(
                'post_type' => 'absensi',
                'post_title' => $post_title,
                'post_status' => 'publish',
                // 'post_author' => $user_id,
            ));
        }

        // Menyimpan informasi absen sebagai post meta
        update_post_meta($post_id, 'shift', $shift);
        update_post_meta($post_id, $action_type, current_time('timestamp'));
        update_post_meta($post_id, 'latitude', $latitude);
        update_post_meta($post_id, 'longitude', $longitude);
        update_post_meta($post_id, 'user_id', $user_id);

        // Mengirim respon ke klien
        wp_send_json_success('Absen berhasil disimpan.');
    } else {
        // Mengirim respon ke klien jika terjadi kesalahan
        wp_send_json_error('Parameter tidak lengkap.');
    }
}


function get_post_id_by_title($post_title)
{
    // Lakukan query untuk mencari post dengan judul tertentu
    $args = array(
        'post_type' => 'absensi',  // Ganti dengan tipe post yang sesuai
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'title' => $post_title,
    );

    $query = new WP_Query($args);

    // Cek apakah posting ditemukan
    if ($query->have_posts()) {
        // Posting ditemukan, ambil ID posting
        $post_id = $query->posts[0]->ID;

        // Reset query
        wp_reset_postdata();

        // Kembalikan ID posting
        return $post_id;
    } else {
        // Posting tidak ditemukan
        return false;
    }
}

// Fungsi untuk membuat shortcode
function tabel_absensi() {
    ob_start(); // Memulai output buffering

    // Mendapatkan ID pengguna berdasarkan meta "cucent_user"
    $user_id = get_current_user_id();

    // Argumen query untuk mendapatkan post type "absensi" dari pengguna tertentu
    $args = array(
        'post_type' => 'absensi',
        'meta_key' => 'user_id',
        'meta_value' => $user_id,
        'posts_per_page' => 30,
    );

    // Melakukan query
    $query = new WP_Query($args);

    // Mengecek apakah ada post yang ditemukan
    if ($query->have_posts()) {
        // Membuat tabel Bootstrap
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Shift</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop untuk setiap post
                while ($query->have_posts()) {
                    $query->the_post();
                    $post_id = get_the_ID();
                    ?>
                    <tr>
                        <td><?php echo get_the_date(); ?></td>
                        <td>
                            <?php
                            $shift = get_post_meta($post_id, 'shift', true);
                            echo $shift;
                            ?>
                        </td>
                        <td>
                            <?php 
                            $checkin = get_post_meta($post_id, 'checkin', true);
                            echo $checkin != '' ? date('d-m-Y H:i:s', (int)$checkin) : '-';
                            ?>
                        </td>
                        <td>
                            <?php
                            $checkout = get_post_meta($post_id, 'checkout', true);
                            echo $checkout != '' ? date('d-m-Y H:i:s', (int)$checkout) : '-';
                            ?>
                        </td>
                        <td>
                            <?php
                            $catatan = get_post_meta($post_id, 'catatan', true);
                            echo $catatan;
                            ?>
                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        // Jika tidak ada post ditemukan
        echo 'Tidak ada absensi ditemukan.';
    }

    // Mengakhiri output buffering dan mengembalikan hasilnya
    return ob_get_clean();
}

// Mendaftarkan shortcode
add_shortcode('tabel-absensi', 'tabel_absensi');