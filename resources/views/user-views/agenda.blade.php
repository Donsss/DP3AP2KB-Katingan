<x-user-components.layout>
    <section class="agenda-section py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-8">
                    <h2 class="fw-bolder">Agenda Kegiatan</h2>
                    <p class="text-muted">Lihat jadwal dan kegiatan mendatang. Klik pada tanggal di kalender untuk melihat detail agenda.</p>
                </div>
            </div>

            <div class="agenda-wrapper shadow-lg">
                <div class="row g-0">
                    <div class="col-lg-7">
                        <div class="calendar-container">
                            <div class="calendar-header">
                                <button id="prev-month" class="calendar-nav" aria-label="Bulan sebelumnya">&lt;</button>
                                <h5 id="month-year" class="mb-0 fw-bold"></h5>
                                <button id="next-month" class="calendar-nav" aria-label="Bulan berikutnya">&gt;</button>
                            </div>
                            <div class="calendar-grid calendar-weekdays">
                                <div>Min</div> <div>Sen</div> <div>Sel</div> <div>Rab</div> <div>Kam</div> <div>Jum</div> <div>Sab</div>
                            </div>
                            <div id="calendar-days" class="calendar-grid">
                                {{-- Tanggal akan diisi oleh JavaScript --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div id="agenda-details" class="agenda-details-container">
                            {{-- Detail agenda akan diisi oleh JavaScript --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .agenda-section .agenda-wrapper { background-color: #ffffff; border-radius: 1rem; overflow: hidden; border: 1px solid #e9ecef; }
        .calendar-container { padding: 2rem; background-color: #fff; }
        .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .calendar-header h5 { color: #343a40; }
        .calendar-nav { background: none; border: 1px solid #ced4da; width: 38px; height: 38px; border-radius: 50%; color: #495057; font-size: 1.2rem; transition: background-color 0.2s ease, color 0.2s ease; }
        .calendar-nav:hover { background-color: #0d6efd; color: #fff; border-color: #0d6efd; }
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem; }
        .calendar-weekdays { font-weight: 600; color: #6c757d; font-size: 0.85rem; text-align: center; margin-bottom: 0.75rem; }
        .calendar-day { position: relative; display: flex; justify-content: center; align-items: center; height: 42px; font-size: 0.9rem; border-radius: 50%; cursor: pointer; transition: background-color 0.2s ease, color 0.2s ease; border: 2px solid transparent; }
        .calendar-day.other-month { color: #adb5bd; cursor: default; }
        .calendar-day:not(.other-month):hover { background-color: #e9ecef; }
        .calendar-day.today { border-color: #0d6efd; font-weight: bold; }
        .calendar-day.selected { background-color: #0d6efd; color: #fff; font-weight: bold; }
        .event-dot { position: absolute; bottom: 6px; width: 5px; height: 5px; border-radius: 50%; background-color: #dc3545; }
        .selected .event-dot { background-color: #fff; }
        .agenda-details-container { background-color: #f8f9fa; padding: 2rem; height: 100%; border-left: 1px solid #e9ecef; }
        .agenda-date-header { font-size: 1.2rem; font-weight: bold; color: #343a40; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 2px solid #dee2e6; }
        .agenda-card { background-color: #fff; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem; border: 1px solid #e9ecef; display: flex; align-items: center; gap: 1rem; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .agenda-card:hover { transform: translateY(-3px); box-shadow: 0 4px 15px rgba(0,0,0,0.07); }
        .agenda-time { font-weight: 600; font-size: 0.9rem; padding: 0.5rem 0.75rem; background-color: #e9ecef; border-radius: 0.375rem; color: #495057; text-align: center; }
        .agenda-title { margin: 0; font-weight: 600; color: #212529; }
        .no-agenda { text-align: center; padding: 3rem 1rem; }
        @media (max-width: 991.98px) { .agenda-details-container { border-left: none; border-top: 1px solid #e9ecef; } }
    </style>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const monthYearEl = document.getElementById('month-year');
        const calendarDaysEl = document.getElementById('calendar-days');
        const agendaDetailsEl = document.getElementById('agenda-details');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');

        let currentDate = new Date();
        let eventsData = {};

        async function fetchEvents(year, month) {
            calendarDaysEl.innerHTML = '<div class="spinner-border text-primary mx-auto mt-5" role="status"><span class="visually-hidden">Loading...</span></div>';
            try {
                const response = await fetch(`/api/agendas?year=${year}&month=${month + 1}`);
                if (!response.ok) throw new Error('Network response was not ok');
                eventsData = await response.json();
                renderCalendar();
            } catch (error) {
                console.error('Failed to fetch events:', error);
                calendarDaysEl.innerHTML = '<p class="text-center text-danger">Gagal memuat agenda.</p>';
            }
        }

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            monthYearEl.textContent = `${monthNames[month]} ${year}`;
            
            calendarDaysEl.innerHTML = '';

            const firstDayOfMonth = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            for (let i = 0; i < firstDayOfMonth; i++) {
                calendarDaysEl.insertAdjacentHTML('beforeend', '<div></div>');
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dayEl = document.createElement('div');
                dayEl.textContent = day;
                dayEl.classList.add('calendar-day');
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                dayEl.dataset.date = dateStr;

                if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
                    dayEl.classList.add('today');
                }
                
                if (eventsData[dateStr]) {
                    dayEl.insertAdjacentHTML('beforeend', '<span class="event-dot"></span>');
                }
                
                dayEl.addEventListener('click', () => {
                    document.querySelectorAll('.calendar-day.selected').forEach(d => d.classList.remove('selected'));
                    dayEl.classList.add('selected');
                    renderAgendaDetails(dateStr);
                });

                calendarDaysEl.appendChild(dayEl);
            }
        }
        
        function renderAgendaDetails(date) {
            const events = eventsData[date] || [];
            const dateObj = new Date(date + 'T00:00:00');
            const dayName = dateObj.toLocaleDateString('id-ID', { weekday: 'long' });
            const formattedDate = dateObj.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });

            let html = `<h5 class="agenda-date-header">${dayName}, ${formattedDate}</h5>`;

            if (events.length > 0) {
                events.forEach(event => {
                    const time = new Date(`1970-01-01T${event.time}`).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                    html += `
                        <div class="agenda-card">
                            <div class="agenda-time">${time}</div>
                            <h6 class="agenda-title flex-grow-1">${event.title}</h6>
                        </div>
                    `;
                });
            } else {
                html += '<div class="no-agenda text-muted"><i class="fas fa-calendar-check fa-2x mb-3"></i><p>Tidak ada agenda pada tanggal ini.</p></div>';
            }
            agendaDetailsEl.innerHTML = html;
        }

        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            fetchEvents(currentDate.getFullYear(), currentDate.getMonth());
        });

        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            fetchEvents(currentDate.getFullYear(), currentDate.getMonth());
        });

        fetchEvents(currentDate.getFullYear(), currentDate.getMonth()).then(() => {
            const todayEl = document.querySelector('.calendar-day.today');
            if (todayEl) {
                todayEl.click();
            } else {
                const firstDayEl = document.querySelector('.calendar-day:not(.other-month)');
                if(firstDayEl) firstDayEl.click();
            }
        });
    });
    </script>
    @endpush
</x-user-components.layout>

