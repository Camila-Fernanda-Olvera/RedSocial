// Global user variable
let currentUser = null;

// Initialize on page load
document.addEventListener('DOMContentLoaded', async () => {
    currentUser = JSON.parse(localStorage.getItem('quorum_user'));

    if (!currentUser) {
        window.location.href = 'Index.html';
        return;
    }

    // Update UI with user info
    await updateUserUI();

    // Load feed
    await loadFeed();
});

// Update user UI elements
async function updateUserUI() {
    // Fetch fresh data from DB
    try {
        const response = await fetch(`api/get_profile.php?user_id=${currentUser.id}`);
        if (response.ok) {
            const freshUser = await response.json();
            currentUser = { ...currentUser, ...freshUser };
            localStorage.setItem('quorum_user', JSON.stringify(currentUser));
        }
    } catch (error) {
        console.error('Error fetching user data:', error);
    }

    // Update name
    const nameElements = ['sidebarUserName', 'modalUserName'];
    nameElements.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.innerText = currentUser.nombre;
    });

    // Update profile pictures
    if (currentUser.foto_perfil && currentUser.foto_perfil !== 'default_profile.png') {
        const src = currentUser.foto_perfil.startsWith('data:') ? currentUser.foto_perfil : `assets/img/${currentUser.foto_perfil}`;
        const pics = ['navProfilePic', 'sidebarProfilePic', 'createPostProfilePic', 'modalProfilePic'];
        pics.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.src = src;
        });
    }
}

// Load feed posts
async function loadFeed() {
    const container = document.getElementById('feedContainer');

    try {
        const response = await fetch('api/get_posts.php');
        const posts = await response.json();

        container.innerHTML = '';

        if (posts.length === 0) {
            container.innerHTML = '<div class="text-center text-gray-500 py-10">No hay publicaciones aún. ¡Sé el primero en publicar!</div>';
            return;
        }

        posts.forEach(post => {
            container.innerHTML += renderPost(post);
        });
    } catch (error) {
        console.error('Error loading feed:', error);
        container.innerHTML = '<div class="text-center text-red-400 py-10">Error al cargar publicaciones.</div>';
    }
}

// Render a single post
function renderPost(post) {
    const userPhoto = post.foto_perfil && post.foto_perfil.startsWith('data:') ? post.foto_perfil : `assets/img/${post.foto_perfil || 'default_profile.png'}`;
    const postImage = post.image ? `<div class="rounded-lg overflow-hidden mb-4 border border-gray-700"><img src="${post.image}" class="w-full h-auto object-cover"></div>` : '';
    const commentsHTML = post.comments ? post.comments.map(c => renderComment(c)).join('') : '';

    return `
        <div class="glass-panel rounded-xl p-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <img src="${userPhoto}" class="w-10 h-10 rounded-full object-cover border border-gray-600">
                    <div>
                        <h4 class="font-semibold text-sm">${post.nombre}</h4>
                        <p class="text-xs text-gray-400">${formatDate(post.created_at)}</p>
                    </div>
                </div>
            </div>
            
            ${post.content ? `<p class="text-gray-200 mb-4 text-sm leading-relaxed">${post.content}</p>` : ''}
            ${postImage}

            <div class="flex justify-end items-center text-gray-400 text-sm mb-3 px-1">
                <div class="flex gap-3">
                    <span>${post.comments ? post.comments.length : 0} comentarios</span>
                </div>
            </div>

            <div class="flex justify-between border-t border-b border-gray-700 py-1 mb-4">
                <button onclick="toggleComments(${post.id})" class="flex-1 flex items-center justify-center gap-2 py-2 text-gray-400 hover:bg-gray-800 rounded-lg transition">
                    <i class="far fa-comment-alt"></i> <span class="text-sm font-medium">Comentar</span>
                </button>
            </div>

            <div id="comments-${post.id}" class="space-y-3 hidden">
                ${commentsHTML}
                
                <div class="flex gap-2 items-start mt-3">
                    <img src="${currentUser.foto_perfil && currentUser.foto_perfil.startsWith('data:') ? currentUser.foto_perfil : 'assets/img/' + (currentUser.foto_perfil || 'default_profile.png')}" class="w-8 h-8 rounded-full object-cover">
                    <div class="flex-1 relative">
                        <input type="text" id="input-comment-${post.id}" placeholder="Escribe un comentario..." class="w-full bg-gray-800/50 rounded-2xl py-2 px-4 text-sm focus:outline-none text-gray-300 border border-transparent focus:border-gray-600" onkeypress="handleCommentKeypress(event, ${post.id})">
                        <button class="absolute right-3 top-2 text-blue-400 text-xs font-semibold hover:text-blue-300" onclick="submitComment(${post.id})">PUBLICAR</button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Render a single comment
function renderComment(comment) {
    const userPhoto = comment.foto_perfil && comment.foto_perfil.startsWith('data:') ? comment.foto_perfil : `assets/img/${comment.foto_perfil || 'default_profile.png'}`;

    return `
        <div class="flex gap-2 items-start">
            <img src="${userPhoto}" class="w-8 h-8 rounded-full object-cover">
            <div class="bg-gray-800 rounded-2xl px-4 py-2 flex-1">
                <p class="font-bold text-xs text-gray-300">${comment.nombre}</p>
                <p class="text-sm text-gray-200">${comment.content}</p>
                <p class="text-xs text-gray-500 mt-1">${formatDate(comment.created_at)}</p>
            </div>
        </div>
    `;
}

// Toggle comments visibility
function toggleComments(postId) {
    const el = document.getElementById(`comments-${postId}`);
    el.classList.toggle('hidden');
}

// Handle comment keypress (Enter to submit)
async function handleCommentKeypress(e, postId) {
    if (e.key === 'Enter') {
        await submitComment(postId);
    }
}

// Submit comment
async function submitComment(postId) {
    const input = document.getElementById(`input-comment-${postId}`);
    const content = input.value.trim();

    if (!content) return;

    try {
        const response = await fetch('api/add_comment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                post_id: postId,
                user_id: currentUser.id,
                content: content
            })
        });

        if (response.ok) {
            input.value = '';
            showToast('Comentario publicado', 'success');
            await loadFeed(); // Reload feed
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al publicar comentario',
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#3b82f6'
            });
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now - date;
    const seconds = Math.floor(diff / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    if (days > 7) {
        return date.toLocaleDateString();
    } else if (days > 0) {
        return `Hace ${days} día${days > 1 ? 's' : ''}`;
    } else if (hours > 0) {
        return `Hace ${hours} hora${hours > 1 ? 's' : ''}`;
    } else if (minutes > 0) {
        return `Hace ${minutes} minuto${minutes > 1 ? 's' : ''}`;
    } else {
        return 'Hace un momento';
    }
}

// Modal functions
function openCreatePostModal() {
    document.getElementById('createPostModal').classList.remove('hidden');
}

function closeCreatePostModal() {
    document.getElementById('createPostModal').classList.add('hidden');
    document.getElementById('postContent').value = '';
    document.getElementById('postImage').value = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
}

function removeImage() {
    document.getElementById('postImage').value = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
}

// Image preview
document.getElementById('postImage').addEventListener('change', async function (e) {
    const file = e.target.files[0];
    if (file) {
        const base64 = await convertToBase64(file);
        document.getElementById('imagePreview').src = base64;
        document.getElementById('imagePreviewContainer').classList.remove('hidden');
    }
});

// Convert file to base64
function convertToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

// Create post form submission
document.getElementById('createPostForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const content = document.getElementById('postContent').value.trim();
    const imageFile = document.getElementById('postImage').files[0];
    const submitBtn = document.getElementById('submitPostBtn');

    if (!content && !imageFile) {
        showToast('La publicación no puede estar vacía', 'error');
        return;
    }

    submitBtn.disabled = true;
    submitBtn.innerText = 'Publicando...';

    try {
        let imageBase64 = null;
        if (imageFile) {
            imageBase64 = await convertToBase64(imageFile);
        }

        const response = await fetch('api/create_post.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                user_id: currentUser.id,
                content: content,
                image: imageBase64
            })
        });

        const result = await response.json();

        if (response.ok) {
            showToast('Publicación creada', 'success');
            closeCreatePostModal();
            await loadFeed();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: result.message || 'Error al crear publicación',
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#3b82f6'
            });
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error de red al crear publicación',
            background: '#1f2937',
            color: '#fff',
            confirmButtonColor: '#3b82f6'
        });
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerText = 'Publicar';
    }
});

// Toast helper
function showToast(message, type = 'info') {
    const toastContainer = document.getElementById('toastContainer');
    const toastId = 'toast-' + Date.now();
    const bgColor = type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-info';

    const toastHTML = `
        <div id="${toastId}" class="toast align-items-center text-white ${bgColor} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

    toastContainer.insertAdjacentHTML('beforeend', toastHTML);
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    toast.show();

    toastElement.addEventListener('hidden.bs.toast', () => toastElement.remove());
}

// Utility functions
function logout() {
    localStorage.removeItem('quorum_user');
    window.location.href = 'Index.html';
}

function switchAccount() {
    Swal.fire({
        title: 'Próximamente',
        text: 'La funcionalidad de cambiar cuenta estará disponible pronto.',
        icon: 'info',
        background: '#1f2937',
        color: '#fff',
        confirmButtonColor: '#3b82f6'
    });
}
