<?php
session_name('myplanet');
session_set_cookie_params(0,'/');
session_start();

include("../conf/connect.php");

$nik = $_SESSION['nik'];
$nama = $_SESSION['nama'];
$location = $_SESSION['locationname'];




// $arr = get_defined_vars();
// print_r($arr);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="../../lobby_leadership_festival/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
	<script src="../../lobby_leadership_festival/assets/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"></script>
	<link rel="stylesheet" href="../../lobby_leadership_festival/assets/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm">
	<script src="../../lobby_leadership_festival/plugin/jquery-cookie-master/src/jquery.cookie.js"></script>
</head>
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
    <script>
        function getInetcek() {

            $.ajax({
                                type: "POST",
                                url : "keepalive.php",
                                success: function(data){

                                    console.log("Connected Internet")

                                    // console.log(data);
                                },
                                error : function() {

                                    //window.location = "<?php echo $back ?>";
                                    // console.log("no Internet");

                                    location.reload();

                                }
                        });

    

        };
    
    
    </script>
    <script language ="javascript" >
                setInterval(function () {document.getElementById("locacekinet").click();}, 7000);
        </script>
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">

<div style="visibility: hidden; margin-bottom: -30px;">
<button id="locacekinet" onclick="getInetcek()">cekposttest</button>
</div>

<nav class="navbar navbar-light bg-light justify-content-between">
  <a class="navbar-brand"></a>
  <div class="form-inline">
    <a href="../in/">
    <button class="btn btn-danger my-2 my-sm-0">Close X</button>
    </a>
  </div>
</nav>
    

<!-- <iframe src="post_test/1/index.php?USER_NAME=<?php echo $mynik ?>" style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;">
    Your browser doesn't support iframes
</iframe> -->
<!-- <div id="frameContainer">
<iframe src="prep.php?be=<?php echo $tesh ?>" style="position:absolute; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;">

</iframe>
</div> -->
<script>
        function myFunction(){
        var mynik = document.getElementsByName("mynik")[0].value;
        var user = document.getElementsByName("username")[0].value;
        var judul = document.getElementsByName("judul")[0].value;
        var isi = document.getElementsByName("isi")[0].value;

        document.getElementsByName("isi")[0].innerHTML = isi;

        // console.log(mynik);


            $.ajax({
                                        type: "POST",
                                        url : "aksi_feedback.php",
                                        data: {'mynik' : mynik, 'username' : user, 'judul' : judul, 'isi' : isi},
                                        success: function(data){

                                            if (data == 'ok proses'){

                                                alert("Berhasil  Submit!");
                                                
                                                window.location = "https://myplanet.enseval.com/festival_leadership/in/";	

                                            } else if (data == 'terlalu pendek/panjang') {

                                                alert("Minimum 150 Karakter !");

                                                    }

                                            console.log(data);
                                        }
                                });

        return false; // to stop submission
        };
</script>
<div class="section">
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">
                <form action="aksi_feedback.php" onsubmit="return myFunction();">
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row justify-content-between align-items-center mcq">
                            <h4>Feedback</h4>
                        </div>
                    </div>
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row align-items-center question-title">
                            <h5 class="mt-1 ml-2">Setelah anda menyimak video barusan, insight apa yang anda bisa ambil ? <br> ( Tuliskan insight tersebut dengan minimal 150 karakter huruf)</h5>
                            <h6 class="mt-1 ml-2"></h6>
                            <input type="hidden" name="mynik" value="<?php echo $nik ?>">
                            <input type="hidden" name="username" value="<?php echo $nama ?>">
                            <input type="hidden" name="judul" value="Manage Change">
                        </div>

                        <div class="ans ml-2">
                            <textarea name="isi" rows="10" cols="100"></textarea>
                        </div>
                        
                        
                        
                        
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-right p-3 bg-white">
                        <button class="btn btn-primary border-success align-items-right btn-success" type="submit">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>




</body>
</html>

<style>
/* #frameContainer {
    position: fixed;
    height: auto;
    top:50px;
    left: 0px;
    right:0px;
    bottom:0px;
    z-index:1;
} */

nav {
    background: #564DCD;
    background: -webkit-linear-gradient(top left, #564DCD, #9D68AB);
    background: -moz-linear-gradient(top left, #564DCD, #9D68AB);
    background: linear-gradient(to bottom right, #564DCD, #9D68AB);
}
body, html {
    background: #564DCD;
}
</style>
