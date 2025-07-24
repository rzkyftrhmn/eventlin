<h2>Upload Bukti Pembayaran</h2>

@if($peserta->proposal->is_berbayar)
    <form action="{{ route('pembayaran.uploadForm.store', $peserta->proposal->id_proposal) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <input type="hidden" name="nim" value="{{$peserta->nim}}">
            <label for="bukti_pembayaran">Bukti Transfer (PDF/JPG/PNG):</label>
            <input type="file" name="bukti_pembayaran" accept=".pdf,.jpg,.jpeg,.png" required>
            @error('bukti_pembayaran')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Upload</button>
    </form>
@else
    <p>Acara ini tidak berbayar.</p>
@endif
