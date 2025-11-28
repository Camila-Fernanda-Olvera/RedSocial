<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Quórum</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-nav {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen">

    <!-- Navbar -->
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50 px-4 py-3">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo -->
            <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400">
                Quórum
            </h1>
            
            <!-- Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <input type="text" placeholder="Buscar en Quórum" 
                    class="w-full px-4 py-2 bg-gray-800/50 border border-gray-700 rounded-full focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 text-sm transition-all duration-300">
            </div>
            
            <!-- Nav Icons -->
            <div class="flex items-center gap-4">
                <button class="p-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200">
                    <i class="fas fa-home text-xl text-gray-300 hover:text-purple-400"></i>
                </button>
                <button class="p-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200">
                    <i class="fas fa-user-friends text-xl text-gray-300 hover:text-purple-400"></i>
                </button>
                <button class="p-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200 relative">
                    <i class="fas fa-bell text-xl text-gray-300 hover:text-purple-400"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-pink-500 rounded-full"></span>
                </button>
                <img src="https://ui-avatars.com/api/?name=Usuario&background=a78bfa&color=fff&size=128" 
                    class="w-9 h-9 rounded-full border-2 border-purple-500 cursor-pointer hover:border-pink-400 transition-all duration-200">
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-20 pb-8">
        <div class="container mx-auto px-4 max-w-6xl">
            
            <!-- Profile Header -->
            <div class="glass-panel rounded-2xl overflow-hidden mb-6 shadow-2xl">
                <!-- Cover Photo -->
                <div class="relative h-64 md:h-80 bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1579546929518-9e396f3cc809?w=1200&h=400&fit=crop" 
                        class="w-full h-full object-cover opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent"></div>
                    <button class="absolute bottom-4 right-4 px-4 py-2 bg-gray-900/70 hover:bg-gray-900/90 backdrop-blur-sm rounded-lg text-sm font-medium transition-all duration-200 border border-gray-700">
                        <i class="fas fa-camera mr-2"></i>Editar portada
                    </button>
                </div>

                <!-- Profile Info -->
                <div class="relative px-6 pb-6">
                    <!-- Profile Picture -->
                    <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16 md:-mt-20">
                        <div class="flex flex-col md:flex-row items-center md:items-end gap-4">
                            <div class="relative group">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-full blur-md opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <img src="https://ui-avatars.com/api/?name=Usuario+Quorum&background=a78bfa&color=fff&size=256" 
                                    class="relative w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-gray-900 object-cover">
                                <button class="absolute bottom-2 right-2 w-10 h-10 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 rounded-full flex items-center justify-center transition-all duration-200 shadow-lg">
                                    <i class="fas fa-camera text-sm"></i>
                                </button>
                            </div>
                            
                            <div class="text-center md:text-left mb-4 md:mb-2">
                                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-pink-400">
                                    Nombre de Usuario
                                </h2>
                                <p class="text-gray-400 text-sm mt-1">@usuario_quorum</p>
                                <div class="flex items-center justify-center md:justify-start gap-4 mt-2 text-sm">
                                    <span class="text-gray-400"><span class="font-semibold text-white">1.2k</span> amigos</span>
                                    <span class="text-gray-400"><span class="font-semibold text-white">342</span> publicaciones</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 mt-4 md:mt-0 justify-center md:justify-end">
                            <button class="px-5 py-2.5 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 hover:from-blue-500 hover:via-purple-500 hover:to-pink-500 rounded-lg font-semibold text-sm shadow-lg transform transition-all duration-200 hover:scale-105">
                                <i class="fas fa-plus-circle mr-2"></i>Agregar historia
                            </button>
                            <button class="px-5 py-2.5 bg-gray-800/70 hover:bg-gray-800 rounded-lg font-semibold text-sm border border-gray-700 transition-all duration-200">
                                <i class="fas fa-pen mr-2"></i>Editar perfil
                            </button>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <div class="flex gap-2 mt-6 border-t border-gray-800 pt-2 overflow-x-auto">
                        <button class="px-4 py-3 text-purple-400 font-semibold border-b-2 border-purple-500 hover:bg-gray-800/30 rounded-t-lg transition-all duration-200">
                            Publicaciones
                        </button>
                        <button class="px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-t-lg transition-all duration-200">
                            Información
                        </button>
                        <button class="px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-t-lg transition-all duration-200">
                            Amigos
                        </button>
                        <button class="px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-t-lg transition-all duration-200">
                            Fotos
                        </button>
                        <button class="px-4 py-3 text-gray-400 hover:text-white hover:bg-gray-800/30 rounded-t-lg transition-all duration-200">
                            Más <i class="fas fa-caret-down ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Intro Card -->
                    <div class="glass-panel rounded-2xl p-5 shadow-xl">
                        <h3 class="text-xl font-bold mb-4">Detalles</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 text-gray-300">
                                <i class="fas fa-briefcase text-purple-400 w-5"></i>
                                <span class="text-sm">Trabaja en <span class="font-semibold text-white">Desarrollo Web</span></span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-300">
                                <i class="fas fa-graduation-cap text-blue-400 w-5"></i>
                                <span class="text-sm">Estudió en <span class="font-semibold text-white">Universidad Tecnológica</span></span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-300">
                                <i class="fas fa-home text-pink-400 w-5"></i>
                                <span class="text-sm">Vive en <span class="font-semibold text-white">Ciudad de México</span></span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-300">
                                <i class="fas fa-map-marker-alt text-purple-400 w-5"></i>
                                <span class="text-sm">De <span class="font-semibold text-white">Guadalajara</span></span>
                            </div>
                        </div>
                        <button class="w-full mt-4 px-4 py-2 bg-gray-800/70 hover:bg-gray-800 rounded-lg text-sm font-medium border border-gray-700 transition-all duration-200">
                            Editar detalles
                        </button>
                    </div>

                    <!-- Photos Card -->
                    <div class="glass-panel rounded-2xl p-5 shadow-xl">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold">Fotos</h3>
                            <a href="#" class="text-purple-400 hover:text-purple-300 text-sm font-medium">Ver todas</a>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <img src="https://picsum.photos/200/200?random=1" class="w-full h-24 object-cover rounded-lg hover:opacity-80 transition-opacity cursor-pointer">
                            <img src="https://picsum.photos/200/200?random=2" class="w-full h-24 object-cover rounded-lg hover:opacity-80 transition-opacity cursor-pointer">
                            <img src="https://picsum.photos/200/200?random=3" class="w-full h-24 object-cover rounded-lg hover:opacity-80 transition-opacity cursor-pointer">
                            <img src="https://picsum.photos/200/200?random=4" class="w-full h-24 object-cover rounded-lg hover:opacity-80 transition-opacity cursor-pointer">
                            <img src="https://picsum.photos/200/200?random=5" class="w-full h-24 object-cover rounded-lg hover:opacity-80 transition-opacity cursor-pointer">
                            <img src="https://picsum.photos/200/200?random=6" class="w-full h-24 object-cover rounded-lg hover:opacity-80 transition-opacity cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Main Feed -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Create Post Card -->
                    <div class="glass-panel rounded-2xl p-5 shadow-xl">
                        <div class="flex gap-3 items-center">
                            <img src="https://ui-avatars.com/api/?name=Usuario&background=a78bfa&color=fff&size=128" 
                                class="w-10 h-10 rounded-full">
                            <button class="flex-1 px-4 py-3 bg-gray-800/50 hover:bg-gray-800 rounded-full text-left text-gray-400 text-sm transition-all duration-200">
                                ¿Qué estás pensando?
                            </button>
                        </div>
                        <div class="border-t border-gray-800 mt-4 pt-3 flex justify-around">
                            <button class="flex items-center gap-2 px-4 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200">
                                <i class="fas fa-video text-pink-500"></i>
                                <span class="text-sm font-medium text-gray-300">Video</span>
                            </button>
                            <button class="flex items-center gap-2 px-4 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200">
                                <i class="fas fa-images text-green-500"></i>
                                <span class="text-sm font-medium text-gray-300">Foto</span>
                            </button>
                            <button class="flex items-center gap-2 px-4 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200">
                                <i class="fas fa-smile text-yellow-500"></i>
                                <span class="text-sm font-medium text-gray-300">Sentimiento</span>
                            </button>
                        </div>
                    </div>

                    <!-- Post 1 -->
                    <div class="glass-panel rounded-2xl p-5 shadow-xl">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex gap-3">
                                <img src="https://ui-avatars.com/api/?name=Usuario&background=a78bfa&color=fff&size=128" 
                                    class="w-11 h-11 rounded-full">
                                <div>
                                    <h4 class="font-semibold text-white hover:underline cursor-pointer">Nombre de Usuario</h4>
                                    <p class="text-xs text-gray-400">Hace 2 horas · <i class="fas fa-globe-americas"></i></p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-white p-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>

                        <p class="text-gray-200 mb-4">¡Nuevo look para mi perfil! 🚀 Explorando nuevas posibilidades en el desarrollo web.</p>
                        
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&h=400&fit=crop" 
                            class="w-full rounded-xl mb-4 hover:opacity-95 transition-opacity cursor-pointer">

                        <div class="flex items-center justify-between text-sm text-gray-400 pb-3 border-b border-gray-800">
                            <div class="flex items-center gap-1">
                                <div class="flex -space-x-1">
                                    <span class="w-5 h-5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-xs">👍</span>
                                    <span class="w-5 h-5 bg-gradient-to-r from-pink-500 to-red-500 rounded-full flex items-center justify-center text-xs">❤️</span>
                                </div>
                                <span class="ml-1 hover:underline cursor-pointer">25</span>
                            </div>
                            <div class="flex gap-3">
                                <span class="hover:underline cursor-pointer">5 comentarios</span>
                                <span class="hover:underline cursor-pointer">2 compartidos</span>
                            </div>
                        </div>

                        <div class="flex justify-around pt-2">
                            <button class="flex-1 flex items-center justify-center gap-2 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200 group">
                                <i class="far fa-thumbs-up text-gray-400 group-hover:text-purple-400"></i>
                                <span class="text-sm font-medium text-gray-400 group-hover:text-purple-400">Me gusta</span>
                            </button>
                            <button class="flex-1 flex items-center justify-center gap-2 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200 group">
                                <i class="far fa-comment-alt text-gray-400 group-hover:text-blue-400"></i>
                                <span class="text-sm font-medium text-gray-400 group-hover:text-blue-400">Comentar</span>
                            </button>
                            <button class="flex-1 flex items-center justify-center gap-2 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200 group">
                                <i class="fas fa-share text-gray-400 group-hover:text-pink-400"></i>
                                <span class="text-sm font-medium text-gray-400 group-hover:text-pink-400">Compartir</span>
                            </button>
                        </div>
                    </div>

                    <!-- Post 2 -->
                    <div class="glass-panel rounded-2xl p-5 shadow-xl">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex gap-3">
                                <img src="https://ui-avatars.com/api/?name=Usuario&background=a78bfa&color=fff&size=128" 
                                    class="w-11 h-11 rounded-full">
                                <div>
                                    <h4 class="font-semibold text-white hover:underline cursor-pointer">Nombre de Usuario</h4>
                                    <p class="text-xs text-gray-400">Ayer a las 10:30 PM · <i class="fas fa-globe-americas"></i></p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-white p-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>

                        <p class="text-gray-200 mb-4">Disfrutando de un excelente día de programación. #Coding #WebDev #Quórum</p>

                        <div class="flex items-center justify-between text-sm text-gray-400 pb-3 border-b border-gray-800">
                            <div class="flex items-center gap-1">
                                <div class="flex -space-x-1">
                                    <span class="w-5 h-5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-xs">👍</span>
                                </div>
                                <span class="ml-1 hover:underline cursor-pointer">12</span>
                            </div>
                            <div class="flex gap-3">
                                <span class="hover:underline cursor-pointer">2 comentarios</span>
                            </div>
                        </div>

                        <div class="flex justify-around pt-2">
                            <button class="flex-1 flex items-center justify-center gap-2 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200 group">
                                <i class="far fa-thumbs-up text-gray-400 group-hover:text-purple-400"></i>
                                <span class="text-sm font-medium text-gray-400 group-hover:text-purple-400">Me gusta</span>
                            </button>
                            <button class="flex-1 flex items-center justify-center gap-2 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200 group">
                                <i class="far fa-comment-alt text-gray-400 group-hover:text-blue-400"></i>
                                <span class="text-sm font-medium text-gray-400 group-hover:text-blue-400">Comentar</span>
                            </button>
                            <button class="flex-1 flex items-center justify-center gap-2 py-2 hover:bg-gray-800/50 rounded-lg transition-all duration-200 group">
                                <i class="fas fa-share text-gray-400 group-hover:text-pink-400"></i>
                                <span class="text-sm font-medium text-gray-400 group-hover:text-pink-400">Compartir</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="js/profile.js"></script>
</body>
</html>
