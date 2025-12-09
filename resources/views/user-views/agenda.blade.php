<x-user-components.layout>
    <section class="agenda-section py-5" style="background-color: #f8f9fa;">
        <div class="container">
            {{-- Header Section --}}
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-8">
                    <h2 class="fw-bolder">Agenda Kegiatan</h2>
                    <p class="text-muted">Lihat jadwal dan kegiatan mendatang. Klik pada tanggal di kalender untuk melihat detail agenda.</p>
                </div>
            </div>

            {{-- Calendar Wrapper --}}
            <div class="agenda-wrapper shadow-lg">
                <div class="row g-0">
                    {{-- Kolom Kiri: Kalender --}}
                    <div class="col-lg-7">
                        <div class="calendar-container">
                            <div class="calendar-header">
                                <button id="prev-month" class="calendar-nav" aria-label="Bulan sebelumnya">&lt;</button>
                                <h5 id="month-year-display" class="mb-0 fw-bold mx-3"></h5>
                                <button id="next-month" class="calendar-nav" aria-label="Bulan berikutnya">&gt;</button>
                            </div>
                            
                            <div class="calendar-grid calendar-weekdays">
                                <div>Min</div> <div>Sen</div> <div>Sel</div> <div>Rab</div> <div>Kam</div> <div>Jum</div> <div>Sab</div>
                            </div>
                            
                            <div id="calendar-days-grid" class="calendar-grid">
                                {{-- Tanggal diisi via JS --}}
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Detail Agenda --}}
                    <div class="col-lg-5">
                        <div id="agenda-details-panel" class="agenda-details-container">
                            {{-- Detail agenda diisi via JS --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Wrapper Utama */
        .agenda-section .agenda-wrapper { 
            background-color: #ffffff; 
            border-radius: 1rem; 
            overflow: hidden; 
            border: 1px solid #e9ecef; 
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }

        /* --- Bagian Kiri: Kalender --- */
        .calendar-container { 
            padding: 2rem; 
            background-color: #fff; 
            height: 100%; 
            display: flex;
            flex-direction: column;
        }

        .calendar-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 2rem; 
            flex-shrink: 0;
        }

        .calendar-header h5 { 
            color: #343a40; 
            min-width: 150px;
            text-align: center;
        }

        /* Tombol Navigasi (Prev/Next) */
        .calendar-nav { 
            background: none; 
            border: 1px solid #ced4da; 
            width: 32px; 
            height: 32px; 
            border-radius: 50%; 
            color: #495057; 
            font-size: 1rem; 
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease; 
            cursor: pointer;
        }
        
        .calendar-nav:hover { 
            background-color: #0d6efd; 
            color: #fff; 
            border-color: #0d6efd; 
        }

        .calendar-grid { 
            display: grid; 
            grid-template-columns: repeat(7, 1fr); 
            gap: 0.5rem; 
        }

        .calendar-weekdays { 
            font-weight: 600; 
            color: #6c757d; 
            font-size: 0.85rem; 
            text-align: center; 
            margin-bottom: 0.75rem; 
        }

        .calendar-day { 
            position: relative; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 42px; 
            font-size: 0.9rem; 
            border-radius: 50%; 
            cursor: pointer; 
            transition: all 0.2s ease; 
            border: 2px solid transparent; 
        }

        .calendar-day:not(.other-month):hover { 
            background-color: #e9ecef; 
        }

        .calendar-day.today { 
            border-color: #0d6efd; 
            font-weight: bold; 
            color: #0d6efd;
        }

        .calendar-day.selected { 
            background-color: #0d6efd; 
            color: #fff; 
            font-weight: bold; 
            border-color: #0d6efd;
        }
        
        .calendar-loading {
            grid-column: span 7;
            text-align: center;
            padding: 2rem;
            color: #0d6efd;
        }

        .event-dot { 
            position: absolute; 
            bottom: 6px; 
            width: 5px; 
            height: 5px; 
            border-radius: 50%; 
            background-color: #dc3545; 
        }

        .selected .event-dot { 
            background-color: #fff; 
        }

        .agenda-details-container { 
            background-color: #f8f9fa; 
            border-left: 1px solid #e9ecef; 
            display: flex;
            flex-direction: column;
            height: 400px;
            overflow: hidden; 
            padding: 0; 
        }

        /* Header Tanggal (Diam/Statis) */
        .agenda-date-header { 
            font-size: 1.2rem; 
            font-weight: bold; 
            color: #343a40; 
            padding: 2rem 2rem 1rem 2rem; 
            margin-bottom: 0;
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6; 
            z-index: 10;
            flex-shrink: 0; 
            box-shadow: 0 4px 6px -4px rgba(0,0,0,0.1); 
        }

        /* Area Scroll (Konten yang bergerak) */
        .agenda-scroll-area {
            padding: 1.5rem 2rem 2rem 2rem; 
            overflow-y: auto; 
            flex-grow: 1; 
        }

        /* Kustomisasi Scrollbar */
        .agenda-scroll-area::-webkit-scrollbar { width: 8px; }
        .agenda-scroll-area::-webkit-scrollbar-track { background: #f1f1f1; }
        .agenda-scroll-area::-webkit-scrollbar-thumb { background: #ced4da; border-radius: 4px; }
        .agenda-scroll-area::-webkit-scrollbar-thumb:hover { background: #adb5bd; }

        .agenda-card { 
            background-color: #fff; 
            border-radius: 0.5rem; 
            padding: 1rem; 
            margin-bottom: 1rem; 
            border: 1px solid #e9ecef; 
            display: flex; 
            align-items: center; 
            gap: 1rem; 
            transition: transform 0.2s ease, box-shadow 0.2s ease; 
        }

        .agenda-card:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 4px 15px rgba(0,0,0,0.07); 
        }

        .agenda-time { 
            font-weight: 600; 
            font-size: 0.9rem; 
            padding: 0.5rem 0.75rem; 
            background-color: #e9ecef; 
            border-radius: 0.375rem; 
            color: #495057; 
            text-align: center; 
            min-width: 80px; 
        }

        .agenda-title { 
            margin: 0; 
            font-weight: 600; 
            color: #212529; 
            line-height: 1.4;
        }

        .no-agenda { 
            text-align: center; 
            padding: 3rem 1rem; 
            color: #6c757d;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%; 
        }

        @media (max-width: 991.98px) { 
            .agenda-details-container { 
                border-left: none; 
                border-top: 1px solid #e9ecef; 
                height: 400px; 
            } 
        }
    </style>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const monthYearEl = document.getElementById('month-year-display');
        const calendarDaysEl = document.getElementById('calendar-days-grid');
        const agendaDetailsEl = document.getElementById('agenda-details-panel');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');

        let currentDate = new Date();
        let eventsData = {};

        async function fetchEvents(year, month) {
            // Tampilkan loading spinner
            calendarDaysEl.innerHTML = '<div class="calendar-loading"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            try {
                const response = await fetch(`/api/agendas?year=${year}&month=${month + 1}`);
                if (!response.ok) throw new Error('Network response was not ok');
                
                eventsData = await response.json();
                renderCalendar();
            } catch (error) {
                console.error('Failed to fetch events:', error);
                calendarDaysEl.innerHTML = '<div class="calendar-loading text-danger">Gagal memuat agenda.</div>';
            }
        }

        // 2. Fungsi Render Kalender
        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            
            monthYearEl.textContent = `${monthNames[month]} ${year}`;
            calendarDaysEl.innerHTML = '';
            
            const firstDayOfMonth = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            // Render sel kosong sebelum tanggal 1
            for (let i = 0; i < firstDayOfMonth; i++) {
                calendarDaysEl.insertAdjacentHTML('beforeend', '<div></div>');
            }

            // Render tanggal
            for (let day = 1; day <= daysInMonth; day++) {
                const dayEl = document.createElement('div');
                dayEl.textContent = day;
                dayEl.classList.add('calendar-day');
                
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                dayEl.dataset.date = dateStr;

                // Cek hari ini
                if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
                    dayEl.classList.add('today');
                }
                
                if (eventsData[dateStr] && eventsData[dateStr].length > 0) {
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

            let html = `<div class="agenda-date-header">${dayName}, ${formattedDate}</div>`;

            html += `<div class="agenda-scroll-area">`;

            if (events.length > 0) {
                events.forEach(event => {
                    const time = new Date(`1970-01-01T${event.time}`).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                    
                    html += `
                        <div class="agenda-card">
                            <div class="agenda-time">${time}</div>
                            <div class="flex-grow-1">
                                <h6 class="agenda-title">${event.title}</h6>
                                ${event.description ? `<p class="text-muted small mb-0 mt-1">${event.description}</p>` : ''}
                            </div>
                        </div>
                    `;
                });
            } else {
                html += '<div class="no-agenda text-muted"><i class="fas fa-calendar-check fa-2x mb-3"></i><p>Tidak ada agenda pada tanggal ini.</p></div>';
            }

            html += `</div>`;

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
            const todayStr = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDate.getDate()).padStart(2, '0')}`;
            const todayEl = document.querySelector(`.calendar-day[data-date="${todayStr}"]`);
            
            if (todayEl) {
                todayEl.click();
            } else {
                renderAgendaDetails(todayStr);
            }
        });
    });
    </script>
    @endpush
</x-user-components.layout>