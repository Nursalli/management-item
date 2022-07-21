const url = "https://api-item.herokuapp.com/";

async function login(apiUrl, formData) {
  await $.ajax({
    url: apiUrl + "login",
    type: "POST",
    data: formData,
    success: function (data) {
        let curCookie = "X-PZN-SESSION=" + data.token;
        document.cookie = curCookie;
        window.location.href = 'admin.php';
    },
    error: function (err) {
        $("#loginError").show();
        $("#loginError").html(err.responseJSON.status);
    },
    cache: false,
    contentType: false,
    processData: false,
  });

  return true;
}

$(document).on("submit", "form#login", async function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  await login(url, formData)
});
