<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-popup {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>
<body>
    ini dashboard admin
    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#3B82F6'
            });
        </script>
    @endif  
    
</body>
</html>