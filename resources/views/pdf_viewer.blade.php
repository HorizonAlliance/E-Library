<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Viewer</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="margin: 0; padding: 0;">
    <iframe 
        src="{{ asset('storage/' . $book->file) }}#toolbar=0&navpanes=0&scrollbar=0" 
        width="100%" 
        height="800px" 
        frameborder="0"
        oncontextmenu="return false" 
        ondblclick="return false" 
        onclick="return false" 
        onmousedown="return false">
    </iframe>

    <script>
        jQuery(document).ready(function(){
            // Nonaktifkan klik kanan di seluruh halaman
            jQuery(document).bind("contextmenu", function(event) {
                event.preventDefault();
                alert('Right click is disabled on this page.');
            });

            // Nonaktifkan kombinasi tombol tertentu
            jQuery(document).keydown(function(event) {
                if (event.ctrlKey && (event.key === 'p' || event.key === 's')) {
                    event.preventDefault();
                    alert('Printing and saving are disabled on this page.');
                }
            });
        });
    </script>
</body>
</html>
