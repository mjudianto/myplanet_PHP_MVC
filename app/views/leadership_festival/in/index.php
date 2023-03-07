<?php
session_name('myplanet');
session_set_cookie_params(0,'/');
session_start();

include("../conf/connect.php");




// $arr = get_defined_vars();
// print_r($arr);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Lobby Virtual Leadership Festival</title>
</head>
<body>
	<img src="../img/VirtualLobbyRakernas2023min.jpg" class="imgback" style="position: fixed;bottom: 0;right: 0;width: 100%;height: 100%;"> 

	<div width="14" height="20" class="kuKEPRPakJony" onclick="location.href='../studio/studio1';"></div>

	<div width="14" height="20" class="kuKEPRPakHandi" onclick="location.href='../studio/studio2';"></div>

	<div width="14" height="20" class="kuKEPRPakFrans" onclick="location.href='../studio/studio3';"></div>

	<div width="14" height="20" class="kuKEPRPakMedi" onclick="location.href='../studio/studio4';"></div>

	<div width="14" height="20" class="kuKEPRPakStanley" onclick="location.href='../studio/studio5';"></div>

  <div width="14" height="20" class="kuKEPRPakPatrick" onclick="location.href='../studio/studio6';"></div>

  <div width="14" height="20" class="kuKEPRLeaderSpecialis" onclick="location.href='../studio/studio7';"></div>


  <div class="action" onclick="actionToggle();">

    <span>+</span>

    <ul>

      <li onclick="location.href='../../index';">
          Back
      </li>
      <!-- <li><a href="#" class="tw-icon"><i class="fa fa-twitter"></i></a>Share on Twitter</li>
      <li><a href="#" class="ig-icon"><i class="fa fa-instagram"></i></a>Share on Instagram</li>
      <li><a href="#" class="pin-icon"><i class="fa fa-pinterest"></i></a>Share on Pinterest</li>
      <li><a href="#" class="in-icon"><i class="fa fa-linkedin"></i></a>Share on Linkedin</li> -->

    </ul>

  </div>




</body>
</html>


<style>

@media screen and (min-width: 1000px) {

    .kuKEPRPakJony {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 7%;
    height: 21%;
    top: 39%;
    right: 40%;
    cursor: pointer;
}

.kuKEPRPakHandi {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 7%;
    height: 21%;
    top: 39%;
    right: 48.5%;
    cursor: pointer;
  }

.kuKEPRPakFrans {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 8%;
    height: 21%;
    top: 39%;
    right: 56%;
    cursor: pointer;
  }

.kuKEPRPakMedi {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 8%;
    height: 22%;
    top: 38%;
    right: 64%;
    cursor: pointer;
  }

.kuKEPRPakStanley {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 8%;
    height: 21%;
    top: 39%;
    right: 72%;
    cursor: pointer;
  }

  .kuKEPRPakPatrick {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 7%;
    height: 21%;
    top: 39%;
    right: 32%;
    cursor: pointer;
  }

  .kuKEPRLeaderSpecialis {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 7%;
    height: 21%;
    top: 39%;
    right: 24%;
    cursor: pointer;
  }

  .kuKEPRself {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 18%;
        height: 41%;
        top: 50%;
        left: 5%;
        }
        /* .kuKEPRtv {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 35.5%;
        height: 39.9%;
        top: 16%;
        right: 31.9%;
        background: none transparent;
        } */

        .kuKEPRtv {
          position: absolute;
          display: flex;
          -webkit-box-pack: center;
          justify-content: center;
          width: 33%;
          height: 32%;
          top: 14%;
          right: 65.2%;
          background: none transparent;
        }

        .kuKEPRMan {
          position: absolute;
          display: flex;
          -webkit-box-pack: center;
          justify-content: center;
          width: 8%;
          height: 20%;
          top: 26%;
          left: 12%;
        }
        .kuKEPRGiv {
          position: absolute;
          display: flex;
          -webkit-box-pack: center;
          justify-content: center;
          width: 8%;
          height: 20%;
          top: 26%;
          left: 21.6%;
        }
        .kuKEPRslman {
          position: absolute;
          display: flex;
          -webkit-box-pack: center;
          justify-content: center;
          width: 8%;
          height: 20%;
          top: 26%;
          right: 10.3%;
        }
        .kuKEPRperfor {
          position: absolute;
          display: flex;
          -webkit-box-pack: center;
          justify-content: center;
          width: 8%;
          height: 20%;
          top: 26%;
          right: 20.2%;

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

        .kwZBnP {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        object-fit: cover;
        }

      .modal-content {
        background: #564DCD;
          background: -webkit-linear-gradient(top left, #efa413, #efa413  );
          background: -moz-linear-gradient(top left, #efa413, #efa413  );
          background: linear-gradient(to bottom right, #efa413, #efa413  );
      }

      .action {
  position: fixed;
  bottom: 50px;
  left: 50px;
  width: 50px;
  height: 50px;
  background: red;
  border-radius: 50%;
  cursor: pointer;
  box-shadow: 3px 5px 5px rgba(0, 0, 0, 0.1);
}

.action span {
  position: relative;
  width: 100%;
  /*height: 100px;*/
  top: 14%;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  font-size: 2em;
  transition: 0.3s ease-in-out;
}

.action.active span {
  transform: rotate(135deg);
}

.action ul {
  position: absolute;
  bottom: 55px;
  background: #262626;
  min-width: 250px;
  padding: 20px;
  border-radius: 20px;
  opacity: 0;
  visibility: hidden;
  transition: 0.3s;
  color: white;
}

.action.active ul {
  bottom: 65px;
  opacity: 1;
  visibility: visible;
  transition: 0.3s;
}

.action.active ul li {
  list-style: none;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  padding: 10px 0;
  transition: 0.3s;
}

.action ul li:hover {
  font-weight: 600;
}

.action ul li:not(:last-child) {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1); /*important shit for other UI*/
}

.action ul li i {
  margin-right: 10px;
  opacity: 0.6;
}

.action ul li:hover i {
  opacity: 0.9;
}

.action ul li a.fb-icon {
  color: #0062e0;
}

.action ul li a.tw-icon {
  color: #00acee;
}

.action ul li a.ig-icon {
  color: #eb28a0;
}

.action ul li a.pin-icon {
  color: #eb2828;
}

.action ul li a.in-icon {
  color: #0e76a8;
}


}
@media screen and (max-device-width: 1200px) {



}


</style>

<script type="text/javascript">
  function actionToggle() {
  var action = document.querySelector(".action");
  action.classList.toggle("active");
}
</script>