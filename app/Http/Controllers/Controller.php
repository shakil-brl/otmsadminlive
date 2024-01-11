<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $app_url;
    public function __construct()
    {
        $this->app_url = Str::finish(config('app.api_url'), '/');
    }

    protected function customPaginate($data, $request, $path)
    {
        try {
            $currentPage = $request->page ?? 1;
            $batch_paginate = new Collection($data['data']['data']);
            $paginator = new LengthAwarePaginator(
                $batch_paginate->forPage($currentPage, $data['data']['per_page']),
                $data['data']['total'],
                $data['data']['per_page'],
                $currentPage
            );
            $paginator->setPath($path);
            return $paginator;
        } catch (\Throwable $th) {
            return false;
        }
    }

    protected function customPaginate2($data, $request, $path)
    {
        try {
            $currentPage = $request->page ?? 1;
            $batch_paginate = new Collection($data['items']['data']);
            $paginator = new LengthAwarePaginator(
                $batch_paginate->forPage($currentPage, $data['items']['per_page']),
                $data['items']['total'],
                $data['items']['per_page'],
                $currentPage
            );
            $paginator->setPath($path);
            return $paginator;
        } catch (\Throwable $th) {
            return false;
        }
    }

    protected function classFileUpload($file, $tmsBatchScheduleDetailId)
    {
        $path = null;

        if ($file != null) {
            $dateTime = now()->format('Ymd_His');
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // Generate a unique filename based on date, time, original filename, and schedule ID
            $filename = "{$dateTime}_{$originalFilename}_{$tmsBatchScheduleDetailId}.{$file->getClientOriginalExtension()}";

            // $folderPath = public_path("storage/class_document");
            $folderPath = storage_path("app/public/class_document");
            // Check if the folder exists, create it if not
            if (!File::isDirectory($folderPath)) {
                File::makeDirectory($folderPath, 0777, true, true);
            }

            $file->move($folderPath, $filename);
            $path = "class_document/{$filename}";
        }

        return $path;
    }

    protected function removeFile($filePath)
    {
        if (File::exists($filePath)) {
            File::delete($filePath);
            return true;
        }

        return false;
    }
}
