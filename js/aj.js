//$("#div1").load("HEADER.php");
$("#div1").load('HEADER.php #p1');
$(".async").click(function (event)
{
  event.preventDefault();
  $("#div1").load("HEADER.php", function (responseTxt, statusTxt, xhr)
  {
    if (statusTxt == "success")
    {
      $(".feed").html("<h2>External content loaded successfully </h2>" + xhr.status + ": " + xhr.
        statusText);
    }
    if (statusTxt == "error")
    {
      $(".feed").html("<h2>Error:</h2>" + xhr.status + ": " + xhr.statusText);
      }
  })
})

$("#get").click(function (event)
{
  event.preventDefault();
  $.get("HEADER.php",
    {
    name: "musa"
  } , function (data, status)
  {
    $("#get_req").html("Data <br>" + data + "<br>status<br>" + status);
  })
})

$("#post").click(function (event)
{
  event.preventDefault();
  $.post("HEADER.php", function (data, status)
  {
    $("#post_req").html("data: " + data + status);
  })
})

$(document).ready(function () {
  $('#loginform').submit(function (event) {
    event.preventDefault();
    $.post("post.php", function (data)
      {
      $("#loginInfo").html(data + "helo");
    })
  })
})

/*$(document).ready(function ()
{
  $("#loginform").submit(function (event)
  {
    event.preventDefault();
    $.post("post.php", function (data)
    {
      $("#loginInfo").html(data + "helo");
      console.log("clicked");
    })
  })
})

$(document).ready(function ()
{
  $('#loginform').submit(function (event)
  {
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: "post.php",
      data: $(this).serialize(),
      success: function (response)
      {
        var jsonData = JSON.parse(response);

        if (jsonData.success == '1')
        {
          $("#loginInfo").html(data)
        }
        else
        {
          $("#loginInfo").html(data);
          }
        }
    })
  })
})
*/
