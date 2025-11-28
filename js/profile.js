// Profile Page Interactions
document.addEventListener('DOMContentLoaded', async () => {
    console.log('Profile JS loaded');

    // Like Button Interaction
    const likeButtons = document.querySelectorAll('button:has(.fa-thumbs-up)');

    likeButtons.forEach(btn => {
        btn.addEventListener('click', async function () {
            const icon = this.querySelector('.fa-thumbs-up');
            const text = this.querySelector('span');

            // Toggle liked state
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.classList.add('text-purple-400');
                text.classList.add('text-purple-400');

                // Simulate API call
                await simulateLikeAction('like');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.classList.remove('text-purple-400');
                text.classList.remove('text-purple-400');

                // Simulate API call
                await simulateLikeAction('unlike');
            }
        });
    });

    // Create Post Input Focus
    const postInput = document.querySelector('button:has-text("¿Qué estás pensando?")');
    if (postInput) {
        postInput.addEventListener('click', async () => {
            // Future: Open create post modal
            alert('Funcionalidad de crear publicación próximamente...');
        });
    }

    // Comment Button Interaction
    const commentButtons = document.querySelectorAll('button:has(.fa-comment-alt)');
    commentButtons.forEach(btn => {
        btn.addEventListener('click', async () => {
            // Future: Open comment section
            alert('Funcionalidad de comentarios próximamente...');
        });
    });

    // Share Button Interaction
    const shareButtons = document.querySelectorAll('button:has(.fa-share)');
    shareButtons.forEach(btn => {
        btn.addEventListener('click', async () => {
            // Future: Open share modal
            alert('Funcionalidad de compartir próximamente...');
        });
    });
});

// Simulate async API call for like action
async function simulateLikeAction(action) {
    return new Promise((resolve) => {
        setTimeout(() => {
            console.log(`Action: ${action}`);
            resolve();
        }, 300);
    });
}

// Future: Fetch user posts from API
async function fetchUserPosts(userId) {
    try {
        const response = await fetch(`api/posts.php?user_id=${userId}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching posts:', error);
        return [];
    }
}

// Future: Fetch user profile data
async function fetchUserProfile(userId) {
    try {
        const response = await fetch(`api/profile.php?user_id=${userId}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching profile:', error);
        return null;
    }
}
