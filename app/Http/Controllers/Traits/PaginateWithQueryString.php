<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;

trait PaginateWithQueryString
{
    protected function paginateWithQueryString(AbstractPaginator $paginator, Request $request): AbstractPaginator
    {
        if (method_exists($paginator, 'withQueryString')) {
            return $paginator->withQueryString();
        }

        $queryString = $request->query();
        $paginator->appends($queryString);
        $paginator->setPath($request->getBaseUrl() . $request->getPathInfo());

        return $paginator;
    }
}
