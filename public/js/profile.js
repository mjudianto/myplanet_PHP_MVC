// function toggleTab(tabName) {
//   //   $("#collapseProfile").collapse({
//   //     toggle: false,
//   //   });
//   //   $("#collapseTraining").collapse({
//   //     toggle: false,
//   //   });
//   //   $("#collapseCertificate").collapse({
//   //     toggle: false,
//   //   });
//   //   $("#collapseProfile").collapse({
//   //     toggle: false,
//   //   });
//   //   if (tabName == "profile") {
//   //     $("#collapseProfile").collapse({
//   //       toggle: true,
//   //     });
//   //   } else if (tabName == "training") {
//   //     $("#collapseTraining").collapse({
//   //       toggle: true,
//   //     });
//   //   } else if (tabName == "certificate") {
//   //     $("#collapseCertificate").collapse({
//   //       toggle: true,
//   //     });
//   //   } else if (tabName == "changepass") {
//   //     $("#collapseProfile").collapse({
//   //       toggle: true,
//   //     });
//   //   }
// }

// var $profileTab = $("#profileTab");
// $profileTab.on("show.bs.collapse", ".collapse", function () {
//   $profileTab.find(".collapse.in").collapse("hide");
// });

function toggleBtn(evt, menuName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("profile-info");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.transform = "scaleY(0.2)";
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" selected", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.className += " selected";
  setTimeout(() => {
    document.getElementById(menuName).style.transform = "scaleY(1)";
  }, 50);
}

window.onload = (event) => {
  document.getElementById("profile").style.display = "block";
  document.getElementById("profile").style.transform = "scaleY(1)";
};
