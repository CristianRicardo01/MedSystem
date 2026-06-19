<h1 align="center">
🏥 Sistema de Gestão Hospitalar
</h1>

<p align="center">
  <strong>Plataforma completa para gerenciamento do fluxo assistencial de pacientes, triagem, consultas, exames e acompanhamento hospitalar.</strong>
</p>

<p align="center">

![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4-EF4223?style=for-the-badge&logo=codeigniter)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql)
![License](https://img.shields.io/badge/license-Private-red?style=for-the-badge)

</p>

<p align="center">  <img src="./assets/img/image.png" alt="Dashboard Hospitalar" width="800" /></p>

---

## 📋 Sobre o Projeto

O Sistema de Gestão Hospitalar foi desenvolvido para controlar todo o fluxo assistencial do paciente, desde sua entrada na triagem até a conclusão do tratamento.

O sistema permite:

- Cadastro de pacientes
- Controle de triagem
- Gestão de solicitações médicas
- Controle de exames
- Acompanhamento de consultas
- Timeline completa do paciente
- Histórico de movimentações
- Indicadores de SLA
- Gestão de setores
- Gestão de usuários
- Dashboard gerencial

---

## ✨ Principais Funcionalidades

### 👨‍⚕️ Central de Triagem

- Registro inicial do paciente
- Classificação de atendimento
- Avaliação de documentação
- Encaminhamento para análise médica

---

### 🏥 Gestão de Pacientes

- Visualização completa do paciente
- Histórico clínico
- Timeline de eventos
- Observações médicas
- Solicitações realizadas

---

### 📑 Solicitações

Tipos de solicitações configuráveis:

- Consultas
- Exames
- Procedimentos
- Internações
- Outros

Cada solicitação possui:

- SLA configurável
- Status
- Data de criação
- Data de conclusão
- Responsável

---

### 📊 Dashboard Gerencial

Indicadores em tempo real:

- Pacientes em Triagem
- Pacientes Regulados
- Consultas Agendadas
- Exames Pendentes
- Exames Concluídos
- Pacientes Finalizados
- SLA em atraso

---

### 📅 Agenda e Consultas

- Controle de consultas
- Agendamentos
- Histórico de atendimento
- Controle de retorno

---

### 🧾 Timeline do Paciente

Registro completo de:

- Cadastro
- Triagem
- Análises médicas
- Solicitações
- Exames
- Consultas
- Transferências
- Finalização

---

## 🔄 Fluxo Assistencial

```text
REGULADO
    ↓
TRIAGEM
    ↓
ANALISE_MEDICA
    ↓
ACEITO
    ↓
AGUARDANDO_EXAMES
    ↓
EXAMES_OK
    ↓
CONSULTA_AGENDADA
    ↓
FINALIZADO
```
