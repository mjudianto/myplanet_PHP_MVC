<?php 

class UserManagement extends Controller {

  public function index() {
    $data['user'] = $this->model('user/User_model', 'User_model')->getAllUsers();
    $data['location'] = $this->model('user/Location_model', 'Location_model')->getAllLocation();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userManagement', $data);
    $this->view('admin/layouts/footer');
  }


}
  