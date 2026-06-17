<script>
    const BASE_URL = "<?= base_url() ?>/";
</script>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JQUERY MASK -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<!-- ALERTS -->
<script src="<?= base_url('assets/js/alerts.js') ?>"></script>
<!-- TRIAGE -->
<script src="<?= base_url('assets/js/triage.js') ?>"></script>
<!-- MASCARA -->
<script src="<?= base_url('assets/js/mascara.js') ?>"></script>
<!-- MUNICIPIOS -->
<script src="<?= base_url('assets/js/municipiosdinamicos.js') ?>"></script>
<!-- TRIAGE -->
<script src="<?= base_url('assets/js/patient.js') ?>"></script>
<!-- TRIAGE -->
<script src="<?= base_url('assets/js/settings/users.js') ?>"></script>

<!-- SOLICITAÇÕES -->
<script src="<?= base_url('assets/js/requests.js') ?>"></script>
<script src="<?= base_url('assets/js/specialties.js') ?>"></script>
<script src="<?= base_url('assets/js/patient-requests.js') ?>"></script>
<script src="<?= base_url('assets/js/hospitalization.js') ?>"></script>

<!-- BOOTSTRAP POPOVER -->
<script src="<?= base_url('assets/js/popover.js') ?>"></script>

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

<!-- FULLCALENDAR -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

<!-- SIDEBAR -->
<script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    if (toggleSidebar && sidebar) {

        toggleSidebar.addEventListener('click', () => {

            sidebar.classList.toggle('active');

        });

    }
</script>

<!-- CALENDAR -->
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
                    },

                    {
                        title: 'João Pedro',
                        start: '2026-05-16',
                    }

                ]

            });

            calendar.render();

        }

    });
</script>