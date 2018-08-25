<?php
include_once '../Classes/PHPExcel/IOFactory.php';

$url = $_SERVER['PHP_SELF'];
$date = explode( '.' ,$url);
$date = $date[0];
$date = explode('_', $date);
$start = $date[0];
$start = explode('/', $start);
$start = $start[2];
$tStart = DateTime::createFromFormat("dmY", $start);
$tStart = $tStart->getTimestamp();

$end = $date[1];
$tEnd = DateTime::createFromFormat("dmY", $end);
$tEnd = $tEnd->getTimestamp();

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
    if ( ! empty($data)) {
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
        var tStart = '<?= $tStart ?>';
        var tEnd = '<?= $tEnd ?>';
        var obj = JSON.parse('<?= json_encode($arrs); ?>');
        $.ajax({
            url: "https://api.royaleapi.com/clan/29YG2LV/warlog",
            type: 'GET',
            headers: {"Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTUxNywiaWRlbiI6IjQ4MDkyODY0MjI0Mzg4NzEwNSIsIm1kIjp7fSwidHMiOjE1MzQ3MzMwNzI0MjZ9.TU55tgja_XhO34ONJKrDDGucMmjU6zR_byMYrz654IM"},
            success: function(result) {
                html += "<table class=\"table table-bordered table-customize table-responsive\">\n" +
                    "        <thead>\n" +
                    "        <tr>\n" +
                    "            <th style=\"text-align: left\">Name</th>\n" +
                    "            <th style=\"text-align: left\">Collect</th>\n" +
                    "            <th style=\"text-align: left\">War</th>\n" +
                    "        </tr>\n" +
                    "        </thead>\n" +
                    "        <tbody>\n";
                for(key in result) {
                    var createdDate = result[key].createdDate;
                    if( createdDate > tStart && createdDate < tEnd ) {
                        for(k in result[key].participants) {
                            var name = result[key].participants[k].name;
                            var cardsEarned = result[key].participants[k].cardsEarned;
                            var win = result[key].participants[k].cardsEarned;
                            var found = jQuery.inArray( name, obj );
                            if( found != '-1' ) {
                                var collect = 0;
                                if( cardsEarned > 1100 ) {
                                    collect = 1;
                                }
                                if( cardsEarned > 1400 ) {
                                    collect = 2;
                                }
                                if( cardsEarned > 1600 ) {
                                    collect = 3;
                                }
                                html += "<tr><td>"+name+"</td><td><span class='text-success'>"+collect+"</span></td><td>0</td></tr>";
                            }
                        }
                    }
                }
                html += "</body>";
                html += "</table>";
                $('.name').html(html);
            }
        });
    });
</script>
<body>
<div class="container-fluid">
    <h1>Check point event (<?= $start ?> - <?= $end ?>)</h1>
    <p>Please wait loading API, don't refresh page</p>
    <div class="name">
    </div>
</div>
</body>
</html>