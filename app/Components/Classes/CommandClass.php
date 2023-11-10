<?php
/* !\class: CommandClass
 *  \brief: Class for defining the Dependency inversion principle, that applies to canvas, shapes and filling classes
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

namespace Components\Classes;

use Components\Interfaces\CommandInterface;

class CommandClass {
    protected $command;

    /* !\fn: __construct
     *  \brief: Constructor Method
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$command (Instanced object from the CommandInterface implementation)
     *  \return NONE
     */
    function __construct(CommandInterface $command){
        $this->command = $command;
    }

    /* !\fn: executeCanvas
     *  \brief: Help to execute the method executePaint that the classes have due to the implementation of the CommandInterface
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:NONE
     *  \return executePaint (A modified canvas, or a String with an error message)
     */
    public function executeCanvas(){
        return $this->command->executePaint();
    }
}