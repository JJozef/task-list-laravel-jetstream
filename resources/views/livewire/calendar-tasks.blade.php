<div>
    <div>
        <h5 class="text-center text-3xl py-4 px-6 pb-25rem ">
            Calendario de tareas pendientes
            <hr>
        </h5>

        <div class="pt-4" id="calendar"></div>
    </div>

    @push('js')
        <script>
            document.addEventListener('livewire:load', function() {
                var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    timeZone: 'America/Santiago',
                    locale: 'es',
                    headerToolbar: {
                        left: 'prev',
                        right: 'today next',
                        center: 'title'
                    },
                    events: @json($tasks)
                });
                calendar.render();
            })
        </script>
    @endpush
</div>
