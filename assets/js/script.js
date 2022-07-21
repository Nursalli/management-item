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
                            <a class="btn btn-warning mb-1" href="#" title="Edit Barang">
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

getData(url);

$(document).on("click", ".hapusBarang", function () {
  const id = $(this).data("id");
  const nameId = `hapus${id}`;

  $('input[type="submit"]').attr("id", nameId);

  $(document).on("click", `#${nameId}`, function () {
    $("#modalHapus").modal("toggle");
    const processDelete = deleteData(url, id);

    setTimeout(() => {
      if(processDelete){
        location.reload();
      }
    },2000);
    
  });
});
