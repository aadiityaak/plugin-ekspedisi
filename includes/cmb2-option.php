<?php
// Pastikan Anda sudah memasukkan CMB2 ke dalam theme atau plugin Anda

// Fungsi untuk membuat metabox
function cmb2_custom_metabox()
{
    $post_id = isset($_GET['post']) ? $_GET['post'] : '';
    $cmb = new_cmb2_box(array(
        'id'            => 'pengirim_metabox',
        'title'         => __('Informasi Pengirim', 'cmb2'),
        'object_types'  => array('cekresi'), // Sesuaikan dengan jenis post type yang Anda inginkan
    ));

    // Field untuk nama pengirim
    $cmb->add_field(array(
        'name' => 'Nama Pengirim',
        'id'   => 'nama_pengirim',
        'type' => 'text',
    ));

    // Field untuk alamat pengirim
    $cmb->add_field(array(
        'name' => 'Alamat Pengirim',
        'id'   => 'alamat_pengirim',
        'type' => 'textarea_small',
        'rows' => 2,
    ));

    // Field untuk nomor HP pengirim
    $cmb->add_field(array(
        'name' => 'Nomor HP Pengirim',
        'id'   => 'no_hp_pengirim',
        'type' => 'text',
    ));

    // Field untuk nama penerima
    $cmb->add_field(array(
        'name' => 'Nama Penerima',
        'id'   => 'nama_penerima',
        'type' => 'text',
    ));

    // Field untuk alamat penerima
    $cmb->add_field(array(
        'name' => 'Alamat Penerima',
        'id'   => 'alamat_penerima',
        'type' => 'textarea_small',
        'rows' => 2,
    ));

    // Field untuk nomor HP penerima
    $cmb->add_field(array(
        'name' => 'Nomor HP Penerima',
        'id'   => 'no_hp_penerima',
        'type' => 'text',
    ));

    // Field untuk tanggal status
    $cmb->add_field(array(
        'name' => 'Tanggal Status',
        'id'   => 'tanggal_status',
        'type' => 'text_datetime_timestamp', // Sesuaikan dengan jenis field yang Anda butuhkan
    ));

    // Field untuk status
    $cmb_group_status_pengiriman = new_cmb2_box(array(
        'id'           => 'yourprefix_group_status_pengiriman_metabox',
        'title'        => esc_html__('Status Pengiriman', 'cmb2'),
        'object_types' => array('cekresi'),
    ));

    // $group_field_id is the field id string, so in this case: 'yourprefix_group_status_pengiriman'
    $group_field_id_status_pengiriman = $cmb_group_status_pengiriman->add_field(array(
        'id'          => 'yourprefix_group_status_pengiriman',
        'type'        => 'group',
        'description' => esc_html__('Informasi Status Pengiriman', 'cmb2'),
        'options'     => array(
            'group_title'    => esc_html__('Status {#}', 'cmb2'), // {#} gets replaced by row number
            'add_button'     => esc_html__('Add Another Status', 'cmb2'),
            'remove_button'  => esc_html__('Remove Status', 'cmb2'),
            'sortable'       => true,
        ),
    ));

    $cmb_group_status_pengiriman->add_group_field($group_field_id_status_pengiriman, array(
        'name'    => esc_html__('Tanggal', 'cmb2'),
        'id'      => 'tanggal',
        'type'    => 'text_datetime_timestamp',
    ));

    $cmb_group_status_pengiriman->add_group_field($group_field_id_status_pengiriman, array(
        'name'    => esc_html__('Status', 'cmb2'),
        'id'      => 'status',
        'type'    => 'select',
        'options' => array(
            'Dalam Pengiriman'  => 'Dalam Pengiriman',
            'Paket Diterima'    => 'Paket Diterima',
            'Dalam Pengantaran' => 'Dalam Pengantaran',
            // Tambahkan opsi status pengiriman lainnya sesuai kebutuhan
        ),
    ));

    $cmb_group_status_pengiriman->add_group_field($group_field_id_status_pengiriman, array(
        'name' => esc_html__('Catatan', 'cmb2'),
        'id'   => 'catatan',
        'type' => 'textarea_small',
        'rows' => 2,
    ));




    $cmb_dari = new_cmb2_box(array(
        'id'            => 'metabox_dari',
        'title'         => __('Informasi Dari', 'cmb2'),
        'object_types'  => array('ongkir'), // Sesuaikan dengan jenis post type yang Anda inginkan
    ));

    // Field untuk provinsi
    $provinsi_asal_value = get_post_meta( $post_id, 'provinsi_asal', true );
    $cmb_dari->add_field( array(
        'name'             => 'Provinsi',
        'id'               => 'provinsi_asal',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => array(
            '-' => esc_html__( '-', 'cmb2' ),
        ),
        'attributes'       => array(
            'class' => $provinsi_asal_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        ),
    ) );

    // Field untuk kabupaten
    $kabupaten_asal_value = get_post_meta( $post_id, 'kabupaten_asal', true );
    $cmb_dari->add_field(array(
        'name' => 'Kabupaten/Kota',
        'id'   => 'kabupaten_asal',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'-' => esc_html__( '-', 'cmb2' ),
		),
        'attributes'       => array(
            'class' => $kabupaten_asal_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        )
    ));

    // Field untuk kecamatan
    $kecamatan_asal_value = get_post_meta( $post_id, 'kecamatan_asal', true );
    $cmb_dari->add_field(array(
        'name' => 'Kecamatan',
        'id'   => 'kecamatan_asal',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'-' => esc_html__( '-', 'cmb2' ),
		),
        'attributes'       => array(
            'class' => $kecamatan_asal_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        )
    ));

    $cmb_tujuan = new_cmb2_box(array(
        'id'            => 'metabox_tujuan',
        'title'         => __('Informasi Tujuan', 'cmb2'),
        'object_types'  => array('ongkir'), // Sesuaikan dengan jenis post type yang Anda inginkan
    ));
    // Field untuk provinsi
    $provinsi_tujuan_value = get_post_meta( $post_id, 'provinsi_tujuan', true );
    $cmb_tujuan->add_field(array(
        'name' => 'Provinsi',
        'id'   => 'provinsi_tujuan',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'-' => esc_html__( '-', 'cmb2' ),
		),
        'attributes'       => array(
            'class' => $provinsi_tujuan_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        )
    ));

    // Field untuk kabupaten 
    $kabupaten_tujuan_value = get_post_meta( $post_id, 'kabupaten_tujuan', true );
    $cmb_tujuan->add_field(array(
        'name' => 'Kabupaten/Kota',
        'id'   => 'kabupaten_tujuan',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'-' => esc_html__( '-', 'cmb2' ),
		),
        'attributes'       => array(
            'class' => $kabupaten_tujuan_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        )
    ));

    // Field untuk kecamatan
    $kecamatan_tujuan_value = get_post_meta( $post_id, 'kecamatan_tujuan', true );
    $cmb_tujuan->add_field(array(
        'name' => 'Kecamatan',
        'id'   => 'kecamatan_tujuan',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'-' => esc_html__( '-', 'cmb2' ),
		),
        'attributes'       => array(
            'class' => $kecamatan_tujuan_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        )
    ));

    $cmb_ongkir = new_cmb2_box(array(
        'id'            => 'metabox_ongkir',
        'title'         => __('Informasi Ongkir', 'cmb2'),
        'object_types'  => array('ongkir'), // Sesuaikan dengan jenis post type yang Anda inginkan
    ));
    // Field untuk berat
    $cmb_ongkir->add_field(array(
        'name' => 'Berat (Kg)',
        'id'   => 'berat',
        'type' => 'text',
    ));

    // Field untuk tarif
    $cmb_ongkir->add_field(array(
        'name' => 'Tarif/Kg',
        'id'   => 'tarif',
        'type' => 'text',
    ));
}

// Panggil fungsi pembuatan metabox
add_action('cmb2_init', 'cmb2_custom_metabox');