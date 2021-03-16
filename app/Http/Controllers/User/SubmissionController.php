<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Attachment;
use App\DataTables\User\SubmissionsDatatable;
use App\Http\Controllers\Controller;
use App\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubmissionsDatatable $submissionsDatatable)
    {
        return $submissionsDatatable->render('user.submission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.submission.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        return view('user.submission.show', compact('submission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (
            Submission::where(function ($query) {
                $query->where('status', Submission::STATUS_PENDING)
                    ->orWhere('status', Submission::STATUS_PROCESSING);
            })
                ->where('user_id', auth()->id())->count() > 0
        )
        {
            return redirect()->back()->withErrors('Anda tidak dapat mengajukan lagi sebelum pengajuan sebelumnya selesai');
        }

        $validated = $this->validate($request, [
            'reason' => 'required',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg',
            'foto_surat_pengantar' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = Submission::STATUS_PENDING;
        $submission = Submission::create($validated);

        Attachment::create([
            'foto_kk' => $request->file('foto_kk')->store('public/kk'),
            'foto_ktp' => $request->file('foto_ktp')->store('public/ktp'),
            'foto_surat_pengantar' => $request->file('foto_surat_pengantar')->store('public/surat'),
            'submission_id' => $submission->id
        ]);

        return redirect()->back()->withSuccess('Pengajuan berhasil dibuat!');
    }
}
