<?php
/* !\interface: CommandInterface
 *  \brief: Abstract Class for the Graph Tool, with its methods
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

namespace Components\Interfaces;

interface CommandInterface
{
    /* !\fn: validateParameters
     *  \brief: For validating the parameters that each class has (the parameters has differences at comparing the 4 classes)
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:NONE
     *  \return A string with a message error, or an empty value
     */
    public function validateParameters();

    /* !\fn: executePaint
     *  \brief: For creating the canvas with its spaces and borders, or filling the canvas with the different shapes and colors
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:NONE
     *  \return A modified canvas, or a String with an error message
     */
    public function executePaint();
}