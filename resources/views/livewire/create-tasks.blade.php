<div class="max-[300px]:w-full">
    <div>
        <x-jet-button class="max-[300px]:w-full max-[300px]:justify-center" wire:click="$set('open', true)">Crear tarea
            </x-jet-secondary-button>
    </div>


    <x-jet-dialog-modal wire:model="open">

        <x-slot name='title'>
            <div class="text-2xl">Crear tarea</div>
        </x-slot>

        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Título" />
                <x-jet-input type="text" class="w-full" wire:model.defer="title" />
                <x-jet-input-error for="title" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Descripción" />
                <textarea wire:model.defer="description" class="form-control w-full" cols="10" rows="4"></textarea>
                <x-jet-input-error for="description" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Fecha límite" />
                <x-jet-input wire:model.defer="deadline" type="date" min="{{ now()->toDateString() }}"
                    class="w-full" />
                <x-jet-input-error for="deadline" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Categoría" />
                <select wire:model.defer="categoryinsert" class="form-control w-full" style="width: 100%">
                    <option value="" hidden selected>Seleccione prioridad</option>
                    <optgroup label="Categorías por defecto">
                        @foreach ($defaultCategories as $defaultCategory)
                            <option value="{{ $defaultCategory->id }}">{{ $defaultCategory->name }}</option>
                        @endforeach
                    </optgroup>

                    <optgroup label="Tus categorías">
                        @foreach ($categories = $categories ?? collect([]) as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </optgroup>
                </select>
                <x-jet-input-error for="categoryinsert" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Prioridad" />
                <select wire:model.defer="priorityinsert" class="form-control w-full" name="" id="">
                    <option value="" hidden selected>Seleccione prioridad</option>
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="priorityinsert" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Estado" />
                <select wire:model.defer="state" class="form-control w-full" name="" id="">
                    <option value="" hidden selected>Seleccione estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="state" />
            </div>
            <div class="mb-4">
                <div class="flex items-center justify-between gap-1 max-sm:flex-wrap">
                    <x-jet-label value="Color" /><span class="text-[10px] text-red-500 opacity-80">(Color de la tarea
                        en el calendario.)</span>
                </div>
                <x-jet-input type="color" class="w-full h-9 form-control" wire:model.defer="color" />
                <x-jet-input-error for="color" />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-jet-danger-button wire:click="$set('open', false)" class="mr-2" wire:target="save" wire:loading.remove>
                Cancelar</x-jet-danger-button>
            <x-jet-button wire:click="save" wire:target="save" wire:loading.remove>
                <span>Crear tarea</span>
            </x-jet-button>
            <div><span class="loader" wire:loading wire:target="save"></span></div>
        </x-slot>

    </x-jet-dialog-modal>
</div>
