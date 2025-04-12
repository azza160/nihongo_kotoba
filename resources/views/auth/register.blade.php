@extends('auth.layout')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-zinc-100 px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
            {{-- Judul --}}
            <h1 class="text-3xl font-bold  text-gray-800 mb-2">Daftar ke Kotoba</h1>

            {{-- Deskripsi Santai --}}
            <p class=" text-sm text-gray-600 mb-6 text-justify">
                Yuk gabung dan mulai petualanganmu mempelajari kosakata Bahasa Jepang dengan cara yang seru dan penuh
                tantangan!
            </p>

            {{-- Form --}}
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf
                {{-- Nama Pengguna --}}
                <div class="relative">
                    <input type="text" id="nama_pengguna" name="nama_pengguna" value="{{ old('nama_pengguna') }}"
                        class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border 
                    border-gray-300 appearance-none focus:outline-none focus:ring-0 
                    focus:border-blue-600 peer @error('nama_pengguna') border-red-500 @enderror"
                        placeholder=" " required />
                    <label for="nama_pengguna"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 
                    scale-75 top-1 z-10 origin-[0] bg-white px-2 
                    peer-focus:px-2 peer-focus:text-blue-600 
                    peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 
                    peer-placeholder-shown:top-1/2 peer-focus:top-1 
                    peer-focus:scale-75 peer-focus:-translate-y-3 start-1">
                        Nama Pengguna
                    </label>
                    @error('nama_pengguna')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Email --}}
                <div class="relative">
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border 
                    border-gray-300 appearance-none focus:outline-none focus:ring-0 
                    focus:border-blue-600 peer @error('email') border-red-500 @enderror"
                        placeholder=" " required />
                    <label for="email"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1">Email</label>
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kata Sandi --}}
                <div class="relative">
                    <input type="password" id="kata_sandi" name="kata_sandi"
                        class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('kata_sandi') border-red-500 @enderror"
                        placeholder=" " required />
                    <label for="kata_sandi"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1">
                        Kata Sandi
                    </label>
                    <button type="button"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
                        onclick="togglePassword('kata_sandi', 'eye-icon-kata_sandi')">
                        <svg id="eye-icon-kata_sandi" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    @error('kata_sandi')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Kata Sandi --}}
                <div class="relative">
                    <input type="password" id="kata_sandi_confirmation" name="kata_sandi_confirmation"
                        class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('kata_sandi') border-red-500 @enderror"
                        placeholder=" " required />
                    <label for="kata_sandi_confirmation"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-1 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 start-1">
                        Konfirmasi Kata Sandi
                    </label>
                    <button type="button"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
                        onclick="togglePassword('kata_sandi_confirmation', 'eye-icon-konfirmasi_kata_sandi')">
                        <svg id="eye-icon-konfirmasi_kata_sandi" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    @error('kata_sandi')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Tombol --}}
                <button type="submit"
                    class="w-full py-2.5 px-4 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-medium transition">Buat
                    Akun</button>

                {{-- Divider --}}
                <div class="flex items-center my-4">
                    <hr class="flex-grow border-t border-gray-300">
                    <span class="px-3 text-sm text-gray-500">atau</span>
                    <hr class="flex-grow border-t border-gray-300">
                </div>

                {{-- Tombol Daftar dengan Google --}}
                <button type="button" 
                    class="w-full py-2.5 px-4 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center justify-center gap-2 transition">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                    <a href="{{ route('auth.google') }}">Daftar dengan Google</a>
                
                </button>


                <p class="text-center text-xs text-gray-500 mt-4">Sudah punya akun? <a href="{{ route('login') }}"
                        class="text-blue-600 hover:underline">Masuk sekarang</a></p>
            </form>
        </div>
    </div>
   

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
@endsection
