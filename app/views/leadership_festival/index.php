<?php
session_name('myplanet');
session_set_cookie_params(0,'/');
session_start();

include("../conf/connect.php");

$nik = $_SESSION['nik'];
$nama = $_SESSION['nama'];
$location = $_SESSION['locationname'];

$cekw = mysqli_query($conn, "SELECT * FROM `leadership_festival_undangan` WHERE `nik` = '$nik'");
$getw = mysqli_fetch_array($cekw);
$getundangan = mysqli_num_rows($cekw);


if ($getundangan >= 1) {
    # code...
} else {

    $string = 'Mohon maaf, Anda Tidak Ada Akses.. !!,\n Silahkan Hubungi Tim Training Pusat !!';

                                echo "<script type='text/javascript'>
                            alert(\"$string\");
                            window.location.href='https://myplanet.enseval.com/index';
                            </script>";

}



// $arr = get_defined_vars();
// print_r($arr);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Festival Leadership</title>
</head>
<body>
	 <img src="img/GedungRakernas2023min.jpg" class="imgback" style="position: fixed;bottom: 0;right: 0;width: 100%;height: 100%;">

	 <div width="14" height="20" class="kuKEPR" onclick="location.href='in/';"></div>
</body>
</html>

<style>

@media screen and (min-width: 1000px) {
      /* body {
        background: url('img/lobby_virtual_mid.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        -o-background-size: cover;
      } */

      .kuKEPR {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 50%;
        height: 50%;
        top: 40%;
        right: 25%;

      }
      .kuKEPRone {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 41.5%;
        height: 35.9%;
        top: 0%;
        right: 27.9%;
        background: none transparent;
        }
      .kuKEPRtwo {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 28%;
        height: 38%;
        top: 38%;
        right: 5%
        }

      .kuKEPRthree {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 21%;
        height: 38%;
        top: 40%;
        right: 36%;
        }

        .kuKEPRfour {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 41.5%;
        height: 35.9%;
        top: 0%;
        right: 27.9%;
        }

        .kuKEPRfive {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 11%;
        height: 23%;
        top: 38%;
        left: 0%;
        }

        /* HIDE RADIO */
        [type=radio] { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
        cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
        outline: 2px solid #f00;
        }

        #menu {
          display: inline-block !important;
          width: 798px;
          height: 145px;
          overflow: scroll;
          white-space: nowrap;
          text-align: center;
        }

        .jumbotron {
          display : none;
        }
        iframe{
            overflow:hidden !important;
        }

}
@media screen and (max-device-width: 1200px) {

  .imgback {
    display: none;
  }
  .kuKEPRone{
    display: block;
    height: 300px;
  }


}
</style>