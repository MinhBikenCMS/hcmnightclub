<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HCM NIGHT CLUB</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css"
</head>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $.ajax({
            url: "https://api.royaleapi.com/clan/29YG2LV/warlog",
            type: 'GET',
            // Fetch the stored token from localStorage and set in the header
            headers: {"Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTUxNywiaWRlbiI6IjQ4MDkyODY0MjI0Mzg4NzEwNSIsIm1kIjp7fSwidHMiOjE1MzQ3MzMwNzI0MjZ9.TU55tgja_XhO34ONJKrDDGucMmjU6zR_byMYrz654IM"},
            success: function(result) {

            }
        });
    });
</script>
<body>
<div class="container-fluid">
    <h1>HCM NIGHT CLUB</h1>
    <h2>Coming soon</h2>
</div>
</body>
</html>