<?php

require_once 'db.php';

class Projects
{
    private $db;
    private $db_table = "projects";
    private $connection = null;

    private $tags;

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

    public function createProject($title, $description, $userId, $tags)
    {
        try {
            $sql = "INSERT INTO " . $this -> db_table . " (user_id, title, description, tags ) VALUES (:user_id, :title, :description, :tags)";
            $stmt = $this -> connection -> prepare($sql);
            $stmt -> bindParam(':title', $title);
            $stmt -> bindParam(':description', $description);
            $stmt -> bindParam(':user_id', $userId);
            $stmt -> bindParam(':tags', $tags);
            $stmt -> execute();

            echo 'project created';
            return true;
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function deleteProject($project_id)
    {
        try {
            $sql = "DELETE FROM " . $this -> db_table . " WHERE id = :project_id";
            $stmt = $this -> connection -> prepare($sql);
            $stmt -> bindParam(':project_id', $project_id);
            $stmt -> execute();
            // delete tags 
            $this -> tags -> deleteAllTagsForProject($project_id);
            return true;
        } catch (PDOException $e) {
            return $e -> getMessage();
        }
    }

    public function updateProject($project_id, $title, $description, $tags)
    {
      try {
        $sql = "UPDATE " . $this -> db_table . " SET title = :title, description = :description, tags = :tags WHERE id = :project_id";
          $stmt = $this -> connection -> prepare($sql);
          $stmt -> bindParam(':title', $title);
          $stmt -> bindParam(':description', $description);
          $stmt -> bindParam(':project_id', $project_id);
          $stmt -> bindParam(':tags', $tags);
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


    public function getUserProjects($userId)
    {
        $sql = "SELECT * FROM ". $this -> db_table ." WHERE user_id = :user_id";
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> bindParam(':user_id', $userId);
        $stmt -> execute();
        $projects = $stmt -> fetchAll();
        return $projects;
    }

    public function getAllProjects()
    {
        $sql = "SELECT * FROM ". $this -> db_table;
        $stmt = $this -> connection -> prepare($sql);
        $stmt -> execute();
        $projects = $stmt -> fetchAll();
        $json = json_encode($projects);
        return $json;
    }


    public function getAllTags()
    {
      // selet tags from projects table 
      $sql = "SELECT tags FROM ". $this -> db_table;
      $stmt = $this -> connection -> prepare($sql);
      $stmt -> execute();
      $tags = $stmt -> fetchAll();
    // create array to store all tags 
    // loop through tags and explode them into an array 
    // loop through the exploded array and push each tag into the all tags array 
      $allTags = array();
      foreach ($tags as $tag) {
        $tag = explode(',', $tag['tags']);
        foreach ($tag as $t) {
          if (!in_array($t, $allTags)) {
            array_push($allTags, $t);
          }
        }
      }
      $json = json_encode($allTags);
      return $json;
    }
}
