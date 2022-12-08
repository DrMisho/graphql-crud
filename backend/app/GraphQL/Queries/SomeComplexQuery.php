<?php

namespace App\GraphQL\Queries;

use App\Models\Book;

final class SomeComplexQuery
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return Book::query()->where('author', 'like', '$'.$args['search'].'%')->get();
    }
}
