<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('category')->get();
    }

    public function create(Request $request): array
    {
        $data = $request->all();

        $book = Book::create([
            'title'       => $data['title'],
            'author'      => $data['author'],
            'price'       => $data['price'],
            'category_id' => $data['category_id'],
        ]);

        return [
            'message' => 'created',
            'data'    => $book
        ];
    }

    public function show($id)
    {
        $book = Book::with('category')->find($id);

        if (!$book) {
            return [
                'message' => 'Not found'
            ];
        }

        return [
            'data' => $book
        ];
    }

    public function update(Request $request, $id): array
    {
        $book = Book::find($id);

        if (!$book) {
            return [
                'message' => 'Not found'
            ];
        }

        $data = $request->all();

        $book->update([
            'title'       => $data['title'] ?? $book->title,
            'author'      => $data['author'] ?? $book->author,
            'price'       => $data['price'] ?? $book->price,
            'category_id' => $data['category_id'] ?? $book->category_id,
        ]);

        return [
            'message' => 'updated',
            'data'    => $book
        ];
    }

    public function delete($id): array
    {
        $book = Book::find($id);

        if (!$book) {
            return [
                'message' => 'Not found'
            ];
        }

        $book->delete();

        return [
            'message' => 'deleted'
        ];
    }
}
