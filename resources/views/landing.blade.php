<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistente Virtual</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-[#1E1E2F] text-white">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="text-2xl font-bold">
                <a href="#" class="flex items-center">
                    <img src="/images/favicon.png" alt="Logo" class="w-8 h-8 mr-2">
                    Assistente Virtual
                </a>
            </div>

            <!-- Menu Toggle (Mobile) -->
            <button
                id="menu-toggle"
                class="lg:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <!-- Links -->
            <div id="menu" class="hidden lg:flex space-x-6 items-center">
                <a href="#home" class="hover:text-[#6081EB] transition">Início</a>
                <a href="#features" class="hover:text-[#6081EB] transition">Recursos</a>
                <a href="#pricing" class="hover:text-[#6081EB] transition">Preços</a>
                <a href="mailto:afilitrends@gmail.com" class="hover:text-[#6081EB] transition">Contato</a>
                <a href="https://wa.me/{{str_replace('+', '', config('twilio.from'))}}"
                    class="bg-[#20C997] text-white px-4 py-2 rounded-lg hover:bg-[#4A6AD1] transition">
                    Experimente Agora
                </a>
            </div>
        </div>

        <!-- Mobile Dropdown -->
        <div id="mobile-menu" class="lg:hidden hidden px-6 py-4 bg-[#5B19E3] rounded">
            <a href="#home" class="block py-2 hover:text-[#6081EB] transition">Início</a>
            <a href="#features" class="block py-2 hover:text-[#6081EB] transition">Recursos</a>
            <a href="#pricing" class="block py-2 hover:text-[#6081EB] transition">Preços</a>
            <a href="mailto:afilitrends@gmail.com" class="block py-2 hover:text-[#6081EB] transition">Contato</a>
            <a href="https://wa.me/{{str_replace('+', '', config('twilio.from'))}}"
                class="block mt-4 bg-[#20C997] text-white px-4 py-2 text-center rounded-lg hover:bg-[#4A6AD1] transition">
                Experimente Agora
            </a>
        </div>
    </nav>



    <!-- Hero Section -->
    <section id="home" class="bg-[#1E1E2F] text-white min-h-screen flex items-center">
        <div class="container mx-auto px-6 flex flex-col lg:flex-row lg:items-center  md:mt-0 mt-10">
            <!-- Esquerda: Copy -->
            <div class="w-full lg:w-1/2 text-center lg:text-left px-4">
                <img src="/images/favicon.png" width="60" height="60" alt="Logo" class="mx-auto lg:mx-0 mb-4 lg:mb-6">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">
                    Caos na organização? <br> Deixe-nos ajudar você a simplificar!
                </h1>
                <p class="text-base md:text-lg text-[#A0A0B1] mb-6">
                    Gerenciar tarefas nunca foi tão desafiador. Com múltiplos aplicativos, prazos perdidos e notificações infinitas, é fácil sentir-se sobrecarregado. Nosso assistente virtual foi projetado para centralizar tudo e devolver a você o controle do seu tempo.
                </p>
                <a href="https://wa.me/{{str_replace('+', '', config('twilio.from'))}}"
                    class="bg-[#20C997] text-white px-6 py-3 rounded-lg shadow-lg hover:bg-[#4A6AD1] transition duration-300 inline-block">
                    Experimente Agora
                </a>
            </div>

            <!-- Direita: Espaço para Imagem -->
            <div class="w-full lg:w-1/2 mt-8 lg:mt-0 flex justify-center px-4 md:mb-0 mb-10">
                <img src="/images/hero.webp" alt="Organização Simplificada" class="rounded-lg shadow-md max-w-full max-h-[500px]">
            </div>
        </div>
    </section>





    <!-- Sobre Section -->
    <section class="bg-[#1E1E2F] text-white py-16">
        <div class="container mx-auto flex flex-col lg:flex-row items-center">
            <!-- Esquerda: Texto -->
            <div class="lg:w-1/2 px-6">
                <h2 class="text-3xl font-bold mb-6">
                    Mais que um assistente, uma solução para sua organização.
                </h2>
                <p class="text-lg text-[#A0A0B1] mb-6">
                    Nosso sistema não é apenas mais uma ferramenta. Ele foi criado para unificar todas as suas tarefas,
                    compromissos e lembretes em um só lugar, eliminando a confusão e maximizando sua produtividade.
                </p>
                <p class="text-lg text-[#A0A0B1] mb-6">
                    Seja você um empreendedor, estudante ou alguém buscando equilíbrio no dia a dia, nosso assistente
                    virtual se adapta às suas necessidades, deixando sua rotina mais leve e organizada.
                </p>
                <a href="https://wa.me/{{str_replace('+', '', config('twilio.from'))}}"
                    class="bg-[#5B19E3] text-white px-6 py-3 rounded-lg shadow-lg hover:bg-[#4A15B3] transition duration-300">
                    Saiba Mais
                </a>
            </div>

            <!-- Direita: Imagem -->
            <div class="lg:w-1/2 mt-10 lg:mt-0 flex justify-center px-6">
                <img src="/images/about.webp" alt="Sobre Nós" class="rounded-lg max-w-full">
            </div>
        </div>
    </section>




    <!-- Funcionalidades Section -->
    <section id="features" class="bg-[#1E1E2F] text-white py-16">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-3xl font-semibold mb-8">Funcionalidades do Assistente Virtual</h2>
            <p class="text-lg text-[#A0A0B1] mb-12">Com nosso assistente virtual, você tem tudo o que precisa para uma organização mais simples e eficiente.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">

                <div class="bg-[#2A2A3D] p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105">
                    <div class="text-[#6081EB] text-4xl mb-4 mx-auto">
                        <i class="ri-task-line"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Gestão de Tarefas</h3>
                    <p class="text-[#A0A0B1]">Organize suas tarefas de forma simples e eficiente. Acompanhe o progresso em tempo real e nunca perca um prazo novamente.</p>
                </div>

                <!-- Funcionalidade 2: Insights Baseados nas Tarefas -->
                <div class="bg-[#2A2A3D] p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105">
                    <div class="text-[#6081EB] text-4xl mb-4 mx-auto">
                        <i class="ri-bar-chart-line"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Insights Baseados nas Tarefas</h3>
                    <p class="text-[#A0A0B1]">Receba insights valiosos sobre como você pode otimizar seu tempo e produtividade, com base nas suas tarefas e padrões de trabalho.</p>
                </div>

                <!-- Funcionalidade 3: Integração com ChatGPT -->
                <div class="bg-[#2A2A3D] p-8 rounded-lg shadow-lg transition duration-300 hover:scale-105">
                    <div class="text-[#6081EB] text-4xl mb-4 mx-auto">
                        <i class="ri-chat-1-line"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">ChatGPT Integrado</h3>
                    <p class="text-[#A0A0B1]">Aproveite a inteligência do ChatGPT para otimizar a gestão de tarefas, tirar dúvidas e receber sugestões de como melhorar sua organização.</p>
                </div>


            </div>
        </div>
    </section>





    <section id="pricing" class="bg-[#1E1E2F] text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6">
                Pronto para Organizar Suas Tarefas e Maximizar Seu Potencial?
            </h2>
            <p class="text-lg text-[#A0A0B1] mb-8">
                Comece agora a simplificar sua rotina e aproveite todos os benefícios do nosso Assistente Virtual. Organize, planeje e tenha insights para otimizar suas tarefas diárias.
            </p>

            <!-- Tabela de Preços -->
            <div class="bg-[#2C2C44] p-8 rounded-lg shadow-lg max-w-md mx-auto">
                <h3 class="text-xl font-semibold mb-4">Plano Único</h3>
                <p class="text-lg mb-4">Ideal para quem busca um assistente virtual que centralize todas as suas tarefas de forma simples e eficiente. Inclui integração com ChatGPT e agendador inteligente.</p>
                <p class="text-3xl font-bold mb-6">R$ 29,90 / mês</p>
                <ul class="mb-6">
                    <li>1 Usuário</li>
                    <li>Agendador de Tarefas</li>
                    <li>Integração com ChatGPT para Insights</li>
                    <li>Acesso ao Histórico de Tarefas</li>
                </ul>
                <a href="https://wa.me/{{str_replace('+', '', config('twilio.from'))}}" class="bg-[#6081EB] text-white px-6 py-3 rounded-lg shadow-lg hover:bg-[#4A6AD1] transition duration-300" target="_blank">Assine Agora</a>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6">
        <p>&copy; 2024 Assistente Virtual. Todos os direitos reservados.</p>
        <p><a href="{{route('privacy-policy')}}" class="text-gray-400 hover:text-gray-200">Política de Privacidade</a> | <a href="{{route('terms')}}" class="text-gray-400 hover:text-gray-200">Termos de Serviço</a></p>
    </footer>



</body>


</html>