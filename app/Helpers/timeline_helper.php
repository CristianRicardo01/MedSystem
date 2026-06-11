<?php

function getTimelineConfig($status)
{
    $config = [

        'icon'  => 'bi-arrow-repeat',

        'class' => 'primary',

    ];

    switch ($status) {

        case 'NEGADO':

            $config['class'] = 'danger';

            $config['icon'] = 'bi-x-circle';

            break;

        case 'ACEITO':

        case 'EM ATENDIMENTO':

            $config['class'] = 'success';

            $config['icon'] = 'bi-person-check';

            break;

        case 'AGUARDANDO EXAMES':

            $config['class'] = 'warning';

            $config['icon'] = 'bi-file-earmark-medical';

            break;

        case 'FINALIZADO':

            $config['class'] = 'danger-indigo';

            $config['icon'] = 'bi-check-circle';

            break;

        case 'OBSERVAÇÃO':

            $config['class'] = 'warning';

            $config['icon'] = 'bi-chat-left-text';

            break;

        case 'SOLICITAÇÃO':

            $config['class'] = 'info';

            $config['icon'] = 'bi-clipboard-plus';

            break;

        case 'SOLICITAÇÃO REMOVIDA':

            $config['class'] = 'danger';

            $config['icon'] = 'bi-clipboard-x';

            break;

        case 'INTERNADO':

            $config['class'] = 'danger-emphasis';

            $config['icon'] = 'bi-clipboard-pulse';

            break;
    }

    return $config;
}
