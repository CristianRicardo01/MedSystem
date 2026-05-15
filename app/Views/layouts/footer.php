<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // SIDEBAR MOBILE

    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleSidebar.addEventListener('click', () => {

        sidebar.classList.toggle('active');

    });
</script>

<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init({

        duration: 600,
        once: true,
        offset: 50,
        easing: 'ease-out-cubic',

    });
</script>

<!-- Municipios Dinamicos -->
<script src="<?= base_url('assets/js/municipisodinamicos.js') ?>"></script>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.css' rel='stylesheet'>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const calendarEl = document.getElementById('calendar');

        if (calendarEl) {

            const calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',

                height: 650,

                locale: 'pt-br',

                events: [

                    {
                        title: 'Maria Silva',
                        start: '2026-05-14',
                        color: '#4A90E2'
                    },

                    {
                        title: 'João Pedro',
                        start: '2026-05-16',
                        color: '#4CAF50'
                    },

                    {
                        title: 'Emergência',
                        start: '2026-05-18',
                        color: '#F44336'
                    }

                ]

            });

            calendar.render();

        }

    });
</script>