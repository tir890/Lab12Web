<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        
        // Cek apakah variabel host sudah terisi
        if (empty($this->host)) {
            die("Error: Konfigurasi database kosong! Pastikan file config.php benar.");
        }

        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        
        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }

    private function getConfig() {
        // PERBAIKAN: Gunakan 'include' (bukan include_once)
        // Agar variabel $config terbaca di dalam fungsi ini
        include __DIR__ . '/../config.php'; 
        
        if(isset($config)) {
            $this->host = $config['host'];
            $this->user = $config['username'];
            $this->password = $config['password'];
            $this->db_name = $config['db_name'];
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function get($table, $where = null) {
        $sql = "SELECT * FROM " . $table;
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        $result = $this->conn->query($sql);
        if ($result) return $result->fetch_assoc();
        return null;
    }

    public function insert($table, $data) {
        if (is_array($data)) {
            $columns = implode(",", array_keys($data));
            $values  = "'" . implode("','", array_values($data)) . "'";
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            return $this->conn->query($sql);
        }
        return false;
    }

    public function update($table, $data, $where) {
        $update_value = [];
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $update_value[] = "$key='$val'";
            }
            $sets = implode(",", $update_value);
            $sql = "UPDATE $table SET $sets WHERE $where";
            return $this->conn->query($sql);
        }
        return false;
    }
}
?>