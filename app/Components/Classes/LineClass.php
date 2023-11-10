<?php
/* !\class: LineClass
 *  \brief: Class for creating a line
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

namespace Components\Classes;

use Components\Interfaces\CommandInterface;

class LineClass implements CommandInterface {
    private $x1;
    private $y1;
    private $x2;
    private $y2;
    private $matrix;
    private $w; /* Width */
    private $h; /* Height */

    /* !\fn: __construct
     *  \brief: Constructor Method
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$x1 (Number)
     *  \param2:$y1 (Number)
     *  \param3:$x2 (Number)
     *  \param4:$y2 (Number)
     *  \param5:$matrix (Array)
     *  \return NONE
     */
    function __construct($x1, $y1, $x2, $y2, $matrix){
        $this->x1 = $x1;
        $this->y1 = $y1;
        $this->x2 = $x2;
        $this->y2 = $y2;
        $this->matrix = $matrix;
        $this->h = sizeof($this->matrix)-2;
        $this->w = sizeof($this->matrix[0])-2;
    }

    /* !\fn: validateParameters
     *  \brief: For validating the parameters that each class has (the parameters has differences at comparing the 4 classes)
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:NONE
     *  \return A string with a message error, or an empty value
     */
    public function validateParameters(){
        if(!is_numeric($this->x1)){
            return "The value of x1 isn't a integer number.\n";
        }
        if(!is_numeric($this->x2)){
            return "The value of x2 isn't a integer number.\n";
        }
        if(!is_numeric($this->y1)){
            return "The value of y1 isn't a integer number.\n";
        }
        if(!is_numeric($this->y2)){
            return "The value of y2 isn't a integer number.\n";
        }
        if($this->x1 < 1 || $this->x1 > $this->w){
            return "The value of x1 isn't between 1 and the canvas' width.\n";
        }
        if($this->x2 < 1 || $this->x2 > $this->w){
            return "The value of x2 isn't between 1 and the canvas' width.\n";
        }
        if($this->x2 < $this->x1){
            return "The value of x2 isn't lower than x1.\n";
        }
        if($this->y1 < 1 || $this->y1 > $this->h){
            return "The value of y1 isn't between 1 and the canvas' height.\n";
        }
        if($this->y2 < 1 || $this->y2 > $this->h){
            return "The value of y2 isn't between 1 and the canvas' height.\n";
        }
        if($this->y2 < $this->y1){
            return "The value of y2 isn't lower than y1.\n";
        }
        if($this->x1 != $this->x2 && $this->y1 != $this->y2){
            return "The line must be horizontal or vertical due to its points.\n";
        }
        return "";
    }

    /* !\fn: executePaint
     *  \brief: For filling the canvas with the different shapes and colors
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:NONE
     *  \return A modified canvas, or a String with an error message
     */
    public function executePaint(){
        $response = $this->validateParameters();
        if($response == ""){
            for ($i=$this->y1; $i <= $this->y2; $i++) { 
                for ($j=$this->x1; $j <= $this->x2; $j++) { 
                    $this->matrix[$i][$j] = "X";
                }
            }
            return $this->matrix;
        } else {
            return $response;
        }
    }
}