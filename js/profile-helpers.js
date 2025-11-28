// Helper functions for profile page

// Format date to relative time
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

// Delete post function
async function deletePost(postId) {
    const user = JSON.parse(localStorage.getItem('quorum_user'));

    const result = await Swal.fire({
        title: '¿Eliminar publicación?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        background: '#1f2937',
        color: '#fff'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch('api/delete_post.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    post_id: postId,
                    user_id: user.id
                })
            });

            const data = await response.json();

            if (response.ok) {
                showToast('Publicación eliminada', 'success');
                // Reload posts
                if (typeof loadUserPosts === 'function') {
                    await loadUserPosts();
                } else {
                    location.reload();
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'No se pudo eliminar la publicación',
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
                text: 'Error de red al eliminar la publicación',
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#3b82f6'
            });
        }
    }
}

// Edit post function
async function editPost(postId, currentContent, currentImage) {
    const result = await Swal.fire({
        title: 'Editar publicación',
        html: `
            <textarea id="editContent" class="w-full bg-gray-800 border border-gray-600 rounded-lg p-3 text-white" rows="4" placeholder="¿Qué estás pensando?">${currentContent || ''}</textarea>
            <div class="mt-3">
                <label class="text-gray-400 text-sm">Imagen actual: ${currentImage ? 'Sí' : 'No'}</label>
                <input type="file" id="editImage" accept="image/*" class="mt-2 w-full text-sm text-gray-400">
                ${currentImage ? '<label class="mt-2 flex items-center gap-2"><input type="checkbox" id="removeImage"> <span class="text-gray-400 text-sm">Eliminar imagen actual</span></label>' : ''}
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        background: '#1f2937',
        color: '#fff',
        preConfirm: () => {
            const content = document.getElementById('editContent').value.trim();
            if (!content) {
                Swal.showValidationMessage('El contenido no puede estar vacío');
                return false;
            }
            return { content };
        }
    });

    if (result.isConfirmed) {
        const user = JSON.parse(localStorage.getItem('quorum_user'));
        const content = result.value.content;
        const imageInput = document.getElementById('editImage');
        const removeImageCheckbox = document.getElementById('removeImage');

        try {
            let imageData = undefined;

            // Check if user wants to remove current image
            if (removeImageCheckbox && removeImageCheckbox.checked) {
                imageData = null;
            } else if (imageInput && imageInput.files && imageInput.files[0]) {
                // New image uploaded
                imageData = await convertToBase64(imageInput.files[0]);
            }

            const payload = {
                post_id: postId,
                user_id: user.id,
                content: content
            };

            if (imageData !== undefined) {
                payload.image = imageData;
            }

            const response = await fetch('api/update_post.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const data = await response.json();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Publicación actualizada',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#1f2937',
                    color: '#fff'
                });

                // Reload posts
                if (typeof loadUserPosts === 'function') {
                    await loadUserPosts();
                } else {
                    location.reload();
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'No se pudo actualizar la publicación',
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
                text: 'Error al actualizar la publicación',
                background: '#1f2937',
                color: '#fff',
                confirmButtonColor: '#3b82f6'
            });
        }
    }
}

// Convert file to base64
function convertToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}
