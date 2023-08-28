<?php


namespace App\Traits;




trait UploadFile
{
    public function UploadFile($folder = null, $filename = null)
    {

        $FileName = time() . '.' .   $filename->getClientOriginalName();
        $filename->move(public_path($folder) , $FileName);
        $path = $folder.'/'.$FileName;
        return $path;
    }


}
