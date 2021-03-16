<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendApprovedKartuKeluarga;
use App\Notifications\KKApprovedNotification;
use App\Notifications\KKRejectedNotification;
use App\Submission;
use App\DataTables\Admin\SubmissionsDatatable;
use App\Http\Controllers\Controller;
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
        return $submissionsDatatable->render('admin.submission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        return view('admin.submission.show', compact('submission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Submission $submission
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Submission $submission)
    {
        if ($submission->status === Submission::STATUS_PROCESSING) {
            return $this->approve($request, $submission);
        }

        $this->validate($request, [
            'action' => 'required|in:accept,reject',
            'reject_reason' => 'required_if:action,reject'
        ]);

        $data = [];

        if ($request->action === 'accept'){
            $data['processed_at'] = now()->toDateTime();
            $data['status'] = Submission::STATUS_PROCESSING;
        } else {
            $data['rejected_at'] = now()->toDateTime();
            $data['status'] = Submission::STATUS_REJECTED;
            $data['reject_reason'] = $request->reject_reason;
            $submission->user->notify(new KKRejectedNotification($submission, $request->reject_reason));
        }

        $submission->update($data);

        return redirect()->back()->withSuccess('Pengajuan berhasil diupdate!');
    }

    /**
     * Method untuk mengupdate submisi yang berstatus processing
     */
    public function approve(Request $request, Submission $submission)
    {
        $this->validate($request, [
           'foto_kk_baru' => 'required|mimes:pdf'
        ]);

        $submission->attachment->update([
            'foto_kk_baru' => $request->file('foto_kk_baru')->store('public/kk_new')
        ]);

        $submission->update([
            'status' => Submission::STATUS_COMPLETED,
            'approved_at' => now()
        ]);

        $submission->user->notify(new KKApprovedNotification($submission));

        return redirect()->back()->withSuccess('Email yang berisi KK baru telah dikirim ke pengguna');
    }

}
