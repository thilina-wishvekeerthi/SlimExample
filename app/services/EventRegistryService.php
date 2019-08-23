<?php
 require_once('../models/EventRegistry.php');  

 class EventRegistryService
 {
     private $eventRegistry ;

     // construct  service with request params
     function __construct($request)
     {
         // initiate event registry by user submitted form data
        if($request->getParam("event_Id") != NULL)
            $this->eventRegistry = new EventRegistry(
                    $request->getParam("event_Id"),
                    $request->getParam("user_Id"),
                    date("Y-m-d H:i:s"),
                    1,
                    0
                );
        else 
            $this->eventRegistry = EventRegistry::createInstance();
            
        
     }


     function registerForEvent()
     {
      // Register user event
        $complete = $this->eventRegistry->insertEventRegistry();
        return  $complete;
     }

     function approveEventRegistry($registryId)
     {
         return $this->eventRegistry->updateEventRegistryAsComplete($registryId);
     }

    
 }
?>