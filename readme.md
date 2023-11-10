# GRAPH TOOL

This is an application that is developed with Symfony, for printing Canvas with different shapes and colors in a outcoming text file, through a commands text file.

* Developed by: Ing. David Rincón
* Personal e-mail: davidrincon_co@yahoo.com
* Date: November 10th 2023


## Files that were created/modified in this development:

* .gitignore
For not incluiding txt files in the new folders: /public/upload and /public/download

* composer.json and composer.lock
For including the fast charge and recognize of the /app/Complements folder (with the classes and interfaces for the graph tool).

* /config/services.yaml
For including 2 new parameters: uploads_directory (for incoming text files), and downloads_directory (for outcoming text files).

* /templates/base.html.twig
For including a css file that gives a basic style for the form.

* /public/assets/css/style.css
A basic CSS file with elementary properties for html body, @media (size of the windows), and general definitions for HTML control objects.

* /templates/uploading/index.html.twig
This file has the form with de file input for uploading the commands file.

* /src/Controller/UploadingController.php
This file has been created for incluiding the methods that processes the incoming commands file, for generating the new outcoming canvas file.

* /src/Form/UploadingType.php
This file has been created for defining the properties of the 2 objects in the main form of the uploading (attachment and submit).

* /lib/UploadingForm.class.php
This file has been created for the configuration of the new form (method configure).

* app/Components/Interfaces/CommandInterface.php
This interface file has abstract methods that apply to the graph tool's classes

* app/Components/Classes/CanvasClass.php, LineClass.php, RectangleClass.php, BucketClass.php
These class files have the implementation of the CommandInterface, and the defintion of the abstract methods (with their own operations), and their own construct() methods.

* app/Components/Classes/CommandClass.php
This class file has the methods than will be used for the 4 last classes (exactly their instances), for applying the concept of the Dependency inversion principle in SOLID methodology.


## How to run this code:

It's importante to have these versions of the next components:
* PHP: 8.1.9 (cli)
* Composer: version 2.2.0 (at least)
* Symfon:y CLI version 5.7.2
In this opportunity, there isn't any database for including.

1. Using GIT, download the root folder with this URL, for saving in your computer:

https://github.com/drinkys1980/graphTool.git

2. For recovering the libraries, it's important to be in the root folder (graphTool), and execute from a console:

```bash
composer install
```

3. In other console but in the same folder, to raise the service of Symfony:

```bash
symfony server:start
```

4. In a browser, to type this URL (Considerating that the enabled port for Symfony applications, is 8000)

http://127.0.0.1:8000/uploading

5. Upload to the form, a text file with commands (input.txt) and press the Send button.

6. After, Click in the link for viewing the outcoming canvas file, with the results of the execution of the commands.
If you want, you can save the file as output.txt.


## How to apply the SOLID concepts in this development:

* Single responsibility principle: The main reason for changing the funcionality in an object, is for improving the time of execution, or reducing the quantity of code.
* Open/closed principle: We can aggregate instanced classes with CommandInterface por including new objects which are associated with shapes and filling; but not for changing the execution based in central and basic methods for the different commands.
* Liskov substitution principle: At the same way that we can include new classes, we can remove the existing ones, without affecting the functionality of the CommandClass.
* Interface segregation principle: This application is ready for the modularization, through other new specific interfaces.
* Dependency inversion principle: All the classes (for canvas, shapes and filling) have abstraction from CommandInterface for using common methods; and these classes can be used with CommandClass instances/objects, in a transparent way.
