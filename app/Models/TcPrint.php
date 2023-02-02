<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TcPrint extends Model {

    //Caraceteres ESC/P
    private $line_break = "\\x0A";

    private $start_ticket = "\\x1B' + '\\x40";
    private $end_ticket = "'\\x0A";
    private $end_character2 = "'";

    private $start_character = "'";
    private $end_character = "'+";

    private $ticket = "";

    /*
     * 
     */

     public function __construct() {

     }

     /*
     * Generacion de tirilla de digi-turno
     */

    public function getTicketPositionInLine($info) {
      
        $text = $this->start_ticket;
		$this->ticket .= $this->start_character . $text . $this->end_character;

        //Linea en blanco
		//$text = $this->line_break;
		//$this->ticket .= $this->start_character . $text . $this->end_character;

        //Informacion del turno
        $info_turno = " '\\x0A' +   
                        '\\x1B' + '\\x45' + '\\x0D' +
                        
                        '\\x1B' + '\\x61' + '\\x31' + 
                        '\\x1B' + '\\x21' + '\\x30' +
                        '{$info['position']}' + 
                        '\\x1B' + '\\x21' + '\\x0A' + '\\x1B' + '\\x45' + '\\x0A' + 
                        '\\x0A' + 

                        '\\x1B' + '\\x61' + '\\x31' + 
                        '\\x1B' + '\\x21' + '\\x30' +
                        '{$info['category']}' + 
                        '\\x1B' + '\\x21' + '\\x0A' + '\\x1B' + '\\x45' + '\\x0A' + 
                        '\\x0A' + 
                        '\\x1B' + '\\x45' + '\\x0A' + ";                        
        $this->ticket .= $info_turno;

        //Linea en blanco
		$text = $this->line_break;
		$this->ticket .= $this->start_character . $text . $this->end_character;

		//Fecha de registro
		$text = sprintf("Fecha: %s    Hora: %s", date('d-m-Y'), date('H:i'));
		$this->ticket .= $this->start_character . $text . $this->end_character;

        $this->ticket .= $this->end_ticket.$this->end_character2;

        return $this->ticket;
    }

}