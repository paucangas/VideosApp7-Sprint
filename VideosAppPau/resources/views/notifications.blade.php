<x-videos-app-layout>
    <h1>Notificacions</h1>

    <div id="notifications" style="margin-top: 20px;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM cargado');

            if (window.Echo) {
                console.log('Echo cargado');

                window.Echo.channel('videos')
                    .listen('video.created', (event) => {
                        console.log('Event recibido:', event);

                        const notification = document.createElement('div');
                        notification.classList.add('notification');

                        const notificationContent = `
                            <strong>Nou Video</strong><br>
                            Título: ${event.title}<br>
                            Fecha de creación: ${new Date(event.created_at).toLocaleString()}
                        `;
                        notification.innerHTML = notificationContent;

                        // Añadir la notificación al contenedor
                        document.getElementById('notifications').appendChild(notification);
                    });
            } else {
                console.error('Echo no está disponible!');
            }
        });
    </script>

</x-videos-app-layout>
