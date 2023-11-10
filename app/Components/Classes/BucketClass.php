<?php
/* !\class: BucketClass
 *  \brief: Class for filling the canvas with a color
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

namespace Components\Classes;

use Components\Interfaces\CommandInterface;

class BucketClass implements CommandInterface {
    private $x;
    private $y;
    private $c;
    private $w; /* Width */
    private $h; /* Height */
    private $matrix;

    /* !\fn: __construct
     *  \brief: Constructor Method
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$px (Number)
     *  \param2:$py (Number)
     *  \param3:$color (Letter)
     *  \para4:$matrix (Array)
     *  \return NONE
     */
    function __construct($px, $py, $color, $matrix){
        $this->x = $px;
        $this->y = $py;
        $this->c = $color;
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
        if(!is_numeric($this->x)){
            return "The value of x isn't a integer number.\n";
        }
        if($this->x < 1 || $this->x > $this->w){
            return "The value of x isn't between 1 and the canvas' width.\n";
        }
        if(!is_numeric($this->y)){
            return "The value of y isn't a integer number.\n";
        }
        if($this->y < 1 || $this->y > $this->h){
            return "The value of y isn't between 1 and the canvas' height.\n";
        }
        if(in_array($this->c, ["X", "x", "|", " ", "-"])){
            return "The color isn't valid.\n";
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
            $this->fillAreas($this->x, $this->y, $this->c, $this->matrix[$this->y][$this->x]);
            return $this->matrix;
        } else {
            return $response;
        }
    }

    /* !\fn: fillAreas
     *  \brief: For filling the canvas with the selected color
     *  \warning: This method uses the local variable of $matrix (Array with the canvas), due to this method is recursive
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$x (Number)
     *  \param2:$y (Number)
     *  \param3:$c (Letter, Color)
     *  \param4:$guide (Letter, Pattern Color)
     *  \return NONE
     */
    private function fillAreas($x, $y, $c, $guide){
        try {
            if(!in_array($this->matrix[$y][$x], ["X", "x", "|", "-"]) && $x >= 1 && $y >= 1 && $x <= $this->w && $y <= $this->h){
                if($this->matrix[$y][$x] == $guide){
                    $this->matrix[$y][$x] = $c;
                }
                if($this->matrix[$y][$x+1] == $guide){
                    $this->fillAreas($x+1, $y, $c, $guide);
                }
                if($this->matrix[$y][$x-1] == $guide){
                    $this->fillAreas($x-1, $y, $c, $guide);
                }
                if($this->matrix[$y+1][$x] == $guide){
                    $this->fillAreas($x, $y+1, $c, $guide);
                }
                if($this->matrix[$y-1][$x] == $guide){
                    $this->fillAreas($x, $y-1, $c, $guide);
                }
            }
        } catch (\Exception $th) {
            die("This error is generated with x ".$x." and y ".$y);
        }
    }
}