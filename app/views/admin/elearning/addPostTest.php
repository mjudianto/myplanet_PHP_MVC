<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Management E-learning</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item"><a href="course.html">Course</a>
								</li>
								<li class="breadcrumb-item"><a href="add-new-modul.html">Add Course</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Post Test</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->


				<hr />

				<div class="d-flex align-items-center">
					<div class="">
						<h6 class="mb-0 text-uppercase">Add Post Test</h6>
					</div>
					<div class="ms-auto mt-2 mb-3">
						<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
							data-bs-target="#modalAddByImport"><i
								class="fadeIn animated bx bx-import"></i>Import</button>
					</div>
				</div>
				<div class="row">
				<form action="<?= BASEURL ?>elearningmanagement/newTest" method="post">
				<input type="hidden" name="courseId" value="<?= $_GET['courseId'] ?>">
				<input type="hidden" name="moduleId" value="<?= $_GET['moduleId'] ?>">
				<input type="hidden" id="questionCounter" name="questionCounter" value="1">
					<div class="card">
						<div class="card-body">
							<div class="mb-4">
								<label class="form-label">Title Post Test</label>
								<input required name="testName" type="text" class="form-control is-invalid" placeholder="Title here...">
								<div class="invalid-feedback">Please enter a title.</div>
							</div>
							<div class="question-one" id="wrapperQuestion">
								<div class="card mb-3" id="sectionQuestion">
									<div class="card-body order-actions">
										<div class="mb-3">
											<label class="form-label">Question 1</label>
											<input required type="text" class="form-control bg-light-secondary" name="question-1"
												placeholder="Input question here...">
										</div>
										<div class="form-check d-flex align-items-center mb-2">
											<input required class="form-check-input me-2" type="radio" name="answer-1" value="1"
												id="questionOne1">
											<input type="text" class="form-control" name="choice1-1"
												placeholder="Answer here..">
										</div>
										<div class="form-check d-flex align-items-center mb-2">
											<input required class="form-check-input me-2" type="radio" name="answer-1" value="2"
												id="questionOne2">
											<input type="text" class="form-control" name="choice1-2"
												placeholder="Answer here..">
										</div>
										<div class="form-check d-flex align-items-center mb-2">
											<input required class="form-check-input me-2" type="radio" name="answer-1" value="3"
												id="questionOne3">
											<input type="text" class="form-control" name="choice1-3"
												placeholder="Answer here..">
										</div>
										<div class="form-check d-flex align-items-center mb-2">
											<input class="form-check-input me-2" type="radio" name="answer-1" value="4"
												id="questionOne4">
											<input required type="text" class="form-control" name="choice1-4"
												placeholder="Answer here..">
										</div>
										<div class="mb-3" style="float: right; width: 11%;">
											<label class="form-label">Score</label>
											<input name="score-1" type="text" class="form-control bg-light-success"
												placeholder="Input score...">
										</div>
									</div>
								</div>
								<div id="card-container"></div>

								<!-- <div class="card mb-3" id="sectionEssay" style="display: none;">
									<div class="card-body order-actions">
										<div class="mb-3">
											<label class="form-label">Essay</label>
											<input type="text" class="form-control"
												placeholder="Input question here...">
										</div>
									</div>
								</div>
								<div id="card-essay"></div> -->


								<div class="d-flex justify-content-end mb-3">
									<button type="button" class="btn btn-outline-primary radius-10 ms-2"
										id="newsectionbtn"><i class="bx bx-plus"></i>Add More</button>
								</div>
								<!-- <div class="card mb-3" id="sectionEssay">
									<div class="card-body order-actions">
										<div class="mb-3">
											<label class="form-label">Essay</label>
											<input type="text" class="form-control"
												placeholder="Input question here...">
										</div>
									</div>
								</div>
								<button type="button" class="btn btn-outline-warning radius-10" id="newEssayBtn"
									onclick="addNewEssay()" style="float: right;"><i
										class="fadeIn animated bx bx-message-alt-detail"></i>Add Essay</button> -->



							</div>

						</div>
					</div>
					<div class="d-flex justify-content-center">
						<button type="submit" class="btn btn-primary ms-2 radius-10">Submit</button>
					</div>
				</form>


				</div>
        <form action="<?= BASEURL ?>elearningmanagement/importTest?moduleId=<?= $_GET['moduleId'] ?>" method="post" enctype="multipart/form-data" id="testImport">
          <!-- Modal Box Add By Import -->
          <div class="modal fade" id="modalAddByImport" tabindex="-1" aria-labelledby="modalAddByImportLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalAddByImportLabel">Import Post Test</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body">
									<input type="hidden" name="courseId" value="<?= $_GET['courseId'] ?>">
                  <div class="mb-3">
                    <label for="modulName" class="form-label">Post Test Title</label>
                    <input required  type="text" class="form-control" name="testName" id="testName" placeholder="Enter Post Test Title">
                  </div>
                  <div class="mb-3">
                    <label for="modulName" class="form-label">Passing Score</label>
                    <input required  type="text" class="form-control" name="passingScore" id="passingScore" placeholder="Enter Passing Score">
                  </div>
                  <div class="mb-3">
                    <label for="modulName" class="form-label">Time Limit</label>
                    <label> ( As Minute! )</label>
                    <input required  type="text" class="form-control" name="timeLimit" id="timeLimit" placeholder="Enter Time Limit as Minute">
                  </div>
                  <div class="filter-akhir mb-3"><label for="filerDateAkhir" class="sr-only">End Date
                    Filters</label>
                    <div class="input-group mb-2 me-sm-2">
                      <input required  type="text" class="form-control datepickerakhir" name="endDate" id="endDate"
                        placeholder="dd/mm/yyyy" autocomplete="off">
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Question File</label>
                    <a href="/public/elearningAssets/test/questionTemplate.xlsx" download> ( Download Question Template File )</a>
                    <input required class="form-control" type="file" name="xlsx_file" id="xlsx_file">
                  </div>
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </form>

			</div>
		</div>
		<!--end page wrapper -->
		<script src="<?= BASEURL ?>admin/js/addMore.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>