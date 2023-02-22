<?php 

class Report extends Controller {

  public function testReport() {
    $model = $this->loadElearningModel();

    $data['testRecord'] = $model['userTestRecord']->getAllRecord();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/report/testReport', $data);
    $this->view('admin/layouts/footer');
  }

  public function lessonReport() {
    $model = $this->loadElearningModel();

    $data['lessonRecord'] = $model['userLessonRecord']->getAllRecord();
    // $data['lessonRecord'] = array_slice($data['lessonRecord'], 0, 20000);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/report/lessonReport', $data);
    $this->view('admin/layouts/footer');
  }

  public function filterDate() {
    $model = $this->loadElearningModel();

    $start_date = $_REQUEST['startDate'];
    $end_date = $_REQUEST['endDate'];

    $data = $model['userTestRecord']->getAllRecord();


    $filtered_data = array_filter($data, function($item) use ($start_date, $end_date) {
      if (empty($item)) {
        $item_date = strtotime($item['time']);
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        
        if ($_REQUEST['startDate'] != '') {
          if ($_REQUEST['endDate'] != '') {
            return ($item_date >= $start) && ($item_date <= $end);
          } else {
            return ($item_date >= $start);
          }
        } else {
          if ($_REQUEST['endDate'] != '') {
            return ($item_date <= $end);
          }
        }
      }
      return;
      
    });

    $i=1;

    foreach($filtered_data as $record) {
      if ($record['nik'] != '') {
        echo '<tr>
                <td>' . $i . '</td>
                <td>' . $record['nik'] . '</td>
                <td>' . $record['nama'] . '</td>
                <td>' . $record['judul'] . '</td>
                <td>' . $record['totalAttempt'] . '</td>
                <td>' . $record['score'] . '</td>
                <td>';

        if ($record['status'] == 'Lulus') {
            echo '<div
                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                    Lulus
                  </div>';
        } else {
          echo  '<div
                    class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                    Tidak Lulus
                  </div>';
        }
                  
        echo   '</td>
                <td>' . $record['time'] . '</td>
                <td>' . $record['locationName'] . '</td>
                <td>' . $record['organizationName'] . '</td>
              </tr>';
        $i+=1;
      }
    }
  }
}