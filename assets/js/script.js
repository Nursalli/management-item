const url = "https://api-item.herokuapp.com/";

async function getData(apiUrl) {
  await $.ajax({
    url: apiUrl,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      $("#dataTable tbody").html("");
      for (let x in data) {
        let row = $("<tr></tr>");
        let cells = [];
        cells[0] = $(`<td> ${+x + 1} </td>`);
        cells[1] = $(`<td class="text-center"> 
                            <img src="https://api-item.herokuapp.com/images/${data[x]["foto_barang"]}" alt="foto_barang" width="100" height="100"> 
                        </td>`);
        cells[2] = $(`<td> ${data[x]["nama_barang"]} </td>`);
        cells[3] = $(`<td> ${data[x]["harga_beli"]} </td>`);
        cells[4] = $(`<td> ${data[x]["harga_jual"]} </td>`);
        cells[5] = $(`<td> ${data[x]["stok"]} </td>`);
        cells[6] = $(`<td class="text-center">
                            <a class="btn btn-warning mb-1 editBarang" href="#" role="button" title="Edit Barang" data-toggle="modal" data-target="#modalForm" data-id="${data[x]["id"]}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger mb-1 hapusBarang" href="#" role="button" title="Hapus Barang" data-toggle="modal" data-target="#modalHapus" data-id="${data[x]["id"]}">
                                <i class="fas fa-trash"></i>
                            </a>
                    </td>`);

        for (let i in cells) {
          row.append(cells[i]);
        }

        $("#dataTable tbody").append(row);
      }
    },
    error: function (err) {
      console.log(err.responseText);
    },
  });

  $("#dataTable").DataTable();

  return true;
}

async function deleteData(apiUrl, id) {
  await $.ajax({
    url: apiUrl + id,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    type: "DELETE",
    dataType: "JSON",
    success: function (data) {
      swal({
        title: "Success",
        text: `${data.status}!`,
        icon: "success",
        button: false,
        timer: 1500,
      });
    },
    error: function (err) {
      swal({
        title: "Failed",
        text: `${err.responseJSON.status}!`,
        icon: "error",
        button: false,
        timer: 1500,
      });
    },
  });

  return true;
}

async function createUpdateData(apiUrl, formData, id = "") {
  const checkFile = formData.get('foto_barang').name;

  if(checkFile === ''){
    formData.set('foto_barang', '');
  }

  let type;
  const command = $("#formModalLabel").text();

  if(command === "Edit Barang"){
    type = "PUT";
  } else {
    type = "POST";
  }

  await $.ajax({
    url: apiUrl + id,
    type,
    enctype: "multipart/form-data",
    data: formData,
    success: function (data) {
      $("#modalForm").modal("toggle");
      swal({
        title: "Success",
        text: `${data.status}!`,
        icon: "success",
        button: false,
        timer: 1500,
      });
    },
    error: function (err) {
      $("#error").show();
      $("#error").html("");
      for (let x = 0; x < err.responseJSON.errors.length; x++) {
        let un = $("<ul></ul>");
        let li = [];

        switch (err.responseJSON.errors[x].param) {
          case "foto_barang":
            li[0] = $(
              `<li> Error Foto Barang: ${err.responseJSON.errors[x].msg} </li>`
            );
            break;
          case "nama_barang":
            li[0] = $(
              `<li> Error Nama Barang: ${err.responseJSON.errors[x].msg} </li>`
            );
            break;
          case "harga_beli":
            li[0] = $(
              `<li> Error Harga Beli: ${err.responseJSON.errors[x].msg} </li>`
            );
            break;
          case "harga_jual":
            li[0] = $(
              `<li> Error Harga Jual: ${err.responseJSON.errors[x].msg} </li>`
            );
            break;
          case "stok":
            li[0] = $(
              `<li> Error Stok: ${err.responseJSON.errors[x].msg} </li>`
            );
            break;
          default:
            break;
        }

        for (let i in li) {
          un.append(li[i]);
        }

        $("#error").append(un);
      }
    },
    cache: false,
    contentType: false,
    processData: false,
  });

  return true;
}

async function findData(apiUrl, id) {
  await $.ajax({
    url: apiUrl + id,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      $(".custom-file-input").next(".custom-file-label").html(data.foto_barang);
      $('.custom-file-input').val('');
      $("#nama_barang").val(data.nama_barang);
      $("#harga_beli").val(data.harga_beli);
      $("#harga_jual").val(data.harga_jual);
      $("#stok").val(data.stok);
    },
    error: function (err) {
      console.log(err);
    },
  });

  return true;
}

getData(url);

$(".custom-file-input").on("change", function (event) {
  let fileName = $(this).val().split("\\").pop();
  $(this).next(".custom-file-label").addClass("selected").html(fileName);
});

$(document).on("click", ".tambahBarang", function () {
  $("#formModalLabel").text("Tambah Barang");
  $("#error").hide();
  $(".custom-file-input").next(".custom-file-label").html("Pilih file...");
  $("#nama_barang").val(null);
  $("#harga_beli").val(null);
  $("#harga_jual").val(null);
  $("#stok").val(null);

  $(document).on("submit", "form#data", function (e) {
    e.preventDefault();
  
    let formData = new FormData(this);
  
    createUpdateData(url, formData).then((res) => {
      setTimeout(() => {
        location.reload();
      }, 1300);
    });
  });
});

$(document).on("click", ".editBarang", function () {
  const id = $(this).data("id");

  $("#formModalLabel").text("Edit Barang");
  $("#error").hide();

  findData(url, id);

  $(document).on("submit", "form#data", function (e) {
    e.preventDefault();
  
    let formData = new FormData(this);
  
    createUpdateData(url, formData, id).then((res) => {
      setTimeout(() => {
        location.reload();
      }, 1300);
    });
  });
});

$(document).on("click", ".hapusBarang", function () {
  const id = $(this).data("id");
  const nameId = `hapus${id}`;

  $('input[type="submit"]').attr("id", nameId);

  $(document).on("click", `#${nameId}`, function () {
    $("#modalHapus").modal("toggle");
    deleteData(url, id).then((res) => {
      setTimeout(() => {
        location.reload();
      }, 1300);
    });
  });
});
