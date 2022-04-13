<?php

namespace Tools;

use PDO;

require "directories.php";

class movieAdder{
    public function upload($rtrn): ?array{
        $up_ok = 1;
        $filename = '';
        if (!empty($_FILES['upload'])){
            if (isset($_POST['submit'])) {
                $file = $_FILES['upload'];
                $filename = $file['basename'];
                $temp = $file['tmp'];
                $fullName = $GLOBALS['POSTERS'] . $filename;
                $filetype = exif_imagetype($fullName);
                if ($filetype == IMAGETYPE_GIF || $filetype == IMAGETYPE_JPEG || $filetype == IMAGETYPE_PNG) {
                    move_uploaded_file($temp, $fullName);
                }else{ ?>
                    <div class="error-message">Le fichier doit être de format GIF, JPEG ou PNG</div>
                <?php $up_ok = 0;
                }
            }else{
                $up_ok = 0;
            }
        }else{
            $up_ok = 0;
        }
        if ($rtrn){
            return array(
                'up_ok' => $up_ok,
                'file' => $filename
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
        //-------------------------- TITLE PART ------------------------------------------
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            echo ($_POST["title"]);
            if (empty(trim($_POST['title']))) {
                $title_err = "Champ obligatoire";
            } else {
                $title = trim($_POST["title"]);
            }
            //-------------- DATE PART --------------------------------
            $date = date('Y-m-d', strtotime($_POST["date"]));
            //--------------- SYNOPSIS PART -------------------------------
            if ((str_word_count($_POST["synopsis"])) < 100) {
                $syn_err = "Le synopsis ne doit pas excéder les 100 mots.";
            } else {
                $syn = trim($_POST["syn"]);
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
            $upload_array = $this->upload(true);

            //-------------- SQL REQUEST ---------------------------
            if ($upload_array['up_ok'] == 1 && empty($syn_err) && empty($title_err)) {
                $pdo = (new dbConnect)->config();
                $request = "INSERT INTO Movies (title, movDate, poster, synopsis) VALUES (:title, :dat, :poster, :synopsis)";
                $sql = $pdo->prepare($request);
                $sql->bindParam(":title", $title);
                $sql->bindParam(":dat", $date);
                $sql->bindParam(":poster", $upload_array['poster']);
                $sql->bindParam(":synopsis", $syn);
                $sql->execute() or die("ERROR : " . $sql->errorCode());
            }
            unset($sql);
            unset($pdo);
        }else{
            echo "PAS EN POST";
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
        session_start();
        $array = $this->adderFeature()?>
<!--        <form action="--><?php //echo (htmlspecialchars($_SERVER['PHP_SELF'])) ?><!--" method="post">-->
<!--            <div class="form-group">-->
<!--                <label>Titre du film</label>-->
<!--                <input type="text" id="title" name="title" class="form-control --><?php //echo(!empty($array['title_err'])) ?'is-invalid' : ''; ?><!--" value="--><?php //echo $array['title'] ?><!--">-->
<!--                <label>Date de sortie</label>-->
<!--                <input type="date" id="date" name="date" class="form-control" placeholder="YYYY/MM/DD" value  = "--><?php //echo $array['date']?><!--">-->
<!--                <label>Synopsis</label>-->
<!--                <input type="text" id="synopsis" name="synopsis" class="form-control --><?php //echo (!empty($array['syn_err'])) ?><!--" placeholder="Synopsis..." value="--><?php //echo $array['syn'] ?><!--" >-->
<!--            </div>-->
<!--        </form>-->
<!--        <form action="--><?php //$this->upload(false) ?><!--" method="post" enctype="multipart/form-data">-->
<!--            <label>Sélectionnez l'image à uploader</label>-->
<!--            <input type="file" name="fileUp" id="upload">-->
<!--            <input type="submit" name="submit" id="submit">-->
<!--        </form>-->
        <form action="<?php echo (htmlspecialchars($_SERVER['PHP_SELF'])) ?>" method="POST">
            <div class="form-group">
                <label>Titre du film</label>
                <input type="text" id="title" class="form-control <?php echo(!empty($array['title_err'])) ?'is-invalid' : '' ?>" value="<?php echo $array['title']?>">
                <label>Date de sortie</label>
                <input type="date" id="date" name="date" class="form-control" placeholder="YYYY/MM/DD" value  = "<?php echo $array['date']?>">
                <label>Synopsis</label>
                <input type="text" id="synopsis" name="synopsis" class="form-control <?php echo (!empty($array['syn_err'])) ?>" placeholder="Synopsis..." value="<?php echo $array['syn'] ?>" >
                <label>Image du film</label>
                <input type="file" name="fileUp" id="upload" formaction="<?php $this->upload(false) ?>">
            </div>
        </form>
<?php    }
}