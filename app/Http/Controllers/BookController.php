<?php

namespace App\Http\Controllers;

use App\Book;

class BookController extends Controller
{
    public function issue()
    {
        $max = 100000;

        $existingBook = Book::find($max);

        $books = Book::where('id', '<=', $max)->get();

        $isExisting = $books->some(function ($book) use (&$existingBook) {
            return $book->title === $existingBook->title;
        });

        dump($isExisting);
    }

    public function chunk()
    {
        $max = 100000;

        $existingBook = Book::find($max);

        $isExisting = false;

        Book::where('id', '<=', $max)->chunk($max / 10, function ($books) use (&$existingBook, &$isExisting) {
            $isExisting = $books->some(function ($book) use (&$existingBook) {
                return $book->title === $existingBook->title;
            });

            return ! $isExisting;
        });

        dump($isExisting);
    }

    public function chunkById()
    {
        $max = 100000;

        $existingBook = Book::find($max);

        $isExisting = false;

        Book::where('id', '<=', $max)->chunkById($max / 10, function ($books) use (&$existingBook, &$isExisting) {
            $isExisting = $books->some(function ($book) use (&$existingBook) {
                return $book->title === $existingBook->title;
            });

            return ! $isExisting;
        });

        dump($isExisting);
    }

    public function insertOrIgnore()
    {
        $max = 100000;

        Book::insertOrIgnore([
            [
                "id" => $max,
                "title" => "New Book",
                "author" => "Memo Chou",
            ],
        ]);

        dump(Book::count());
    }
}
