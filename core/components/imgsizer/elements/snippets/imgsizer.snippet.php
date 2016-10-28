<?php
/* set default properties */

$hash = hash_file('crc32',$input);
$path_parts = pathinfo($input);

/*echo "<pre>";
echo $input, "\n";
echo $path_parts['dirname'], "\n";
echo $path_parts['basename'], "\n";
echo $path_parts['extension'], "\n";
echo $path_parts['filename'], "\n";
echo "</pre>";*/

return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $hash . '.' . $options . '.' . $path_parts['extension'];