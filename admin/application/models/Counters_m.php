<?php
class Counters_m extends CI_Model {

    private $table = '';
    public $data = array(
        'id' => '',
        'today' => '',
        'week' => '',
        'month' => '',
        'year' => '',
        'properties' => ''
    );

    function __construct() {

        parent::__construct();

        $this->table = 'counters';
    }

    public function update() {

        $properties = array('day' => date('d'),
            'week' => date('W'),
            'month' => date('m'),
            'year' => date('Y'));

        $sql = "UPDATE " . $this->table;

        $sql .= " SET today = today + 1/2, week = week + 1/2, month = month + 1/2, year = year + 1/2,   properties = '" . serialize($properties) . "' ";

        $sql .= " WHERE id = 1";

        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function updateCounter($datas) {

        $this->db->update($this->table, $datas, array('id' => 1));

        return $this->db->affected_rows();
    }

    public function getCounter() {

        $this->db->where('id', 1);

        $this->db->limit(1);

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {

            $result = $query->row();

            $query->free_result();

            return $result;
        } else
            return '';
    }

    public function resetCounter() {

        $this->db->select('today,properties');

        $this->db->where('id', 1);

        $this->db->limit(1);

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {

            $result = $query->row();

            $query->free_result();

            $properties = unserialize($result->properties);

            if ($properties['day'] != date('d')) {

                $this->db->update($this->table, array('yesterday' => $result->today), array('id' => 1));

                $this->resetToday();
            }



            if ($properties['week'] != date('W'))
                $this->resetWeek();

            if ($properties['month'] != date('m'))
                $this->resetMonth();

            if ($properties['year'] != date('Y'))
                $this->resetYear();

            return 1;
        } else
            return '';
    }

    public function resetToday() {

        $this->db->update($this->table, array('today ' => 1), array('id' => 1));
    }

    public function resetWeek() {

        $this->db->update($this->table, array('week ' => 1), array('id' => 1));
    }

    public function resetMonth() {

        $this->db->update($this->table, array('month ' => 1), array('id' => 1));
    }

    public function resetYear() {

        $this->db->update($this->table, array('year ' => 1), array('id' => 1));
    }

}

?>