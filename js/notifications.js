        }
    } catch (error) {
    console.error('Error loading notification count:', error);
}
}

// Start polling for notifications
function startNotificationPolling() {
    loadNotificationCount(); // Load immediately
    notificationInterval = setInterval(loadNotificationCount, 30000); // Every 30 seconds
}

// Stop polling
function stopNotificationPolling() {
    if (notificationInterval) {
        clearInterval(notificationInterval);
    }
}

// Toggle notifications panel
function toggleNotifications() {
    const panel = document.getElementById('notificationsPanel');
    if (panel.classList.contains('hidden')) {
        loadNotifications();
        panel.classList.remove('hidden');
    } else {
        if (notifications.length === 0) {
            container.innerHTML = '<div class="text-center text-gray-500 py-4 text-sm">No hay notificaciones</div>';
            return;
        }

        container.innerHTML = notifications.map(n => `
            <div class="p-3 hover:bg-gray-800 cursor-pointer transition ${!n.is_read ? 'bg-gray-800/50' : ''}" onclick="window.location.href='feed.html'">
                <div class="flex gap-3 items-start">
                    <img src="${n.commenter_photo && n.commenter_photo.startsWith('data:') ? n.commenter_photo : 'assets/img/' + (n.commenter_photo || 'default_profile.png')}" class="w-10 h-10 rounded-full object-cover">
                    <div class="flex-1">
                        <p class="text-sm">
                            <span class="font-semibold">${n.commenter_name}</span> 
                            comentó en tu publicación
                        </p>
                        <p class="text-xs text-gray-400 mt-1">${formatDate(n.created_at)}</p>
                    </div>
                </div>
            </div>
        `).join('');

        // Mark as read after viewing
        markNotificationsRead();
    } catch (error) {

        // Update badge
        loadNotificationCount();
    } catch (error) {
        console.error('Error marking notifications as read:', error);
    }
}

// Close notifications when clicking outside
document.addEventListener('click', function (event) {
    const panel = document.getElementById('notificationsPanel');
    const bellIcon = document.querySelector('[onclick="toggleNotifications()"]');

    if (panel && !panel.contains(event.target) && bellIcon && !bellIcon.contains(event.target)) {
        panel.classList.add('hidden');
    }
});
