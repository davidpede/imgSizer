<?php
if ($modx->event->name == 'OnFileManagerUpload') {

  $name = $files[file]['name'];
  $src = MODX_BASE_PATH . '' . $directory . '' . $name;

  $hash = hash_file('crc32',$src);
  
  $path_parts = pathinfo($src);
  $fname = $path_parts['filename'];
  $ext = $path_parts['extension'];
  
  //$fileurl = $directory . '' . $file->get('name');
  //$results = print_r($array, true); //print array values to a variable
  $modx->log(modX::LOG_LEVEL_ERROR,$directory . '' . $name,'','imgSet');
  
  $modx->loadClass('Resizer', MODX_CORE_PATH . 'components/resizer/model/', true, true);
  $resizer = new Resizer($modx);  // pass in the modX object
  $resizer->debug = true;  // (optional) Enable debugging messages.
  $resizer->processImage(
    $src,  // input image file. Path can be absolute or relative to MODX_BASE_PATH
    MODX_BASE_PATH . '' . $directory . $fname . '.' . $hash . '.50.' . $ext,  // output image file. Extension determines image format
    array('w' => 50, 'scale' => 1)  // or 'w=600&scale=1.5' instead of an array
  );
  $resizer->processImage(
    $src,  // input image file. Path can be absolute or relative to MODX_BASE_PATH
    MODX_BASE_PATH . '' . $directory . $fname . '.' . $hash . '.200.' . $ext,  // output image file. Extension determines image format
    array('w' => 200, 'scale' => 1)  // or 'w=600&scale=1.5' instead of an array
  );
  $modx->log(modX::LOG_LEVEL_ERROR, 'Resizer debug output' . substr(print_r($resizer->debugmessages, TRUE), 7, -2));
}