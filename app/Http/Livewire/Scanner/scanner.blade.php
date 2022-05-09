<div>
    <h3 class="text-dark mb-4">Scanner</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Scanner</p>
        </div>
        <div class="card-body">
            <div id="reader" width="600px"></div>
        </div>
    </div>

    <div class="card shadow mt-5">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Form</p>
        </div>
        <div class="card-body">
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            }

            function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        })
    </script>
</div>