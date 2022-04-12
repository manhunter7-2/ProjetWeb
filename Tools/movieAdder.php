<?php

use Tools\dbConnect;

require "directories.php";

class movieAdder{
    public function adderFeature(){

        $title = $title_err = $synopsis = $date = '';

        //----------- FILE PART --------------------------------------
        $file_trgt = $GLOBALS['POSTERS'].basename($_FILES["fileUp"]["name"]);
        $up_ok = 1;
        $fileType = strtolower(pathinfo($file_trgt, PATHINFO_EXTENSION));
        $fileTotal = pathinfo($file_trgt);
        $fileName = $fileTotal['filename'];
        $verif = getimagesize($_FILES["fileUp"]["tmp"]);
        if (!$verif){
            echo "Ce fichier est une image";
        }else{
            $up_ok = 0;
            echo "Ce fichier n'est pas une image";
        }if (file_exists($file_trgt)){
            echo "Le nom de fichier existe déjà";
            $up_ok = 0;
        }
        //-------------------------- TITLE PART ------------------------------------------

        if ($_SERVER["REQUEST_METHOD"] = "POST"){
            if (empty(trim($_POST["title"]))){
                $title_err = "Champ obligatoire";
            }else{
                $title = trim($_POST["title"]);
            }
            $pdo = (new dbConnect())->config();
            //check is movie already exists
            $check = "SELECT * FROM Movies";
            $rqst = $pdo->prepare($check);
            $rqst->execute() or die("ERROR : " . $rqst->errorCode());
            $results = $rqst->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $r){
                if (strtolower($r->title) == strtolower($title)){
                    $title_err = "Ce titre est déjà pris";
                }
            }
            $title = trim($_POST["title"]);
            unset($request);
            unset($pdo);
        }

        //-------------- DATE PART --------------------------------
        if


        if ($up_ok == 1){
            $pdo = (new dbConnect)->config();
            $request = "INSERT INTO Movies (title, movDate, poster, synopsis) VALUES (:title, :dat, :poster, :synopsis)";
            $sql = $pdo->prepare($request);
            $sql->bindParam(":title", $title);
            $sql->bindParam()
            $sql->execute() or die("ERROR : ".$sql->errorCode());
        }
    }
    public function generateUploadForm(){ ?>
        <form action="<?php echo (htmlspecialchars($_SERVER['PHP_SELF'])) ?>" method="post">
            <div class="form-group">
                <label>Titre du film</label>
                <input type="text" name="title" class="form-control <?php echo(!empty($title_err)) ?'is-invalid' : ''; ?>" >
                <label>Date de sortie</label>
                <input type="text" name="date" class="form-control" placeholder="YYYY/MM/DD">
            </div>
        </form>
        <form action="<?php echo $this->uploadFeature() ?>" method="post" enctype="multipart/form-data">
            <label>Sélectionnez l'image à uploader</label>
            <input type="submit" name="fileUp" id="fileUp">
        </form>
<?php    }
}