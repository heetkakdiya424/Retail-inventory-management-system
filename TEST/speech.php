<!DOCTYPE html>
<html>
<body>
  <button id="startRecording">Start Recording</button>
  <button id="stopRecording" disabled>Stop Recording</button>
  <audio id="audio" controls></audio>

  <script>
    let mediaRecorder;
    let audioChunks = [];

    const startRecordingButton = document.getElementById("startRecording");
    const stopRecordingButton = document.getElementById("stopRecording");
    const audioElement = document.getElementById("audio");

    startRecordingButton.addEventListener("click", () => {
      navigator.mediaDevices
        .getUserMedia({ audio: true })
        .then((stream) => {
          mediaRecorder = new MediaRecorder(stream);
          mediaRecorder.ondataavailable = (event) => {
            if (event.data.size > 0) {
              audioChunks.push(event.data);
            }
          };
          mediaRecorder.onstop = () => {
            const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
            audioElement.src = URL.createObjectURL(audioBlob);
            stopRecordingButton.disabled = true;
          };
          mediaRecorder.start();
          startRecordingButton.disabled = true;
          stopRecordingButton.disabled = false;
        });
    });

    stopRecordingButton.addEventListener("click", () => {
      mediaRecorder.stop();
    });
  </script>
</body>
</html>
