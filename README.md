# Sistema de reservas online

1) O objetivo desta aplicação é desenvolver uma aplicação web de reservas online que permita aos utilizadores pesquisar, reservar e gerir vários serviços, como hotéis, voos e eventos. Os utilizadores podem consultar a disponibilidade, realizar reservas e efetuar pagamentos de forma segura. A aplicação também fornece aos administradores ferramentas para monitorizar e gerir todas as reservas e informações dos clientes.
A aplicação será utilizada por dois tipos de utilizadores: o cliente , o utilizador que procura, reserva e gere as suas próprias reservas, e o administrador, o responsável por gerir os serviços disponíveis, os dados dos clientes e as configurações do sistema.
Quanto às principais funcionalidades, o cliente pode efetuar login ou registo na plataforma, pesquisar e visualizar detalhes dos vários serviços disponíveis, realizar pagamentos de forma segura e visualizar antigas reservas. Quanto aos administradores, estes podem adicionar, editar e remover serviços disponíveis, gerir a disponibilidade destes, gerir as informações dos clientes registados e monitorizar transações e o estado das reservas em tempo real.

Tiago Sousa

Diogo Bizarro 

Ricardo Correia

2) Ator: Cliente

CLI01 - Efetuar login ou registo - Como cliente, quero efetuar login ou registo na aplicação (prioridade - Alta);
CLI02 - Visualizar os vários serviços disponíveis - Como cliente, quero pesquisar e visualizar detalhes dos vários serviços disponíveis (prioridade - Alta);
CLI03 - Efetuar o pagamento - Como cliente, quero realizar pagamentos de forma segura na aplicação (prioridade - Alta);
CLI04 - Ver o histórico de reservas - Como cliente, quero visualizar reservas antigas (prioridade - Média);

Ator: Administrador

ADM01 - Gerir serviços - Como administrador, quero adicionar, editar ou remover os serviços disponíveis (prioridade - Alta);
ADM02 - Ver reservas - Como administrador, quero consultar todas as reservas efetuadas (prioridade - Alta);
ADM03 - Atualizar a disponibilidade - Como administrador, quero atualizar a disponnibilidade dos vários serviços (prioridade - Alta);
ADM04 - Gerir utilizadores - Como administrador, quero consultar e gerir as contas dos utilizadores (prioridade - Média);

3.Especificação
1)
a) Na página de entrada da aplicação web irá ser uma página de login onde o utilizador terá de criar uma conta ou se já tiver conta iniciar sessão na sua conta. Nesta página irá ter uma breve descrição da empresa de reservas online. O utilizador e o administrador vão ter acesso a esta página.
b)Na primeira página será o login/registo do utilizador e o logo da aplicação e um breve texto de apresentação da aplicação
Na segunda página irá aparecer os vários serviços, tendo em cada que em cada serviço irá aparecer o nome do serviço uma imagem do serviço, o preço, a disponibilidade e um botão para reservar. Esta página vai ser dedicada para o utilizador, pois o administrador terá outra página dedicada a ele.
A terceira página será para o administrador onde este será redirecionado para este quando no login fôr identificado como administrador. Esta página será igual à do utilizador mas o administrador terá um link de acesso na página onde este será redirecionado para outra página que vai ter as reservas feitas pelo utilizador.
Numa quarta página que será aberta quando se carrega no botão de reservar de um serviço interessado pelo utilizador irá aparecer os detalhes do serviço interessado como preço, disponibilidade, data de reserva pretendida pelo utilizador, métodos de pagamento disponíveis e botão para confirmar reserva.
A quinta página é a página que o administrador é redirecionado quando carrega no link de reservas da terceira página e esta terá as reservas feitas pelo utilizador para que o administrador possa gerir a disponibilidade dos serviços. 
A sexta página será dedicada para receber feedbacks dos utilizadores sobre os serviços da aplicação web.
