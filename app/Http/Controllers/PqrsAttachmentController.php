<?php

namespace App\Http\Controllers;

use App\Models\PqrsSubmission;
use Illuminate\Support\Facades\Storage;

class PqrsAttachmentController extends Controller
{
    public function show(PqrsSubmission $submission)
    {
        if (! $submission->adjunto || ! Storage::disk('local')->exists($submission->adjunto)) {
            abort(404);
        }

        return Storage::disk('local')->download($submission->adjunto);
    }
}