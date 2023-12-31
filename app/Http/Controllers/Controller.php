<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
}
