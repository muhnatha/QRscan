@php 

    use SimpleSoftwareIO\QrCode\Facades\QrCode; 

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            </div>
            <div class="p-6 bg-white flex items-center justify-center">
                {{-- <img src="{{ asset('storage/qr/' .$qr->image) }}" class="h-80 w-80" alt="QR Code"> --}}
                {{-- <h1 class="text-2xl font-bold text-white text-center ">Ini buat nanti QR nya</h1> --}}
                <!-- <img src="https://www.sbsaudilawyers.com/wp-content/uploads/2022/05/1200px-QR_Code_Example.svg.png" class="w-full" alt="QR Code"> -->
                @if (session('qrFileName'))
                    <img src="{{ asset('qrcodes/' . session('qrFileName')) }}" class="h-80 w-80" alt="QR Code">
                @else
                    <h1 class="text-2xl font-bold text-black text-center mb-4">QR not generated</h1>
                    <form action="{{ route('generate.qr') }}" method="POST">
                        @csrf
                        <select name="activity" class="border rounded px-2 py-1 mr-2" required>
                            <option value="" disabled selected>Select data for QR code</option>
                            <option value="Guru">Guru</option>
                        </select>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Generate QR Code
                        </button>
                    </form>
                @endif
                {{-- {!! QrCode::size(400)->generate('tes') !!} --}}
            </div>
        </div>
    </div>
</body>
</html>