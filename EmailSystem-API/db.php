<?php 

class DBConnection {
	protected $connection;

	public function getConnInstance() {
		if (!isset($this->connection)) {
			$this->connection = new PDO('mysql:host=localhost;dbname=rest;charset=utf8mb4', 
				'root', 'root');
		}

		return $this->connection;
	}

	public function addTemplate($content, $name, $vars) {
		// TODO: Add check - content name

		// Add to database
		$sql = "INSERT INTO templates(tcontent, tname, tvar) VALUES (:content, :name, :vars)";

		$stmt = $this->getConnInstance()->prepare($sql);
		$result = $stmt->execute(
			array(
				':content' => $content,
				':name' => $name,
				':vars' => $vars
			)
		);

		return $result;

	}

	public function getAllTemplates() {
		$sql = "SELECT * FROM templates";
		
		$stmt = $this->getConnInstance()->query($sql);

		$templates = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// TODO: Array to object , add template.class

		$result = array();
		foreach ($templates as $template) {
			$temp = array(
				'content' => $template['tcontent'],
				'name' => $template['tname'],
				'vars' => $template['tvar'],
				'id' => $template['tid']
			);

			$result[] = $temp;
		}

		return $result;
	}

	public function getTemplateById($id) {
		$sql = "SELECT * FROM templates where tid = :tid";
		
		$stmt = $this->getConnInstance()->prepare($sql);

		$stmt->execute(
			array(
				':tid' => $id
			)
		);

		$template = $stmt->fetch();

		$result = array(
			'content' => $template['tcontent'],
			'name' => $template['tname'],
			'vars' => $template['tvar'],
			'id' => $template['tid']
		);

		return $result;
	}

}


// $db = new DBConnection();

// $sth = $db->getTemplateById(1);
// var_dump($sth);



