@extends('layouts.app')

@section('title', 'ISBorrow | Admin Dashboard')

@section('content')
    @php
        $activeTab = request('tab', 'catalog');
    @endphp

    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <span class="isb-badge">Admin Dashboard</span>
                    <h1 class="display-6 mt-3">Kelola Katalog dan Peminjaman</h1>
                    <p class="text-muted">Gunakan tab di bawah untuk melihat katalog, history, dan meninjau peminjaman.</p>
                </div>
                <div class="text-end">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab === 'catalog' ? 'active' : '' }}"
                                href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['tab' => 'catalog'])) }}">
                                Katalog
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab === 'history' ? 'active' : '' }}"
                                href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['tab' => 'history'])) }}">
                                History
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $activeTab === 'peminjaman' ? 'active' : '' }}"
                                href="{{ route('admin.dashboard', array_merge(request()->except('page'), ['tab' => 'peminjaman'])) }}">
                                Peminjaman
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade {{ $activeTab === 'catalog' ? 'show active' : '' }}" id="catalog"
                            role="tabpanel">
                            <div class="mb-4">
                                <h4 class="card-title mb-1">Katalog</h4>
                                <p class="text-muted mb-0">Filter, cari, dan urutkan item yang tersedia.</p>
                            </div>

                            <form method="GET" action="{{ route('admin.dashboard') }}"
                                class="row gy-2 gx-2 align-items-end mb-4">
                                <input type="hidden" name="tab" value="catalog">
                                <div class="col-md-4">
                                    <label class="form-label">Cari item</label>
                                    <input name="catalog_search" value="{{ request('catalog_search') }}"
                                        class="form-control" placeholder="Nama, kategori, atau lokasi">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Kategori</label>
                                    <select name="catalog_category" class="form-select">
                                        <option value="all">Semua Kategori</option>
                                        <option value="Hardware"
                                            {{ request('catalog_category') === 'Hardware' ? 'selected' : '' }}>Hardware
                                        </option>
                                        <option value="Software"
                                            {{ request('catalog_category') === 'Software' ? 'selected' : '' }}>Software
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Status</label>
                                    <select name="catalog_availability" class="form-select">
                                        <option value="all">Semua Status</option>
                                        <option value="available"
                                            {{ request('catalog_availability') === 'available' ? 'selected' : '' }}>
                                            Tersedia</option>
                                        <option value="borrowed"
                                            {{ request('catalog_availability') === 'borrowed' ? 'selected' : '' }}>Habis
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Sortir</label>
                                    <select name="catalog_sort" class="form-select">
                                        <option value="name_asc"
                                            {{ request('catalog_sort') === 'name_asc' ? 'selected' : '' }}>Nama A-Z
                                        </option>
                                        <option value="name_desc"
                                            {{ request('catalog_sort') === 'name_desc' ? 'selected' : '' }}>Nama Z-A
                                        </option>
                                        <option value="quantity_asc"
                                            {{ request('catalog_sort') === 'quantity_asc' ? 'selected' : '' }}>Stok naik
                                        </option>
                                        <option value="quantity_desc"
                                            {{ request('catalog_sort') === 'quantity_desc' ? 'selected' : '' }}>Stok turun
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-primary">Terapkan</button>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Nama Item</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th class="text-end">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($catalogItems as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->location }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $item->quantity > 0 ? 'success' : 'secondary' }}">
                                                        {{ $item->quantity > 0 ? 'Tersedia' : 'Habis' }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#item-detail-{{ $item->id }}">
                                                        Lihat
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="item-detail-{{ $item->id }}">
                                                <td colspan="6">
                                                    <div class="border rounded p-3 bg-light">
                                                        <p class="mb-1"><strong>Deskripsi:</strong>
                                                            {{ $item->description ?? 'Tidak ada deskripsi' }}</p>
                                                        <p class="mb-0"><strong>URL Gambar:</strong>
                                                            {{ $item->image_url ?? '-' }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada item katalog ditemukan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                {{ $catalogItems->links() }}
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $activeTab === 'history' ? 'show active' : '' }}" id="history"
                            role="tabpanel">
                            <div class="mb-4">
                                <h4 class="card-title mb-1">History Peminjaman</h4>
                                <p class="text-muted mb-0">Lihat semua permintaan yang pernah diproses.</p>
                            </div>

                            <form method="GET" action="{{ route('admin.dashboard') }}"
                                class="row gy-2 gx-2 align-items-end mb-4">
                                <input type="hidden" name="tab" value="history">
                                <div class="col-md-4">
                                    <label class="form-label">Cari history</label>
                                    <input name="request_search" value="{{ request('request_search') }}"
                                        class="form-control" placeholder="Nama siswa, email, item, status">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                    <select name="request_status" class="form-select">
                                        <option value="all">Semua Status</option>
                                        <option value="pending"
                                            {{ request('request_status') === 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="accepted"
                                            {{ request('request_status') === 'accepted' ? 'selected' : '' }}>Diterima
                                        </option>
                                        <option value="rejected"
                                            {{ request('request_status') === 'rejected' ? 'selected' : '' }}>Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Sortir</label>
                                    <select name="request_sort" class="form-select">
                                        <option value="requested_at_desc"
                                            {{ request('request_sort') === 'requested_at_desc' ? 'selected' : '' }}>Terbaru
                                        </option>
                                        <option value="requested_at_asc"
                                            {{ request('request_sort') === 'requested_at_asc' ? 'selected' : '' }}>Terlama
                                        </option>
                                        <option value="due_date_asc"
                                            {{ request('request_sort') === 'due_date_asc' ? 'selected' : '' }}>Jatuh tempo
                                            awal</option>
                                        <option value="due_date_desc"
                                            {{ request('request_sort') === 'due_date_desc' ? 'selected' : '' }}>Jatuh tempo
                                            akhir</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-primary">Terapkan</button>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Nama Siswa</th>
                                            <th>Email</th>
                                            <th>Permintaan</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Status</th>
                                            <th class="text-end">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($borrowRequests as $request)
                                            <tr>
                                                <td>{{ $request->catalogItem?->name ?? 'Item tidak ditemukan' }}</td>
                                                <td>{{ $request->student_name }}</td>
                                                <td>{{ $request->student_email }}</td>
                                                <td>{{ $request->requested_at->format('d M Y') }}</td>
                                                <td>{{ $request->due_date->format('d M Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $request->status === 'pending' ? 'warning text-dark' : ($request->status === 'accepted' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#history-detail-{{ $request->id }}">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="history-detail-{{ $request->id }}">
                                                <td colspan="7">
                                                    <div class="border rounded p-3 bg-light">
                                                        <p class="mb-1"><strong>Catatan:</strong>
                                                            {{ $request->notes ?? 'Tidak ada catatan' }}</p>
                                                        <p class="mb-0"><strong>Jumlah item saat ini:</strong>
                                                            {{ $request->catalogItem?->quantity ?? '-' }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada riwayat peminjaman
                                                    ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                {{ $borrowRequests->links() }}
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $activeTab === 'peminjaman' ? 'show active' : '' }}" id="peminjaman"
                            role="tabpanel">
                            <div class="mb-4">
                                <h4 class="card-title mb-1">Peminjaman</h4>
                                <p class="text-muted mb-0">Terima atau tolak permintaan peminjaman yang tertunda.</p>
                            </div>

                            <form method="GET" action="{{ route('admin.dashboard') }}"
                                class="row gy-2 gx-2 align-items-end mb-4">
                                <input type="hidden" name="tab" value="peminjaman">
                                <div class="col-md-4">
                                    <label class="form-label">Cari permintaan</label>
                                    <input name="request_search" value="{{ request('request_search') }}"
                                        class="form-control" placeholder="Nama siswa, email, item">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                    <select name="request_status" class="form-select">
                                        <option value="all">Semua Status</option>
                                        <option value="pending"
                                            {{ request('request_status') === 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="accepted"
                                            {{ request('request_status') === 'accepted' ? 'selected' : '' }}>Diterima
                                        </option>
                                        <option value="rejected"
                                            {{ request('request_status') === 'rejected' ? 'selected' : '' }}>Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Sortir</label>
                                    <select name="request_sort" class="form-select">
                                        <option value="requested_at_desc"
                                            {{ request('request_sort') === 'requested_at_desc' ? 'selected' : '' }}>Terbaru
                                        </option>
                                        <option value="requested_at_asc"
                                            {{ request('request_sort') === 'requested_at_asc' ? 'selected' : '' }}>Terlama
                                        </option>
                                        <option value="due_date_asc"
                                            {{ request('request_sort') === 'due_date_asc' ? 'selected' : '' }}>Jatuh tempo
                                            awal</option>
                                        <option value="due_date_desc"
                                            {{ request('request_sort') === 'due_date_desc' ? 'selected' : '' }}>Jatuh tempo
                                            akhir</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-primary">Terapkan</button>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Nama Siswa</th>
                                            <th>Email</th>
                                            <th>Permintaan</th>
                                            <th>Jatuh Tempo</th>
                                            <th>Status</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($borrowRequests as $request)
                                            <tr>
                                                <td>{{ $request->catalogItem?->name ?? 'Item tidak ditemukan' }}</td>
                                                <td>{{ $request->student_name }}</td>
                                                <td>{{ $request->student_email }}</td>
                                                <td>{{ $request->requested_at->format('d M Y') }}</td>
                                                <td>{{ $request->due_date->format('d M Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $request->status === 'pending' ? 'warning text-dark' : ($request->status === 'accepted' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#approval-detail-{{ $request->id }}">
                                                        Detail
                                                    </button>
                                                    @if ($request->status === 'pending')
                                                        <form
                                                            action="{{ route('admin.borrow_requests.accept', $request) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm">Terima</button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.borrow_requests.reject', $request) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Tolak</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="approval-detail-{{ $request->id }}">
                                                <td colspan="7">
                                                    <div class="border rounded p-3 bg-light">
                                                        <p class="mb-1"><strong>Catatan:</strong>
                                                            {{ $request->notes ?? 'Tidak ada catatan' }}</p>
                                                        <p class="mb-0"><strong>Jumlah item saat ini:</strong>
                                                            {{ $request->catalogItem?->quantity ?? '-' }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada peminjaman ditemukan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                {{ $borrowRequests->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
