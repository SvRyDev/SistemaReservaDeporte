<?php
class SampleModel extends Model {
    public function getData() {
        $result = $this->db->query("SELECT * FROM sample_table");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
