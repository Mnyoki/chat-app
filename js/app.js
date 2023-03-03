//var user = $("#user").val();

//console.log("helo world");

function checkUser(user)
{
  if (user.value == '')
  {
    $('#used').html('&nbsp; ');
    return;
  }
  
  xhr = false;

  if (XMLHttpRequest) {
    xhr = new XMLHttpRequest();
  } else if (ActiveXObject) {
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
  }

  var targetDiv = document.getElementById("used");
  url = "checkuser.php";
  var user = document.getElementById("user").value;
  var param = "user=" + user;
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function ()
  {
    if (xhr.readyState == 4 && xhr.status == 200) {
      targetDiv.innerHTML = xhr.responseText;
      targetDiv.style.marginTop = 0;
    }
  }
  
  xhr.send(param);

  /*jquery.post(
      'checkuser.php',
      { user: user.val() },
      function (data)
      {
        $('#used').html(data);
        }
  )*/
}

