<div>
    <h3 class="text-dark mb-4">QR Codes</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">List of QR Codes</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                        <label class="form-label">
                            <input type="search" wire:model="search" class="form-control form-control-sm"
                                aria-controls="dataTable" placeholder="Search" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>QRCode</th>
                        </tr>
                    </thead>
                    <tbody id="equipmentsGroup">
                        @foreach ($qrcodes as $item)
                        <tr>
                            <td class="text-nowrap">
                                <a href="{{ url('equipments/'.$item->qr_code) }}"
                                    class="btn btn-sm btn-primary" aria-controls="equipment-details">Detail</a>
                            </td>
                            <td>{{ $item->qr_code }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                </div>
                <div class="col-md-6">
                    {{ $qrcodes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
