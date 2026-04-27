<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>404 | VellumCMS</title>
    <meta name="robots" content="noindex">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #0f172a;
            background-image: radial-gradient(circle, #1e293b 1px, transparent 1px);
            background-size: 36px 36px;
        }

        /* Floating document */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(-5deg); }
            50%       { transform: translateY(-32px) rotate(5deg); }
        }
        .doc { animation: float 5s ease-in-out infinite; }

        /* Glitch effect */
        .glitch {
            position: relative;
            display: inline-block;
            animation: glitch-shake 4s steps(1) infinite;
        }
        .glitch::before,
        .glitch::after {
            content: '404';
            position: absolute;
            inset: 0;
            opacity: 0;
        }
        .glitch::before {
            color: #4CC9F0;
            clip-path: inset(0 0 60% 0);
            animation: glitch-top 4s steps(1) infinite;
        }
        .glitch::after {
            color: #4361EE;
            clip-path: inset(60% 0 0 0);
            animation: glitch-btm 4s steps(1) infinite;
        }
        @keyframes glitch-shake {
            0%, 85%, 100% { transform: none; }
            86%           { transform: translate(4px, -1px); }
            88%           { transform: translate(-4px, 1px); }
            90%           { transform: none; }
        }
        @keyframes glitch-top {
            0%, 85%, 100% { opacity: 0; transform: none; }
            86%           { opacity: 1; transform: translate(-6px, -3px); }
            89%           { opacity: 1; transform: translate(6px, 3px); }
            91%           { opacity: 0; }
        }
        @keyframes glitch-btm {
            0%, 85%, 100% { opacity: 0; transform: none; }
            87%           { opacity: 1; transform: translate(6px, 3px); }
            90%           { opacity: 1; transform: translate(-6px, -3px); }
            92%           { opacity: 0; }
        }

        /* Fade-up entrance */
        @keyframes up {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .u1 { animation: up 0.55s 0.05s ease both; }
        .u2 { animation: up 0.55s 0.2s  ease both; }
        .u3 { animation: up 0.55s 0.35s ease both; }
        .u4 { animation: up 0.55s 0.5s  ease both; }

        /* Stars */
        @keyframes blink {
            0%, 100% { opacity: 0.06; }
            50%       { opacity: 0.65; }
        }
        .star {
            position: fixed;
            width: 3px; height: 3px;
            background: #fff;
            border-radius: 50%;
            animation: blink ease-in-out infinite;
        }
    </style>
</head>
<body class="text-white min-h-screen flex items-center justify-center px-6 overflow-hidden font-sans">

    <!-- Stars -->
    <span class="star" style="top:8%;  left:6%;  animation-duration:2.3s; animation-delay:0s;"   aria-hidden="true"></span>
    <span class="star" style="top:15%; left:90%; animation-duration:3.1s; animation-delay:0.4s;" aria-hidden="true"></span>
    <span class="star" style="top:72%; left:11%; animation-duration:2.0s; animation-delay:1.1s;" aria-hidden="true"></span>
    <span class="star" style="top:80%; left:82%; animation-duration:2.9s; animation-delay:0.2s;" aria-hidden="true"></span>
    <span class="star" style="top:44%; left:96%; animation-duration:3.5s; animation-delay:0.7s;" aria-hidden="true"></span>
    <span class="star" style="top:60%; left:2%;  animation-duration:2.2s; animation-delay:1.4s;" aria-hidden="true"></span>
    <span class="star" style="top:92%; left:48%; animation-duration:3.0s; animation-delay:0.3s;" aria-hidden="true"></span>
    <span class="star" style="top:4%;  left:58%; animation-duration:2.6s; animation-delay:0.9s;" aria-hidden="true"></span>
    <span class="star" style="top:35%; left:78%; animation-duration:1.9s; animation-delay:0.6s;" aria-hidden="true"></span>

    <!-- Glow blob -->
    <div class="fixed inset-0 flex items-center justify-center pointer-events-none" aria-hidden="true">
        <div class="w-[700px] h-[400px] bg-gradient-to-r from-[#4361EE] via-[#4895EF] to-[#4CC9F0] opacity-[0.07] blur-3xl rounded-full"></div>
    </div>

    <div class="relative z-10 text-center max-w-xl mx-auto">

        <!-- Floating doc -->
        <div class="doc inline-block mb-4 u1" aria-hidden="true">
            <svg width="72" height="90" viewBox="0 0 72 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="1" y="1" width="58" height="76" rx="5" fill="#1e293b" stroke="#4361EE" stroke-width="1.5"/>
                <path d="M44 1 L59 16 L44 16 Z" fill="#0f172a"/>
                <path d="M44 1 L59 16" stroke="#4361EE" stroke-width="1.5"/>
                <line x1="11" y1="28" x2="48" y2="28" stroke="#4361EE" stroke-linecap="round" stroke-width="1.5" opacity="0.6"/>
                <line x1="11" y1="39" x2="41" y2="39" stroke="#4361EE" stroke-linecap="round" stroke-width="1.5" opacity="0.4"/>
                <line x1="11" y1="50" x2="45" y2="50" stroke="#4361EE" stroke-linecap="round" stroke-width="1.5" opacity="0.25"/>
                <line x1="11" y1="61" x2="30" y2="61" stroke="#4361EE" stroke-linecap="round" stroke-width="1.5" opacity="0.15"/>
                <circle cx="30" cy="80" r="9" fill="#0f172a" stroke="#4CC9F0" stroke-width="1.5"/>
                <text x="30" y="85" text-anchor="middle" fill="#4CC9F0" font-size="11" font-weight="700" font-family="monospace">?</text>
            </svg>
        </div>

        <!-- 404 -->
        <div class="u2 leading-none mb-2">
            <span class="glitch text-[10rem] md:text-[13rem] font-extrabold tracking-tighter text-white select-none">404</span>
        </div>

        <!-- Headline -->
        <h1 class="u3 text-3xl md:text-4xl font-extrabold mb-3 leading-tight">
            Nope. Nothing here.
        </h1>

        <!-- Subtext -->
        <p class="u3 text-gray-400 text-lg mb-10 leading-relaxed">
            This page doesn't exist.<br>Your cause does, let's get back to it.
        </p>

        <!-- CTAs -->
        <div class="u4 flex flex-wrap justify-center gap-4">
            <a href="/" class="bg-white text-[#0f172a] px-7 py-3 rounded-full font-bold hover:bg-gray-100 transition text-sm">
                Take Me Home
            </a>
            <a href="/get-started" class="bg-[#4361EE] text-white px-7 py-3 rounded-full font-bold hover:bg-[#364FC7] transition text-sm">
                Get Started Free
            </a>
        </div>

        <!-- Small breadcrumb -->
        <p class="u4 mt-10 text-xs text-gray-600">
            <a href="/" class="hover:text-gray-400 transition">VellumCMS</a>
            <span class="mx-2">/</span>
            <span>404</span>
        </p>

    </div>
</body>
</html>
