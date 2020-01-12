<?php
	class DatabaseHelper{
		private $db;

		public function __construct($servername, $username, $password, $dbname){
			$this->db = new mysqli($servername, $username, $password, $dbname);
			if($this->db->connect_error){
				die("Connection failed to db");
			}
		}

		public function createUser($username, $password, $email){
			$stmt = $this->db->prepare("INSERT INTO `User` (`username`, `password`, `email`) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $username, $password, $email);
			$stmt->execute();
			$result = $stmt->get_result();
			$result = $result->fetch_all(MYSQLI_NUM);
			return $this->MatrixToArray($result);
		}

		public function getUserParam($username, $param){
			$stmt = $this->db->prepare("SELECT ?
										FROM User
										WHERE username = ?");
			$stmt->bind_param("ss", $param, $username);
			$stmt->execute();
			$result = $stmt->get_result();
			$result = $result->fetch_all(MYSQLI_NUM);
			return $this->MatrixToArray($result);
		}

		public function createEvent($managerId, $roomId, $imageId, $date, $name, $description, $price){	//managerId, roomId, imageId and date are required fields
			$stmt = $this->db->prepare("INSERT INTO `Event` (`idManager`, `idRoom`, `idImage`, `date`, `name`, `description`, `price` ) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("iiisssd", $managerId, $roomId, $imageId, $date, $name, $description, $price);
			$stmt->execute();
			$result = $stmt->get_result();
			$result = $result->fetch_all(MYSQLI_NUM);
			return $this->MatrixToArray($result);
		}

		public function getUpcomingEvents($quantity = 10, $offset = 0, $roomId = "*"){
			$stmt = $this->db->prepare("SELECT *
										FROM Event
										WHERE date >= ? AND idRoom = ?
										ORDER BY ASC 
										OFFSET ?
										LIMIT ?");
			$stmt->bind_param("iii", date("Y-m-d"), $roomId, $offset, $quantity);
			$stmt->execute();
			$result = $stmt->get_result();
			$result = $result->fetch_all(MYSQLI_NUM);
			return $result;
		}

		public function ticketAvailable($eventId){
			$stmt = $this->db->prepare("SELECT *
										FROM Event
										WHERE idEvent = ?");
			$stmt->bind_param("i", $eventId);
			$stmt->execute();
			$result = $stmt->get_result();
			$result = $result->fetch_all(MYSQLI_NUM);
			return $this->MatrixToArray($result);
		}

		/*
		public function getElementsbyInsieme($n){
			$stmt = $this->db->prepare("SELECT valore
										FROM insiemi
										WHERE insieme = ?");
			$stmt->bind_param("i", $n);
			$stmt->execute();
			$result = $stmt->get_result();
			$result = $result->fetch_all(MYSQLI_NUM);
			return $this->MatrixToArray($result);
		}
		*/

		//trasforma una matrice[n][1] in un array[n] 
		public function MatrixToArray($m){
			$output = array();
			foreach ($m as $r){
				$output[] = $r[0];	//array[] = significa push
			}		
			return $output;
		}

	}
?>