<?php
/* set default properties */

$hash = hash_file('crc32',$input);
$cache_url = $modx->getOption('imgsizer.cache_url');
$path_parts = pathinfo($input);

/*echo "<pre>";
echo $input, "\n";
echo $path_parts['dirname'], "\n";
echo $path_parts['basename'], "\n";
echo $path_parts['extension'], "\n";
echo $path_parts['filename'], "\n";
echo $options, "\n";
echo "</pre>";*/

return $cache_url . $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $hash . '.' . $options . '.' . $path_parts['extension'];