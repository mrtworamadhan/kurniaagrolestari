<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koneksi Terputus - PT KAL</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-secondary-50 h-screen flex flex-col items-center justify-center p-6 text-center">
    
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-secondary-200 max-w-sm w-full">
        <div class="mb-6 flex justify-center">
             <div class="w-16 h-16 rounded-xl flex items-center justify-center bg-primary-50 border border-primary-200">
                <img src="{{ asset('images/logoKAL.png') }}" alt="Logo" class="w-12 h-12 object-contain">
             </div>
        </div>
        
        <div class="mb-4 flex justify-center text-secondary-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>
        
        <h1 class="text-xl font-bold text-gray-800 mb-2">Koneksi Terputus</h1>
        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
            Maaf, aplikasi tidak dapat terhubung ke server. Periksa jaringan internet Anda.
        </p>
        
        <button onclick="window.location.reload()" class="w-full bg-primary-500 hover:bg-primary-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-primary-500/30 transition duration-200 transform active:scale-95">
            Coba Lagi
        </button>
    </div>

</body>
</html>