import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let scale = 1, posX = 0, posY = 0;
let isPanning = false, startX = 0, startY = 0;

const modalContent = document.getElementById("modalContent");
const zoomContainer = document.getElementById("zoomContainer");

function updateTransform() {
    zoomContainer.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
}

function resetZoomAndPan() {
    scale = 1;
    posX = 0;
    posY = 0;
    updateTransform();
}

// Zoom scroll
modalContent.addEventListener("wheel", (e) => {
    e.preventDefault();
    const zoomStep = 0.1;
    if (e.deltaY < 0) scale += zoomStep;
    else scale = Math.max(0.2, scale - zoomStep);
    updateTransform();
});

// Drag to pan
modalContent.addEventListener("mousedown", (e) => {
    isPanning = true;
    startX = e.clientX - posX;
    startY = e.clientY - posY;
});
modalContent.addEventListener("mousemove", (e) => {
    if (!isPanning) return;
    posX = e.clientX - startX;
    posY = e.clientY - startY;
    updateTransform();
});
modalContent.addEventListener("mouseup", () => isPanning = false);
modalContent.addEventListener("mouseleave", () => isPanning = false);

// Tombol kontrol
document.getElementById("zoomIn").addEventListener("click", () => {
    scale += 0.2;
    updateTransform();
});
document.getElementById("zoomOut").addEventListener("click", () => {
    scale = Math.max(0.2, scale - 0.2);
    updateTransform();
});
document.getElementById("resetZoom").addEventListener("click", () => {
    resetZoomAndPan();
});

// Buka Modal dengan konten & reset zoom
document.querySelectorAll(".open-modal").forEach(button => {
    button.addEventListener("click", e => {
        e.preventDefault();
        const file = button.dataset.file;
        const url = new URL(file);
        const relativePath = url.pathname;
        const encodedPath = encodeURIComponent(relativePath);

        const ext = button.dataset.extension.toLowerCase();

        let html = '';
        if (['jpg', 'jpeg', 'png'].includes(ext)) {
            html = `<img src="${file}" alt="Image Preview" style="width:100vw; height:100vh; object-fit: contain; display:block; margin:0; padding:0;">`;
        } else if (ext === 'pdf') {
            html = `<iframe src="/pdfjs/web/custom-viewer.html?file=${encodedPath}&zoom=page-width" style="width: 100vw; height: 100vh; border: none;"></iframe>`;
        } else if (['docx', 'ppt', 'pptx'].includes(ext)) {
            html = `<iframe src="https://docs.google.com/gview?url=${encodeURIComponent(file)}&embedded=true" style="width:100vw; height:100vh; object-fit: contain; display:block; margin:0; padding:0;"></iframe>`;
        } else {
            html = `<div class="text-white p-6">Preview tidak tersedia. <a href="${file}" target="_blank" class="underline text-green-400">Buka file</a></div>`;
        }

        zoomContainer.innerHTML = html;
        resetZoomAndPan();

        document.getElementById("previewModal").classList.remove("hidden");
        document.getElementById("modalBackdrop").classList.remove("hidden");
    });
});

// Tutup Modal
document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("previewModal").classList.add("hidden");
    document.getElementById("modalBackdrop").classList.add("hidden");
});

// Simple Keyboard integration
        const Keyboard = window.SimpleKeyboard.default;
      
        let currentInput = null;
      
        const keyboard = new Keyboard({
          onChange: input => {
            if (currentInput) {
              currentInput.value = input;
            }
          },
          onKeyPress: button => {
            console.log("Key pressed:", button);
          }
        });
      
        const keyboardContainer = document.getElementById("keyboard-container");
      
        // Input fields
        const inputs = document.querySelectorAll(".input");
      
        inputs.forEach(input => {
          input.addEventListener("click", () => {
            currentInput = input;
            keyboard.setInput(input.value || "");
            keyboardContainer.style.display = "block";
          });
        });
      
        // Hide keyboard on outside click
        document.addEventListener("click", function (e) {
          if (!keyboardContainer.contains(e.target) && !Array.from(inputs).includes(e.target)) {
            keyboardContainer.style.display = "none";
          }
        });

        const zoomControls = document.getElementById('zoomControls');
        const modal = document.getElementById('previewModal');
        let controlsVisible = true;

        // Fungsi toggle zoom controls
        function toggleControls() {
          if (controlsVisible) {
            zoomControls.style.display = 'none';
          } else {
            zoomControls.style.display = 'flex';
            autoHide();
          }
          controlsVisible = !controlsVisible;
        }

        // Auto-hide setelah beberapa detik
        function autoHide() {
          setTimeout(() => {
            zoomControls.style.display = 'none';
            controlsVisible = false;
          }, 3000);
        }

        // Tampilkan saat pertama buka modal
        window.addEventListener('load', () => {
          zoomControls.style.display = 'flex';
          controlsVisible = true;
          autoHide();
        });

        // Klik/tap tunggal yang aman, tidak mengganggu tombol
        document.getElementById('previewModal').addEventListener('click', (e) => {
          const isButton = e.target.tagName === 'BUTTON' || e.target.closest('button');
          if (!isButton) {
            toggleControls();
          }
        });

        // Untuk layar sentuh (opsional karena 'click' umumnya juga meng-cover tap)
        document.getElementById('previewModal').addEventListener('touchend', (e) => {
          const isButton = e.target.tagName === 'BUTTON' || e.target.closest('button');
          if (!isButton && window.matchMedia("(orientation: portrait)").matches) {
            toggleControls();
          }
        });

                  
        document.addEventListener('DOMContentLoaded', function () {
          const overlay = document.getElementById('idleOverlay');
          let isIdle = false;
          let timer;

          function showOverlay() {
            overlay.style.display = 'flex';
            isIdle = true;
          }

          function hideOverlay() {
            if (isIdle) {
              overlay.style.display = 'none';
              isIdle = false;
            }
          }

          function resetTimer() {
            clearTimeout(timer);
            hideOverlay();
            timer = setTimeout(showOverlay, 3000);
          }

          resetTimer(); // trigger awal setelah halaman siap

          ['mousemove', 'keydown', 'scroll', 'click', 'touchstart'].forEach(evt => {
            document.addEventListener(evt, resetTimer);
          });

          overlay.addEventListener('click', resetTimer);
        });
