<?php
namespace App\Core;

use App\Core\ResourceModelInterface;
use App\Config\Database;

class ResourceModel implements ResourceModelInterface
{
	private $table;
	private $id;
	private $model;

	public function _init($table, $id,$model)
	{
		$this->table = $table;
		$this->id = $id;
		$this->model = $model;
	}

    public function save()
    {
    	$sql = "INSERT INTO " . $this->table . " (" . $this->model->getProperties() . "created_at, updated_at) VALUES ("
    		. $this->model->getValue() . ":created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function showAllTasks()
    {
        $sql = "SELECT * FROM " . $this->table;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function edit($id)
    {
        $sql = "UPDATE tasks SET " . $this->model->update() ."updated_at = :updated_at WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function delete($id)
    {
    	$sql = "DELETE FROM " . $this->table . " WHERE ". $this->id . " = " . $id . ";";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute();
    }
}