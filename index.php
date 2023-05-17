<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="index, follow">
  <meta name="description" content="Shorten a URL using Linkity Demo. A free URL shortener. Powered by DevUncoded's Linkity.">
  <title>Home | Linkity Demo</title>
  <link rel="stylesheet" href="npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous">
  <link rel="stylesheet" href="css.css?family=Nunito+Sans:400,600">
  <link rel="stylesheet" href="css.css">
</head>

<body>
  <img class="bg" src="photo-1518873890627-d4b177c06e51.jpeg" alt="">
  <main class="page">
    <h1>Shorten a URL</h1>

    <div class="shorten">
      <input type="text" name="url" placeholder="URL" id="url" required="">

        
      <button onclick="getLink()">Shorten</button>
    </form>

    <div id="url_d">
      <p id="url_res"></p>
    </div>

  </main>
  <footer class="footer">
    &copy; <?php echo date('Y') ?> <a href="https://devsecit.com" target="_blank">DEV SEC IT</a> SHORT LINK </footer>
  <script src="npm/jquery@3.3.1/dist/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script>
  <script src="npm/sweetalert2@8.8.2/dist/sweetalert2.all.min.js" integrity="sha256-F35YL6dQdoi9Lri7XPCq9cB0iLetbJiNUfYfcIQwu24=" crossorigin="anonymous"></script>
  <script src="npm/tippy.js@3.4.1/dist/tippy.all.min.js" integrity="sha256-iLOTBBYaCzN2utfyApj2yRw3ltH86LwYZrzOz3TTbyg=" crossorigin="anonymous"></script>
  <script>
    var nonce = "nonce_XjCVlkWPIYSjRP1LgoXXKI9rKvmtEojkwake0eeQ9KOrof6KSK9HChisocihNP5PmRO";
  </script>

  <style>
    #url_d {
      height: 50px;
      width: 100%;
      text-align: center;
      background: white;
      display: none;
      margin-top:20px;
      border-radius: 30px;
      text-align: center;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      line-height: 50px;
    }

    #url_d h1 {
      font-size: 18px;
      color: #333;
      font-weight: bold;
      padding-top: 25px;
    }
  </style>

  <script>
    function getLink() {
      var response;
      var ur = document.getElementById("url").value;
      var ur_res = document.getElementById("url_res");

      if(ur.length>5) {
      $.ajax({
        type: 'GET',
        url: 'action.php?u=' + ur,
        success: function(resp) {
          response = resp;
          console.log(response);
          document.getElementById('url_d').style.display='flex';
          ur_res.innerHTML="<h1> Shorted URL is <a href='"+response+"' target='_blank'>"+response+"</a></h1>";
        }
      })
    }else {
    alert("URL does not empty");
  }
  } 
  </script>
 

 <script>
       $(document).ready(function(e) {
      $(".bg").addClass("active")
      setTimeout(function() {
        $(".page").addClass("active")
        setTimeout(function() {
          $("input").focus()
        }, 400)
      }, 800)
    })
 </script>

</body>

</html>