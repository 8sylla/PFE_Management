<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Auth::user()->documents()->latest()->get();
        return view('student.documents.index', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:10240'], // 10MB max
            'description' => ['required', 'string', 'max:255'],
        ]);

        $path = $request->file('file')->store('pfe_documents/'.Auth::id(), 'public');

        Auth::user()->documents()->create([
            'description' => $request->description,
            'file_path' => $path,
            'file_name' => $request->file('file')->getClientOriginalName(),
        ]);

        return back()->with('success', 'Document téléversé avec succès !');
    }

    public function destroy(Document $document)
    {
        // Vérifier que l'utilisateur est bien le propriétaire du document
        if (Auth::id() !== $document->user_id) {
            abort(403);
        }

        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return back()->with('success', 'Document supprimé.');
    }
}