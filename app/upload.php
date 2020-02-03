<?php
/*
 * Here we receive xhr sent FormData()
 * this FormData is populated with ONE OR MORE files
 * because we used <input type = 'file'... name='userUploads[]' ... multiple> in the form input element.
 *
 * So how to deal with $_FILES array:
 * We therefore cannot reference $_FILES['userUploads']['tmp_name'] or $_FILES['userUploads']['name'].
 * The correct reference for the first upload request: $_FILES['userUploads']['name'][0];
 * And the second: $_FILES['userUploads']['name'][1];
 * etc.
 * Same for all other $_FILES elements you'd like access to.
 */

foreach($_FILES['userUploads']['name'] as $key => $value) {
    echo 'key : ' . $key;
    echo '<br />';
    echo 'value : ' . $value;
    echo '<br />';
}

if(true) {
    $path = __DIR__ . '/repo/uploads'; // path to the uploads folder
    // create uploads directory if does not exist
    if (!file_exists($path)) {
        mkdir($path, 0777);
    }
    $fileCount = count($_FILES['userUploads']['tmp_name']); // count the # of files to be uploaded
    for($i = 0; $i < $fileCount; $i++) {
        $tempFile = $_FILES['userUploads']['tmp_name'][$i]; // the temp location on server storing the file the user selected using a multipart/form-data enctype
        $origFileSize = filesize($tempFile); // get the filesize
        $targetFile = $_FILES['userUploads']['name'][$i]; // use the original 'name' of the file
        $path = __DIR__ . '/repo/uploads'; // path to the uploads folder
        $targetFile = $path . "/" . $targetFile; // the full target file path to store the file

        $chunk_size = 256; // chunk in bytes
        $bytesUploaded = 0; // initialize

        $temp = fopen($tempFile, "rb");
        $target = fopen($targetFile, 'w');

        while ($bytesUploaded < $origFileSize) {
            $contents = fread($temp, $chunk_size); // read chunk temp file
            fwrite($target, $contents); // write chunk to target file

            // strlen() returns the number of bytes rather than the number of characters in a string.
            $bytesUploaded += strlen($contents); // keep track of bytes uploaded
            fseek($temp, $bytesUploaded); // forward the filepointer on temp file to next chunk
        }

        fclose($temp);
        fclose($target);
        unlink($_FILES['userUploads']['tmp_name'][$i]);
    }
}
