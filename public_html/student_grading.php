<?php require_once 'nav.php' ?>
<?php  is_logged_in(true);?>
<?php
        // create array to save*
        $data = array(
            'quest' => "quest",
        );

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
?>

<head>
    <meta charset="UTF-8">
    <title>Student Grades</title>
</head>
<br>
<!-- <h1>View Grades Here</h1> --> 

<div class="row">
    <div class="col" style= "margin-left: 20;">
        <h1><center><b>Grades</b></center></h1>
        <br>
        <table >
            <tr>
                <th style = "background-color:#d6d6d6;width:50%;height: 70px;"><center>Question</center></th>
                <th style = "background-color:#d6d6d6;height: 70px;"><center>Received Score</center></th>
            </tr>
            <?php foreach ($recieved_array as $array_index =>$each_array): ?>
            <tr>
                <td><center><?php echo $each_array['question']; ?></center></td>
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
                    <?php endif ?> 
                    <?php if( $array == $arr[1]): ?>
                        <td><center><?php echo (round($each_array['score_testcase1'], 2))."/".(round($total,2));?></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[2]): ?>
                        <td><center><?php echo (round($each_array['score_testcase2'], 2))."/".(round($total,2)); ?></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[3]): ?>
                        <td><center><?php echo (round($each_array['score_testcase3'], 2))."/".(round($total,2)); ?></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[4]): ?>
                        <td><center><?php echo (round($each_array['score_testcase4'], 2))."/".(round($total,2)); ?></center></td>
                    <?php endif ?>
                    <?php if( $array == $arr[5]): ?>
                        <td><center><?php echo (round($each_array['score_testcase5'], 2))."/".(round($total,2)); ?></center></td>
                    <?php endif ?>
                </tr>
            <?php endforeach; ?>
            </tr>
            <?php if( $each_array['constraints']!=''): ?>
                <tr>
                    <td><center><?php echo "Constraints => ".$each_array['constraints']; ?></center></td>
                    <td><center><?php echo (round($each_array['score_constraints'],2))."/".(round($total,2)); ?></center></td>
                </tr>
            <?php endif?>
            <?php if( $each_array['score_testcase5']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+ $each_array['score_testcase3']+ $each_array['score_testcase4']+ $each_array['score_testcase5']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                </tr>
            <?php elseif($each_array['score_testcase4']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+ $each_array['score_testcase3']+ $each_array['score_testcase4']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                </tr>
            <?php elseif( $each_array['score_testcase3']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+ $each_array['score_testcase3']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                </tr>
            <?php elseif( $each_array['score_testcase2']!=''): ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><center><?php echo round($each_array['score_name']+$each_array['score_testcase1']+ $each_array['score_testcase2']+$each_array['score_constraints'])."/".$each_array['total_score']; ?></center></td>
                </tr>
            <?php endif ?>
            <tr>
                <th style = "background-color:#d6d6d6;height: 70px;"><center>Comment</center></th>
                <td><center><?php echo $each_array['comments'] ?></center><br></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php require_once 'flash.php' ?>