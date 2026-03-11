        <div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">K. Ebenin Kişisel İzlem ve Notları</div>
            <div class="card-body">

                <div class="mb-3">
                    <label for="ebenin_yorumu" class="form-label">Yorum / Not:</label>
                    <textarea name="ebenin_yorumu" id="ebenin_yorumu" class="form-control @error('ebenin_yorumu') is-invalid @enderror" rows="5">{{ old('ebenin_yorumu') }}</textarea>
                    @error('ebenin_yorumu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
