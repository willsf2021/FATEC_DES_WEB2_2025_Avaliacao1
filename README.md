# 🏛️ Avaliação Desenvolvimento Web II - FATEC Araras

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

## 📝 Descrição do Projeto

Sistema completo para gestão de bibliotecas acadêmicas desenvolvido em **PHP estruturado**, permitindo:

- ✅ Controle de acesso diferenciado para professores e bibliotecários
- 📚 Cadastro e gerenciamento de livros
- 📋 Registro de pedidos/recomendações
- 🔍 Consulta ao acervo e solicitações

## 🧑‍💻 Acesso ao Sistema

### Credenciais de Login:

| Tipo de Usuário  | Login     | Senha     |
|------------------|-----------|-----------|
| Professor        | professor | professor |
| Bibliotecário    | biblio    | biblio    |

## 🛠️ Funcionalidades Principais

### Área do Bibliotecário
- ✨ Cadastro de novos livros no acervo
- 👀 Visualização de todos os livros cadastrados
- 📥 Visualização de pedidos de aquisição
- 🔒 Logout seguro

### Área do Professor
- 🔎 Consulta ao acervo completo
- 📝 Solicitação de novos livros
- 🔒 Logout seguro

## 📂 Estrutura do Projeto

```

├── assets/                  # Arquivos estáticos
│   └── bg.jpg               # Imagem de fundo
├── bibliotecario/           # Área do bibliotecário
│   ├── cadastrar_livros.php # Cadastro de livros
│   ├── listar_pedidos_livros.php # Listagem de pedidos
│   ├── livros.txt           # Base de dados de livros
├── professor/               # Área do professor
│   ├── cadastrar_pedido.php # Solicitação de novos livros
│   ├── pedidos.txt          # Registro de pedidos
├── dashboard_biblio.php     # Dashboard do bibliotecário
├── dashboard_professor.php  # Dashboard do professor
├── index.php                # Página inicial (Login)
├── listar_todos_livros.php  # Listagem geral dos livros
├── login.php                # Página de login
├── logout.php               # Logout do sistema
└── README.md                # Documentação do projeto
```

## 🚀 Como Executar

### 1. Pré-requisitos:
   - Servidor web (Apache, Nginx)
   - PHP 7.4 ou superior

### 2. Instalação:
   ```bash
   git clone https://github.com/willsf2021/FATEC_DES_WEB2_2025_Avaliacao1.git
   cd FATEC_DES_WEB2_2025_Avaliacao1
   ```

### 3. Configuração:
- Garanta permissões de escrita nos arquivos `.txt`
- Configure seu servidor web para apontar para a pasta do projeto

### 4. Acesso:
```
http://localhost/caminho/do/projeto
```

## ⚠️ Observações Importantes
- Armazenamento em arquivos texto (não utiliza banco de dados)
- Sistema desenvolvido conforme especificações da avaliação
- Credenciais fixas conforme exigido no enunciado

## 📅 Cronograma

| Evento                 | Data e Hora             |
|------------------------|------------------------|
| Prazo final           | 01/04/2025 (19h)       |
| Entrega com atraso    | Até 03/04/2025 (23h)   |
| Última data aceita    | Não serão aceitos projetos após 03/04 |

## 📚 Documentação Adicional

| Recurso                | Link                   |
|------------------------|------------------------|
| Documentação PHP       | [php.net](https://www.php.net/) |
| Bootstrap 5           | [getbootstrap.com](https://getbootstrap.com/) |

## 👨‍🏫 Desenvolvedor

**Wilson Júnior**  
Curso: Desenvolvimento de Software Multiplataforma  
FATEC - Faculdade de Tecnologia de Araras
Ano: 2025  

<div align="center"> <sub>Desenvolvido com ❤️ para a disciplina de Desenvolvimento Web II</sub> </div>
