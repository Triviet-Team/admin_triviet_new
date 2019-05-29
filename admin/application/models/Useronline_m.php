<?php
class Useronline_m extends CI_Model {

    private $table = '';
    public $data = array(
        'session_id' => '',
        'time' => '',
        'local' => ''
    );

    function __construct() {
        parent::__construct();
        $this->table = 'user_online';
    }

    public function addDatas($datas) {
        $this->db->insert($this->table, $datas);
        return $this->db->insert_id();
    }

    public function getOnline() {
        $this->db->select('session_id');
        $this->db->distinct();
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $results = $query->num_rows();
            $query->free_result();
            return $results;
        } else
            return 1;
    }

    public function clear($time) {
        $sql = "DELETE FROM " . $this->table . " WHERE `time` < " . $time;
        $this->db->query($sql);
    }

    public function checkExits($session_id) {
        $this->db->select('session_id');
        $this->db->where('session_id', $session_id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $query->free_result();
            return 1;
        } else
            return 0;
    }

    public function updateTime($time, $local, $session_id) {
        $this->db->update($this->table, array('time' => $time, 'local' => $local), array('session_id' => $session_id));
        return $this->db->affected_rows();
    }

}

?>