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
