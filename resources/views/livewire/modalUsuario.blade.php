<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md z-50">
    <div class="max-w-3xl w-full mx-4 p-6 bg-white rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Detalles</h2>
        <form wire:submit.prevent="enviarClick" class="grid grid-cols-2 gap-x-6 gap-y-4">
            <div class="flex flex-col space-y-4">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input id="nombre" wire:model="nombre" type="text" 
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none 
                        focus:ring-2 focus:ring-orange-500 transition">
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input id="telefono" wire:model="telefono" type="text"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none 
                        focus:ring-2 focus:ring-orange-500 transition">
                    @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="turno" class="block text-sm font-medium text-gray-700">Turno</label>
                    <select id="turno" wire:model="turno"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none 
                            focus:ring-2 focus:ring-orange-500 transition">
                        <option value="">Seleccione un turno</option>
                        <option value="manana">Mañana</option>
                        <option value="tarde">Tarde</option>
                        <option value="noche">Noche</option>
                    </select>
                    @error('turno') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="rol" class="block text-sm font-medium text-gray-700">Rol del Usuario</label>
                    <select id="rol" wire:model="rol"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none 
                            focus:ring-2 focus:ring-orange-500 transition">
                        <option value="">Seleccione un rol</option>
                        <option value="farmaceutico">Farmacéutico</option>
                        <option value="administrador">Administrador</option>
                    </select>
                    @error('rol') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex flex-col space-y-4">
                <div>
                    <label for="usuario" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                    <input id="usuario" wire:model="usuario" type="text"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none 
                        focus:ring-2 focus:ring-orange-500 transition">
                    @error('usuario') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="contrasena" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="contrasena" wire:model="contrasena" type="password"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none 
                        focus:ring-2 focus:ring-orange-500 transition">
                    @error('contrasena') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="contrasena1" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                    <input id="contrasena1" wire:model="contrasena1" type="password"
                        class="w-full p-3 border border-gray-300 rounded-md focus:outline-none 
                        focus:ring-2 focus:ring-orange-500 transition">
                    @error('contrasena1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-span-2 flex justify-between space-x-4 mt-4">
                <button type="submit"
                    class="w-full bg-red-600 text-white font-bold py-3 rounded-md transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    Guardar
                </button>
                <button type="button" wire:click="closeModal()"
                    class="w-full bg-gray-300 text-gray-800 font-bold py-3 rounded-md transition hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>