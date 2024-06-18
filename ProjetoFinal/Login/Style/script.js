window.addEventListener('load', function() {
    var loadingScreen = document.getElementById('loading-screen');
    var content = document.getElementById('content');

    // Simula um carregamento por 2 segundos
    setTimeout(function() {
        loadingScreen.style.display = 'none';
        content.style.display = 'block';
    }, 2000);
});
