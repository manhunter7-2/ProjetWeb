<?php

class movEditor{
    public function editor(){
        $q = $_GET['q'];
        $sql = "SELECT * FROM Movies WHERE title='".$q."';";
        $pdo = (new \Tools\dbConnect())->config();
        $request = $pdo->prepare($sql);
        $request->execute();
        $all = $request->fetchAll(\PDO::FETCH_OBJ); ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
            <div class="edit-form-group">
                <input type="text" name="txt" class="form-control">
            </div>
            <textarea
        </form>

<?php    }
}
