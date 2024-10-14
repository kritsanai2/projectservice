<?php

namespace App\Http\Controllers;

use App\Models\Movie; // ใช้โมเดล Movie
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // คืนค่ารายการหนังทั้งหมด
        return Movie::all(); // หรือสามารถใช้ MovieResource ถ้าคุณมี Resource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'release_year' => 'required|integer|min:1888|max:' . date('Y'), // ใช้ integer ที่นี่
                'genre' => 'nullable|string',
                'description' => 'nullable|string',
            ]);
            

            // สร้างหนังใหม่
            $movie = Movie::create($validatedData);

            // ส่งการตอบกลับ JSON พร้อมข้อมูลหนังใหม่
            return response()->json($movie, 201);
        } catch (\Exception $e) {
            // บันทึกข้อผิดพลาดลงใน log
            Log::error($e->getMessage());

            // ส่งการตอบกลับ JSON พร้อมรายละเอียดข้อผิดพลาด
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        
        // ตรวจสอบว่าหนังมีอยู่หรือไม่
        if (!$movie) {
            return response()->json(['error' => 'Movie not found.'], 404);
        }

        return response()->json($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // ค้นหาหนังตามไอดี
            $movie = Movie::findOrFail($id);

            // ตรวจสอบข้อมูลที่ส่งเข้ามาว่าถูกต้องหรือไม่
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'release_year' => 'required|integer|min:1888|max:' . date('Y'), // ใช้ integer ที่นี่
                'genre' => 'nullable|string',
                'description' => 'nullable|string',
            ]);
            
            

            // อัปเดตข้อมูลของหนัง
            $movie->update($validatedData);

            // ส่งการตอบกลับ JSON พร้อมข้อมูลหนังใหม่
            return response()->json($movie, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            // แสดงข้อความข้อผิดพลาดจากฐานข้อมูล
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // แสดงข้อความข้อผิดพลาดทั่วไป
            return response()->json(['error' => 'มีบางอย่างผิดพลาดในกระบวนการอัปเดตข้อมูล'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // ค้นหาหนังในฐานข้อมูล
        $movie = Movie::find($id);

        // ตรวจสอบว่าหนังมีอยู่หรือไม่
        if (!$movie) {
            return response()->json(['error' => 'Movie not found.'], 404);
        }

        // ลบหนัง
        $movie->delete();

        // ส่งการตอบกลับ JSON พร้อมข้อความสำเร็จ
        return response()->json(['success' => 'ลบหนังเรียบร้อยแล้ว.'], 200);
    }
}
