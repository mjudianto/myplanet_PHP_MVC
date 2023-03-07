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
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Leadership Festival || Studio 2</title>
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
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">

	 <!-- <div style="visibility: hidden; margin-bottom: -30px;">

        <button id="locacek" onclick="getCek()">cek</button>
        <button id="locacekpost" onclick="getCekposttest()">cekposttest</button>

     </div> -->


 	<script type="text/javascript">
		function goFullscreen(id) {

		  var ctrlVideo = document.getElementById("video1"); 
		  var element = document.getElementById(id);    

		  console.log(ctrlVideo); 


		  if (element.mozRequestFullScreen) {
		    element.mozRequestFullScreen();
		    ctrlVideo.play();
		  } else if (element.webkitRequestFullScreen) {
		    element.webkitRequestFullScreen();
		    ctrlVideo.play();
		  }  
		}
	</script>


<img src="../../lobby_leadership_festival/img/leadership_festival/studio/layar_noexit.jpg" class="imgback" style="position: fixed;bottom: 0;right: 0;width: 100%;height: 100%;">

		<!-- <div class="kuKEPRplay" onclick="goFullscreen('videoOne'); return false"> -->
            <!-- <button class="active">Play</button> -->
        <!-- </div> -->
        <div class="kuKEPR">
            <a onclick="goFullscreen('video1')">
            <video id="video1" style="width: 1000px; max-width: 100%; max-height: 100%;object-fit: cover;" data-mce-style="width: 1000px; max-width: 100%; max-height: 100%;" autoplay="autoplay" controls>
            <source src="vid/TeamPerformance.mp4" type="video/mp4">
            </a>
            </video>
            <!-- <ifr
            <!-- <iframe width="100%" height="100%" src="https://www.youtube.com/embed/4JJFJsmliUU?autoplay=1&controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                <!-- <iframe id="videoOne" width="100%" height="100%" src="https://www.youtube-nocookie.com/embed/Q96yBdJEOf0?autoplay=1&controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

        </div>










</body>

<style>
.kuKEPR {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    background-size: 100% 100%;
    width: 56%;
    height: 52%;
    top: 8%;
    right: 22%;
}

.kuKEPRplay {
    /* position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    background-size: 100% 100%;
    width: 5%;
    height: 5%;
    top: 49%;
    left: 14.8%; */
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 56%;
    height: 52%;
    top: 8%;
    right: 22%;
    z-index:1000;

}

.kuKEPRex {
    position: absolute;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    width: 10%;
    height: 20%;
    top: 41%;
    right: 6.8%;
    border: solid 2px;
    animation: blinker 1s linear infinite;
    text-align: center;
      }

      .kuKEPRchat {
        position: absolute;
        display: block;
        width: 70%;
        height: 20%;
        top: 5%;
        left: 0%;
        

      }

      .kuKEPRlike {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        width: 30%;
        height: 5%;
        top: 61%;
        right: 36%;
      }

      .kuKEPRlikeshow {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        background-size: 100% 100%;
        width: 56%;
        height: 52%;
        top: 8%;
        right: 22%;

      }
    .kuKEPRlikeshowAll {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        justify-content: center;
        background-size: 100% 100%;
        width: 56%;
        height: 52%;
        top: 8%;
        right: 22%;
        background : none transparent;
    }

.flex {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
}

.box.box-warning {
    border-top-color: #f39c12
}

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1)
}

.box-header.with-border {
    border-bottom: none;
}

.box-header.with-border {
    border-bottom: none;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative
}

.box-header:before,
.box-body:before,
.box-footer:before,
.box-header:after,
.box-body:after,
.box-footer:after {
    content: "";
    display: table
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative
}

.box-header>.fa,
.box-header>.glyphicon,
.box-header>.ion,
.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1
}

.box-header>.box-tools {
    position: absolute;
    right: 10px;
    top: 5px
}

.box-header>.box-tools [data-toggle="tooltip"] {
    position: relative
}

.bg-yellow,
.callout.callout-warning,
.alert-warning,
.label-warning,
.modal-warning .modal-body {
    background-color: #f39c12 !important
}

.bg-yellow {
    color: #fff !important
}

.btn {
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent
}

.btn-box-tool {
    padding: 5px;
    font-size: 12px;
    background: transparent;
    color: #97a0b3
}

.direct-chat .box-body {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    position: relative;
    overflow-x: hidden;
    padding: 0
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px
}

.box-header:before,
.box-body:before,
.box-footer:before,
.box-header:after,
.box-body:after,
.box-footer:after {
    content: "";
    display: table
}

.direct-chat-messages {
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    -o-transform: translate(0, 0);
    transform: translate(0, 0);
    padding: 10px;
    height: 250px;
    overflow: auto
}

.direct-chat-messages,
.direct-chat-contacts {
    -webkit-transition: -webkit-transform .5s ease-in-out;
    -moz-transition: -moz-transform .5s ease-in-out;
    -o-transition: -o-transform .5s ease-in-out;
    transition: transform .5s ease-in-out
}

.direct-chat-msg {
    margin-bottom: 10px
}

.direct-chat-msg,
.direct-chat-text {
    display: block
}

.direct-chat-info {
    display: block;
    margin-bottom: 2px;
    font-size: 12px
}

.direct-chat-timestamp {
    color: #999
}

.btn-group-vertical>.btn-group:after,
.btn-group-vertical>.btn-group:before,
.btn-toolbar:after,
.btn-toolbar:before,
.clearfix:after,
.clearfix:before,
.container-fluid:after,
.container-fluid:before,
.container:after,
.container:before,
.dl-horizontal dd:after,
.dl-horizontal dd:before,
.form-horizontal .form-group:after,
.form-horizontal .form-group:before,
.modal-footer:after,
.modal-footer:before,
.modal-header:after,
.modal-header:before,
.nav:after,
.nav:before,
.navbar-collapse:after,
.navbar-collapse:before,
.navbar-header:after,
.navbar-header:before,
.navbar:after,
.navbar:before,
.pager:after,
.pager:before,
.panel-body:after,
.panel-body:before,
.row:after,
.row:before {
    display: table;
    content: ""
}

.direct-chat-img {
    border-radius: 50%;
    float: left;
    width: 40px;
    height: 40px
}

.direct-chat-text {
    border-radius: 5px;
    position: relative;
    padding: 5px 10px;
    background: #d2d6de;
    border: 1px solid #d2d6de;
    margin: 5px 0 0 50px;
    color: #444
}

.direct-chat-msg,
.direct-chat-text {
    display: block
}

.direct-chat-text:before {
    border-width: 6px;
    margin-top: -6px
}

.direct-chat-text:after,
.direct-chat-text:before {
    position: absolute;
    right: 100%;
    top: 15px;
    border: solid transparent;
    border-right-color: #d2d6de;
    content: ' ';
    height: 0;
    width: 0;
    pointer-events: none
}

.direct-chat-text:after {
    border-width: 5px;
    margin-top: -5px
}

.direct-chat-text:after,
.direct-chat-text:before {
    position: absolute;
    right: 100%;
    top: 15px;
    border: solid transparent;
    border-right-color: #d2d6de;
    content: ' ';
    height: 0;
    width: 0;
    pointer-events: none
}

:after,
:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box
}

.direct-chat-msg:after {
    clear: both
}

.direct-chat-msg:after {
    content: "";
    display: table
}

.direct-chat-info {
    display: block;
    margin-bottom: 2px;
    font-size: 12px
}

.right .direct-chat-img {
    float: right
}

.direct-chat-warning .right>.direct-chat-text {
    background: #f39c12;
    border-color: #f39c12;
    color: #fff
}

.right .direct-chat-text {
    margin-right: 50px;
    margin-left: 0
}

.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff
}

.box-header:before,
.box-body:before,
.box-footer:before,
.box-header:after,
.box-body:after,
.box-footer:after {
    content: "";
    display: table
}

.input-group-btn {
    position: relative;
    font-size: 0;
    white-space: nowrap
}

.input-group-btn:last-child>.btn,
.input-group-btn:last-child>.btn-group {
    z-index: 2;
    margin-left: -1px
}

.btn-warning {
    color: #fff;
    background-color: #f0ad4e;
    border-color: #eea236
}
.btn-warning {
    color: #fff;
    background-color: purple;
    border-color: #eea236;
}
@keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    video::-webkit-media-controls {
  display:none !important;
    }
    iframe:fullscreen {
    pointer-events: none !important;
    }

    .like {
          font: 15px/1.4 sans-serif;
          display: inline-block;
          padding: 3px 10px;
          cursor: pointer;
          box-shadow: inset 0 0 0 2px #0bf;
          font-weight: bold;
          user-select: none;
          border-radius: 8px;
          background: white;
        }
        .like:after {
          content: "❤";
          vertical-align: top;
          margin-left: 5px;
          border-radius: 8px;
        }

        .is-liked {
          background: #0bf;
          color: #fff;
          border-radius: 8px;
          
        }
        div.hearts {
    width: 200px;
    height: 600px;
    position: absolute;
    bottom: 0;
    left: 50%;
    margin-left: -50px;
}
div.heart {
    width: 30px;
    height: 30px;
    opacity: 1;
    position: absolute;
    bottom: 0;
    display: none;
}
div.heart i {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 1;
}
.colOne {
    color: #fce473;
}
.colTwo {
    color: #f68b39;
}
.colThree {
    color: #ed6c63;
}
.colFour {
    color: #847bb9;
}
.colFive {
    color: #97cd76;
}
.colSix {
    color: #35b1d1;
}
@keyframes flowOne {
    0% {
    opacity: 0;
    bottom: 0;
    left: 14%}
40% {
    opacity: .8;
}
50% {
    opacity: 1;
    left: 0;
}
60% {
    opacity: .2;
}
80% {
    bottom: 80%}
100% {
    opacity: 0;
    bottom: 100%;
    left: 18%}
}@keyframes flowTwo {
    0% {
    opacity: 0;
    bottom: 0;
    left: 0;
}
40% {
    opacity: .8;
}
50% {
    opacity: 1;
    left: 11%}
60% {
    opacity: .2;
}
80% {
    bottom: 60%}
100% {
    opacity: 0;
    bottom: 80%;
    left: 0;
}
}@keyframes flowThree {
    0% {
    opacity: 0;
    bottom: 0;
    left: 0;
}
40% {
    opacity: .8;
}
50% {
    opacity: 1;
    left: 30%}
60% {
    opacity: .2;
}
80% {
    bottom: 70%}
100% {
    opacity: 0;
    bottom: 90%;
    left: 0;
}
}
    
</style>




</html>