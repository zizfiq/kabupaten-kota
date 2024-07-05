<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class User {
    public $id;
    public $username;
    public $email;
    public $password;
    public $no_hp;
    public $role;

    private $connection;
    private $table = 'tb_user';

    public function __construct($db) {
        $this->connection = $db;
    }

    public function home() {
        return "Selamat Datang di API User versi 1.0!";
    }

    public function readUsers() {
        // kueri untuk membaca data dari tabel
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';
        $data = $this->connection->prepare($query);
        $data->execute();
        return $data;
    }

    public function readUserById($_id) {
        $this->id = $_id;
        // kueri untuk membaca data dari tabel
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id=?';
        $data = $this->connection->prepare($query);
        $data->bindValue(1, $this->id, PDO::PARAM_INT);
        $data->execute();
        return $data;
    }

    public function createUser($params) {
        try {
            // memberikan nilai
            $this->username = $params['username'];
            $this->email = $params['email'];
            $this->password = $params['password'];
            $this->no_hp = $params['no_hp'];
            $this->role = $params['role'];

            // kueri untuk memasukkan data ke dalam tabel
            $query = "INSERT INTO " . $this->table . " SET
                      username = :username,
                      email = :email,
                      password = :password,
                      no_hp = :no_hp,
                      role = :role";

            $data = $this->connection->prepare($query);
            $data->bindValue(':username', $this->username);
            $data->bindValue(':email', $this->email);
            $data->bindValue(':password', $this->password);
            $data->bindValue(':no_hp', $this->no_hp);
            $data->bindValue(':role', $this->role);

            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateUser($params) {
        try {
            // memberikan nilai
            $this->id = $params['id'];
            $this->username = $params['username'];
            $this->email = $params['email'];
            $this->password = $params['password'];
            $this->no_hp = $params['no_hp'];
            $this->role = $params['role'];

            // kueri untuk memperbarui seluruh field data
            $query = "UPDATE " . $this->table . " SET
                      username = :username,
                      email = :email,
                      password = :password,
                      no_hp = :no_hp,
                      role = :role
                      WHERE id = :id";

            $data = $this->connection->prepare($query);
            $data->bindValue(':id', $this->id);
            $data->bindValue(':username', $this->username);
            $data->bindValue(':email', $this->email);
            $data->bindValue(':password', $this->password);
            $data->bindValue(':no_hp', $this->no_hp);
            $data->bindValue(':role', $this->role);

            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteUser($id) {
        try {
            // memberikan nilai
            $this->id = $id;
            // kueri untuk menghapus data
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            $data = $this->connection->prepare($query);
            $data->bindValue(':id', $this->id);

            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
