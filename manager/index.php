<?php
if( isset($_POST['start']) ) {
    include_once '../Classes/PHPExcel.php';
    $target_file = '../event/' . $_POST['start']. '_' . $_POST['end'] . '.xlsx';
    $objPHPExcel = new PHPExcel();
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    $objWriter->save($target_file);

    $file_registry = '../event/'.  $_POST['start']. '_' . $_POST['end'] . '_registry.php';
    $fRegistry = fopen($file_registry, 'w');
    $data_registry = file_get_contents('member.php');
    fwrite($fRegistry, $data_registry);

    $file_event = '../event/'.  $_POST['start']. '_' . $_POST['end'] . '_event.php';
    $fEvent = fopen($file_event, 'w');
    $data_event = file_get_contents('event.php');
    fwrite($fEvent, $data_event);

} else {
    if( isset($_POST['name']) ) {
        unlink('../event/'.$_POST['name'].'.xlsx');
        unlink('../event/'.$_POST['name'].'_event.php');
        unlink('../event/'.$_POST['name'].'_registry.php');
        die("Deleted successfully!");
    }
}
$dir    = '../event';
$files2 = array_diff(scandir($dir), array('..', '.', '.DS_Store'));
foreach ($files2 as $key => $f) {
    $fm = explode('.', $f);
    if( $fm[1] == 'php' ) {
        unset($files2[$key]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HCM NIGHT CLUB</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.min.css">
</head>

<body>
<div class="container-fluid">
    <div class="col-lg-12">
        <h1>Add new event war</h1>
    </div>
    <form action="index.php" method="post">
        <div class="col-lg-2">
            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                <span class="input-group-addon">
                    Start:
                </span>
                    <input type='text' class="form-control" name="start" />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                <span class="input-group-addon">
                    End:
                </span>
                    <input type='text' class="form-control" name="end" />
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <input type="submit" name="submit" maxlength="100" class="btn btn-primary" value="Upload">
        </div>
    </form>
    <div class="col-lg-12">
        <h1>List event</h1>
    </div>
    <div class="col-lg-12">
        <table class="table table-bordered table-customize table-responsive">
            <thead>
            <tr>
                <th style="text-align: left">File name</th>
                <th style="text-align: left">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($files2 as $f): ?>
            <tr>
                <td data-title="File"><?= $f ?></td>
                <td>
                    <?php $fm = explode('.', $f); ?>
                    <a href="../event/<?= $fm[0].'_registry.php' ?>" target="_blank" class="btn btn-success">Registry</a>
                    <a href="../event/<?= $fm[0].'_event.php' ?>" target="_blank" class="btn btn-success">Check</a>
                    <a href="../event/<?= $f ?>" target="_blank" class="btn btn-primary">Download</a>
                    <input type="submit" name="submit" maxlength="100" class="btn btn-danger" data-name="<?= $fm[0] ?>" onclick="deleleFile(this)" value="Delete">
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    function deleleFile(obj) {
        var name = $(obj).attr('data-name');
        $.ajax({
            type: 'post',
            url : 'index.php',
            data: "name="+name,
            success: function(result) {
                alert(result);
                window.location = '.';
            }
        });
    }
    $('#datetimepicker').datepicker({ format: 'ddmmyyyy' });
    $('#datetimepicker2').datepicker({ format: 'ddmmyyyy' });
</script>
