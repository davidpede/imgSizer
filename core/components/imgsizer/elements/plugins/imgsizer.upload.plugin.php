<?php
if ($modx->event->name == 'OnFileManagerUpload') {
  
  $cache_path = $modx->getOption('imgsizer.cache_path');
  $output_path = MODX_BASE_PATH . $cache_path . $directory;
  $name = $files[file]['name'];
  $src = MODX_BASE_PATH . '' . $directory . '' . $name;
  $hash = hash_file('crc32',$src);
  
  $path_parts = pathinfo($src);
  $fname = $path_parts['filename'];
  $ext = $path_parts['extension'];
  
  //$modx->log(modX::LOG_LEVEL_ERROR,$directory . '' . $name,'','imgSizer');
  
  $modx->loadClass('Resizer', MODX_CORE_PATH . 'components/resizer/model/', true, true);
  $resizer = new Resizer($modx);  // pass in the modX object
  //$resizer->debug = true;  // (optional) Enable debugging messages.
  //create cache folder if it doesn't exist
  if (!file_exists($output_path)) {
    mkdir($output_path, 0755, true);
  }
  $resizer->processImage(
    $src,  // input image file. Path can be absolute or relative to MODX_BASE_PATH
    $output_path . $fname . '.' . $hash . '.50.' . $ext,  // output image file. Extension determines image format
    array('w' => 50, 'scale' => 1)  // or 'w=600&scale=1.5' instead of an array
  );
  $resizer->processImage(
    $src,  // input image file. Path can be absolute or relative to MODX_BASE_PATH
    $output_path . $fname . '.' . $hash . '.200.' . $ext,  // output image file. Extension determines image format
    array('w' => 200, 'scale' => 1)  // or 'w=600&scale=1.5' instead of an array
  );
  //$modx->log(modX::LOG_LEVEL_ERROR, 'Resizer debug output' . substr(print_r($resizer->debugmessages, TRUE), 7, -2));
}