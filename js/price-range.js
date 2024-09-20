
    document.addEventListener('DOMContentLoaded', function() {
        const minRange = document.getElementById('min-range');
        const maxRange = document.getElementById('max-range');
        const minOutput = document.getElementById('min-output');
        const maxOutput = document.getElementById('max-output');

            console.log(minRange);
            
        minRange.addEventListener('input', function() {
            minOutput.textContent = this.value;
        });

        maxRange.addEventListener('input', function() {
            maxOutput.textContent = this.value;
        });
    });

