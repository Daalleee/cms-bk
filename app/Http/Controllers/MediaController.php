<?php

namespace App\Http\Controllers;

use App\Models\DetailPenanganan;
use App\Models\LogAktivitas;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        ini_set('upload_max_filesize', '500M');
        ini_set('post_max_size', '512M');
        ini_set('max_execution_time', '300');

        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'detail_id' => 'required|exists:detail_penanganan,id',
            'koleksi' => 'required|in:foto',
        ]);

        $file = $request->file('file');
        $detail = DetailPenanganan::findOrFail($request->detail_id);

        $path = $file->store('media/foto', 'public');

        $this->optimasiGambar($path);

        $urutan = Media::where('model_id', $detail->id)
            ->where('model_type', DetailPenanganan::class)
            ->where('koleksi', $request->koleksi)
            ->max('urutan') + 1;

        $media = Media::create([
            'model_id' => $detail->id,
            'model_type' => DetailPenanganan::class,
            'koleksi' => $request->koleksi,
            'nama' => $file->getClientOriginalName(),
            'sumber' => 'unggah',
            'path' => $path,
            'tipe_mime' => $file->getMimeType(),
            'ukuran' => $file->getSize(),
            'urutan' => $urutan,
        ]);

        LogAktivitas::create([
            'pengguna_id' => auth()->id(),
            'aktivitas' => 'Mengunggah ' . ($request->koleksi === 'foto' ? 'foto' : 'video') . ': ' . $file->getClientOriginalName(),
            'alamat_ip' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'media' => [
                'id' => $media->id,
                'nama' => $media->nama,
                'url' => $media->url_media,
                'thumbnail' => $media->thumbnail,
                'sumber' => $media->sumber,
                'koleksi' => $media->koleksi,
                'tipe_mime' => $media->tipe_mime,
                'urutan' => $media->urutan,
            ],
        ]);
    }

    public function uploadChunk(Request $request)
    {
        ini_set('upload_max_filesize', '500M');
        ini_set('post_max_size', '512M');
        ini_set('max_execution_time', '300');

        $request->validate([
            'file' => 'required|file',
            'detail_id' => 'required|exists:detail_penanganan,id',
            'koleksi' => 'required|in:foto',
            'chunk_index' => 'required|integer|min:0',
            'total_chunks' => 'required|integer|min:1',
            'upload_id' => 'required|string',
            'original_name' => 'required|string',
        ]);

        $uploadId = $request->upload_id;
        $chunkDir = storage_path("app/temp/chunks/{$uploadId}");
        $chunkFile = "{$chunkDir}/{$request->chunk_index}";

        if (!is_dir($chunkDir)) {
            mkdir($chunkDir, 0755, true);
        }

        $request->file('file')->move($chunkDir, $request->chunk_index);

        $isLast = ($request->chunk_index + 1) >= $request->total_chunks;

        if ($isLast) {
            $ext = pathinfo($request->original_name, PATHINFO_EXTENSION);
            $finalName = $uploadId . '.' . $ext;
            $finalPath = "media/foto/{$finalName}";
            $finalFullPath = storage_path("app/public/{$finalPath}");

            if (!is_dir(dirname($finalFullPath))) {
                mkdir(dirname($finalFullPath), 0755, true);
            }

            $out = fopen($finalFullPath, 'wb');
            for ($i = 0; $i < $request->total_chunks; $i++) {
                $chunk = "{$chunkDir}/{$i}";
                if (file_exists($chunk)) {
                    fwrite($out, file_get_contents($chunk));
                    unlink($chunk);
                }
            }
            fclose($out);

            rmdir($chunkDir);

            $detail = DetailPenanganan::findOrFail($request->detail_id);
            $mime = mime_content_type($finalFullPath);
            $size = filesize($finalFullPath);

            $this->optimasiGambar($finalPath);

            $urutan = Media::where('model_id', $detail->id)
                ->where('model_type', DetailPenanganan::class)
                ->where('koleksi', $request->koleksi)
                ->max('urutan') + 1;

            $media = Media::create([
                'model_id' => $detail->id,
                'model_type' => DetailPenanganan::class,
                'koleksi' => $request->koleksi,
                'nama' => $request->original_name,
                'sumber' => 'unggah',
                'path' => $finalPath,
                'tipe_mime' => $mime,
                'ukuran' => $size,
                'urutan' => $urutan,
            ]);

            LogAktivitas::create([
                'pengguna_id' => auth()->id(),
                'aktivitas' => 'Mengunggah (chunk) ' . ($request->koleksi === 'foto' ? 'foto' : 'video') . ': ' . $request->original_name,
                'alamat_ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'complete' => true,
                'media' => [
                    'id' => $media->id,
                    'nama' => $media->nama,
                    'url' => $media->url_media,
                    'thumbnail' => $media->thumbnail,
                    'sumber' => $media->sumber,
                    'koleksi' => $media->koleksi,
                    'tipe_mime' => $media->tipe_mime,
                    'urutan' => $media->urutan,
                ],
            ]);
        }

        return response()->json([
            'success' => true,
            'complete' => false,
            'chunk_index' => $request->chunk_index,
        ]);
    }

    public function addLink(Request $request)
    {
        $request->validate([
            'detail_id' => 'required|exists:detail_penanganan,id',
            'koleksi' => 'required|in:foto,video',
            'tipe' => 'required|in:youtube,tautan',
            'url' => 'required|string|max:500',
            'nama' => 'nullable|string|max:255',
        ]);

        $detail = DetailPenanganan::findOrFail($request->detail_id);

        $youtubeId = null;
        $finalUrl = $request->url;

        if ($request->tipe === 'youtube') {
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $request->url, $matches);
            $youtubeId = $matches[1] ?? null;
            if (!$youtubeId) {
                return response()->json(['success' => false, 'message' => 'URL YouTube tidak valid.'], 422);
            }
            $finalUrl = 'https://www.youtube.com/watch?v=' . $youtubeId;
        }

        $urutan = Media::where('model_id', $detail->id)
            ->where('model_type', DetailPenanganan::class)
            ->where('koleksi', $request->koleksi)
            ->max('urutan') + 1;

        $media = Media::create([
            'model_id' => $detail->id,
            'model_type' => DetailPenanganan::class,
            'koleksi' => $request->koleksi,
            'nama' => $request->nama ?? ($youtubeId ? 'YouTube - ' . $youtubeId : 'Tautan'),
            'sumber' => $request->tipe,
            'url' => $request->tipe === 'tautan' ? $request->url : null,
            'youtube_id' => $youtubeId,
            'urutan' => $urutan,
        ]);

        return response()->json([
            'success' => true,
            'media' => [
                'id' => $media->id,
                'nama' => $media->nama,
                'url' => $media->url_media,
                'thumbnail' => $media->thumbnail,
                'sumber' => $media->sumber,
                'koleksi' => $media->koleksi,
                'urutan' => $media->urutan,
            ],
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'media_ids' => 'required|array',
            'media_ids.*' => 'exists:media,id',
        ]);

        foreach ($request->media_ids as $index => $id) {
            Media::where('id', $id)->update(['urutan' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Media $media)
    {
        if ($media->sumber === 'unggah' && $media->path) {
            Storage::disk('public')->delete($media->path);
        }
        $media->delete();

        return response()->json(['success' => true]);
    }

    private function optimasiGambar(string $path): void
    {
        $fullPath = Storage::disk('public')->path($path);
        if (!file_exists($fullPath)) return;

        $info = getimagesize($fullPath);
        if (!$info) return;

        [$w, $h] = $info;
        $maxDim = 1920;
        if ($w <= $maxDim && $h <= $maxDim) return;

        $ratio = min($maxDim / $w, $maxDim / $h);
        $newW = (int)($w * $ratio);
        $newH = (int)($h * $ratio);

        $src = match ($info[2]) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($fullPath),
            IMAGETYPE_PNG => imagecreatefrompng($fullPath),
            IMAGETYPE_GIF => imagecreatefromgif($fullPath),
            IMAGETYPE_WEBP => imagecreatefromwebp($fullPath),
            default => null,
        };

        if (!$src) return;

        $dst = imagescale($src, $newW, $newH);
        if (!$dst) { imagedestroy($src); return; }

        $ext = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        match ($ext) {
            'jpg', 'jpeg' => imagejpeg($dst, $fullPath, 85),
            'png' => imagepng($dst, $fullPath, 6),
            'gif' => imagegif($dst, $fullPath),
            'webp' => imagewebp($dst, $fullPath, 85),
            default => null,
        };

        imagedestroy($src);
        imagedestroy($dst);
    }
}
