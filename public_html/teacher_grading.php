<?php require_once 'nav.php' ?>
<?php  is_logged_in(true);?>
<?php
    if(isset($_POST['autograding'])){
        $data = array(
            'autograding' => "autograding",
        );
    }
    if (isset($_POST["submit"])) {
        //print_r($_POST);
        //$data = urlencode($_POST); 
        $data = $_POST;
    }
    $url = "https://afsaccess4.njit.edu/~mm2623/canvas/middle.php";

    // curl*
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);

    $recieved_array = array();
    $recieved_array = json_decode($result,true);
    //print_r($recieved_array);
    //echo "<br>";
    //var_dump($result);
?>
<head>
    <meta charset="UTF-8">
    <title>Teacher Grading</title>
</head>
<br>

<div class="row">
    <div class="col" style= "margin-left: 20;">
        <h1><center><b>Teacher Grading</b></center></h1>
        <br>
        <form method="POST">
        <?php if(!isset($_POST['autograding']) && !isset($_POST['submit'])):?>
                <input class="submit" style = "margin-left:90px; font-size: 200px; justify-content:center;" type="submit" value="Autograding" name="autograding"> 
        <?php endif;?>
        <?php if(isset($_POST['autograding']) || isset($_POST['submit'])):?>
        <table>
            <tr>
                <th style = background-color:#d6d6d6;><center>Question</center></th>
                <th style = background-color:#d6d6d6;><center>Received Score</center></th>
                <th style = background-color:#d6d6d6;><center>Update Score</center></th>
            </tr>
            <?php foreach ($recieved_array as $array_index =>$each_array): ?>
            <tr>
                <td><center><?php echo $each_array['question']; ?></center></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
                    <?php $arr = explode("<br><br>", $each_array['detail']);?>
            <tr>
            <?php foreach ($arr as $array): ?>
                <?php $total = 0; ?>
                <?php if( $each_array['constraints']!=''): ?>
                    <?php $total = $each_array['total_score']/(count($arr)+1); ?>
                <?php endif?>
                <?php if( $each_array['constraints']==''): ?>
                    <?php $total = $each_array['total_score']/(count($arr)); ?>
                <?php endif?>
                <tr>
                    <td ><center><?php echo $array; ?></center></td>
                    <?php if( $array == $arr[0]): ?>
                        <td><center><?php echo (round($each_array['score_name'], 2))."/".(round($total,2)); ?></center></td>
                        <td><center><input type="float"  style = "width:50px;" name="<?php echo 'score_name-'.$each_array['question_id']; ?>"></center></td>
                    <?php endif ?> 
                    <?php if( $array == $arr[1]): ?>
                        <td><center><?php echo (round($each_array['score_testcase1'],2))."/".(round($total,2)); ?></center></td>
                        <td><center><input type="float"  style = "width:50px;" name="<?php echo 'score_testcase1-'.$each_array['question_id'] ?>"></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[2]): ?>
                        <td><center><?php echo (round($each_array['score_testcase2'],2))."/".(round($total,2)); ?></center></td>
                        <td><center><input type="float"  style = "width:50px;" name="<?php echo 'score_testcase2-'.$each_array['question_id'] ?>"></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[3]): ?>
                        <td><center><?php echo (round($each_array['score_testcase3'],2))."/".(round($total,2)); ?></center></td>
                        <td><center><input type="float"  style = "width:50px;" name="<?php echo 'score_testcase3-'.$each_array['question_id'] ?>"></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[4]): ?>
                        <td><center><?php echo (round($each_array['score_testcase4'],2))."/".(round($total,2)); ?></center></td>
                        <td><center><input type="float"  style = "width:50px;" name="<?php echo 'score_testcase4-'.$each_array['question_id'] ?>"></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[5]): ?>
                        <td><center><?php echo (round($each_array['score_testcase5'],2))."/".(round($total,2)); ?></center></td>
                        <td><center><input type="float"  style = "width:50px;" name="<?php echo 'score_testcase5-'.$each_array['question_id'] ?>"></center></td>
                    <?php endif ?>
                </tr>
            <?php endforeach; ?>
            </tr>
            <?php if( $each_array['constraints']!=''): ?>
                <tr>
                    <td><center><?php echo "Constraints => ".$each_array['constraints']; ?></center></td>
                    <td><center><?php echo (round($each_array['score_constraints'],2))."/".(round($total,2)); ?></center></td>
                    <td><center><input type="float"  style = "width:50px;" name="<?php echo 'score_constraints-'.$each_array['question_id'] ?>"></center></td>
                </tr>
            <?php endif?>
            <?php if( $each_array['score_testcase5']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+ $each_array['score_testcase3']+ $each_array['score_testcase4']+ $each_array['score_testcase5']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                    <td></td>
                </tr>
            <?php elseif($each_array['score_testcase4']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+ $each_array['score_testcase3']+ $each_array['score_testcase4']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                    <td></td>
                </tr>
            <?php elseif( $each_array['score_testcase3']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+ $each_array['score_testcase3']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                    <td></td>
                </tr>
            <?php elseif( $each_array['score_testcase2']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                    <td></td>
                </tr>
            <?php endif ?>
            <tr>
                <th style = background-color:#d6d6d6;><center>Comment</center></th>
                <td><textarea rows="4" cols="80" name="<?php echo 'comments-'.$each_array['question_id'] ?>"  placeholder = "<?php echo $each_array['comments'] ?>"></textarea><br></td>
                <td>&nbsp;</td>
            </tr>
            <?php endforeach; ?>
        </table>
        <center><input class="submit" style = "margin-bottom:10px;padding: 20px;" type="submit" name="submit"></center>
        <?php endif;?>
        </form>
    </div>
</div>

<?php require_once 'flash.php' ?>