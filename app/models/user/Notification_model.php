<?php 

include_once '../app/core/Database.php';

class Notification_model {
  private $table = 'notification';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllNotification() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getUserNotification($userId, $orgId) {
    $this->db->query('select * from ' . $this->table . ' where access_type=0 and state=1
                      union
                      select ' . $this->table . '.* from userNotification
                      left join ' . $this->table . ' on ' . $this->table . '.notificationId = userNotification.notificationId
                      where ' . $this->table . '.access_type=2
                      and userNotification.userId=:userId
                      and userNotification.state=1
                      and notification.state=1
                      union
                      select ' . $this->table . '.* from organizationNotification
                      left join ' . $this->table . ' on ' . $this->table . '.notificationId = organizationNotification.notificationId
                      where ' . $this->table . '.access_type=2
                      and organizationNotification.organizationId=:orgId
                      and organizationNotification.state=1
                      and notification.state=1');
    $this->db->bind('userId', $userId);
    $this->db->bind('orgId', $orgId);

    return $this->db->resultSet();
  }

  public function countNotification() {
    
  }

  

}