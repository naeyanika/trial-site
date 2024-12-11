<script>
        // JavaScript to control audio volume
        const audioPlayer = document.getElementById('audioPlayer');
        const volumeControl = document.getElementById('volumeControl');

        // Set initial volume
        audioPlayer.volume = volumeControl.value;

        // Update volume based on slider input
        volumeControl.addEventListener('input', function() {
            audioPlayer.volume = this.value;
        });

        // Play the audio when the page loads
        window.onload = function() {
            audioPlayer.play();
        };
</script>

