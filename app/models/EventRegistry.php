<?php

class EventRegistry {
	// event attributes
    private $Id, $event_Id, $user_Id , $RegisteredDate, $NumberOfTickets, $Complete;

	// static function to get event instance
	public static function createInstance(){
		return new EventRegistry("","","","","");
	}

	// constructor to capture public event attributes
    function __construct( $event_Id, $user_Id , $RegisteredDate, $NumberOfTickets, $Complete)
	{
		$this->event_Id = $event_Id;
		$this->user_Id = $user_Id;
		$this->RegisteredDate = $RegisteredDate;
		$this->NumberOfTickets = $NumberOfTickets;
        $this->Complete = $Complete;
	}
  
	// getters
	public function getId() {
		return $this->Id;
    }
    
    public function getEvent_Id() {
		return $this->event_Id;
	}

	public function getUser_Id() {
		return $this->user_Id;
	}

	public function getRegisteredDate() {
		return $this->RegisteredDate;
	}

	public function getNumberOfTickets() {
		return $this->NumberOfTickets;
	}
	
	public function getComplete() {
		return $this->Complete;
	}
	
	
  
	
	// setters
	function setId($Id) {
		$this->Id = $Id;
    }

	function setComplete($complete) {
		$this->Complete = $complete;
    }


	// insert user in to the database
	public function insertEventRegistry()
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("INSERT INTO user_registered_events 
			( event_Id, user_Id , RegisteredDate, NumberOfTickets, Complete) 
			VALUES (?, ?, ?, ?, ?)");
		 
			$stmt->bind_param("iisii",
            $this->event_Id ,
            $this->user_Id,
            $this->RegisteredDate ,
            $this->NumberOfTickets ,
            $this->Complete
			);
			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	// get events by id
	public function getUserEvent($userId ,$eventId)
	{
		
		try{
			global $mysqli;
		

			$stmt = $mysqli->prepare("SELECT * FROM user_registered_events WHERE user_Id = ? and event_Id = ?");
			$stmt->bind_param("ii", $userId ,$eventId);
			$stmt->execute();
			$result = $stmt->store_result();
			$event = null;
			if($stmt->num_rows == 0) {
				return $event;
			} else{

                $stmt->bind_result( $Id, $event_Id, $user_Id , $RegisteredDate, $NumberOfTickets, $Complete);

				$stmt->fetch();
			
				$event = new EventRegistry($event_Id, $user_Id , $RegisteredDate, $NumberOfTickets, $Complete);
				
				$event->setId($Id);
			
			}	
			
			return $event;
			

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		} 
	}
 
	public function getEventRegisterRequests()
    {
        try{
			global $mysqli;
			
		    $sql ="SELECT ur.Id, e.Name, e.StartingDateTime, e.Venue, u.FullName, 
				   u.ContactNo, ur.RegisteredDate  
			       FROM  user_registered_events ur
			       INNER JOIN user u ON ur.user_Id = u.Id
			       INNER JOIN event e ON ur.event_Id = e.Id
			       WHERE  ur.Complete = 0 ";

			$result = $mysqli->query($sql);
			$requests = array();

			if($result->num_rows == 0) {
				return $requests;
			} else{
				while($row = $result->fetch_assoc()){
                    array_push($requests, $row);
                }
			}	
			
			return $requests;
			

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		} 
    }


	public function updateEventRegistryAsComplete($registryID)
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("UPDATE user_registered_events 
			 SET Complete = 1 WHERE Id = ?");
		 
			$stmt->bind_param("i",$registryID);

			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	
}