@extends('layouts.admin')
@section('title', 'Edit Event | Admin')
@section('page-title', 'Edit Event')
@section('content')

<!-- Admin Header -->
<div class="admin-header bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="bi bi-pencil-square me-3"></i>Edit Event
                </h1>
                <p class="lead mb-0">Perbarui informasi event "{{ $event->title }}"</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('events.index') }}" class="btn btn-light btn-lg rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="form-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card bg-white rounded-4 shadow-lg p-5">
                    <div class="form-header text-center mb-4">
                        <div class="form-icon mb-3">
                            <i class="bi bi-calendar-event text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-2">Form Edit Event</h3>
                        <p class="text-muted">Perbarui informasi event yang dipilih</p>
                    </div>

                    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
                        
                        <!-- Event Title -->
                        <div class="form-group mb-4">
                            <label for="title" class="form-label fw-semibold">
                                <i class="bi bi-calendar-event text-primary me-2"></i>Judul Event
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   placeholder="Masukkan judul event"
                                   value="{{ old('title', $event->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Date -->
                        <div class="form-group mb-4">
                            <label for="date" class="form-label fw-semibold">
                                <i class="bi bi-calendar-date text-primary me-2"></i>Tanggal Event
                            </label>
                            <input type="date" 
                                   name="date" 
                                   id="date"
                                   class="form-control form-control-lg @error('date') is-invalid @enderror" 
                                   value="{{ old('date', $event->date) }}"
                                   required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Registration Period -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_start_date" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-check text-success me-2"></i>Tanggal Buka Pendaftaran
                                        <span class="text-muted small">(Opsional)</span>
                                    </label>
                                    <input type="datetime-local" 
                                           name="registration_start_date" 
                                           id="registration_start_date"
                                           class="form-control form-control-lg @error('registration_start_date') is-invalid @enderror" 
                                           value="{{ old('registration_start_date', $event->registration_start_date ? $event->registration_start_date->format('Y-m-d\TH:i') : '') }}">
                                    <div class="form-text">Kosongkan jika pendaftaran langsung dibuka</div>
                                    @error('registration_start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_end_date" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-x text-danger me-2"></i>Tanggal Tutup Pendaftaran
                                        <span class="text-muted small">(Opsional)</span>
                                    </label>
                                    <input type="datetime-local" 
                                           name="registration_end_date" 
                                           id="registration_end_date"
                                           class="form-control form-control-lg @error('registration_end_date') is-invalid @enderror" 
                                           value="{{ old('registration_end_date', $event->registration_end_date ? $event->registration_end_date->format('Y-m-d\TH:i') : '') }}">
                                    <div class="form-text">Pendaftaran otomatis tertutup setelah tanggal ini</div>
                                    @error('registration_end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Google Form Link -->
                        <div class="form-group mb-4">
                            <label for="google_form_link" class="form-label fw-semibold">
                                <i class="bi bi-link-45deg text-success me-2"></i>Link Google Form Pendaftaran
                                <span class="text-muted small">(Opsional, contoh: https://forms.gle/xxxx)</span>
                            </label>
                            <input type="url" 
                                   name="google_form_link" 
                                   id="google_form_link"
                                   class="form-control form-control-lg"
                                   placeholder="Masukkan link Google Form untuk pendaftaran event"
                                   value="{{ old('google_form_link', $event->google_form_link) }}">
                        </div>

                        <!-- Event Location -->
                        <div class="form-group mb-4">
                            <label for="location" class="form-label fw-semibold">
                                <i class="bi bi-geo-alt text-primary me-2"></i>Lokasi Event
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="location" 
                                   id="location"
                                   class="form-control form-control-lg @error('location') is-invalid @enderror" 
                                   placeholder="Contoh: Aula Kampus, Ruang Lab, Auditorium"
                                   value="{{ old('location', $event->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Payment Type -->
                        <div class="form-group mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-currency-dollar text-primary me-2"></i>Tipe Event
                            </label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="event_type" 
                                               id="event_free" 
                                               value="free"
                                               {{ old('event_type', $event->event_type ?? 'free') == 'free' ? 'checked' : '' }}
                                               onchange="toggleEventTypeFields()"
                                               required>
                                        <label class="form-check-label" for="event_free">
                                            <i class="bi bi-gift me-2"></i>Gratis
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="event_type" 
                                               id="event_paid" 
                                               value="paid"
                                               {{ old('event_type', $event->event_type ?? ($event->is_paid ? 'paid' : 'free')) == 'paid' ? 'checked' : '' }}
                                               onchange="toggleEventTypeFields()"
                                               required>
                                        <label class="form-check-label" for="event_paid">
                                            <i class="bi bi-currency-dollar me-2"></i>Berbayar
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="event_type" 
                                               id="event_public" 
                                               value="public"
                                               {{ old('event_type', $event->event_type ?? 'free') == 'public' ? 'checked' : '' }}
                                               onchange="toggleEventTypeFields()"
                                               required>
                                        <label class="form-check-label" for="event_public">
                                            <i class="bi bi-globe me-2"></i>Publik
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('event_type')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text mt-2">
                                <strong>Gratis:</strong> Event gratis dengan pendaftaran internal<br>
                                <strong>Berbayar:</strong> Event berbayar dengan sistem pembayaran<br>
                                <strong>Publik:</strong> Event publik, pendaftaran via Google Form (tanpa sistem internal)
                            </div>
                        </div>

                        <!-- Event Price (only show if paid) -->
                        <div class="form-group mb-4" id="priceField">
                            <label for="price" class="form-label fw-semibold">
                                <i class="bi bi-tag text-primary me-2"></i>Harga Event
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       class="form-control form-control-lg @error('price') is-invalid @enderror" 
                                       placeholder="Masukkan harga event"
                                       value="{{ old('price', $event->price) }}"
                                       min="0"
                                       step="1000">
                            </div>
                            <div class="form-text">
                                Masukkan harga dalam rupiah (contoh: 50000 untuk Rp 50.000)
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- QRIS Image -->
                        <div class="form-group mb-4" id="qrisField">
                            <label for="qris_image_path" class="form-label fw-semibold">
                                <i class="bi bi-qr-code text-success me-2"></i>Gambar QRIS
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="qris-upload-container">
                                <input type="file" 
                                       name="qris_image_path" 
                                       id="qris_image_path"
                                       class="form-control form-control-lg @error('qris_image_path') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewQrisImage(this)">
                                
                                <!-- Current QRIS Preview -->
                                @if($event->qris_image_path)
                                <div class="current-qris-preview mt-3" id="currentQrisPreview">
                                    <h6 class="fw-semibold text-success mb-2">
                                        <i class="bi bi-qr-code me-2"></i>QRIS Saat Ini
                                    </h6>
                                    <div class="current-qris-container">
                                        <img src="{{ asset('uploads/'.$event->qris_image_path) }}" 
                                             class="img-fluid rounded-3 shadow-sm" 
                                             style="max-height: 200px;"
                                             alt="QRIS Saat Ini">
                                    </div>
                                </div>
                                @endif
                                
                                <!-- New QRIS Preview -->
                                <div class="qris-preview mt-3" id="qrisPreview" style="{{ $event->qris_image_path ? 'display: none;' : 'display: block;' }}">
                                    <h6 class="fw-semibold text-success mb-2">
                                        <i class="bi bi-eye me-2"></i>Preview QRIS Baru
                                    </h6>
                                    <img id="previewQrisImg" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                </div>
                            </div>
                            <div class="form-text">
                                Upload gambar QRIS untuk pembayaran. Format yang didukung: JPG, PNG
                            </div>
                            @error('qris_image_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Certificate Template -->
                        <div class="form-group mb-4">
                            <label for="certificate_template" class="form-label fw-semibold">
                                <i class="bi bi-award text-primary me-2"></i>Template Sertifikat
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="certificate-upload-container">
                                <input type="file" 
                                       name="certificate_template" 
                                       id="certificate_template"
                                       class="form-control form-control-lg @error('certificate_template') is-invalid @enderror" 
                                       accept="image/*,.pdf"
                                       onchange="previewCertificate(this)">
                                
                                <!-- Current Certificate Template Preview -->
                                @if($event->certificate_template)
                                <div class="current-certificate-preview mt-3">
                                    <h6 class="fw-semibold text-primary mb-2">
                                        <i class="bi bi-award me-2"></i>Template Sertifikat Saat Ini
                                    </h6>
                                    <div class="current-certificate-container">
                                        @if(pathinfo($event->certificate_template, PATHINFO_EXTENSION) === 'pdf')
                                            <div class="pdf-preview bg-light p-4 rounded-3 text-center">
                                                <i class="bi bi-file-earmark-pdf text-danger display-4"></i>
                                                <p class="mt-2 mb-0 fw-semibold">Template PDF</p>
                                                <p class="text-muted small">{{ basename($event->certificate_template) }}</p>
                                            </div>
                                        @else
                                            <img src="{{ asset('uploads/'.$event->certificate_template) }}" 
                                                 class="img-fluid rounded-3 shadow-sm" 
                                                 style="max-height: 200px;"
                                                 alt="Template Sertifikat">
                                        @endif
                                        <div class="current-certificate-overlay">
                                            <span class="badge bg-primary">Template Saat Ini</span>
                                        </div>
                                    </div>
                                    <p class="text-muted small mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Upload template baru untuk mengganti template saat ini
                                    </p>
                                </div>
                                @endif
                                
                                <!-- New Certificate Template Preview -->
                                <div class="certificate-preview mt-3" id="certificatePreview" style="display: none;">
                                    <h6 class="fw-semibold text-success mb-2">
                                        <i class="bi bi-eye me-2"></i>Preview Template Baru
                                    </h6>
                                    <div id="previewCertificateContainer"></div>
                                </div>
                            </div>
                            <div class="form-text">
                                Upload template sertifikat untuk event ini. Format yang didukung: JPG, PNG, PDF
                            </div>
                            @error('certificate_template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Certificate Settings -->
                        <div class="form-group mb-4" id="certificateSettings" style="display: none;">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-gear text-primary me-2"></i>Konfigurasi Sertifikat
                            </label>
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="cert_x" class="form-label small">Posisi X (Horizontal)</label>
                                            <input type="number" name="cert_x" id="cert_x" class="form-control" placeholder="Default: Center" value="{{ old('cert_x', $event->cert_x) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cert_y" class="form-label small">Posisi Y (Vertikal)</label>
                                            <input type="number" name="cert_y" id="cert_y" class="form-control" placeholder="Default: Center" value="{{ old('cert_y', $event->cert_y) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cert_font_size" class="form-label small">Ukuran Font</label>
                                            <input type="number" name="cert_font_size" id="cert_font_size" class="form-control" placeholder="Default: 60" value="{{ old('cert_font_size', $event->cert_font_size) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cert_color" class="form-label small">Warna Teks</label>
                                            <input type="color" name="cert_color" id="cert_color" class="form-control form-control-color w-100" value="{{ old('cert_color', $event->cert_color ?? '#000000') }}" title="Pilih warna teks">
                                        </div>
                                    </div>
                                    <div class="form-text mt-2">
                                        Atur posisi dan gaya teks nama peserta pada sertifikat. Biarkan kosong untuk menggunakan default.
                                    </div>
                                </div>
                            </div>

                        <!-- Event Image -->
                        <div class="form-group mb-4">
                            <label for="image" class="form-label fw-semibold">
                                <i class="bi bi-image text-primary me-2"></i>Gambar Event
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <div class="image-upload-container">
                                <input type="file" 
                                       name="image" 
                                       id="image"
                                       class="form-control form-control-lg @error('image') is-invalid @enderror" 
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                
                                <!-- Current Image Preview -->
                                @if($event->image)
                                <div class="current-image-preview mt-3">
                                    <h6 class="fw-semibold text-primary mb-2">
                                        <i class="bi bi-image me-2"></i>Gambar Saat Ini
                                    </h6>
                                    <div class="current-image-container">
                                        <img src="{{ asset('uploads/'.$event->image) }}" 
                                             class="img-fluid rounded-3 shadow-sm" 
                                             style="max-height: 200px;"
                                             alt="{{ $event->title }}">
                                        <div class="current-image-overlay">
                                            <span class="badge bg-primary">Gambar Saat Ini</span>
                                        </div>
                                    </div>
                                    <p class="text-muted small mt-2">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Upload gambar baru untuk mengganti gambar saat ini
                                    </p>
                                </div>
                                @endif
                                
                                <!-- New Image Preview -->
                                <div class="image-preview mt-3" id="imagePreview" style="display: none;">
                                    <h6 class="fw-semibold text-success mb-2">
                                        <i class="bi bi-eye me-2"></i>Preview Gambar Baru
                                    </h6>
                                    <img id="previewImg" class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                </div>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Description -->
                        <div class="form-group mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="bi bi-text-paragraph text-primary me-2"></i>Deskripsi Event
                            </label>
                            <textarea name="description" 
                                      id="description"
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="5"
                                      placeholder="Jelaskan detail event, tujuan, dan informasi penting lainnya..."
                                      required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- WhatsApp Group Link -->
                        <div class="form-group mb-4">
                            <label for="whatsapp_group_link" class="form-label fw-semibold">
                                <i class="bi bi-whatsapp text-success me-2"></i>Link Grup WhatsApp
                                <span class="text-muted small">(Opsional)</span>
                            </label>
                            <input type="url" 
                                   name="whatsapp_group_link" 
                                   id="whatsapp_group_link"
                                   class="form-control form-control-lg @error('whatsapp_group_link') is-invalid @enderror" 
                                   placeholder="https://chat.whatsapp.com/..."
                                   value="{{ old('whatsapp_group_link', $event->whatsapp_group_link) }}">
                            <div class="form-text">
                                Link grup WhatsApp untuk peserta event. Peserta dapat bergabung untuk mendapatkan informasi terkini.
                            </div>
                            @error('whatsapp_group_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- SEO Fields -->
                        <hr class="my-4">
                        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-search me-2"></i>Google SEO</h5>
                        <div class="form-group mb-3">
                            <label for="seo_title" class="form-label fw-semibold">SEO Title</label>
                            <input type="text" name="seo_title" id="seo_title" class="form-control form-control-lg" placeholder="Judul SEO (opsional)" value="{{ old('seo_title', $event->seo_title) }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="seo_description" class="form-label fw-semibold">Meta Description</label>
                            <textarea name="seo_description" id="seo_description" class="form-control" rows="3" placeholder="Deskripsi singkat untuk meta description (opsional)">{{ old('seo_description', $event->seo_description) }}</textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label for="seo_jsonld" class="form-label fw-semibold">JSON-LD (Structured Data)</label>
                            <textarea name="seo_jsonld" id="seo_jsonld" class="form-control" rows="5" placeholder='Tempelkan JSON-LD valid, mis: {"&#64;context":"https://schema.org", ...} (opsional)'>{{ old('seo_jsonld', $event->seo_jsonld) }}</textarea>
                            <div class="form-text">Jika diisi, script JSON-LD akan ditampilkan di halaman publik.</div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 me-3">
                                <i class="bi bi-check-circle me-2"></i>Update Event
                            </button>
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-5">
                                <i class="bi bi-x-circle me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                    <hr class="my-5">
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-ticket-perforated me-2"></i>Voucher Diskon</h5>
                    <form action="{{ route('admin.events.vouchers.store', $event->id) }}" method="POST" class="row g-3 mb-3">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label">Kode</label>
                            <input type="text" name="code" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Diskon</label>
                            <select name="discount_percent" class="form-select" required>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                                <option value="50">50%</option>
                                <option value="80">80%</option>
                                <option value="100">100%</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary w-100">Tambah</button>
                        </div>
                    </form>
                    @php($vouchersTableExists = \Illuminate\Support\Facades\Schema::hasTable('vouchers'))
                    @if(!$vouchersTableExists)
                        <div class="alert alert-warning">Jalankan migrasi untuk mengaktifkan voucher: <code>php artisan migrate</code></div>
                    @else
                        <ul class="list-group">
                            @foreach(\App\Models\Voucher::where('applicable_type','event')->where('applicable_id',$event->id)->get() as $voucher)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $voucher->code }} — {{ $voucher->discount_percent }}%</span>
                                <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Info Section -->
<div class="event-info-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-primary mb-3">Informasi Event</h2>
            <p class="lead text-muted">Detail lengkap event yang sedang diedit</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="info-card bg-white rounded-4 p-4 shadow-lg">
                    <h4 class="fw-bold text-primary mb-3">
                        <i class="bi bi-info-circle me-2"></i>Detail Event
                    </h4>
                    <div class="info-item mb-3">
                        <strong>Judul:</strong> {{ $event->title }}
                    </div>
                    <div class="info-item mb-3">
                        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                    </div>
                    <div class="info-item mb-3">
                        <strong>Lokasi:</strong> {{ $event->location ?? 'Tidak ditentukan' }}
                    </div>
                    <div class="info-item mb-3">
                        <strong>Status:</strong> 
                        @if($event->date >= now())
                            <span class="badge bg-success">Mendatang</span>
                        @else
                            <span class="badge bg-secondary">Selesai</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="info-card bg-white rounded-4 p-4 shadow-lg">
                    <h4 class="fw-bold text-primary mb-3">
                        <i class="bi bi-image me-2"></i>Gambar Event
                    </h4>
            @if($event->image)
                        <div class="event-image-display">
                            <img src="{{ asset('uploads/'.$event->image) }}" 
                                 class="img-fluid rounded-3 shadow-sm" 
                                 alt="{{ $event->title }}">
                        </div>
                    @else
                        <div class="no-image-placeholder text-center py-4">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">Tidak ada gambar</p>
                        </div>
            @endif
        </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Admin Header */
.admin-header {
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
}

/* Form Card */
.form-card {
    transition: all 0.3s ease;
}

.form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.form-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1976d2 0%, #3F3F9C 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin: 0 auto;
}

/* Form Controls */
.form-control {
    border: 2px solid #e9ecef;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
}

.form-control-lg {
    font-size: 1rem;
}

/* Image Upload */
.image-upload-container {
    border: 2px dashed #dee2e6;
    border-radius: 0.75rem;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
}

.image-upload-container:hover {
    border-color: #1976d2;
    background: rgba(25, 118, 210, 0.05);
}

.current-image-container {
    position: relative;
    display: inline-block;
}

.current-image-overlay {
    position: absolute;
    top: 10px;
    right: 10px;
}

.image-preview {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    padding: 1rem;
    background: #f8f9fa;
}

.no-image-placeholder {
    border: 2px dashed #dee2e6;
    border-radius: 0.5rem;
    background: #f8f9fa;
}

/* Info Cards */
.info-card {
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important;
}

.info-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    border-bottom: none;
}

.event-image-display {
    text-align: center;
}

/* Form Actions */
.form-actions .btn {
    transition: all 0.3s ease;
}

.form-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .admin-header {
        text-align: center;
    }
    
    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-actions .btn {
        width: 100%;
    }
}
</style>

<script>
// Toggle fields based on event type
function toggleEventTypeFields() {
    const eventType = document.querySelector('input[name="event_type"]:checked')?.value;
    const priceField = document.getElementById('priceField');
    const qrisField = document.getElementById('qrisField');
    const certificateSettings = document.getElementById('certificateSettings');
    
    if (eventType === 'paid') {
        // Paid event: show price, QRIS, certificate, WhatsApp
        priceField.style.display = 'block';
        qrisField.style.display = 'block';
        if (certificateField) certificateField.style.display = 'block';
        if (certificateSettings) certificateSettings.style.display = 'block';
        if (whatsappField) whatsappField.style.display = 'block';
        if (googleFormField) {
            googleFormField.style.display = 'block';
            const googleFormInput = document.getElementById('google_form_link');
            if (googleFormInput) googleFormInput.removeAttribute('required');
        }
        // Make price required
        document.getElementById('price').setAttribute('required', 'required');
    } else if (eventType === 'public') {
        // Public event: hide price, QRIS, certificate, WhatsApp; show and require Google Form
        priceField.style.display = 'none';
        qrisField.style.display = 'none';
        if (certificateField) certificateField.style.display = 'none';
        if (certificateSettings) certificateSettings.style.display = 'none';
        if (whatsappField) whatsappField.style.display = 'none';
        if (googleFormField) {
            googleFormField.style.display = 'block';
            const googleFormInput = document.getElementById('google_form_link');
            if (googleFormInput) googleFormInput.setAttribute('required', 'required');
        }
        // Clear and remove required from price
        document.getElementById('price').removeAttribute('required');
    } else {
        // Free event: hide price and QRIS, show certificate and Google Form (optional)
        priceField.style.display = 'none';
        qrisField.style.display = 'none';
        if (certificateField) certificateField.style.display = 'block';
        if (certificateSettings) certificateSettings.style.display = 'block';
        if (whatsappField) whatsappField.style.display = 'none';
        if (googleFormField) {
            googleFormField.style.display = 'block';
            const googleFormInput = document.getElementById('google_form_link');
            if (googleFormInput) googleFormInput.removeAttribute('required');
        }
        // Clear and remove required from price
        document.getElementById('price').removeAttribute('required');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleEventTypeFields();
});

function previewQrisImage(input) {
    const preview = document.getElementById('qrisPreview');
    const previewImg = document.getElementById('previewQrisImg');
    const currentQrisPreview = document.getElementById('currentQrisPreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
            if (currentQrisPreview) {
                currentQrisPreview.style.display = 'none';
            }
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
        if (currentQrisPreview) {
            currentQrisPreview.style.display = 'block';
        }
    }
}

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}

function previewCertificate(input) {
    const preview = document.getElementById('certificatePreview');
    const previewContainer = document.getElementById('previewCertificateContainer');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            
            if (fileExtension === 'pdf') {
                previewContainer.innerHTML = `
                    <div class="pdf-preview bg-light p-4 rounded-3 text-center">
                        <i class="bi bi-file-earmark-pdf text-danger display-4"></i>
                        <p class="mt-2 mb-0 fw-semibold">Template PDF</p>
                        <p class="text-muted small">${file.name}</p>
                    </div>
                `;
            } else {
                previewContainer.innerHTML = `
                    <img src="${e.target.result}" 
                         class="img-fluid rounded-3 shadow-sm" 
                         style="max-height: 200px;"
                         alt="Preview Template Sertifikat">
                `;
            }
            
            preview.style.display = 'block';
        };
        
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

@endsection
