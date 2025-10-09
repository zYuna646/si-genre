@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-elephant-900">Kalender Kegiatan PIKR: {{ $pikr->name }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('master.kegiatan.index', ['pikr_id' => $pikr->id]) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                Kembali ke Daftar
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <div id="calendar"></div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
<style>
    .fc-event {
        cursor: pointer;
    }
    .fc-event-title {
        font-weight: bold;
    }
    .fc-daygrid-event {
        background-color: #6366f1;
        border-color: #4f46e5;
    }
    .fc-daygrid-day.fc-day-today {
        background-color: rgba(99, 102, 241, 0.1);
    }
    .fc-button-primary {
        background-color: #6366f1 !important;
        border-color: #4f46e5 !important;
    }
    .fc-button-primary:hover {
        background-color: #4f46e5 !important;
    }
    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        color: #1f2937;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listMonth'
            },
            locale: 'id',
            events: @json($events),
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            },
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    return false;
                }
            },
            eventDidMount: function(info) {
                if (info.event.extendedProps.description) {
                    const tooltip = document.createElement('div');
                    tooltip.className = 'fc-tooltip';
                    tooltip.innerHTML = `
                        <div class="p-2 bg-gray-800 text-white rounded shadow-lg max-w-xs">
                            <p class="font-bold">${info.event.title}</p>
                            <p>${info.event.extendedProps.description || ''}</p>
                            <p>${info.event.extendedProps.location || ''}</p>
                        </div>
                    `;
                    
                    tippy(info.el, {
                        content: tooltip,
                        allowHTML: true,
                        placement: 'top',
                        arrow: true,
                        interactive: true
                    });
                }
            }
        });
        calendar.render();
    });
</script>
@endpush
@endsection