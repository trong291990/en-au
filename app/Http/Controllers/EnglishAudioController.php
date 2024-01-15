<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class EnglishAudioController extends Controller
{
    protected string $baseDir;

    public function __construct()
    {
        $this->baseDir = public_path('/audio');
    }

    public function getList()
    {
        $result = [];
        $folders = File::directories($this->baseDir);
        $folderNames = [];

        foreach ($folders as $folder) {
            $folderNames[] = basename($folder);
        }

        natsort($folderNames);

        foreach ($folderNames as $folder) {
            $files = File::files($this->baseDir . DIRECTORY_SEPARATOR . $folder);
            $data = [
                'name' => $folder,
                'files' => []
            ];
            foreach ($files as $file) {
                $fileName = $file->getFilename();

                $data['files'][] = url('audio/' . $folder . '/' . $fileName);
            }
            $result[] = $data;
        }

        return $result;
    }
}