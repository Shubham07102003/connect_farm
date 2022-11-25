<?php

include('header.php');
$page_title = "Update thingsspeak";


$old = $handler->select('thingsspeak');
// print_r($old);
    $old = $old[0];
    // print_r($old);
    
    
if(isset($_POST['submit'])){
    $resultant = $handler->update('thingsspeak',
        ['id'=>1,'channelid'=>$_POST['channelid'],'apikey'=>$_POST['apikey']],
        ['id'=>1],
        ['apikey'=>['empty'],'channelid'=>['empty']]
    );

    if($resultant == true){
        echo '<script>location.replace("thinksspeak.php");</script>';
    }else{
        $error = $resultant;
    }

}

?>




    <section class="container grey-text">


        <form class="white"style="padding: 20px;margin: 10px auto;max-width: 500px" action="" method="POST">
            <?php

            foreach ($error as $err){
                ?>

                <div class="red-text"><?php echo htmlspecialchars($err)?></div>
                <br>
                <?php
            }
            ?>


            <label>Channel Id:</label>
            <input name="channelid" id="channelid" type="text" value="<?php echo htmlspecialchars($old['channelid'])?>">
            
                        <label>Api Key:</label>
            <input name="apikey" id="apikey" type="text" value="<?php echo htmlspecialchars($old['apikey'])?>">


            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn center white-text brand-btn">
            </div>

        </form>

<br>

    </section>

<?php include('footer.php');

?>