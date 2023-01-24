@section('title', 'Tareas | To-Do Hero')
<div wire:init="loadTasks">
    <x-slot name="header">
        <div class="flex justify-between max-sm:flex-wrap">
            <h2 class="font-semibold text-3xl color-1fx3 leading-tight max-sm:mb-2">
                {{ __('Tareas') }}
            </h2>
            <div
                class="flex items-center gap-2 max-sm:w-full max-sm:gap-0 max-sm:justify-between max-[300px]:flex-col max-[300px]:gap-2 max-[300px]:w-full">
                @livewire('create-tasks')
                @livewire('create-category')
            </div>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 max-sm:w-full">
        <div
            class="flex justify-between items-center bg-white shadow-default rounded mb-6 py-5 px-4 mt-5 max-sm:m-0 max-sm:rounded-none max-sm:flex-wrap">
            <div class="flex flex-col color-1fx3 max-sm:w-full max-sm:mb-3">
                <x-jet-label for="titlefilter" class="mb-1 pb-1 color-1fx3 text-base" value="Buscar" />
                <x-jet-input class="text-black max-sm:w-full" id="titlefilter" wire:model="search" type="text"
                    placeholder="Título de la tarea" />
            </div>
            <div class="flex flex-col color-1fx3" wire:ignore>
                <x-jet-label for="estado_id" class="mb-1 pb-1 color-1fx3 text-base" value="Filtrar por estado" />
                <select wire:model="estadoId" name="estado_id" class="select2 text-black">
                    <option value="">Todas las tareas</option>
                    @foreach ($estado as $states)
                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 transition">
        @if (count($tasksuser))
            <x-card>
                @foreach ($tasksuser as $row)
                    <div
                        class="flex flex-col justify-between bg-white shadow-default shadow-d-h rounded mb-6 py-5 px-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex">
                                @foreach ($row->categories as $category)
                                    <span class="bg-gray-200 rounded px-3 font-light text-sm mr-3"
                                        style="background: {{ $category->backgroundcolor }};"
                                        title="{{ $category->description }}">
                                        {{ $category->name }} <i class="fa-solid fa-badge-check"></i>
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex items-center justify-center gap-2">
                                <x-dropdown align="right" width="36">
                                    <x-slot name="trigger">
                                        <i class="fa-solid fa-ellipsis-vertical cursor-pointer text-base w-5 h-5 rounded-full border flex justify-center items-center"
                                            style="border-color: {{ $row->color }}; display: flex !important;"></i>
                                    </x-slot>
                                    <x-slot name="content" class="flex flex-col">
                                        <x-dropdown-link class="cursor-pointer flex items-center font-medium"
                                            wire:click="addcomment({{ $row->id }})">
                                            <i class="fa-solid fa-message flex-i items-center w-5 h-5"
                                                style="color: #2ed573;"></i>
                                            <hr class="h-5 w-[2px] mx-1 boder" style="background: #2ed573;">Comentarios
                                        </x-dropdown-link>
                                        <hr>
                                        <x-dropdown-link class="cursor-pointer flex items-center font-medium"
                                            wire:click="edit({{ $row->id }})">
                                            <i class="fa-solid fa-pen-to-square flex-i items-center w-5 h-5"
                                                style="color: #1e90ff;"></i>
                                            <hr class="h-5 w-[2px] mx-1 boder" style="background: #1e90ff;">Editar
                                        </x-dropdown-link>
                                        <hr>
                                        <x-dropdown-link class="cursor-pointer flex items-center font-medium"
                                            wire:click="$emit('deleteTask', {{ $row }})">
                                            <i class="fa-solid fa-trash flex-i items-center w-5 h-5"
                                                style="color: #ff4757;"></i>
                                            <hr class="h-5 w-[2px] mx-1 boder" style="background: #ff4757;">Eliminar
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                        <div>
                            <div class="mt-2">
                                <h4 tabindex="0"
                                    class="flex justify-between items-center focus:outline-none color-1fx3 font-bold pb-4 text-lg"
                                    style="word-break: break-all; overflow: hidden;">
                                    {{ $row->title }}
                                </h4>
                            </div>
                            <div class="focus:outline-none color-1fx3 text-sm"
                                style="word-break: break-all; overflow: hidden;">
                                {!! $row->description !!}
                            </div>
                        </div>
                        <div>
                            <div
                                class="flex items-center justify-between mt-4 max-[350px]:flex-col max-[350px]:items-baseline">
                                <div>
                                    <p tabindex="0" class="focus:outline-none text-xs color-1fx3">
                                        Fecha límite, {{ date('d-m-y', strtotime($row->deadline)) }}.
                                    </p>
                                    <p tabindex="0" class="focus:outline-none text-xs color-1fx3"
                                        style="--tw-text-opacity: .6;">
                                        Creada, {{ date('d-m-y | h:i a', strtotime($row->created_at)) }}.
                                    </p>
                                </div>
                                <div>
                                    @if ($row->estadotarea)
                                        <span tabindex="0" class="focus:outline-none text-xs color-1fx3 px-1 rounded "
                                            style="color: {{ $row->estadotarea->color }};"
                                            title="{{ $row->estadotarea->description }}">{{ $row->estadotarea->name }}
                                        </span>
                                    @endif
                                    @if ($row->priority)
                                        <b class="text-gray-900">|</b>
                                        <span class="text-gray-900 px-1 text-xs rounded"
                                            title="Esta tarea tiene una pioridad: {{ $row->priority->name }}"
                                            style="background: {{ $row->priority->color }};">
                                            {{ $row->priority->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </x-card>
            @if ($tasksuser->hasPages())
                <div class="px-6 py-3  bg-white shadow-lg rounded pagination-task">
                    {{ $tasksuser->links() }}
                </div>
            @endif
        @else
            <div
                class="flex justify-center items-center py-7 color-1fx3 text-4xl text-center bg-white shadow-default rounded">
                No hay tareas que mostrar.
            </div>
        @endif
    </div>


    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            <div class="text-2xl">Editar tarea</div>
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Título" class="text-lg" />
                <x-jet-input wire:model="task.title" type="text" class="w-full" />
                <x-jet-input-error for="task.title" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Descripción" />
                <textarea wire:model="task.description" class="form-control w-full" cols="10"rows="4"></textarea>
                <x-jet-input-error for="task.description" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Fecha límite" />
                <x-jet-input wire:model="task.deadline" type="date" min="{{ now()->toDateString() }}"
                    class="w-full" />
                <x-jet-input-error for="task.deadline" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Categoría" />
                <select wire:model="selectedCategories" name="selectedCategories[]" class="form-control w-full"
                    id="categories" style="width: 100%;">
                    <optgroup label="Categorías por defecto">
                        @foreach ($defaultCategories as $defaultCategory)
                            <option value="{{ $defaultCategory->id }}"
                                {{ $task_categories->contains('id', $defaultCategory->id) ? 'selected' : '' }}>
                                {{ $defaultCategory->name }}</option>
                        @endforeach
                    </optgroup>

                    <optgroup label="Tus categorías">
                        @foreach ($userCategories as $userCategory)
                            <option value="{{ $userCategory->id }}"
                                {{ $task_categories->contains('id', $userCategory->id) ? 'selected' : '' }}>
                                {{ $userCategory->name }}</option>
                        @endforeach
                    </optgroup>
                </select>
                <x-jet-input-error for="selectedCategories" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Prioridad" />
                <select wire:model="task.priority_id" class="form-control w-full" name="" id="">
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}"
                            {{ $priority->id == $task->priority_id ? 'selected' : '' }}>
                            {{ $priority->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="task.priority_id" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Estado" class="text-lg" />
                <select wire:model="task.state_id" class="form-control w-full" name="" id="">
                    @foreach ($estados as $estado)
                        @if ($estado->id != 5 || $task->state_id == 5)
                            <option value="{{ $estado->id }}"
                                {{ $estado->id == $task->state_id ? 'selected' : '' }}>
                                {{ $estado->name }}</option>
                        @endif
                    @endforeach
                </select>
                <x-jet-input-error for="task.state_id" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Color" />
                <x-jet-input type="color" class="w-full h-9 form-control" wire:model="task.color" />
                <x-jet-input-error for="color" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('open_edit', false)" class="mr-2">Cancelar</x-jet-danger-button>
            <x-jet-button wire:click="update">Actualizar</x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="open_comment">
        <x-slot name="title">
            <div class="flex items-center justify-between">
                <div class="text-2xl">Comentarios</div>
                <div>
                    <a class="cursor-pointer" wire:click="$set('open_comment', false)"><i
                            class="fa-solid fa-xmark text-xl hover:rotate-180 transition-transform duration-500"
                            style="color: #ff4757;"></i></a>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <section>
                <div class="mb-6">
                    <div class="py-2 mb-1">
                        <x-jet-label for="commenttopost" class="mb-2 text-sm flex justify-between items-center">
                            <span>Tu comentario</span>
                            <span class="text-[10px] text-red-500 opacity-80">(Solo visibles para ti.)</span>
                        </x-jet-label>
                        <textarea rows="2" wire:model="commenttopost" class="px-1 w-full text-sm color-1fx3 form-control"
                            placeholder="Escribe un comentario..." required></textarea>
                        <x-jet-input-error for="commenttopost" />
                    </div>
                    <x-jet-button wire:click="postcomment">
                        Publicar comentario
                    </x-jet-button>
                </div>
                <div class="h-1 w-full mx-auto border-b mt-2 mb-2"></div>
                @foreach ($task->comments as $comment)
                    <article class="p-6 mb-3 text-base bg-white shadow-default rounded">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center">
                                <p class="text-sm color-1fx3"><time pubdate
                                        datetime="{{ date('d-m-Y', strtotime($comment->created_at)) }}"
                                        title="Fecha y hora de publicacion.">{{ date('d-m-y | h:i a', strtotime($comment->created_at)) }}</time>
                                </p>
                            </div>
                            <div>
                                <a wire:click="$emit('deleteCommentTask', {{ $comment->id }})"
                                    class="cursor-pointer" title="Eliminar este comentario." style="color: #ff4757;">
                                    <i class="fa-solid fa-delete-left text-base"></i>
                                </a>
                            </div>
                        </footer>
                        <p class="color-1fx3">{{ $comment->content }}</p>
                    </article>
                @endforeach
            </section>
        </x-slot>
        <x-slot name="footer" class="h-0">
        </x-slot>
    </x-jet-dialog-modal>
</div>
@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            $('.select2').select2();
            $('.select2').on('change', function() {
                @this.set('estadoId', this.value);
            });
        })
    </script>
    <script>
        Livewire.on('deleteTask', taskId => {
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

                    Livewire.emitTo('show-tasks', 'delete', taskId);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Tu tarea ha sido eliminada.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        });
    </script>
    <script>
        Livewire.on('deleteCommentTask', commentId => {
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
                    Livewire.emitTo('show-tasks', 'deleteComment', commentId);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Se eliminó el comentario.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        })
    </script>
@endpush
</div>
