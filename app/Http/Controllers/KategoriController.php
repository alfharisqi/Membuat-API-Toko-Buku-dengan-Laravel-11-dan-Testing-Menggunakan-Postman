<?php
namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;
class KategoriController extends Controller
{
    public function index()
    {
        return Kategori::all();
    }
    public function store(Request $request)
    {
        try {
            $request->validate(['nama_kategori' => 'required|unique:kategoris']);
            $kategori = Kategori::create($request->all());
            return response()->json($kategori, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    public function show(string $id){}
    public function update(Request $request, string $id){}
    public function destroy(string $id){}
}