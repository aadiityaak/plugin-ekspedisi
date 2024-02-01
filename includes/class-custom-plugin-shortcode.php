<?php

/**
 * Class Custom_Plugin_Shortcode
 */
class Custom_Plugin_Shortcode
{

    /**
     * Custom_Plugin_Shortcode constructor.
     */
    public function __construct()
    {
        add_shortcode('custom-plugin', array($this, 'custom_plugin_text_shortcode_callback')); // [custom-plugin]
        add_shortcode('tracking_shortcode', array($this, 'tracking_shortcode'));
        add_shortcode('tarif_pengiriman', array($this, 'formulir_tarif_pengiriman'));
        add_shortcode('jam', array($this, 'displayCurrentTime'));
        add_shortcode('format-tanggal', array($this, 'func_current_date_time_custom_format'));
    }

    /**
     * Shortcode callback to display text.
     *
     * @param array $atts Shortcode attributes.
     * @param string $content Shortcode content.
     *
     * @return string
     */
    public function custom_plugin_text_shortcode_callback($atts, $content = null)
    {
        return '<p>Contoh Output shortcode</p>';
    }


    public function tracking_shortcode()
    {
        ob_start(); ?>

        <div class="frame-cek-resi">
            <div class="">
                <form action="" method="post" class="form-cek-resi">
                    <div class="row align-items-end">
                        <div class="col-9">
                            <label for="tracking" class="font-size-10">
                                <small class="form-text">Masukkan No AWB</small>
                            </label>
                            <input type="text" id="tracking" name="tracking" placeholder="No AWB" class="form-control required" autocomplete="off">
                                
                            
                        </div>
                        <div class="col-3">
                            <label>
                                <button type="submit" class="btn btn-primary lacak-resi" data-bs-toggle="modal" data-bs-target="#modalResi">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade text-dark" id="modalResi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalResiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" id="modalResiContent">
                    <div class="p-4">
                        Loading data...
                    </div>
                </div>
            </div>
        </div>
    <?php
        return ob_get_clean();
    }

    public function formulir_tarif_pengiriman()
    {
        ob_start();
        // Buat query untuk mendapatkan semua post type 'ongkir'
        $query_args = array(
            'post_type' => 'ongkir',
            'posts_per_page' => -1, // -1 untuk mendapatkan semua post
        );

        $ongkir_posts = new WP_Query($query_args);

        // Loop melalui hasil query
        $alamat = [];
        while ($ongkir_posts->have_posts()) {
            $ongkir_posts->the_post();

            // Dapatkan ID post
            $ongkir_post_id = get_the_ID();

            // Dapatkan nilai meta 'alamat_dari'
            $alamat_dari = get_post_meta($ongkir_post_id, 'alamat_dari', true);
            $alamat_tujuan = get_post_meta($ongkir_post_id, 'alamat_tujuan', true);
            $alamat['dari'][] = $alamat_dari;
            $alamat['tujuan'][] = $alamat_tujuan;
        }

        // Reset post data
        wp_reset_postdata();
        
        // echo '<pre>';
        // print_r($alamat);
        // echo '</pre>';
        ?>

        <div class="frame-cek-ongkir">
            <form id="form-cek-ongkir" action="#hasil-ongkir">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label for="dari"><small>Dari Alamat</small></label>
                        <input class="form-control" name="dari" list="dari" required>
                        <datalist id="dari">
                            <?php
                            if(isset($alamat['dari']) && is_array($alamat['dari'])){
                                $daris = array_unique($alamat['dari']);
                                foreach($daris as $nama_alamat){
                                    echo '<option value="'.$nama_alamat.'">';
                                }
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <label for="tujuan"><small>Tujuan Alamat</small></label>
                        <input class="form-control" name="tujuan" list="tujuan" required>
                        <datalist id="tujuan">
                            <?php
                            if(isset($alamat['tujuan']) && is_array($alamat['tujuan'])){
                                $tujuans = array_unique($alamat['tujuan']);
                                foreach($tujuans as $nama_alamat){
                                    echo '<option value="'.$nama_alamat.'">';
                                }
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="col-md-2 mb-2 mb-md-0">
                        <label for="berat"><small>Berat (kg)</small></label>
                        <input min="1" type="number" class="form-control" name="berat" value="1" required="">
                    </div>
                    <div class="col-md-2 text-center">
                        <button class="btn btn-primary" type="submit">Cek</button>
                    </div>
                </div>
            </form>
            <div class="modal fade" id="modalOngkir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalResiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg text-dark">
                <div class="modal-content" id="modalOngkirContent">
                    <div class="p-4">
                        Loading data...
                    </div>
                </div>
            </div>
        </div>
                
        </div>

        <?php
        return ob_get_clean();
    }

    public function displayCurrentTime()
    {
        date_default_timezone_set('Asia/Jakarta');

        $timeFormat = "H:i:s";
        $currentTime = date($timeFormat);
        $currentTime = '<div class="real-time-clock">' . $currentTime . '</div>';

        return $currentTime;
    }

    public function func_current_date_time_custom_format()
    {
        date_default_timezone_set('Asia/Jakarta');

        // Format tanggal dengan nama bulan dalam bahasa Indonesia
        $format_tanggal_waktu = "%A - %d %B %Y";

        // Menggunakan strftime untuk menampilkan nama bulan dalam bahasa Indonesia
        setlocale(LC_TIME, 'id_ID');
        $tanggal_waktu_saat_ini = strftime($format_tanggal_waktu);

        // Mengembalikan waktu dan tanggal saat ini
        return $tanggal_waktu_saat_ini;
    }

}

// Inisialisasi class Custom_Plugin_Shortcode
new Custom_Plugin_Shortcode();
