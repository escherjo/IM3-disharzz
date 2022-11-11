<?php

require_once 'db.php';

class Projects
{
    private $db;
    private $db_table = "projects";
    private $connection = null;

    public function __construct()
    {
        // check if the connection is already established
        if ($this -> connection == null) {
            // create a new connection
            $this -> db = new DBConnection();
            $this -> connection = $this -> db -> connect();
        }
    }

    public function __destruct()
    {
        //close pdo connection
        $this -> connection = null;
    }

    public function isOwner($project_id, $user_id)
    {
        $sql = "SELECT * FROM " . $this -> db_table . " WHERE id = :project_id AND user_id = :user_id";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> bindParam(':project_id', $project_id);
        $stmt -> bindParam(':user_id', $user_id);
        $stmt -> execute();
        $result = $stmt -> fetch();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getProject($project_id)
    {
        $sql = "SELECT * FROM " . $this -> db_table . " WHERE id = :project_id";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> bindParam(':project_id', $project_id);
        $stmt -> execute();
        $project = $stmt -> fetch();
        return $project;
    }

    public function getProjects($userId)
    {
        $sql = "SELECT * FROM ". $this -> db_table ." WHERE user_id = :user_id";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> bindParam(':user_id', $userId);
        $stmt -> execute();
        $projects = $stmt -> fetchAll();
        return $projects;
    }

    public function createProject($title, $description, $userId)
    {
        $sql = "INSERT INTO " . $this -> db_table . " (title, description, user_id) VALUES (:title, :description, :user_id)";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> bindParam(':title', $title);
        $stmt -> bindParam(':description', $description);
        $stmt -> bindParam(':user_id', $userId);
        $stmt -> execute();
    }

    public function deleteProject($project_id)
    {
        try {
            $sql = "DELETE FROM " . $this -> db_table . " WHERE id = :project_id";
            $stmt = $this -> connection -> prepare($sql);
            $stmt -> bindParam(':project_id', $project_id);
            $stmt -> execute();
            return true;
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function updateProject($project_id, $title, $description)
    {
      try {
          $sql = "UPDATE " . $this -> db_table . " SET title = :title, description = :description WHERE id = :project_id";
          $stmt = $this -> connection -> prepare($sql);
          $stmt -> bindParam(':title', $title);
          $stmt -> bindParam(':description', $description);
          $stmt -> bindParam(':project_id', $project_id);
          $stmt -> execute();
          return true;
      } catch (PDOException $e) {
          return $e -> getMessage();
      }
    }

    public function getLastID()
    {
        return $this -> connection -> lastInsertId();
    }

    public function getAllProjects()
    {
        $sql = "SELECT * FROM ". $this -> db_table;
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute();
        $projects = $stmt -> fetchAll();
        return $projects;
    }
}
