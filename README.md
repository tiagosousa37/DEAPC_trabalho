# Sistema de reservas online

## Objetivos da aplicação

- Facilitar o processo de reserva online para clientes
- Automatizar a gestão de disponibilidade de serviços
- Permitir o processamento de pagamentos digitais
- Fornecer uma plataforma administrativa para controlo e análise de reservas

## Tipos de utilizadores

- Cliente
- Administrador

## Funcionalidades disponibilizadas aos diferentes utilizadores

- Cliente:
	- Registo e login
	- Consulta de serviços e disponibilidade
	- Criação e gestão de reservas
	- Pagamento online
	- Histórico de reservas

- Administrador:
	- Gestão de serviços e disponibilidade
	- Consulta e edição de reservas
	- Visualização de dados estatísticos
	- Gestão de utilizadores

### Utilizador: Cliente

| Código | Nome						| Descrição                                                            			| Prioridade |
| ------ | ---------------------------------------------| --------------------------------------------------------------------------------------| ---------- |
| CLI01  | Aceder à lista de serviços                   | Como Cliente quero aceder à lista de serviços disponíveis                          	| Alta       |
| CLI02  | Fazer uma reserva                            | Como Cliente quero fazer uma reserva indicando a data, serviço e número de pessoas	| Alta       |
| CLI03  | Efetuar o pagamento                          | Como Cliente quero pagar a minha reserva online de forma segura                       | Alta       |
| CLI04  | Visualizar o histórico 			| Como Cliente quero ver o histórico das minhas reservas anteriores	                | Média      |
| CLI05  | Cancelar a reserva          			| Como Cliente quero cancelar uma reserva antes da sua data         			| Média      |

### Utilizador: Administrador

| Código | Nome                                         | Descrição                                    			                        | Prioridade |
| ------ | ---------------------------------------------| ------------------------------------------------------------------------------------- | ---------- |
| ADM01  | Gerir serviços                               | Como Administrador quero adicionar, editar ou remover serviços disponíveis            | Alta       |
| ADM02  | Ver reservas                                 | Como Administrador quero consultar todas as reservas efetuadas                        | Alta       |
| ADM03  | Atualizar disponibilidade                    | Como Administrador quero atualizar a disponibilidade dos serviços                     | Alta       |
| ADM04  | Gerir utilizadores 				| Como Administrador quero consultar e gerir contas de utilizadores			| Média      |
| ADM05  | Ver estatística e relatórios          	| Como Administrador quero aceder a relatórios de reservas e pagamentos        		| Média      |
