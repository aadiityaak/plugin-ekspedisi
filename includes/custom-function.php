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
                echo '<div>' . $tanggal_status . ' WIB</div>';
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
function ambil_nilai_otomatis() {
    // Buat nomor acak 4 digit
    $random_number = sprintf('%04d', mt_rand(0, 9999));
    // Bangun format nilai field
    $nilai_field = "#ED-" . $random_number . date('U');
    // Kembalikan nilai sebagai respons Ajax
    wp_send_json_success($nilai_field);
}
// Tambahkan action hook untuk menangani request Ajax
add_action('wp_ajax_ambil_nilai_otomatis', 'ambil_nilai_otomatis');