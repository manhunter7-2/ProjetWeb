<?php

namespace Tools;

use PDO;

require "directories.php";

class movieAdder{
    private function upload($rtrn): ?array{
        $up_ok = 1; //1 = PROBLEM   0 = NO-PROBLEM
        $filename = '';
        if (!empty($_FILES["fileUp"])){
            if (isset($_POST["submit"])) {
                $file = $_FILES['fileUp'];
                $temp = $file['tmp_name'];
                $filename = $file['name'];
                $fullName = $GLOBALS['FILE_UPLOAD'].$filename;
                $parts = pathinfo($fullName);
                $filetype = $parts['type'];
                if (!($filetype == IMAGETYPE_GIF || $filetype == IMAGETYPE_JPEG || $filetype == IMAGETYPE_PNG || $filetype="png")) { ?>
                    <div class="error-message">Le fichier doit être de format GIF, JPEG ou PNG</div>
                <?php $up_ok = 0;
                echo "ERREUR ";
                }
            }else{
                $up_ok = 0;
            }
        }else{
            $up_ok = 0;
        }
        if ($up_ok == 1 && ($filetype == IMAGETYPE_GIF || $filetype == IMAGETYPE_JPEG || $filetype == IMAGETYPE_PNG || $filetype="png")){
            move_uploaded_file($temp, $fullName);
            chmod ($fullName, 0777); //if issues with upload
            echo "Le fichier a été uploadé dans ".$fullName;
        }
        if ($rtrn){
            return array(
                'up_ok' => $up_ok,
                'file' => $file['name'],
            );
        }else{
            return null;
        }
    }

    public function adderFeature(): array{
        $title = $title_err = '';
        $file_err = '';
        $syn = $syn_err = '';
        $date = '';
        session_start();
        //-------------------------- TITLE PART ------------------------------------------
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty(trim($_POST["title"]))) {
                $title_err = "Champ obligatoire";
            } else {
                $title = htmlspecialchars(trim($_POST["title"]));
            }
            //-------------- DATE PART --------------------------------
            $date = date('Y-m-d', strtotime($_POST["date"]));
            //--------------- SYNOPSIS PART -------------------------------
            if ((str_word_count($_POST["synopsis"])) > 100) {
                $syn_err = "Le synopsis ne doit pas excéder les 100 mots.";
            } else {
                $syn = htmlspecialchars(trim($_POST["synopsis"]));
            }
            $pdo = (new dbConnect())->config();
            //check is movie already exists
            $check = "SELECT * FROM Movies";
            $rqst = $pdo->prepare($check);
            $rqst->execute() or die("ERROR : " . $rqst->errorCode());
            $results = $rqst->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $r) {
                if (strtolower($r->title) == strtolower($title)) {
                    $title_err = "Ce titre est déjà pris";
                }
            }
            unset($request);
            unset($pdo);

            //-------------- SQL REQUEST ---------------------------
            if (empty($syn_err) && empty($title_err)) {
                $upload_array = $this->upload(true);
                if ($upload_array['up_ok'] == 1) {
                    $pdo = (new dbConnect)->config();
                    $request = "INSERT INTO Movies (title, movDate, poster, synopsis) VALUES (:title, :dat, :poster, :synopsis)";
                    $sql = $pdo->prepare($request);
                    $sql->bindParam(":title", $title);
                    $sql->bindParam(":dat", $date);
                    $sql->bindParam(":poster", $upload_array['file']);
                    $sql->bindParam(":synopsis", $syn);
                    if ($sql->execute()) {
                        session_start();
                        header("location:".$GLOBALS['PAGES']."mainPage.php");
                    }
                }
            }else{
                echo $syn_err.$title_err;
                header("location: ".$_SERVER['PHP_SELF']);
            }
            unset($sql);
            unset($pdo);
        }
        return array(
            'title' => $title,
            'syn' => $syn,
            'file_err' => $file_err,
            'title_err' => $title_err,
            'syn_err' => $syn_err,
            'date' => $date,
        );
    }
    public function generateUploadForm(){
        $array = $this->adderFeature()?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Titre du film</label>
                <input type="text" id="title" name="title" class="form-control <?php echo(!empty($array['title_err']))?>" placeholder="Titre..." value="">
                <label>Date de sortie</label>
                <input type="date" id="date" name="date" class="form-control" placeholder="YYYY/MM/DD" value  = "">
                <label>Synopsis</label>
                <input type="text" id="synopsis" name="synopsis" class="form-control <?php echo (!empty($array['syn_err'])) ?>" placeholder="Synopsis..." value="" >
                <label>Image du film</label>
                <input type="file" name="fileUp" id="fileUp" class="file-data">
                <input type="submit" name="submit" class="btn btn-primary" value="Add" formaction="<?php ((empty($array['title_err'])) && $this->upload(false)) ?>">
            </div>
        </form>
<?php    }
}