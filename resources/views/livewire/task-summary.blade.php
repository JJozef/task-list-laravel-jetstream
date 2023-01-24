<div class="mb-6">
    <div class="container-card-states">
        @foreach ($tasksSummary as $state)
            @if ($state->name == 'Expirada' && $state->tasks > 0)
                <div
                    class="card-states flex items-center justify-between gap-4 bg-white rounded shadow-default p-2 py-1">
                    <div class="px-3 py-1">
                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">{{ $state->name }}s
                        </p>
                        <h5 class="mb-0 font-bold">{{ $state->tasks ?? '0' }}</h5>
                    </div>
                    <div>
                        <i class="fa-solid fa-list-check text-2xl" style="color: {{ $state->color }};"></i>
                    </div>
                </div>
            @elseif ($state->name != 'Expirada')
                <div
                    class="card-states flex items-center justify-between gap-4 bg-white rounded shadow-default p-2 py-1">
                    <div class="px-3 py-1">
                        <p class="mb-0 font-sans font-semibold leading-normal text-sm">{{ $state->name }}s
                        </p>
                        <h5 class="mb-0 font-bold">{{ $state->tasks ?? '0' }}</h5>
                    </div>
                    <div>
                        <i class="fa-solid fa-list-check text-2xl" style="color: {{ $state->color }};"></i>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
