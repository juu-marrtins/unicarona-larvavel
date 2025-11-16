@extends('layouts.app')

@section('content')
<div class="w-full max-w-3xl bg-white shadow-xl rounded-2xl p-10">

    {{-- Logo --}}
    <div class="w-full flex justify-center mb-6">
        <img src="{{ asset('images/logoRotafy.jpg') }}"
            alt="Ray"
            class="h-12 md:h-14 lg:h-16 w-auto mx-auto object-contain">
    </div>

    <h2 class="text-2xl font-semibold text-center mb-8 text-[#1D3557]">
        Criar conta
    </h2>

    <form method="POST" action="/api/register" class="space-y-6" id="registerForm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input name="name" type="text" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input name="email" type="email" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">Senha</label>
                <input name="password" type="password" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">Curso</label>
                <input name="course" type="text" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">RA</label>
                <input name="ra" type="text" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">Telefone</label>
                <input name="phone" type="text" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">CPF</label>
                <input name="cpf" type="text" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">CNPJ da instituição</label>
                <input name="cnpj" type="text" required
                    class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">
            </div>
        </div>

        <input type="hidden" name="user_type" value="passenger">
        <input type="hidden" name="user_title" value="student">

        <button type="submit"
            class="w-full text-white font-semibold py-3 rounded-lg text-lg shadow-md hover:opacity-90 transition"
            style="background-color: #1D3557;">
            Registrar
        </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
        Já tem conta?
        <a href="/login" class="text-[#1D3557] font-semibold hover:underline">Entrar</a>
    </p>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    const response = await fetch('/api/register', {
        method: 'POST',
        body: formData
    });

    if (response.ok) {
        window.location.href = "/login";
    } else {
        alert("Erro ao registrar. Verifique os dados.");
    }
});
</script>

@endsection
