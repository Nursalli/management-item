async function getData(apiUrl){
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
    error: function(err) {
      console.log(err.responseText);
    }
  });

  $('#dataTable').DataTable();
}

getData("https://api-item.herokuapp.com/");
