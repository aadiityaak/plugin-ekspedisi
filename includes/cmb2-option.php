<?php
// Pastikan Anda sudah memasukkan CMB2 ke dalam theme atau plugin Anda

// Fungsi untuk membuat metabox
function cmb2_custom_metabox()
{
    $post_id = isset($_GET['post']) ? $_GET['post'] : '';
    $prefix = '';
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
    $provinsi_dari_value = get_post_meta( $post_id, 'provinsi_dari', true );
    $cmb_dari->add_field( array(
        'name'             => 'Provinsi',
        'id'               => 'provinsi_dari',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => array(
            '-' => esc_html__( '-', 'cmb2' ),
        ),
        'attributes'       => array(
            'class' => $provinsi_dari_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        ),
    ) );

    // Field untuk kabupaten
    $kabupaten_dari_value = get_post_meta( $post_id, 'kabupaten_dari', true );
    $cmb_dari->add_field(array(
        'name' => 'Kabupaten/Kota',
        'id'   => 'kabupaten_dari',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'-' => esc_html__( '-', 'cmb2' ),
		),
        'attributes'       => array(
            'class' => $kabupaten_dari_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        )
    ));

    // Field untuk kecamatan
    $kecamatan_dari_value = get_post_meta( $post_id, 'kecamatan_dari', true );
    $cmb_dari->add_field(array(
        'name' => 'Kecamatan',
        'id'   => 'kecamatan_dari',
		'type'             => 'select',
		'show_option_none' => true,
		'options'          => array(
			'-' => esc_html__( '-', 'cmb2' ),
		),
        'attributes'       => array(
            'class' => $kecamatan_dari_value, // Menambahkan kelas 'tambahan' dan nilai dari post meta
        )
    ));
    $cmb_dari->add_field(array(
        'name' => 'Alamat Dari',
        'id'   => 'alamat_dari',
        'type' => 'hidden',
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
    $cmb_tujuan->add_field(array(
        'name' => 'Alamat Tujuan',
        'id'   => 'alamat_tujuan',
        'type' => 'hidden',
    ));

    $cmb_ongkir = new_cmb2_box(array(
        'id'            => 'metabox_ongkir',
        'title'         => __('Informasi Ongkir', 'cmb2'),
        'object_types'  => array('ongkir'), // Sesuaikan dengan jenis post type yang Anda inginkan
    ));

    // Field untuk tarif
    $cmb_ongkir->add_field(array(
        'name' => 'Tarif per 1 Kg',
        'id'   => 'tarif',
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
        ),
    ));


    // Detail Absensi Metabox
    $detail_absensi_metabox = new_cmb2_box(array(
        'id'           => $prefix . 'detail_absensi',
        'title'        => esc_html__('Detail Absensi', 'online-generator'),
        'object_types' => ['absensi'],
        'context'      => 'normal',
    ));

    // Fields for Detail Absensi Metabox
    $detail_absensi_metabox->add_field(array(
        'name' => esc_html__('Tanggal (Date)', 'online-generator'),
        'id'   => $prefix . 'tanggal',
        'type' => 'text_date',
    ));

    $detail_absensi_metabox->add_field(array(
        'name' => esc_html__('Jam Masuk (Check-in Time)', 'online-generator'),
        'id'   => $prefix . 'jam_masuk',
        'type' => 'text_time',
    ));

    $detail_absensi_metabox->add_field(array(
        'name' => esc_html__('Jam Pulang (Check-out Time)', 'online-generator'),
        'id'   => $prefix . 'jam_pulang',
        'type' => 'text_time',
    ));

    $detail_absensi_metabox->add_field(array(
        'name' => esc_html__('Lokasi (Location)', 'online-generator'),
        'id'   => $prefix . 'lokasi',
        'type' => 'text',
    ));

    $detail_absensi_metabox->add_field(array(
        'name'    => esc_html__('Status Kehadiran', 'online-generator'),
        'id'      => $prefix . 'status_kehadiran',
        'type'    => 'select',
        'options' => [
            'Hadir'       => esc_html__('Hadir', 'online-generator'),
            'Izin'        => esc_html__('Izin', 'online-generator'),
            'Tidak hadir' => esc_html__('Tidak hadir', 'online-generator'),
        ],
    ));

    $detail_absensi_metabox->add_field(array(
        'name' => esc_html__('Keterangan (Remarks)', 'online-generator'),
        'id'   => $prefix . 'keterangan',
        'type' => 'textarea',
    ));

    $detail_absensi_metabox->add_field(array(
        'name' => esc_html__('Nama Karyawan (User ID)', 'online-generator'),
        'id'   => $prefix . 'nama_karyawan',
        'type' => 'text',
    ));

    $detail_absensi_metabox->add_field(array(
        'name' => esc_html__('Face ID', 'online-generator'),
        'id'   => $prefix . 'face_id',
        'type' => 'textarea',
    ));
}

// Panggil fungsi pembuatan metabox
add_action('cmb2_init', 'cmb2_custom_metabox');
