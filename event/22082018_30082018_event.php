<?php
include_once '../Classes/PHPExcel/IOFactory.php';

$url = $_SERVER['PHP_SELF'];
$date = explode('.', $url);
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

$date = $date[0] . '_' . $date[1] . '.xlsx';
$path = '../' . $date;

try {
    $inputFileType = PHPExcel_IOFactory::identify($path);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($path);
} catch (Exception $e) {
    die('Error "' . pathinfo($path, PATHINFO_BASENAME) . '": ' . $e->getMessage());
}

$sheet = $objPHPExcel->getSheet(0);
$sheet->getColumnDimensionByColumn('A')->setWidth('20');
$column = 1;
$arrs = array();
while ($column <= 50) {
    $data = $sheet->getCellByColumnAndRow(0, $column)->getValue();
    if (!empty($data)) {
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
    $(function () {
        var html = '';
        var tStart = '<?= $tStart ?>';
        var tEnd = '<?= $tEnd ?>';
        var obj = JSON.parse('<?= json_encode($arrs); ?>');
        $.ajax({
            url: "https://api.royaleapi.com/clan/29YG2LV/warlog",
            type: 'GET',
            headers: {"Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTUxNywiaWRlbiI6IjQ4MDkyODY0MjI0Mzg4NzEwNSIsIm1kIjp7fSwidHMiOjE1MzQ3MzMwNzI0MjZ9.TU55tgja_XhO34ONJKrDDGucMmjU6zR_byMYrz654IM"},
            beforeSend: function () {
                $('.loader').css('display', 'block');
            },
            success: function (result) {

                var data = {};
                var n = 0 ;
                for (key in result) {
                    var createdDate = result[key].createdDate;
                    if (createdDate > tStart && createdDate < tEnd) {
                        data.push(createdDate);
                    }
                }
                for (key in result) {
                    var createdDate = result[key].createdDate;
                    if (createdDate > tStart && createdDate < tEnd) {
                        for (k in result[key].participants) {
                            var name = result[key].participants[k].name;
                            var found = jQuery.inArray(name, obj);
                            if (found != '-1') {
                                var cardsEarned = result[key].participants[k].cardsEarned;
                                var battlesPlayed = result[key].participants[k].battlesPlayed;

                                var collect = 0;
                                if (cardsEarned > 1100) {
                                    collect = 1;
                                }
                                if (cardsEarned > 1400) {
                                    collect = 2;
                                }
                                if (cardsEarned > 1600) {
                                    collect = 3;
                                }
                                var win = result[key].participants[k].wins;
                                if (win == 1 && battlesPlayed == 1 ) {
                                    win = 3;
                                } else if (win == 2 && battlesPlayed == 2) {
                                    win = 6;
                                } else if ( win == 1 && battlesPlayed == 1) {
                                    win = 2;
                                } else {
                                    win = 0;
                                }
                                var group = {};
                                group.name = name;
                                group.win = win;
                                group.collect = collect;
                                data[n].push(group);

                            }
                        }
                        n++;
                    }
                }
                console.log(data);
            }



//                $('.loader').css('display', 'none');
//                html += "<table class=\"table table-bordered table-customize table-responsive\">\n" +
//                    "        <thead>\n" +
//                    "        <tr>\n" +
//                    "            <th style=\"text-align: left\">#</th>\n" +
//                    "            <th style=\"text-align: left\">Name</th>\n";
//                for (key in result) {
//                    var createdDate = result[key].createdDate;
//                    var d = new Date(createdDate * 1000);
//                    if (createdDate > tStart && createdDate < tEnd) {
//                        html += "<th style='text-align: center'>" + d.toDateString() + "</th>";
//                    }
//                }
//                html +=
//                    "        <th style=\"text-align: left\">Total</th>\n" +
//                    "        </tr>\n" +
//                    "        </thead>\n" +
//                    "        <tbody>\n";
//                var n = 1;
//
//                for (ko in obj) {
//                    html += "<tr>";
//                    for (key in result) {
//                        var createdDate = result[key].createdDate;
//                        if (createdDate > tStart && createdDate < tEnd) {
//                            for (k in result[key].participants) {
//                                var name = result[key].participants[k].name;
//                                var cardsEarned = result[key].participants[k].cardsEarned;
//                                var found = jQuery.inArray(name, obj);
//                                if (found != '-1' && name == obj[ko]) {
//                                    var collect = 0;
//                                    if (cardsEarned > 1100) {
//                                        collect = 1;
//                                    }
//                                    if (cardsEarned > 1400) {
//                                        collect = 2;
//                                    }
//                                    if (cardsEarned > 1600) {
//                                        collect = 3;
//                                    }
//                                    console.log(name);
//                                    html += "<td>" + n + "</td><td class='nameData'>" + name + "</td>";
//                                    break;
//                                }
//                            }
//                        }
//                        break;
//                    }
//                    var total = 0;
//                    for (key in result) {
//                        var createdDate = result[key].createdDate;
//                        if (createdDate > tStart && createdDate < tEnd) {
//                            for (k in result[key].participants) {
//                                var name = result[key].participants[k].name;
//                                var cardsEarned = result[key].participants[k].cardsEarned;
//                                var found = jQuery.inArray(name, obj);
//                                if (found != '-1' && name == obj[ko]) {
//                                    var collect = 0;
//                                    if (cardsEarned > 1100) {
//                                        collect = 1;
//                                    }
//                                    if (cardsEarned > 1400) {
//                                        collect = 2;
//                                    }
//                                    if (cardsEarned > 1600) {
//                                        collect = 3;
//                                    }
//                                    var win = result[key].participants[k].wins;
//                                    if (win == 1) {
//                                        win = 3;
//                                    } else if (win == 2) {
//                                        win = 6;
//                                    } else {
//                                        win = 0;
//                                    }
//                                    total += collect + win;
//                                    html += "<td><span class='text-success text-res'>" + collect + "&nbsp;<img src='../assets/img/crown-blue.png' alt='crown' width='20'></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='text-success text-res'>" + win + "&nbsp;<img src='../assets/img/cw-war-win.png' width='20' alt='wins'></span></td>";
//                                    html += "";
//                                    break;
//                                }
//                            }
//                        }
//                    }
//                    html += "<td><span class='text-danger text-total'>" + total + "</span></td>";
//                    html += "</tr>";
//                    n++;
//                }
//                html += "</body>";
//                html += "</table>";
//                $('.name').html(html);
//
//                var list = [];
//                $('.name tbody tr').each(function(e) {
//                    var total = $(this).find('.text-total').text();
//                    var name = $(this).find('.nameData').text();
//                    var group = {};
//                    group.name = name;
//                    group.total = total;
//                    list.push(group);
//                });
//                list.sort(function(a,b) {
//                    return b.total - a.total;
//                });
//                for (l in list) {
//                    $.ajax({
//                        type: 'post',
//                        url : "<?//= $start ?>//_<?//= $end ?>//_registry.php",
//                        data: "member="+list[l].name+"&mode=again",
//                        success: function(result) {
//
//                        }
//                    });
//                }
        });
    });
    function numberAs(a,b) {
        return a-b;
    }
</script>
<body>
<div class="container-fluid">
    <h1>Check point event war(<?= $start ?> - <?= $end ?>)</h1>
    <div class="loader loader--style3" title="2">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px"
             width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;"
             xml:space="preserve">
          <path fill="#000"
                d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
              <animateTransform attributeType="xml"
                                attributeName="transform"
                                type="rotate"
                                from="0 25 25"
                                to="360 25 25"
                                dur="0.6s"
                                repeatCount="indefinite"/>
          </path>
        </svg>
    </div>
    <div class="name">
    </div>
</div>
</body>
</html>