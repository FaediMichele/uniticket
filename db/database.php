<?php
class DatabaseHelper
{
	private $db;

	public function __construct($servername, $username, $password, $dbname)
	{
		$this->db = new mysqli($servername, $username, $password, $dbname);
		if ($this->db->connect_error) {
			die("Connection failed to db");
		}
	}

	public function close(){
		$this->db->close();
	}

	public function createUser($username, $password, $email, $manager)
	{
		$stmt = $this->db->prepare("CALL createUser(?, ?, ?, ?, @idUser)");
		$stmt->bind_param("sssi", $username, $password, $email, $manager);
		$stmt->execute();

		// per ottenere i valori di out 
		$select = $this->db->query("SELECT @idEvent");
		$result = $select->fetch_assoc();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $this->MatrixToArray($result);
	}

	public function getUserParam($sessionId)
	{
		$stmt = $this->db->prepare("CALL getUserData(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();

		$result = $result->fetch_assoc();
		return $result;
	}

	public function createEvent($sessionId, $name, $description, $artist, $price, $date, $idRoom)
	{	//managerId, roomId, imageId and date are required fields
		$stmt = $this->db->prepare("CALL newEvent(?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssdsi", $sessionId, $name, $description, $artist, $price, $date, $idRoom);
		$stmt->execute();
		$select = $this->db->query("SELECT @idEvent");

		$result = $select->fetch_assoc();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $this->MatrixToArray($result);
	}

	public function userIsLogged($sessionId){
		$stmt = $this->db->prepare("CALL userLogged(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result;
	}

	public function getLocationsAndRoom($sessionId)
	{
		$stmt = $this->db->prepare("CALL getLocationsAndRoom(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		print_r($result);
		return $result;
	}

	public function getUpcomingEvents($sessionId, $quantity = 10, $offset = 0)
	{
		$stmt = $this->db->stmt_init();
		$stmt = $this->db->prepare("CALL getEventHome(?, ?, ?)");
		$stmt->bind_param("bii", $sessionId, $quantity, $offset);
		$stmt->execute();
		try{
			$result = $stmt->get_result();
			$result = $result->fetch_all(MYSQLI_NUM);
		} catch (ERROR $e) {
			echo "0 Events availabe. I think we have a problem...";
		}
		return $result;
	}

	public function ticketAvailable($eventId)
	{
		$stmt = $this->db->prepare("CALL ticketAvaliable(?, @n);");
		$stmt->bind_param("i", $eventId);
		$stmt->execute();

		// per ottenere i valori di out 
		$select = $this->db->query("SELECT @idEvent");
		$result = $select->fetch_assoc();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $this->MatrixToArray($result);
	}

	public function logIn($username, $password)
	{
		$stmt = $this->db->prepare("CALL logIn(?, ?)");
		$stmt->bind_param("ss", $username, $password);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows() != 1) {
			return 0;
		}
		$stmt->bind_result($result);
		$stmt->fetch();
		return $result;
	}

	public function logOut($sessionId)
	{
		$stmt = $this->db->prepare("CALL logOut(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
	}


	public function getEventInfo($eventId)
	{
		$stmt = $this->db->prepare("CALL getEventInfo(?)");
		$stmt->bind_param("i", $eventId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
 	}
	

	/************************************************************/
	//TEMPORANEA
	public function getEvents()
	{
		//$stmt = $this->db->stmt_init();
		$stmt = $this->db->prepare("SELECT idEvent FROM event");
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result;
	}
	/************************************************************/

	//trasforma una matrice[n][1] in un array[n] 
	public function MatrixToArray($m)
	{
		$output = array();
		foreach ($m as $r) {
			$output[] = $r[0];	//array[] = significa push
		}
		return $output;
	}
}