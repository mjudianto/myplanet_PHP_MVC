<?php 

class NotificationManagement extends Controller {

  public function index() {
    $data['notification'] = $this->model('user/Notification_model', 'Notification_model')->getAllNotification();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/notificationManagement', $data);
    $this->view('admin/layouts/footer');
  }

  public function addNotification() {
    
  }


}
  