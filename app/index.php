<?php
include('./header.php');
include('./helpers.php');

$heading = heading('Upload File');
$fileUploadForm = <<<HEREDOC
$heading
<form id='uploadForm' method="post" enctype="multipart/form-data">
<input type="file" id='userUploads' name="userUploads[]" multiple>
<input type="submit" id="submit" name="submit" value="upload file">
</form>\r\n\r\n
HEREDOC;
echo $fileUploadForm;

echo "<br />\r\n";

$dir = __DIR__ . "/repo/uploads";
$files = scandir($dir); // directory contents of uploads folder to array
echo heading('Repository', 2, 'click a title to view/download');
echo '<table>';
foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        echo '<tr>';
        echo '<td class="newyork title">';
        echo "<a href='download.php?download=" . urlencode($file) . "' target='_blank'>$file</a>";
        echo '</td>';
        echo '<td class="newyork delete">';
        echo "<a href='unlink.php?unlink=" . urlencode($file) . "' title='delete file: " . $file . "'><button>delete</button></a>";
        echo '</td>';
        echo '</tr>';
    }
}
echo '</table>';

include('./footer.php');
?>

<!-- handle file upload with js xhr -->
<script>
    // reference the form, the file <input> and submit <input>
    let form = document.getElementById('uploadForm');
    let userUploads = document.getElementById('userUploads');
    let submit = document.getElementById('submit');

    form.onsubmit = function(event) {
        event.preventDefault();
        let files = userUploads.files; // retrieve FileList from <input type = 'file'...> element - access the files property
        let formData = new FormData();

        /* cycle through the files array */
        for(let i = 0; i < files.length; i++) {
            let file = files[i];

            // Check the file type - turned-off
            //if (!file.type.match('image.*')) {
            //    continue;
            //}
            formData.append('userUploads[]', file, file.name);
        }

        /* set up xhr */
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload.php', true);
        xhr.onload = function() {
            if(xhr.status === 200) {
                //successful upload
                alert('successful upload');
            } else {
                alert('an error occured');
            }
        };

        xhr.send(formData); // send the data to upload.php


    }; // LET OP, check ; or not... ?
</script>

