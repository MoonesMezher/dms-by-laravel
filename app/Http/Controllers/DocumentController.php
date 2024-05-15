<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use Illuminate\Support\Facades\Cache;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Cache::remember('documents', 60, function() {
            return Document::with('user', 'comments')->get();
        });

        return response()->json([
            'state' => 'success',
            'documents' => $documents
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        $file = $request->file('file');
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->storeAs('documents', $filename);

        Cache::forget('documents');

        $document = Document::insert([
            'user_id' => $request->user()->id,
            'file_name' => $filename,
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType(),
            'updated_at' => now(),
            'created_at' => now()
        ]);

        return response()->json([
            'state' => 'success',
            'document' => $document
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Document $document, $id)
    {
        $document = Document::find($id);

        return response()->json([
            'state' => 'success',
            'document' => $document
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document, $id)
    {
        $file = $request->file('file');
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->storeAs('documents', $filename);

        Cache::forget('documents');

        $document = Document::find($id);

        $document->update([
            'file_name' => $filename,
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'state' => 'success',
            'document' => $document
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document, $id)
    {
        $document = Document::find($id);

        Cache::forget('documents');

        $document->delete();

        return response()->json([
            'state' => 'success',
            'document' => $document
        ]);
    }
}
