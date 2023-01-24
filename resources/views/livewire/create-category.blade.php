<div class="max-[300px]:w-full">

    <x-jet-secondary-button class="max-[300px]:w-full max-[300px]:justify-center" wire:click="$set('open_cat', true)">Categorías</x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="open_cat">
        <x-slot name='title'>
            <div class="text-2xl">Categorías</div>
        </x-slot>

        <x-slot name='content'>
            <div class="p-1">
                <div class="mb-4 w-full p-1">
                    <x-jet-label value="Nombre" />
                    <x-jet-input type="text" class="w-full" wire:model.defer="name" />
                    <x-jet-input-error for="name" />
                </div>
                <div class="mb-4 w-full p-1">
                    <x-jet-label value="Descripción" />
                    <textarea wire:model.defer="description" class="form-control w-full" cols="10" rows="4"></textarea>
                    <x-jet-input-error for="description" />
                </div>
                <div class="mb-4 w-full p-1">
                    <x-jet-label value="Color de fondo" />
                    <x-jet-input type="color" class="w-full h-10 rounded" wire:model.defer="backgroundcolor" />
                    <x-jet-input-error for="backgroundcolor" />
                </div>
                <div class="mb-4 w-full p-1 text-center">
                    <x-jet-button wire:click="save" wire:show="!isEditing" wire:target="save" wire:loading.remove
                        style="{{ !$isEditing ? '' : 'display: none;' }}">
                        <span>Crear categoría</span>
                    </x-jet-button>
                    <x-jet-danger-button wire:click="cancel" wire:show="isEditing" wire:target="save"
                        wire:loading.remove style="{{ $isEditing ? '' : 'display: none;' }}" class="btn-cancel-edit">
                        <span>Cancelar</span>
                    </x-jet-danger-button>
                    <x-jet-secondary-button wire:click="update" wire:show="isEditing" wire:target="save"
                        wire:loading.remove style="{{ $isEditing ? '' : 'display: none;' }}">
                        <span>Actualizar categoría</span>
                    </x-jet-secondary-button>
                    <div><span class="loader" wire:loading wire:target="save"></span></div>
                    <div><span class="loader" wire:loading wire:target="update"></span></div>
                </div>
            </div>

            <div class="h-1 w-full mx-auto border-b mt-2 mb-2"></div>
            <div x-data="{ open: false }"
                class="bg-gray-50 flex flex-col items-center justify-center relative overflow-hidden">
                <div @click="open = ! open"
                    class="p-4 bg-blue-de rounded flex justify-between items-center w-full accordian-animation">
                    <div class="flex items-center gap-2">
                        <svg viewBox="0 0 48 48" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 26h28v-4H10v4zm-4 8h28v-4H6v4zm8-20v4h28v-4H14z" fill="#d1453b"
                                class="fill-000000"></path>
                            <path d="M0 0h48v48H0z" fill="none"></path>
                        </svg>
                        <h4 class="font-medium text-base color-1fx3 ">Tus categorías</h4>
                    </div>
                    <div class="icon-accordian">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-0"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 translate-y-10"
                    x-transition:leave-end="opacity-0 translate-y-0" class="w-full bg-white boder-blue-de rounded-b-lg">
                    <div class="p-1">
                        @if (count($categories))
                            <div class="mb-4 w-full p-1 grid grid-cols-4 max-sm:grid-cols-2 gap-4">
                                @foreach ($categories as $category)
                                    <div
                                        class="w-full h-auto rounded shadow-default shadow-d-h bg-white py-1 px-3 flex flex-col justify-center items-center text-center">
                                        <span class="w-full font-light text-sm cursor-help rounded p-1 break-all"
                                            style="background: {{ $category->backgroundcolor }};"
                                            title="{{ $category->description }}">
                                            {{ $category->name }}
                                        </span>
                                        <div class="h-1 w-full mx-auto border-b my-1"
                                            style="border-color: {{ $category->backgroundcolor }};"></div>
                                        <div class="flex items-center justify-center gap-3 text-sm">
                                            <a wire:click="editcat({{ $category->id }})"
                                                title="Editar esta categoría: {{ $category->name }}"><i
                                                    class="fa-solid fa-pen-to-square rounded p-1 cursor-pointer"
                                                    style="color: #1e90ff;"></i></a>
                                            <a wire:click="$emit('deleteCat', {{ $category }})"
                                                title="Eliminar esta categoría: {{ $category->name }}"><i
                                                    class="fa-solid fa-trash rounded p-1 cursor-pointer"
                                                    style="color: #ff4757;"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="w-full grid grid-cols-1 place-items-center color-1fx3 py-2 text-center">
                                <h3 class="text-base underline mb-1">No hay categorías que mostrar.</h3>
                                <span class="color-1fx3 text-xs">En la parte superior, puedes crear una nueva categoría
                                    llenando el formulario con su nombre, descripción y color de fondo. Haz clic en
                                    "Crear categoría" para agregarla. Organiza mejor tus tareas asignándolas a esta
                                    nueva categoría.</span>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-danger-button wire:click="$set('open_cat', false)" class="mr-2">Cerrar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script>
            Livewire.on('deleteCat', catId => {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, Eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('create-category', 'delete', catId);
                    }
                })
            });
        </script>
    @endpush

</div>
