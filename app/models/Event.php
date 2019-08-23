<?php

class Event {
	// event attributes
	private $Id, $Name, $Description , $Venue, $StartingDateTime, $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive;

	// static function to get event instance
	public static function createInstance(){
		return new Event("","","","","","","","","","","");
	}

	// constructor to capture public event attributes
    function __construct($Name, $Description , $Venue, $StartingDateTime, $TotalTickets, 
    $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive)
	{
		$this->Name = $Name;
		$this->Description = $Description;
		$this->Venue = $Venue;
		$this->StartingDateTime = $StartingDateTime;
		$this->TotalTickets = $TotalTickets;
        $this->Speaker1 = $Speaker1;
        $this->Speaker2 = $Speaker2;
        $this->STitle1 = $STitle1;
        $this->STitle2 = $STitle2;
        $this->Picture = $Picture;
        $this->IsActive = $IsActive;
	}
  
	// getters
	public function getId() {
		return $this->Id;
    }
    
    public function getName() {
		return $this->Name;
	}

	public function getDescription() {
		return $this->Description;
	}

	public function getVenue() {
		return $this->Venue;
	}

	public function getStartingDateTime() {
		return $this->StartingDateTime;
	}
	
	public function getTotalTickets() {
		return $this->TotalTickets;
	}
	
	public function getSpeaker1() {
		return $this->Speaker1;
	}

	public function getSpeaker2() {
		return $this->Speaker2;
	}

	public function getSTitle1() {
		return $this->STitle1;
	}

	public function getSTitle2() {
		return $this->STitle2;
	}

	public function getPicture() {
		return $this->Picture;
    }
    
    public function getIsActive() {
		return $this->IsActive;
    }
  
	
	// setters
	function setId($Id) {
		$this->Id = $Id;
    }

	function setIsActive($active) {
		$this->IsActive = $active;
    }


	// insert user in to the database
	public function insertEvent()
    {
		try{
			global $mysqli;
			$stmt = $mysqli->prepare("INSERT INTO event 
			($Name, $Description , $Venue, $StartingDateTime, $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		 
			$stmt->bind_param("ssssisssssi",
            $this->Name,
            $this->Description,
            $this->Venue,
            $this->StartingDateTime,
            $this->TotalTickets,
            $this->Speaker1,
            $this->Speaker2,
            $this->STitle1 ,
            $this->STitle2 ,
            $this->Picture ,
            $this->IsActive 
			);
			$stmt->execute();
			
			return $stmt->close() == true;

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	// get events by id
	public function getEventById($Id)
	{
		
		try{
			global $mysqli;
		

			$stmt = $mysqli->prepare("SELECT * FROM event WHERE Id = ?");
			$stmt->bind_param("i", $Id);
			$stmt->execute();
			$result = $stmt->store_result();
			$event = null;
			if($stmt->num_rows == 0) {
				return $event;
			} else{

                $stmt->bind_result($Id, $Name, $Description , $Venue, $StartingDateTime,
                 $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive);

				$stmt->fetch();
			
				$event = new Event($Name, $Description , $Venue, $StartingDateTime,
                $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive);
				
				$event->setId($Id);
			
			}	
			
			return $event;
			

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		} 
	}
 
	public function getAllEvents()
    {
        try{
			global $mysqli;
		

			$stmt = $mysqli->prepare("SELECT * FROM event ");
			$stmt->execute();
			//$result = $stmt->store_result();
            $events = array();
            
			if($stmt->num_rows == 0) {
				return $events;
			} else{

                $stmt->bind_result($Id, $Name, $Description , $Venue, $StartingDateTime,
                 $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive);

				while($stmt->fetch()){

                    $event = new Event($Name, $Description , $Venue, $StartingDateTime,
                    $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive);
                    $event->setId($Id);
                    array_push($events, $event);
                }
			}	
			
			return $event;
			

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		} 
    }

    public function getAllActiveEvents()
    {
        try{
			global $mysqli;
		

			$stmt = $mysqli->prepare("SELECT * FROM event WHERE IsActive = 1");
			$stmt->execute();
		    $stmt->store_result();
            $events = array();
            
			if($stmt->num_rows == 0) {
				return $events;
			} else{

                $stmt->bind_result($Id, $Name, $Description , $Venue, $StartingDateTime,
                 $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive);

				while($stmt->fetch()){

                    $event = new Event($Name, $Description , $Venue, $StartingDateTime,
                    $TotalTickets, $Speaker1, $Speaker2, $STitle1, $STitle2, $Picture,$IsActive);
                    $event->setId($Id);
                    array_push($events, $event);
                }
			
			
			
			}	
			
			return $events;
			

		}catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		} 
	}
	
	// get events by id

}