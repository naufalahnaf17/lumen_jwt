<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //kontruktor kosong atau untuk validasi
    }

    public function index(){
      $books = Book::all();
      $data = $books->toArray();

      $response = [
          'success' => true,
          'data' => $data,
          'message' => 'Books retrieved successfully.'
      ];

      return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        if ($book = Book::create($input)) {
          $data = $book->toArray();
          $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Simpan Buku successfully.'
          ];

          return response()->json($response, 200);
        }else {
          return response('gagal');
        }

    }

    public function show($id){

      if ($book = Book::where('id',$id)->get()) {
          $data = $book->toArray();
          $response = [
            'success' => true,
            'data' => $data,
            'message' => 'Simpan Buku successfully.'
          ];

          return response()->json($response, 200);

      }else {
        return response('gagal');
      }

    }

    public function update($id , Request $request)
    {

      $name = $request->input('name');
      $author = $request->input('author');

      $data = Book::where('id',$id)->first();
      $data->name = $name;
      $data->author = $author;

      if ($data->save()) {
        $res['status'] = "200";
        $res['message'] = "Success Mengubah Data";
        return response($res);
      }else {
        $res['status'] = "400";
        $res['message'] = "Something Wrong";
        return response($res);
      }

    }

    public function delete($id){

      $data = Book::where('id',$id)->first();
      if($data->delete()){
        $res['status'] = "200";
        $res['message'] = "Success!";
        return response($res);
      }
      else{
          $res['status'] = "200";
          $res['message'] = "Failed!";
          return response($res);
      }

    }

}
