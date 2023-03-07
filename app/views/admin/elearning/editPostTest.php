<div class="page-wrapper">

<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal" data-bs-target="#modalAddByImport">
Import
</button>

<form action="<?= BASEURL ?>elearningmanagement/importTest?moduleId=&testId=<?= $_GET['testId'] ?>" method="post" enctype="multipart/form-data" id="testImport">
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
						<input type="hidden" name="testId" value="<?= $_GET['testId'] ?>">
            <div class="mb-3">
              <label for="modulName" class="form-label">Post Test Title</label>
              <input required  type="text" class="form-control" name="testName" id="testName" placeholder="Enter Post Test Title" value="<?= $data['elearningTest']['judul'] ?>">
            </div>
            <div class="mb-3">
              <label for="modulName" class="form-label">Passing Score</label>
              <input required  type="text" class="form-control" name="passingScore" id="passingScore" placeholder="Enter Passing Score" value="<?= $data['elearningTest']['passingScore'] ?>">
            </div>
            <div class="mb-3">
              <label for="modulName" class="form-label">Time Limit</label>
              <label> ( As Minute! )</label>
              <input required  type="text" class="form-control" name="timeLimit" id="timeLimit" placeholder="Enter Time Limit as Minute" value="<?= $data['elearningTest']['timeLimit']/60000 ?>">
            </div>
            <div class="filter-akhir mb-3"><label for="filerDateAkhir" class="sr-only">End Date
              Filters</label>
              <div class="input-group mb-2 me-sm-2">
                <input  type="text" class="form-control datepickerakhir" name="endDate" id="endDate"
                  placeholder="dd/mm/yyyy" autocomplete="off" value="<?= $data['elearningTest']['endDate'] ?>">
              </div>
            </div>
            <div class="mb-3">
              <label for="formFile" class="form-label">Question File</label>
              <a href="/public/elearningAssets/test/questionTemplate.xlsx" download> ( Download Question Template File )</a>
              <input  class="form-control" type="file" name="xlsx_file" id="xlsx_file">
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