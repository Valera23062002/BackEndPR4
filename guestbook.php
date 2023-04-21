<?php

session_start();

if (!empty($_POST)){
    $jsonString = json_encode($_POST);
    $fileStream = fopen ('comments.csv','a');
    fwrite($fileStream , $jsonString ."\n");
    fclose($fileStream);
}
?>

<!DOCTYPE html>
<html>
<?php require_once 'sectionHead.php' ?>
<body>

<div class="container">
    <!-- navbar menu -->
    <?php require_once 'sectionNavbar.php' ?>
    <br>
    <!-- guestbook section -->
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            GuestBook form
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <form method="post">
                        <div class="form-group">
                            <label>Date</label>
                            <input class="form-control" type="date" name="date"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email"/>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name"/>
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <input class="form-control" type="text" name="comment"/>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="form"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            Сomments
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    if ( file_exists ('comments.csv')){
                        $fileStream = fopen('comments.csv', "r");
                        while(!feof($fileStream)){
                            $jsonString = fgets ($fileStream);
                            $array = json_decode ($jsonString, true);

                            if (empty ($array)) break ;

                            echo $array ['date'] . '<br>';
                            echo $array ['email'] . '<br>';
                            echo $array ['name'] . '<br>';
                            echo $array ['comment'] . '<br>';
                        }
                        fclose ($fileStream );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
