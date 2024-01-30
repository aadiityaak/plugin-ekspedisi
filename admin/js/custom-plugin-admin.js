jQuery(document).ready(function ($) {
  // Fungsi untuk mengambil nilai otomatis saat membuka halaman tambah post
  function ambilNilaiOtomatis() {
    $.ajax({
      url: ajaxurl, // Ajax URL telah disediakan oleh WordPress
      type: "POST",
      data: {
        action: "ambil_nilai_otomatis",
      },
      success: function (response) {
        // Isi nilai field dengan nilai yang diambil
        if ($(".post-type-ongkir #titlewrap input").val() == "") {
          $(".post-type-ongkir #titlewrap input").val(response.data);
          $(".post-type-ongkir #title-prompt-text").hide();
        }
      },
      error: function (error) {
        console.error("Gagal mengambil nilai otomatis:", error);
      },
    });
  }

  // Panggil fungsi saat halaman siap
  ambilNilaiOtomatis();
});

jQuery(document).ready(function ($) {
  // INIT
  // Fungsi untuk mengisi elemen select provinsi dari data yang ada di local storage
  function populateProvinsiFromLocalStorage(
    selectElement,
    storageKey,
    selected
  ) {
    // Mengecek apakah data ada di local storage
    const provincesDataString = localStorage.getItem(storageKey);
    if (provincesDataString) {
      // Mengonversi string JSON menjadi objek JavaScript
      const provincesData = JSON.parse(provincesDataString);
      // Mengosongkan elemen select
      selectElement.empty();
      // Mengisi elemen select dengan opsi-opsi dari data provinsi
      $.each(provincesData, function (index, province) {
        selectElement.append(
          $("<option>", {
            value: province.id,
            selected: province.id === selected,
            text: province.name,
          })
        );
      });
      console.log(
        `Data provinsi dari ${storageKey} berhasil dimuat ke dalam elemen select.`
      );
    } else {
      console.error(
        `Data provinsi dari ${storageKey} tidak ditemukan di local storage.`
      );
    }
  }
  // Fungsi untuk mengupdate alamat tujuan
  // Memanggil fungsi untuk mengisi elemen select provinsi_dari
  populateProvinsiFromLocalStorage(
    $("#provinsi_dari"),
    "provincesData",
    $("#provinsi_dari").attr("class")
  );
  // Memanggil fungsi untuk mengisi elemen select provinsi_tujuan
  populateProvinsiFromLocalStorage(
    $("#provinsi_tujuan"),
    "provincesData",
    $("#provinsi_tujuan").attr("class")
  );
  // KABUPATEN & KECAMATAN
  // $(document).ready(function () {
  const provinsiSelectDari = $("#provinsi_dari");
  const kabupatenSelectDari = $("#kabupaten_dari");
  const kecamatanSelectDari = $("#kecamatan_dari");
  const provinsiSelectTujuan = $("#provinsi_tujuan");
  const kabupatenSelectTujuan = $("#kabupaten_tujuan");
  const kecamatanSelectTujuan = $("#kecamatan_tujuan");
  function populateKabupaten(selectElem, provinsiId, selected) {
    selectElem.empty();
    if (!provinsiId) {
      console.log("Provinsi belum dipilih.");
      return;
    }

    const apiUrl = `https://aadiityaak.github.io/api-wilayah-indonesia/api/regencies/${provinsiId}.json`;

    // Mengecek apakah data kabupaten sudah ada di local storage
    const kabupatenDataString = localStorage.getItem(`kabupaten_${provinsiId}`);
    if (kabupatenDataString) {
      // Jika sudah ada, mengambil data dari local storage
      const kabupatenData = JSON.parse(kabupatenDataString);
      // Mengisi elemen select dengan opsi-opsi dari data kabupaten
      $.each(kabupatenData, function (index, kabupaten) {
        selectElem.append(
          $("<option>", {
            value: kabupaten.id,
            selected: kabupaten.id === selected,
            text: kabupaten.name,
          })
        );
      });
      console.log(
        "Data kabupaten dari local storage berhasil dimuat ke dalam elemen select."
      );
    } else {
      // Jika belum ada, mengambil data dari API
      $.ajax({
        url: apiUrl,
        type: "GET",
        dataType: "json",
        success: function (data) {
          // Menyimpan data kabupaten ke local storage
          localStorage.setItem(`kabupaten_${provinsiId}`, JSON.stringify(data));

          // Mengisi elemen select dengan opsi-opsi dari data kabupaten
          $.each(data, function (index, kabupaten) {
            selectElem.append(
              $("<option>", {
                value: kabupaten.id,
                selected: kabupaten.id === selected,
                text: kabupaten.name,
              })
            );
          });

          console.log("Data kabupaten berhasil dimuat ke dalam elemen select.");
        },
        error: function (error) {
          console.error(
            "Terjadi kesalahan saat mengambil data kabupaten:",
            error
          );
        },
      });
    }
  }

  function populateKecamatan(selectElem, kabupatenId, selected) {
    selectElem.empty();

    if (!kabupatenId) {
      console.log("Kabupaten belum dipilih.");
      return;
    }

    // Mengecek apakah data kecamatan sudah ada di local storage
    const kecamatanDataString = localStorage.getItem(
      `kecamatan_${kabupatenId}`
    );
    if (kecamatanDataString) {
      // Jika sudah ada, mengambil data dari local storage
      const kecamatanData = JSON.parse(kecamatanDataString);
      // Mengisi elemen select dengan opsi-opsi dari data kecamatan
      $.each(kecamatanData, function (index, kecamatan) {
        selectElem.append(
          $("<option>", {
            value: kecamatan.id,
            selected: kecamatan.id === selected,
            text: kecamatan.name,
          })
        );
      });
      console.log(
        "Data kecamatan dari local storage berhasil dimuat ke dalam elemen select."
      );
    } else {
      // Jika belum ada, mengambil data dari API
      const apiUrl = `https://aadiityaak.github.io/api-wilayah-indonesia/api/districts/${kabupatenId}.json`;
      $.ajax({
        url: apiUrl,
        type: "GET",
        dataType: "json",
        success: function (data) {
          // Menyimpan data kecamatan ke local storage
          localStorage.setItem(
            `kecamatan_${kabupatenId}`,
            JSON.stringify(data)
          );

          // Mengisi elemen select dengan opsi-opsi dari data kecamatan
          $.each(data, function (index, kecamatan) {
            selectElem.append(
              $("<option>", {
                value: kecamatan.id,
                selected: kecamatan.id === selected,
                text: kecamatan.name,
              })
            );
          });

          console.log("Data kecamatan berhasil dimuat ke dalam elemen select.");
        },
        error: function (error) {
          console.error(
            "Terjadi kesalahan saat mengambil data kecamatan:",
            error
          );
        },
      });
    }
  }

  // jalankan fungsi populateKabupaten setiap kali elemen select provinsi_dari berubah dan jika ditemukan class di id #provinsi_dari
  if ($("#provinsi_dari").attr("class") !== "") {
    const selectedProvinsiId = $("#provinsi_dari").attr("class");
    populateKabupaten(
      kabupatenSelectDari,
      selectedProvinsiId,
      $("#kabupaten_dari").attr("class")
    );
  }
  provinsiSelectDari.on("change", function () {
    const selectedProvinsiId = $(this).val();
    populateKabupaten(
      kabupatenSelectDari,
      selectedProvinsiId,
      $("#kabupaten_dari").attr("class")
    );
  });

  if ($("#kabupaten_dari").attr("class") !== "") {
    const selectedKabupatenId = $("#kabupaten_dari").attr("class");
    populateKecamatan(
      kecamatanSelectDari,
      selectedKabupatenId,
      $("#kecamatan_dari").attr("class")
    );
  }
  kabupatenSelectDari.on("change", function () {
    const selectedKabupatenId = $(this).val();
    populateKecamatan(kecamatanSelectDari, selectedKabupatenId);
  });

  kecamatanSelectDari.on("change", function () {
    const namaKecamatan = $(this).find(":selected").text();
    const namaKabupaten = $("#kabupaten_dari").find(":selected").text();
    const namaProvinsi = $("#provinsi_dari").find(":selected").text();
    $("#alamat_dari").val(
      namaKecamatan + ", " + namaKabupaten + ", " + namaProvinsi
    );
  });

  // Menangani peristiwa change pada elemen select provinsi_tujuan
  if ($("#provinsi_tujuan").attr("class") !== "") {
    const selectedProvinsiId = $("#provinsi_tujuan").attr("class");
    populateKabupaten(
      kabupatenSelectTujuan,
      selectedProvinsiId,
      $("#kabupaten_tujuan").attr("class")
    );
  }
  provinsiSelectTujuan.on("change", function () {
    const selectedProvinsiId = $(this).val();
    populateKabupaten(kabupatenSelectTujuan, selectedProvinsiId);
  });

  // Menangani peristiwa change pada elemen select kabupaten_tujuan
  if ($("#kabupaten_tujuan").attr("class") !== "") {
    const selectedKabupatenId = $("#kabupaten_tujuan").attr("class");
    populateKecamatan(
      kecamatanSelectTujuan,
      selectedKabupatenId,
      $("#kecamatan_tujuan").attr("class")
    );
  }
  kabupatenSelectTujuan.on("change", function () {
    const selectedKabupatenId = $(this).val();
    populateKecamatan(kecamatanSelectTujuan, selectedKabupatenId);
  });
  kecamatanSelectTujuan.on("change", function () {
    const namaKecamatan = $(this).find(":selected").text();
    const namaKabupaten = $("#kabupaten_tujuan").find(":selected").text();
    const namaProvinsi = $("#provinsi_tujuan").find(":selected").text();
    $("#alamat_tujuan").val(
      namaKecamatan + ", " + namaKabupaten + ", " + namaProvinsi
    );
  });
  // });
});

// Mengecek apakah data sudah ada di local storage
if (!localStorage.getItem("provincesData")) {
  // Jika tidak ada, maka ambil data dari URL
  fetch("https://aadiityaak.github.io/api-wilayah-indonesia/api/provinces.json")
    .then((response) => response.json())
    .then((data) => {
      // Mengonversi data menjadi string JSON
      const jsonString = JSON.stringify(data);

      // Menyimpan string JSON ke local storage dengan kunci tertentu
      localStorage.setItem("provincesData", jsonString);

      console.log("Data berhasil diambil dan disimpan di local storage.");
    })
    .catch((error) => console.error("Terjadi kesalahan:", error));
} else {
  console.log("Data sudah ada di local storage.");
}
