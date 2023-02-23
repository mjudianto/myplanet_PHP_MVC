const orgSelect = document.getElementById("orgSelect");
const orgTableBody = document.querySelector("#orgTable tbody");

orgSelect.addEventListener("change", () => {
  const selectedOrg = orgSelect.value;

  const newRow = document.createElement("tr");
  const orgCell = document.createElement("td");
  orgCell.textContent = selectedOrg;
  newRow.appendChild(orgCell);

  const actionCell = document.createElement("td");
  const trashBtn = document.createElement("button");
  trashBtn.innerHTML = '<i class="bx bxs-trash"></i>';
  trashBtn.classList.add("btn", "btn-light-danger");
  trashBtn.addEventListener("click", () => {
    newRow.remove();
  });
  actionCell.appendChild(trashBtn);
  newRow.appendChild(actionCell);

  orgTableBody.appendChild(newRow);
});

const userSelect = document.getElementById("userSelect");
const userTableBody = document.querySelector("#userTable tbody");

userSelect.addEventListener("change", () => {
  const selectedUser = userSelect.value;

  const newRowUser = document.createElement("tr");
  const userCell = document.createElement("td");
  userCell.textContent = selectedUser;
  newRowUser.appendChild(userCell);

  const actionCellUser = document.createElement("td");
  const trashBtnUser = document.createElement("button");
  trashBtnUser.innerHTML = '<i class="bx bxs-trash"></i>';
  trashBtnUser.classList.add("btn", "btn-light-danger");
  trashBtnUser.addEventListener("click", () => {
    newRowUser.remove();
  });
  actionCellUser.appendChild(trashBtnUser);
  newRowUser.appendChild(actionCellUser);

  userTableBody.appendChild(newRowUser);
});