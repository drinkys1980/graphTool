<?php
/* !\class: UploadingForm
 *  \brief: Class with the configure method for the form
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

    class UploadingForm extends sfForm
    {
        /* !\fn: configure
        *  \brief: For defining properties about the input fields in the new form
        *  \author: Ing. David Rincón
        *    \date: 10/11/2023
        *  \param1:NONE
        *  \return NONE
        */
        public function configure()
        {
            $this->setWidgets(array(
                'file' => new sfWidgetFormInputFile()
            ));
        }
    }
?>