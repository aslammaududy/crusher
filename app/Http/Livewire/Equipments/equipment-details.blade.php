<div>
    <div class="spinner" wire:loading>
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="equipment-details-table" wire:loading.remove>
        <div class="row">
            <div class="col-md-6 text-nowrap">
            </div>
            <div class="col-md-6">
                <div class="text-md-end dataTables_filter" id="dataTable_filter">
                    <label class="form-label">
                        <input type="search" wire:model="search" class="form-control form-control-sm"
                            aria-controls="dataTable" placeholder="Search" />
                    </label>
                </div>
            </div>
        </div>
        <table class="table table-responsive table-bordered table-dark">
            <thead>
                <th>Equipment Code</th>
                <th>Component Number</th>
                <th>Material Description</th>
                <th>Component Quantity</th>
                <th>Unit</th>
                <th>Storage</th>
            </thead>
            <tbody>
                @foreach ($details as $item)
                <tr>
                    <td>{{ $item->equipment_header_code }}</td>
                    <td>{{ $item->component_quantity }}</td>
                    <td>{{ $item->material_description }}</td>
                    <td>{{ $item->component_quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->storage }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6 align-self-center">
            </div>
            <div class="col-md-6">
                {{ $details->links() }}
            </div>
        </div>
    </div>
</div>
