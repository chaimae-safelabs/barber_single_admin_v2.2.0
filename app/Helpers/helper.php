<?php

namespace App\Helpers;


class Helper
{
    public function update_env($data)
    {
        $envFile = app()->environmentFilePath();
        if ($envFile) {
            $str = file_get_contents($envFile);
            if (count($data) > 0) {
                foreach ($data as $envKey => $envValue) {
                    $str .= "\n"; // In case the searched variable is in the last line without \n
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                    // If key does not exist, add it
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                }
            }
            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
            }
            return true;
        }
    }

    public function imageUpload($image,$path)
    {
        $imageName = $path.'_'.uniqid() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('storage/images/'.$path);
        $image->move($destinationPath, $imageName);
        $data = $imageName;
        return $data;
    }

}
