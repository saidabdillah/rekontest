<?php

namespace App\Livewire\Upload;

use App\Models\TbData;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UploadPdf extends Component
{
    use WithFileUploads;
    use WithPagination, WithoutUrlPagination;
    public $cari;
    public $filePdf;
    public $pathPdf;
    public $data;


    public function uploadPdf($id)
    {
        try {
            $this->validate([
                'filePdf' => 'required|mimes:pdf',
            ], [
                'filePdf.required' => 'File tidak boleh kosong.',
                'filePdf.mimes' => 'File harus berupa pdf.',
            ]);
            $tb_data = TbData::find($id);
            // Storage::disk('public')->delete($tb_data->file_path);

            $this->pathPdf = $this->filePdf->storeAs('pdf', $tb_data->id . '-' . $this->filePdf->getClientOriginalName(), ['disk' => 'public']);

            $tb_data->file_path = $this->pathPdf;
            $tb_data->save();

            $this->modal('uploadPdf-' . $id)->close();
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
        } catch (\Throwable $th) {
            $this->modal('uploadPdf-' . $id)->close();
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function cariData()
    {
        // Pagination buttons should not disappear during search
        $this->resetPage();
    }


    public function render()
    {
        $tb_data = TbData::when($this->cari, function ($query) {
            $query->cari($this->cari);
        })->latest()->paginate(10);

        return view('livewire.upload.upload-pdf', compact('tb_data'));
    }
}
