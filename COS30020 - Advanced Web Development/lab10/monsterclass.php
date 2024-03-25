<?php
class Monster {             // start the Monster class
    private $num_of_eyes;   // properties
    private $colour;

    public function Monster($num, $col) {	// constructor
        $this->num_of_eyes = $num;	        // initialise number of eyes
        $this->colour = $col;	            // initialise colour
    }

    public function describe () {
        $ans = "The " . $this->colour . " monster has " . $this->num_of_eyes . " eyes.";
        return $ans;
    }
}
?>