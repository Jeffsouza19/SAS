<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ['error' => ''];

        $books = Book::all();

        $response['books'] = $books;

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ['error' => ''];

        if (isset($request['value']) && !empty($request['value'])) {
            $request['value'] = str_replace(',', '.', $request['value']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'isbn' => 'integer',
            'value' => 'decimal:1,9',
        ]);

        if (empty($validator->fails())) {
            $data = $request->only('name', 'isbn', 'value');

            $book = Book::create($data);

            $response['book'] = $book;
        } else {
            $response['error'] = $validator->errors()->first();
        }


        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (empty($validator->fails())) {
            $book = Book::find($request->id);
            if ($book) {
                $response['book'] = $book;
            } else {
                $response['error'] = 'Book not found';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = ['error' => ''];

        if (isset($request['value']) && !empty($request['value'])) {
            $request['value'] = str_replace(',', '.', $request['value']);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'isbn' => 'integer',
            'value' => 'decimal:1,9',
        ]);

        if (empty($validator->fails())) {
            $data = $request->only('name', 'isbn', 'value');

            $book = Book::find($request->id);

            if ($book) {
                $book->update($data);
                $book->save();
            } else {
                $response['error'] = 'Book not found';
            }

            $response['book'] = $book;
        } else {
            $response['error'] = $validator->errors()->first();
        }


        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (empty($validator->fails())) {
            $book = Book::find($request->id);
            if ($book) {
                $book->delete();
                $response['success'] = 'The book has been deleted';
            } else {
                $response['error'] = 'Book not found';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }

        return $response;
    }
}
