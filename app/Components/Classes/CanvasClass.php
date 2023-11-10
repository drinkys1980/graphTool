<?php
/* !\class: CanvasClass
 *  \brief: Class for defining the canvas
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

namespace Components\Classes;

use Components\Interfaces\CommandInterface;

class CanvasClass implements CommandInterface {
    private $w;
    private $h;
    private $matrix;

    /* !\fn: __construct
     *  \brief: Constructor Method
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$width (Number)
     *  \param2:$height (Number)
     *  \return NONE
     */
    function __construct($width, $height){
        $this->w = $width;
        $this->h = $height;
    }

    /* !\fn: validateParameters
     *  \brief: For validating the parameters that each class has (the parameters has differences at comparing the 4 classes)
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:NONE
     *  \return A string with a message error, or an empty value
     */
    public function validateParameters(){
        if(!is_numeric($this->w)){
            return "The width isn't a integer number.\n";
        }
        if(!is_numeric($this->h)){
            return "The height isn't a integer number.\n";
        }
        if($this->w < 1 || $this->w > 80){
            return "The width isn't between 1 and 80.\n";
        }
        if($this->h < 1 || $this->h > 25){
            return "The height isn't between 1 and 25.\n";
        }
        return "";
    }

    /* !\fn: executePaint
     *  \brief: For creating the canvas with its spaces and borders
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:NONE
     *  \return A modified canvas, or a String with an error message
     */
    public function executePaint(){
        $response = $this->validateParameters();
        if($response == ""){
            $this->matrix = array();
            $this->matrix[0] = array();
            $this->matrix[0][0] = "-";
            for ($i=1; $i <= $this->w; $i++) { 
                $this->matrix[0][$i] = "-";
            }
            $this->matrix[0][$i] = "-";
            for ($j=1; $j <= $this->h; $j++) { 
                $this->matrix[$j] = array();
                $this->matrix[$j][0] = "|";
                for ($i=1; $i <= $this->w; $i++) { 
                    $this->matrix[$j][$i] = " ";
                }
                $this->matrix[$j][$i] = "|";
            }
            $this->matrix[$j] = array();
            $this->matrix[$j][0] = "-";
            for ($i=1; $i <= $this->w; $i++) { 
                $this->matrix[$j][$i] = "-";
            }
            $this->matrix[$j][$i] = "-";
            return $this->matrix;
        } else {
            return $response;
        }
    }
}