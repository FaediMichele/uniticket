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
		$stmt = $this->db->prepare("CALL createUser(?, ?, ?, ?)");
		$stmt->bind_param("sssi", $username, $password, $email, $manager);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_NUM)[0][0];
	}

	public function blockUser($sessionId, $username, $message){
		$stmt = $this->db->prepare("CALL blockUser(?, ?, ?)");
		$stmt->bind_param("sss", $sessionId, $username, $message);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_NUM)[0][0];
	}
	public function unlockUser($sessionId, $username){
		$stmt = $this->db->prepare("CALL unlockUser(?, ?)");
		$stmt->bind_param("ss", $sessionId, $username);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_NUM)[0][0];
	}

	public function blockEvent($sessionId, $idEvent, $message){
		$stmt = $this->db->prepare("CALL blockEvent(?, ?, ?)");
		$stmt->bind_param("sis", $sessionId, $idEvent, $message);
		$stmt->execute();
		$result = $stmt->get_result();
		
		return $result->fetch_all(MYSQLI_NUM)[0][0];
	}

	public function unlockEvent($sessionId, $idEvent, $message){
		$stmt = $this->db->prepare("CALL unlockEvent(?, ?, ?)");
		$stmt->bind_param("sis", $sessionId, $idEvent, $message);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_NUM)[0][0];
	}

	public function createNotice($sessionId, $idEvent, $message, $date){
		$stmt = $this->db->prepare("CALL createNotice(?, ?, ?, ?)");
		$stmt->bind_param("siss", $sessionId, $idEvent, $message, $date);
		$stmt->execute();
		$result = $stmt->get_result();
		var_dump(mysqli_error($this->db));
		$result = $result->fetch_all(MYSQLI_NUM)[0][0];
		return $result;
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

	public function addImageToEvent($sessionId, $idEvent, $imgNumber, $img){
		$stmt = $this->db->prepare("CALL addImageToEvent(?, ?, ?, ?)");
		$stmt->bind_param("siis", $sessionId, $idEvent, $imgNumber, $img);
		$stmt->execute();
		$result = $stmt->get_result();
		var_dump(mysqli_error($this->db));
	}

	public function getNotice($sessionId){
		$stmt = $this->db->prepare("CALL getNotification(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}


	public function createEvent($sessionId, $name, $description, $artist, $price, $date, $idRoom) {	
		$stmt = $this->db->prepare("CALL newEvent(?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssdsi", $sessionId, $name, $description, $artist, $price, $date, $idRoom);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		return $result;
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
		
		print_r(mysqli_error($this->db));
		$result = $stmt->get_result();
		$num_rows = $result->num_rows;
		$result = $result->fetch_all(MYSQLI_ASSOC);

		$array = array();

		// convert the result in {Location=>{Room=>idRoom}}.
		for($i = 0; $i < $num_rows; $i++){
			if(isset($array[strval($result[$i]["Location"])])){
				$tmp = array($result[$i]["Room"] => $result[$i]["idRoom"]);
				$array[strval($result[$i]["Location"])] = array_merge($array[strval($result[$i]["Location"])] , $tmp);
			} else{
				$array[strval($result[$i]["Location"])] = array($result[$i]["Room"] => $result[$i]["idRoom"]);	
			}
		}

		return $array;
	}

	public function getRoomData($eventId)
	{
		$stmt = $this->db->prepare("CALL getRoomData(?)");
		$stmt->bind_param("i", $eventId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}
	public function confirmMail($code){
		$stmt = $this->db->prepare("CALL confirmMail(?)");
		$stmt->bind_param("s", $code);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result;
	}

	public function getUpcomingEvents($sessionId, $quantity = 5, $offset = 0)
	{
		$stmt = $this->db->stmt_init();
		$stmt = $this->db->prepare("CALL getEventHome(?, ?, ?)");
		$stmt->bind_param("sii", $sessionId, $offset, $quantity);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
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

	public function getAgenda($sessionId){
		$stmt = $this->db->prepare("CALL getAgenda(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function getUserOrders($sessionId)
	{
		$stmt = $this->db->prepare("CALL getUserOrders(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function getEventImages($eventId)
	{
		$stmt = $this->db->prepare("CALL getEventImage(?)");
		$stmt->bind_param("i", $eventId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function searchEvent($text){
		$stmt = $this->db->stmt_init();
		$stmt = $this->db->prepare("CALL searchEvent(?)");
		$stmt->bind_param("s", $text);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result;
	}


	public function checkEmail($email){
		$stmt = $this->db->prepare("CALL checkEmail(?)");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result;
	}

	public function checkUsername($username){
		$stmt = $this->db->prepare("CALL checkUsername(?)");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result;
	}

	public function getManagedEvent($sessionId)
	{
		$stmt = $this->db->prepare("CALL getManagedEvent(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function addTicketToCart($sessionId, $idEvent, $nTicket)
	{
		$stmt = $this->db->prepare("CALL addTicketToCart(?,?,?)");
		$stmt->bind_param("sii", $sessionId, $idEvent, $nTicket);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result[0];
	}

	public function isEventPresent($eventId){
		$stmt = $this->db->prepare("SELECT idEvent FROM event WHERE idEvent = ?");
		$stmt->bind_param("i", $idEvent);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows == 0) {
			// row not found, do stuff...
			//echo "falso";
			return false;
		} else {
			// do other stuff...
			//echo "vero";
			return true;
		}
	}

	public function getEventsInCart($sessionId)
	{
		$stmt = $this->db->prepare("CALL getEventsInCart(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result;
	}

	public function getNoticeToRead($sessionId){
		$stmt = $this->db->prepare("CALL getNoticeToRead(?)");
		$stmt->bind_param("s", $sessionId);
		$stmt->execute();
		$result = $stmt->get_result();		
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}

	public function readNotice($sessionId, $idEvent){
		$stmt = $this->db->prepare("CALL noticeRead(?, ?)");
		$stmt->bind_param("si", $sessionId, $idEvent);
		$stmt->execute();
		echo mysqli_error($this->db);
	}

	public function addLocation($sessionId, $name, $address, $cap, $tel, $email){
		$stmt = $this->db->prepare("CALL newLocation(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssss", $sessionId, $name, $address, $tel, $email, $cap);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		return $result;
	}

	public function addRoom($sessionId, $name, $capacity, $locationName){
		$stmt = $this->db->prepare("CALL newRoom(?, ?, ?, ?)");
		$stmt->bind_param("ssds", $sessionId, $name, $capacity, $locationName);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		return $result;
	}


	public function buyTicket($sessionId, $idEvent){
		$stmt = $this->db->prepare("CALL buyTicket(?,?)");
		$stmt->bind_param("si", $sessionId, $idEvent);
		$stmt->execute();
		$result = $stmt->get_result();
		$result = $result->fetch_all(MYSQLI_NUM);
		return $result[0][0];
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