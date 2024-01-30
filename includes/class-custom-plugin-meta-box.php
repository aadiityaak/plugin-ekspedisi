<?php

/**
 * Class Custom_Plugin_Meta_Box
 */
class Custom_Plugin_Meta_Box {
    
    /**
     * Custom_Plugin_Meta_Box constructor.
     */
    public function __construct() {
        add_filter('rwmb_meta_boxes', array($this, 'register_meta_boxes'));
        add_action('admin_notices', array($this, 'metabox_admin_notice'));
    }

    /**
     * Register meta boxes.
     *
     * @param array $meta_boxes Meta boxes.
     *
     * @return array
     */
    public function register_meta_boxes($meta_boxes) {
        $prefix = '';

        $meta_boxes[] = [
            'title'      => esc_html__( 'Data Pengirim', 'online-generator' ),
            'id'         => 'data_pengirim',
            'post_types' => 'cekresi',
            'context'    => 'normal',
            'fields'     => [
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Nama', 'online-generator' ),
                    'id'   => $prefix . 'nama_pengirim',
                ],
                [
                    'type' => 'textarea',
                    'name' => esc_html__( 'Alamat', 'online-generator' ),
                    'id'   => $prefix . 'alamat',
                ],
                [
                    'type' => 'number',
                    'name' => esc_html__( 'Nomor HP', 'online-generator' ),
                    'id'   => $prefix . 'nomor_hp',
                ],
            ],
        ];

        $meta_boxes[] = [
            'title'      => esc_html__( 'Data Penerima', 'online-generator' ),
            'id'         => 'data_penerima',
            'post_types' => 'cekresi',
            'context'    => 'normal',
            'fields'     => [
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Nama', 'online-generator' ),
                    'id'   => $prefix . 'nama_penerima',
                ],
                [
                    'type' => 'textarea',
                    'name' => esc_html__( 'Alamat', 'online-generator' ),
                    'id'   => $prefix . 'alamat',
                ],
                [
                    'type' => 'number',
                    'name' => esc_html__( 'Nomor HP', 'online-generator' ),
                    'id'   => $prefix . 'nomor_hp',
                ],
            ],
        ];

        $meta_boxes[] = [
            'title'      => esc_html__( 'Data Produk', 'online-generator' ),
            'id'         => 'data_produk',
            'post_types' => 'cekresi',
            'context'    => 'normal',
            'fields'     => [
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Total Berat', 'online-generator' ),
                    'id'   => $prefix . 'total_berat',
                ],
                [
                    'type' => 'text',
                    'name' => esc_html__( 'Total Ongkir', 'online-generator' ),
                    'id'   => $prefix . 'total_ongkir',
                ],
            ],
        ];

        $meta_boxes[] = array(
            'id'                => 'noresi',
            'title'             => 'Detail Resi',
            'post_types'        => 'cekresi',
            'context'           => 'normal',
            'priority'          => 'high',

            'fields' => array(
                array(
                    'type'      => 'heading',
                    'name'      => esc_html__( 'Status Pengiriman', 'vsstem' ),
                    'desc'      => esc_html__( '', 'vsstem' ),
                ),
                
                array(
                    'name'      => 'Status',
                    'desc'      => 'contoh: <b>Isi dengan tanggal dan status</b>',
                    'id'        => 'opsiresi',
                    'type'      => 'key_value',
                    'clone'     => 'true',

                ),
            
            //   array(
            //         'name'      => 'Status',
            //         'desc'      => 'contoh: <b>12 Juni 2020 = Sedang dalam proses pengepakan</b>',
            //         'id'        => 'opsistatus',
            //         'type'      => 'wysiwyg',
            //         'clone'     => 'true',
            //     	'options' => [
            //             'textarea_rows' => 5,
            //             'teeny'         => true,
            //         ],
            //     ),
            )
        );

        // $meta_boxes[] = [
        //     'title'      => esc_html__( 'Detail Absensi', 'online-generator' ),
        //     'id'         => 'detail_absensi',
        //     'post_types' => ['absensi', 'ongkir'],
        //     'context'    => 'normal',
        //     'fields'     => [
        //         [
        //             'type' => 'date',
        //             'name' => esc_html__( 'Tanggal (Date)', 'online-generator' ),
        //             'id'   => $prefix . 'tanggal',
        //         ],
        //         [
        //             'type' => 'time',
        //             'name' => esc_html__( 'Jam Masuk (Check-in Time)', 'online-generator' ),
        //             'id'   => $prefix . 'jam_masuk',
        //         ],
        //         [
        //             'type' => 'time',
        //             'name' => esc_html__( 'Jam Pulang (Check-out Time)', 'online-generator' ),
        //             'id'   => $prefix . 'jam_pulang',
        //         ],
        //         [
        //             'type' => 'text',
        //             'name' => esc_html__( 'Lokasi (Location)', 'online-generator' ),
        //             'id'   => $prefix . 'lokasi',
        //         ],
        //         [
        //             'type'    => 'select',
        //             'name'    => esc_html__( 'Status Kehadiran', 'online-generator' ),
        //             'id'      => $prefix . 'status_kehadiran',
        //             'options' => [
        //                 'Hadir'       => esc_html__( 'Hadir', 'online-generator' ),
        //                 'Izin'        => esc_html__( 'Izin', 'online-generator' ),
        //                 'Tidak hadir' => esc_html__( 'Tidak hadir', 'online-generator' ),
        //             ],
        //         ],
        //         [
        //             'type' => 'textarea',
        //             'name' => esc_html__( 'Keterangan (Remarks)', 'online-generator' ),
        //             'id'   => $prefix . 'keterangan',
        //         ],
        //         [
        //             'type' => 'text',
        //             'name' => esc_html__( 'Nama Karyawan (User ID)', 'online-generator' ),
        //             'id'   => $prefix . 'nama_karyawan',
        //         ],
        //         [
        //             'type' => 'textarea',
        //             'name' => esc_html__( 'Face ID', 'online-generator' ),
        //             'id'   => $prefix . 'face_id',
        //         ],
        //     ],
        // ];

        return $meta_boxes;
    }

    public function metabox_admin_notice(){
        // global $pagenow;
        // if ( $pagenow == 'options-general.php' ) {
        if ( ! is_plugin_active( 'meta-box/meta-box.php' ) ) {
             echo "<div class='notice notice-warning is-dismissible'>
                 <p>Custom Plugin: Install & Aktifkan plugin 'Meta Box – WordPress Custom Fields Framework.'</p>
             </div>";
        }
        // }
    }
}

// Inisialisasi class Custom_Plugin_Meta_Box
new Custom_Plugin_Meta_Box();