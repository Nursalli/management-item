$(document).ready(function () {
  $.ajax({
    url: "https://api-item.herokuapp.com/",
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    type: "GET",
    dataType: "json",
    data: {
    },
    success: function (result) {
        console.log(result);
    },
    error: function () {
        console.log("error");
    }
    // success: function (data) {
    //   $("#dataTable tbody").html("");
    //   for (let x in data) {
    //     let row = $("<tr></tr>");
    //     let cells = [];
    //     cells[0] = $("<td>" + (+x + 1) + "</td>");
    //     cells[1] = $("<td>" + data[x]["foto_barang"] + "</td>");
    //     cells[2] = $("<td>" + data[x]["nama_barang"] + "</td>");
    //     cells[3] = $("<td>" + data[x]["harga_beli"] + "</td>");
    //     cells[4] = $("<td>" + data[x]["harga_jual"] + "</td>");
    //     cells[5] = $("<td>" + data[x]["stok"] + "</td>");

    //     for (let i in cells) {
    //       row.append(cells[i]);
    //     }

    //     $("#dataTable tbody").append(row);
    //   }
    // },
  });
});
