<div>
    @if ($ShowBar)
        <div class=" flex items-center absolut bottom-0 left-0 px-4 py-12 bg-gray-700 text-white">
            <div class="w-3/12">

            </div>
            <div class="flex-1">
                <p>Esta web utiliza cookiies para su correcto funcionamiento, el uso de la misma implíca su aceptación
                </p>
            </div>
            <div class="w-3/12">
                <button wire.click="AcceptCookie" class=" w-full px-3 py-2 bg-green-700 border-white hover:bg-green-800">Aceptar Cookie

                </button>

            </div>
        </div>
    @endif
</div>
