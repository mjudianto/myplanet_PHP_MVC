function toggleCollapse(col) {
  if (col.currentTarget.lastElementChild.classList.contains("arrow-rotate")) {
    col.currentTarget.lastElementChild.className =
      "fa-chevron-up fa arrow-button";
  } else {
    col.currentTarget.lastElementChild.className =
      "fa-chevron-up fa arrow-button arrow-rotate";
  }
}
