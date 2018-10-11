<?php

namespace RuLong\Panel\Controllers;

use Illuminate\Http\Request;
use RuLong\Panel\Models\Storage as StorageModel;

class StorageController extends Controller
{

    public function test()
    {
        return view('RuLong::storages.test');
    }

    public function upload(Request $request, $name)
    {
        if ($request->hasFile($name) && $request->file($name)->isValid()) {
            $File      = $request->file($name);
            $hash      = \File::hash($File->path());
            $hasUpload = StorageModel::where('hash', $hash)->first();

            if (!$hasUpload) {
                $path = $File->storeAs(
                    date('Y/m/d'), $hash . '.' . $File->getClientOriginalExtension(), 'public'
                );
                $url = \Storage::disk('public')->url($path);

                $hasUpload = StorageModel::create([
                    'name' => $File->getClientOriginalName(),
                    'hash' => $hash,
                    'type' => $File->getClientMimeType(),
                    'size' => $File->getSize(),
                    'path' => $url,
                ]);
            }

            return [
                'statusCode'   => 200,
                'message'      => '文件上传成功',
                'callbackType' => 'closeCurrent',
                'data'         => [
                    'id'   => $hasUpload->id,
                    'name' => $hasUpload->name,
                    'size' => $hasUpload->size,
                    'type' => $hasUpload->type,
                    'url'  => $hasUpload->path,
                ],
            ];
        } else {
            return $this->error('未选择文件或文件不合法');
        }
    }

    public function index(Request $request)
    {
        $name           = $request->name;
        $numPerPage     = $request->numPerPage ?: 30;
        $orderField     = $request->orderField;
        $orderDirection = $request->orderDirection;

        $storages = StorageModel::when($name, function ($query) use ($name) {
            $query->where('name', 'like', "%{$name}%");
        })->when($orderField, function ($query) use ($orderField, $orderDirection) {
            $query->orderBy($orderField, $orderDirection);
        })->orderBy('id', 'desc')->paginate($numPerPage);

        return view('RuLong::storages.index', compact('storages'));
    }
}
