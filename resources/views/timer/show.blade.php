<x-layout>
<!-- Cara 2 - Kirimnya/Desainya Melalui View(untuk BlankPage & Card_Title): -->
<x-slot name="title">Mode Fokus</x-slot> 
<x-slot name="card_title">Timer Mode Fokus</x-slot> 
<x-slot name="card_footer">@Terbit</x-slot>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Timer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .timer {
            font-size: 2em;
            margin: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 1em;
            margin: 5px;
        }
        input {
            padding: 10px;
            font-size: 1em;
            width: 100px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
    <h1>Set Timer</h1>
    <div>
        <label for="minutes">Set Minutes:</label>
        <input type="number" id="minutes" placeholder="Minutes" min="0">
    </div>
    <div class="timer" id="timer">00:00</div>
    <button onclick="startTimer()">Start</button>
    <button onclick="stopTimer()">Stop</button>
    <button onclick="resetTimer()">Reset</button>
    </div>
    <script>
        let timerInterval;
        let remainingSeconds = 0;

        function updateTimerDisplay() {
            const minutes = Math.floor(remainingSeconds / 60);
            const seconds = remainingSeconds % 60;
            document.getElementById('timer').textContent =
                `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        function startTimer() {
            const minutesInput = document.getElementById('minutes').value;
            if (minutesInput && remainingSeconds === 0) {
                remainingSeconds = parseInt(minutesInput, 10) * 60;
                updateTimerDisplay();
            }
            if (!timerInterval && remainingSeconds > 0) {
                timerInterval = setInterval(() => {
                    remainingSeconds--;
                    updateTimerDisplay();

                    if (remainingSeconds <= 0) {
                        clearInterval(timerInterval);
                        timerInterval = null;
                        alert("Waktu habis!");
                    }
                }, 1000);
            }
        }

        function stopTimer() {
            clearInterval(timerInterval);
            timerInterval = null;
        }

        function resetTimer() {
            stopTimer();
            remainingSeconds = 0;
            updateTimerDisplay();
        }
    </script>
</body>
</html>
</x-layout>