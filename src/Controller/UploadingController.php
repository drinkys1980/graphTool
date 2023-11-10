<?php
/* !\class: UploadingController
 *  \brief: Class with methods that help to process the commands file with instructions for the Graph Tool
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

namespace App\Controller;

use App\Form\UploadingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/* Clasess to allow the use of the GraphTool */
use Components\Classes\CanvasClass;
use Components\Classes\LineClass;
use Components\Classes\RectangleClass;
use Components\Classes\BucketClass;
/* Generic Class */
use Components\Classes\CommandClass;

class UploadingController extends AbstractController
{
    private $thereIsACanvas = false;

    /* !\fn: index
     *  \brief: Main method for redirecting to the form and process the text file when the validations are correct
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$request (Object with form controls)
     *  \return A render to the form
     */
    #[Route('/uploading', name: 'app_uploading')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(UploadingType::class);
        $form->handleRequest($request);
        $textRoute = "#";
        $visibleRoute = "hidden";
        if($form->isSubmitted() && $form->isValid()) {
            $textRoute = $this->readFile($form);
            $visibleRoute = "visible";
        }

        return $this->render('uploading/index.html.twig', [
            'our_form' => $form->createView(),
            'TextRoute' => $textRoute,
            'VisibleRoute' => $visibleRoute
        ]);
    }

    /* !\fn: readFile
     *  \brief: Helps to read tle commands file and generate the outcoming canvas file
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$form (Form object)
     *  \return A string with the relative route of the new outcoming file.
     */
    private function readFile($form){
        $attachmentFile = $form->get('attachment')->getData();
        if ($attachmentFile) {
            $originalFilename = pathinfo($attachmentFile->getClientOriginalName(), PATHINFO_FILENAME);
            $extensionFilename = pathinfo($attachmentFile->getClientOriginalName(), PATHINFO_EXTENSION);
            $newFilename = $originalFilename.".".$extensionFilename;
            try {
                $matrix = array();
                $attachmentFile->move($this->getParameter('uploads_directory'), $newFilename);
                /* Create a new file with the canvas */
                $fcp = fopen($this->getParameter('downloads_directory')."/output.txt", "w");
                /* Read the file */
                $fp = fopen($this->getParameter('uploads_directory')."/".$newFilename, "r");
                while (!feof($fp)){
                    $line = trim(fgets($fp));
                    $matrix = $this->paintCanvas($line, $fcp, $matrix);
                }
                fclose($fp);
                fclose($fcp);
                return "/download/output.txt";
            } catch (FileException $e) {
                die("There's a problem with the upload of the commands file.");
            }
        }
    }

    /* !\fn: paintCanvas
     *  \brief: Helps to process the command lines to modify the canvas
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$line (String with commands and parameters)
     *  \param2:$fcp (Pointer for the outcoming file)
     *  \param3:$matrix (Array with the canvas)
     *  \return An modified array
     */
    private function paintCanvas($line, $fcp, $matrix){
        $commandLine = explode(" ", $line);
        switch ($commandLine[0]) {
            case 'C':
                if(!$this->thereIsACanvas){
                    $canvas = new CanvasClass($commandLine[1], $commandLine[2]);
                    $command = new CommandClass($canvas);
                    $result = $command->executeCanvas();
                    if(is_array($result)){
                        $matrix = $result;
                        $this->printCanvas($matrix, $fcp);
                        $this->thereIsACanvas = true;
                    } else {
                        fputs($fcp, $result);
                    }
                    unset($canvas);
                } else {
                    fputs($fcp, "The canvas is still created.\n");
                }
            break;
            case 'L': case 'R': case 'B':
                if($this->thereIsACanvas){
                    if($commandLine[0] == "L"){
                        $graphObject = new LineClass($commandLine[1], $commandLine[2], $commandLine[3], $commandLine[4], $matrix);
                    } else if($commandLine[0] == "R") {
                        $graphObject = new RectangleClass($commandLine[1], $commandLine[2], $commandLine[3], $commandLine[4], $matrix);
                    } else if($commandLine[0] == "B") {
                        $graphObject = new BucketClass($commandLine[1], $commandLine[2], $commandLine[3], $matrix);
                    }
                    $command = new CommandClass($graphObject);
                    $result = $command->executeCanvas();
                    if(is_array($result)){
                        $matrix = $result;
                        $this->printCanvas($matrix, $fcp);
                    } else {
                        fputs($fcp, $result);
                    }
                    unset($graphObject);
                } else {
                    fputs($fcp, "The canvas isn't still created.\n");
                }
            break;
            default:
                fputs($fcp, "Command isn't recognized.\n");
            break;
        }
        return $matrix;
    }

    /* !\fn: printCanvas
     *  \brief: Helps to write the modified canvas in the outcoming text file
     *  \author: Ing. David Rincón
     *    \date: 10/11/2023
     *  \param1:$matrix (Array with the canvas)
     *  \param2:$fcp (Pointer for the outcoming file)
     *  \return NONE
     */
    private function printCanvas($matrix, $fcp){
        $height = sizeof($matrix);
        $width = sizeof($matrix[0]);
        for ($i=0; $i < $height; $i++) { 
            for ($j=0; $j < $width; $j++) { 
                fputs($fcp, $matrix[$i][$j]);
            }
            fputs($fcp, "\n");
        }
    }
}
