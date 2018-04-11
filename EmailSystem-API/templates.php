<?php 

// echo 'list.php is used';

class templates {
	// function __construct() {
	// 	echo 'constructor -- emailList object is created';
	// }

	// public function insertMethod() {
	// 	echo 'using insert method';
	// }

	/**
	* @Method othermethod
	* @Input int id input id to delete
	* @Output boolean if true delete
	* Detail-.....
	*/
	// public function deleteMethod($id) {
	// 	echo 'using delete method' . $id;
	// 	return true;
	// }

	public function indexMethod() {
		return 'template index action is working';

	}

	/**
	* Method : POST
	* URL : template/save
	* 
	* Request body format
	* req - post:
	*
	*{
	*	"content": "<h1> html content </h1>",
	*	"name":		"template 1",
	*	"var":		"var1; var2"
	*}
	*
	*	will return format":
	*	json:
	*	{
	*		"code":  200,
	*		"message":  "success"
	*	}
	*/
	public function saveMethod() {
		$content = $_POST['content'];
		$name    = $_POST['name'];
		$var     = $_POST['var'];

		$conn = new DBConnection();
		$result = $conn->addTemplate($content, $name, $var);

		if($result) {
			return json_encode(array(
				'code' => 200,
				'message' => "Template add successfully"
			));
		} else {
			return json_encode(array(
				'code' => 500,
				'message' => "Template add failed"
			));
		}

	}

	/*
	* Request body format
	* method: GET
	* URL: templates/get
	* will return:
	* json:
	* [
	*	{
	*     "id": 1,
	*	  "content": "hello",
	*	  "name": "template 1",
	*	  "var": "var1; var2",
	*	},
	*	{
	*     "id": 1,
	*	  "content": "hello2",
	*	  "name": "template 2",
	*	  "var": "var1; var2",
	*	}
	* ]
	*/

	public function getMethod() {
		$conn = new DBConnection();
		$result = $conn->getAllTemplates();

		if($result) {
			return json_encode($result);
		} else {
			return json_encode(array(
				'code' => 400,
				'message' => "No Template exit"
			));
		}


	}
}





 ?>