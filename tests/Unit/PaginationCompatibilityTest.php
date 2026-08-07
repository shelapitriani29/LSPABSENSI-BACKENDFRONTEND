<?php

namespace Tests\Unit;

use App\Http\Controllers\Traits\PaginateWithQueryString;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\Paginator;
use Tests\TestCase;

class PaginationCompatibilityTest extends TestCase
{
    public function test_it_appends_query_parameters_when_paginator_has_no_with_query_string_method(): void
    {
        $controller = new class {
            use PaginateWithQueryString;

            public function runPagination(AbstractPaginator $paginator, Request $request): AbstractPaginator
            {
                return $this->paginateWithQueryString($paginator, $request);
            }
        };

        $paginator = new Paginator(['item'], 1, 1, ['path' => '/']);
        $request = new Request(['search' => 'abc', 'status' => 'Aktif']);

        $result = $controller->runPagination($paginator, $request);

        $this->assertSame($paginator, $result);
        $this->assertSame(1, $result->currentPage());
    }
}
