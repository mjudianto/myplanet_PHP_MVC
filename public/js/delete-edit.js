$(document).ready(function () {
  $(".notification_icon .delete-edit").click(function () {
    $(".dropdown").toggleClass("active");
  });
});

$(document).ready(function () {
  $(".notification_icon .delete-edit").click(function () {
    $(".dropdown-activity").toggleClass("active");
  });
});

$(document).ready(function () {
  $(".more-btn-section-comment .delete-edit-section-comment").click(
    function () {
      $(".menu-sec-comment").toggleClass("active");
    }
  );
});
