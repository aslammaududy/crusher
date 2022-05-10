<div>
    <h3 class="text-dark mb-4">Scanner</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Scanner</p>
        </div>
        <div class="card-body row" wire:ignore>
            <div class="col-md-12" style="text-align: center;margin-bottom: 20px;">
                <div id="reader" style="display: inline-block; position: relative; padding: 0px; border: 1px solid silver; width: 600px"></div>
            {{-- <div id="reader" width="100px"></div> --}}
        </div>
    </div>

    @livewire('scanner.form', ['qrcode' => $qrcode])
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            @this.set("qrcode", decodedText);
            console.log(`Code matched = ${decodedText}`, decodedResult);
            }

            function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        })
    </script>
</div>
