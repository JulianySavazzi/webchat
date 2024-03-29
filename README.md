## REALTIME WEBCHAT - Seguindo tutorial Código Aberto do Gustavo Web

- Criando webchat com funcionamento em tempo real;
- As dependências utilizadas nesse projeto foram instaladas via php composer e node;

* Tecnologias utilizadas:
    - PHP
    - Node
    - Vue3
    - Vuex
    - Laravel
    - Jetstream
    - Tailwind CSS
    - Maria DB

* Executar aplicação:
     * Foram utilizadas as seguintes versões:
        - XAMPP 8.2.4 Rev. 0
        - PHP v8.2.4
        - Node.js v20.10.0
        - Laravel Framework 10.43.0

    - Iniciar http server pelo laravel no terminal dentro da pasta do projeto: php artisan serve
    - Iniciar o recarregamento automatico dos pacotes e alterações de codigo pelo node watch: npm run build --watch
    - Iniciar o servidor de websockets: php artisan websockets:serve

    - Acessar painel de controle dos websockets: localhost:8000/laravel-websockets

* Anotações:
    - Criar model e migrations com laravel: php artisan make:model ModelName -m
    - Criar o BD usando migrations (modelagem do banco de dados): php artisan migrate
    - Criar controlers com metodos da api pelo lavarel: php artisan make:controller Api/ControllerName --api 

* Links úteis:
    - https://agenciadevalor.notion.site/agenciadevalor/C-digo-Aberto-Temporada-2-7d7234d105e846a8926cf63748a4b62c
    - https://youtu.be/llgb7F_VqMI?si=OOR0PVlXUT0GRMHY
    - https://laravel.com/docs/10.x 
    - https://tailwindcss.com
    - https://pt.vuejs.org
    - https://vuex.vuejs.org/ptbr/#o-que-e-um-padrao-de-gerenciamento-do-estado

