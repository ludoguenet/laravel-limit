<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    // SELECT *
    // FROM
    // (SELECT
    // *,
    // ROW_NUMBER() OVER (PARTITION BY post_id ORDER BY post_id) as post_row_number
    // FROM comments
    // WHERE post_id IN (1, 2, 3)
    // ) as comments_table
    // WHERE comments_table.post_row_number < 4;

    $posts = Post::query()
        ->with([
            'comments' => fn ($query) => $query->limit(10),
        ])
        ->limit(10)
        ->get();

    return view('welcome', compact('posts'));
});
