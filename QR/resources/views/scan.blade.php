<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scan QR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center items-center h-full min-h-screen w-full px-4">
        <div class="p-6 bg-gray-100 rounded-md outline-1 outline-black border flex flex-col items-center justify-center max-w-lg w-full">
            <div class="text-center mb-5">
                <h1 class="text-2xl font-bold">Scan QR Code</h1>
                <div class="p-6 bg-white flex items-center justify-center">
                        {{-- <img src="{{ asset('storage/qr/' .$qr->image) }}" class="h-80 w-80" alt="QR Code"> --}}
                        {{-- <h1 class="text-2xl font-bold text-white text-center ">Ini buat nanti QR nya</h1> --}}
                        <!-- <img src="https://www.sbsaudilawyers.com/wp-content/uploads/2022/05/1200px-QR_Code_Example.svg.png" class="w-full" alt="QR Code"> -->
                    <div id="qr-code" class="p-6 bg-white flex items-center justify-center"></h1>
                </div>
            </div>   
        </div>
            <div class="mt-4 flex gap-4 items-center justify-center">
                <button onclick="startAutoGenerate()" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Start 
                </button>
                <button onclick="stopAutoGenerate()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Stop
                </button>
            </div> 
    </div>

    <script>
        let fetchInterval = null;
        let generateInterval = null;

        async function fetchLatestQR() {
            try {
                const res = await fetch('/latest-qr');
                const data = await res.json();

                const qrDiv = document.getElementById('qr-code');

                // Fetch the SVG QR code from the server
                const svgRes = await fetch(`/generate-qr-svg/${data.qr}?_=${Date.now()}`);
                const svg = await svgRes.text();

                qrDiv.innerHTML = svg;
            } catch (err) {
                console.error('Error fetching QR:', err);
                document.getElementById('qr-code').innerHTML = '<p>Error loading QR Code</p>';
            }
        }

        async function generateNewQR() {
            try {
                await fetch('/generate-qr', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                });
                console.log("New QR generated");
                fetchLatestQR(); // Immediately update view
            } catch (err) {
                console.error("Error generating QR:", err);
            }
        }

        function startAutoGenerate() {
            if (generateInterval || fetchInterval) return; // Already running

            generateNewQR(); // Generate and fetch once now
            fetchInterval = setInterval(fetchLatestQR, 10000); // Refresh QR from server
            generateInterval = setInterval(generateNewQR, 10000); // Generate new QR every 10s
        }

        function stopAutoGenerate() {
            clearInterval(fetchInterval);
            clearInterval(generateInterval);
            fetchInterval = null;
            generateInterval = null;
            // Reset the QR code display
            document.getElementById('qr-code').innerHTML = '';
        }
    </script>
</body>
</html>