<?php

namespace App\Http\Controllers\dc_controller;

use App\dc_model\Activity;
use App\dc_model\Document;
use App\dc_model\File;
use App\dc_model\User;
use App\Http\Requests\UpdateProfileRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use ZipArchive;

class HomeController extends AppBaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = Document::all();
        $activities = Activity::with(['createdBy', 'document']);
        if ($request->has('activity_range')) {
            $dates = explode("to", $request->get('activity_range'));
            $activities->whereDate('created_at', '>=', $dates[0] ?? '');
            $activities->whereDate('created_at', '<=', $dates[1] ?? '');
        }
        $activities = $activities->orderByDesc('id')->paginate(25);
        $documentCounts = $documents->count();
        $filesCounts = File::whereIn('document_id', $documents->toArray())->count();
        return view('page.document_control.home', compact('documents', 'activities', 'documentCounts', 'filesCounts'));
    }

    public function welcome()
    {
        \Artisan::call("inspire");
        $quotes = \Artisan::output();
        return view('welcome', compact('quotes'));
    }

    public function profile(UpdateProfileRequest $request)
    {
        $profile = User::findOrFail(\Auth::id());
        $data = $request->all();
        if ($request->isMethod('POST')) {
            if ($request->has('btnprofile')) {
                \Flash::success("Profile Updated Successfully");
            } elseif ($request->has('btnpass')) {
                $data['password'] = bcrypt($data['new_password']);
                \Flash::success('Password Updated Successfully');
            }
            $profile->update($data);
            return redirect()->route('profile.manage');
        }

        return view('profile', compact('profile'));
    }

    /**
     * Show Or Download File.
     * @param Request $request
     * @param string $dir
     * @param null $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function showFile(Request $request, $dir = 'original', $file = null)
    {
        $name = $file;
        $attachment = 'inline';
        if ($request->has('force')) { //for force download
            $attachment = 'attachment';
        }
        if (!empty($file)) {
            $fileModels = File::where('file', $file)->get();
            if ($fileModels->isNotEmpty()) {
                $fileModel = $fileModels[0];
                $name = Str::slug($fileModel->document->name) . "_" . $fileModel->document->id . "_" . $dir . "_" . Str::slug($fileModel->name);
                $name .= "." . last(explode('.', $file));
            }
        }
        $file = storage_path('app/files/' . $dir . '/') . $file;
        return response()->file($file, ['Content-disposition' => $attachment . '; filename="' . $name . '"']);
    }

    public function downloadZip(Request $request, $id, $dir = 'all')
    {
        $document = Document::findOrFail($id);
        $tmpDir = storage_path('app/tmp/');
        if (!file_exists($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }
        $docFileTitle = Str::slug($document->name) . "_" . Str::slug($dir) . "_" . $document->id . ".zip";
        $zip_file = $tmpDir . $docFileTitle;

        $directories = [];
        $imageVariants = explode(",", config('settings.image_files_resize'));
        if ($dir == 'all' || $dir == 'original') {
            $directories[] = "original";
        } else {
            $directories[] = $dir;
        }
        if ($dir == 'all') {
            foreach ($imageVariants as $imageVariant) {
                $directories[] = $imageVariant;
            }
        }

        /*Create a zip archive*/
        $zip = new ZipArchive();
        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        if (!empty($dir) && !empty($directories)) {
            foreach ($directories as $directory) {
                foreach ($document->files as $file) {
                    $newName = $directory . "/" . Str::slug($file->name) . "_" . $file->id;
                    $newName .= "." . last(explode('.', $file->file));
                    $existingFile = storage_path("app/files/$directory/$file->file");
                    if (file_exists($existingFile)) {
                        $zip->addFile($existingFile, $newName);
                    }
                }
            }
        }

        $zip->close();
        return response()->download($zip_file)->deleteFileAfterSend();
    }

    public function downloadPdf(Request $request)
    {
        $files = $request->get('images', '');
        $varient = $request->get('images_varient', 'original');
        if (empty($files)) {
            return redirect()->back();
        }
        $files = explode(",", $files);
        $docName = Document::whereHas('files', function ($q) use ($files) {
            return $q->where('file', $files[0]);
        })->pluck('name')->first();
        $docName = Str::slug($docName) . "_" . $varient;
        $filePaths = [];
        foreach ($files as $file) {
            $filePaths[] = Image::make(storage_path("app/files/$varient/$file"))->encode('data-url');
        }
        $pdf = PDF::loadView('pdf', compact('docName', 'filePaths'));
        return $pdf->download($docName . ".pdf");
    }
}
