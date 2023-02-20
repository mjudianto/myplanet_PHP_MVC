// Add more question

const cardContainer = document.getElementById("card-container");
const addMoreBtn = document.getElementById("newsectionbtn");

let cardCount = 1;

addMoreBtn.addEventListener("click", function () {
  $('#questionCounter').val(cardCount+1);
  const newCard = document.createElement("div");
  newCard.classList.add("card", "mb-3");
  newCard.id = "sectionQuestion" + cardCount;
  newCard.innerHTML = `
    <div class="card-body order-actions">
      <div class="mb-3">
        <label class="form-label">Question ${cardCount + 1}</label>
        <input type="text" name="question-${cardCount + 1} class="form-control bg-light-secondary" placeholder="Input question here...">
      </div>
      <div class="form-check d-flex align-items-center mb-2">
        <input value="1" class="form-check-input me-2" type="radio" name="answer-${
          cardCount + 1
        }" id="question${cardCount + 1}1">
        <input type="text" class="form-control" name="choice${
          cardCount + 1
        }-1" required placeholder="Answer here..">
      </div>
      <div class="form-check d-flex align-items-center mb-2">
        <input value="2" class="form-check-input me-2" type="radio" name="answer-${
          cardCount + 1
        }" id="question${cardCount + 1}2">
        <input type="text" class="form-control" name="choice${
          cardCount + 1
        }-2" required placeholder="Answer here..">
      </div>
      <div class="form-check d-flex align-items-center mb-2">
        <input value="3" class="form-check-input me-2" type="radio" name="answer-${
          cardCount + 1
        }" id="question${cardCount + 1}3">
        <input type="text" class="form-control" name="choice${
          cardCount + 1
        }-3" required placeholder="Answer here..">
      </div>
      <div class="form-check d-flex align-items-center mb-2">
        <input value="4" class="form-check-input me-2" type="radio" name="answer-${
          cardCount + 1
        }" required id="question${cardCount + 1}4">
        <input type="text" class="form-control" name="choice${
          cardCount + 1
        }-4" placeholder="Answer here..">
      </div>
      <div class="mb-3" style="float: right; width: 11%;>
		    <label class="form-label">Score</label>
		    <input type="text" class="form-control bg-light-success"
			    placeholder="Input score..." name="score-${
            cardCount + 1
          }>
	    </div> 
    </div>
  `;
  cardContainer.appendChild(newCard);
  cardCount++;
});

// Add Essay
function addNewEssay() {
  const existingSections = document.querySelectorAll(".card.mb-3"); // get all existing essay sections
  const newSectionId = `sectionEssay-${existingSections.length + 1}`; // create a new section ID

  // create a new card element with the new ID
  const newCard = document.createElement("div");
  newCard.classList.add("card", "mb-3");
  newCard.setAttribute("id", newSectionId);

  // create the card body and input element
  const cardBody = document.createElement("div");
  cardBody.classList.add("card-body", "order-actions");
  const inputLabel = document.createElement("label");
  inputLabel.classList.add("form-label");
  inputLabel.textContent = "Essay";
  const inputElement = document.createElement("input");
  inputElement.classList.add("form-control");
  inputElement.setAttribute("type", "text");
  inputElement.setAttribute("placeholder", "Input question here...");

  // assemble the card and append it to the page
  cardBody.appendChild(inputLabel);
  cardBody.appendChild(inputElement);
  newCard.appendChild(cardBody);
  const addButton = document.getElementById("newEssayBtn");
  addButton.insertAdjacentElement("beforebegin", newCard);
}
