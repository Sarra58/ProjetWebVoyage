<?php 
    class Evenement{
        private int $id;
        private string $name;
        private int $datetime;
        private int $participant;
        private string $description;
        public function __construct($ID, $nom, $DTime, $Par, $desc){
            $this->id =$ID;
            $this->name=$nom;
            $this->datetime=$DTime;
            $this->participant=$Par;
            $this->description=$desc;
        }
        public function getEventId (){
            return  $this->id;
        }
        public function getEventName(){
            return $this->name;
        }
        public function getEventDateTime(){
            return $this->datetime;
        }
        public function getParticipant () {
            return $this->participant;
        }
        
        public function getEventdescription(){
            return $this->description;
        }

    }
?>