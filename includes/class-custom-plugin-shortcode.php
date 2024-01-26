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

        <div class="">
            <div class="boxt bg-secondary p-3 rounded">
                <h4 class="text-white fw-bold">LACAK KIRIMAN</h4>
                <form action="" method="post" class="form-cek-resi">
                    <div class="row">
                        <div class="col-9">
                            <label class="text-white font-size-10">
                                <input type="text" id="tracking" name="tracking" placeholder="No AWB" class="form-control required" autocomplete="off">
                                <small class="form-text">Masukkan No AWB</small>
                            </label>
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
        <div class="modal fade" id="modalResi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalResiLabel" aria-hidden="true">
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
        ob_start(); ?>

        <div class="card">
            <form class="p-4" action="#hasil-ongkir">
                <h4 class="text-dark fw-bold">TARIF KIRIMAN</h4>
                <div class="row">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <select class="form-control" name="dari" required="">
                            <option value="">Pilih Asal Pengiriman</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Surabaya">Surabaya</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select class="form-control" name="tujuan" required="">
                            <option value="">Pilih Tujuan Pengiriman</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Sidoarjo">Sidoarjo</option>
                            <option value="Gorontalo">Gorontalo</option>
                            <option value="Manado">Manado</option>
                            <option value="Semarang">Semarang</option>
                            <option value="Jakarta">Jakarta</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="row m-0 align-items-center">
                            <div class="col-9 p-0">
                                <input min="1" type="number" class="form-control" name="berat" value="1" required="">
                            </div>
                            <div class="col-3 p-1"><small>Kg</small></div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <button class="btn btn-primary" type="submit">Cek</button>
                    </div>
                </div>
            </form>
        </div>

<?php
        return ob_get_clean();
    }
}

// Inisialisasi class Custom_Plugin_Shortcode
new Custom_Plugin_Shortcode();