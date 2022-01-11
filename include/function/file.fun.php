<?php
/*
 * 文件寫入
 */
function fileWrite($path, $fileName, $str)
{
    if (!is_dir($path) && $path != './' && $path != '../') {
        $dirname = '';
        $folders = explode('/', $path);
        foreach ($folders as $folder) {
            $dirname .= $folder . '/';
            if ($folder != '' && $folder != '.' && $folder != '..' && !is_dir($dirname)) {
                mkdir($dirname);
                @chmod($dirname, 0777);
            }
        }
        @chmod($path, 0777);
    }
    file_put_contents($path . $fileName, $str);

    return true;
}

function deleteDirectory($dir, $file)
{
    if (!file_exists($dir)) {
        return true;
    }

    // if (!is_dir($dir) || is_link($dir)) {
    //     if ($dir != $file) {
    //         return unlink($dir);
    //     }
    // }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . "/" . $item, $file)) {
            chmod($dir . "/" . $item, 0777);

            if (!deleteDirectory($dir . "/" . $item, $file)) {
                return false;
            }
        }
    }
    if ($dir != $file) {
        return rmdir($dir);
    }
}
