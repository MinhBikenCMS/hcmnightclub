<?php
include_once '../Classes/PHPExcel/IOFactory.php';

$url = $_SERVER['PHP_SELF'];
$date = explode( '.' ,$url);
$date = $date[0];
$date = explode('_', $date);
$date = $date[0]. '_' .$date[1] . '.xlsx';
$path = '../'.$date;

try {
    $inputFileType = PHPExcel_IOFactory::identify($path);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($path);
} catch(Exception $e) {
    die('Error "'.pathinfo($path,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$sheet = $objPHPExcel->getSheet(0);
$sheet->getColumnDimensionByColumn('A')->setWidth('20');
$column = 1;
$arrs = array();
while($column <= 50) {
    $data = $sheet->getCellByColumnAndRow(0, $column)->getValue();
    if (empty($data)) {
        if( isset($_POST['member']) ) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A$column", $_POST['member']);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save($path);
            die('success');
        }
    } else {
        array_push($arrs, $data);
    }
    $column++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HCM NIGHT CLUB</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css"
</head>
<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript">
    $(function() {
        var html = '';
        var obj = JSON.parse('<?= json_encode($arrs); ?>');
        $.ajax({
            url: "https://api.royaleapi.com/clan/29YG2LV",
            type: 'GET',
            headers: {"Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTUxNywiaWRlbiI6IjQ4MDkyODY0MjI0Mzg4NzEwNSIsIm1kIjp7fSwidHMiOjE1MzQ3MzMwNzI0MjZ9.TU55tgja_XhO34ONJKrDDGucMmjU6zR_byMYrz654IM"},
            success: function(result) {
                html += "<table class=\"table table-bordered table-customize table-responsive\">\n" +
                    "        <thead>\n" +
                    "        <tr>\n" +
                    "            <th style=\"text-align: left\">Name</th>\n" +
                    "            <th style=\"text-align: left\">Action</th>\n" +
                    "        </tr>\n" +
                    "        </thead>\n" +
                    "        <tbody>\n";
                for(key in result.members) {
                    var name = result.members[key].name;
                    var found = jQuery.inArray( name, obj );
                    if( found == '-1' ) {
                        html += "<tr><td>"+name+"</td><td><input type='submit' data='"+name+"' class='btn-success btn-registry' value='Registry'></td></tr>";
                    } else {
                        html += "<tr><td>"+name+"</td><td><span class='text-success'>Register successfully!</span></td></tr>";
                    }
                }
                html += "</body>";
                html += "</table>";
                $('.name').html(html).on('click', '.btn-registry', function() {
                    $(this).css('pointer-events', 'none');
                    var member = $(this).attr('data');
                    $.ajax({
                        type: 'post',
                        url : '<?= $_SERVER['PHP_SELF'] ?>',
                        data: "member="+member,
                        success: function(result) {
                            alert(result);
                            window.location = '<?=$url?>';
                        }
                    });
                });
            }
        });
    });
</script>
<body>
<div class="container-fluid">
    <h1>Registry</h1>
    <p>Please wait loading API, don't refresh page</p>
    <div class="name">
    </div>
</div>
</body>
