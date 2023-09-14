<?php

use App\Http\Controllers\DocumentManagementController;
use App\Models\DocumentManagement;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(\route('login'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/document', function () {
        $datas = DocumentManagement::get();
        return view('pages.index',compact('datas'));
    })->name('document');

    Route::get('/document/create', function () {
        return view('pages.create');
    })->name('document-create');

    Route::get('/document/edit/{id}', function ($id) {
        return view('pages.edit',compact('id'));
    })->name('document-edit');

    Route::get('/document/remove/{id}', function ($id) {
        DocumentManagement::find($id)->delete();
        return redirect()->back();
    })->name('document-edit');

//    Route::post('store',[DocumentManagementController::class,'store'])->name('document-management.store');


    Route::get('/test-1', function () {
// Array input
        $data = ['11', '12', 'cii', '001', '2', '1998', '7', '89', 'iia', 'fii'];

// Inisialisasi array asosiatif untuk menyimpan hasil
        $results = [];

// Iterasi melalui elemen-elemen dalam array
        foreach ($data as $item) {
            // Mengecek apakah elemen hanya berisi huruf
            if (ctype_alpha($item)) {
                // Mengecek apakah elemen sudah ada dalam hasil
                $results[$item] = [];
                // Membuat substring dan menambahkannya ke hasil
                $length = strlen($item);
                for ($i = 1; $i <= $length * 2 - 1; $i++) {
                    if ($i <= $length) {
                        $substring = substr($item, 0, $i);
                    } else {
                        $substring = substr($item, $i - $length, $length);
                    }
                    $results[$item][] = $substring;
                }
            }
        }
// Menggabungkan semua hasil substring menjadi satu array besar
        $mergedArray = [];
        foreach ($results as $key => $value) {
            $mergedArray = array_merge($mergedArray, $value);
        }
// Menghapus duplikat dan mengurutkan hasil akhir
        $mergedArray = array_values(array_unique($mergedArray));

// Menampilkan hasil
        foreach ($results as $key => $value) {
            echo "$key = " . json_encode(array_values(array_unique($value))) . "<br>";
        }

// Menampilkan hasil akhir
        echo 'S = ' . json_encode($mergedArray) . "\n";


    })->name('test-1');


});
