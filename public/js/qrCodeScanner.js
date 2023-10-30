
const btnScanQR = document.getElementById("btn-scan-qr");

btnScanQR.onclick = () => {
    const qrcode = window.qrcode;
    const video = document.createElement("video");
    const canvasElement = document.getElementById("qr-canvas");
    const canvas = canvasElement.getContext("2d");

    // const qrResult = document.getElementById("qr-result");
    const outputData = document.getElementById("outputData");
    const gambar = document.getElementById("gambar-qr");
    let scanning = false;

    qrcode.callback = (res) => {

        if (res) {
            //   outputData.focus();
            outputData.value = res;
            outputData.blur();

            scanning = false;

            video.srcObject.getTracks().forEach(track => {
                track.stop();
            });

            //   qrResult.hidden = false;
            btnScanQR.hidden = false;
            canvasElement.hidden = true;
        }
    };


    // outputData.innerText = 'nasi';
    outputData.focus();
    navigator.mediaDevices
        .getUserMedia({ video: { facingMode: "environment" } })
        .then(function (stream) {
            scanning = true;
            // qrResult.hidden = true;
            btnScanQR.hidden = true;
            gambar.hidden = true;
            canvasElement.hidden = false;
            video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
            video.srcObject = stream;
            video.play();
            tick();
            scan();
        });


    function tick() {
        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

        scanning && requestAnimationFrame(tick);
    }


    function scan() {
        try {
            qrcode.decode();
        } catch (e) {
            setTimeout(scan, 300);
        }
    }
};
