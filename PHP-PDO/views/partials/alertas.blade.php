@if (!empty($erro))
<div class="flex flex-col items-center w-screen absolute">
  <span class="bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded">
      {{ $erro }}
  </span>
</div>
@endif

@if (!empty($mensagem))
<div class="flex flex-col items-center w-screen absolute">
  <span class="bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded">
      {{ $mensagem }}
  </span>
</div>
@endif
