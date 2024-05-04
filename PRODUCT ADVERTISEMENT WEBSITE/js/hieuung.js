document.addEventListener('DOMContentLoaded', function () {
    let snowflakes = document.getElementById('snow');
    let numFlakes = 20; // Số lượng tuyết rơi

    // Tạo các phần tử tuyết rơi
    for (let i = 0; i < numFlakes; i++) {
        let flake = document.createElement('div');
        flake.className = 'flake';
        flake.style.left = Math.random() * 100 + 'vw';
        flake.style.animationDuration = Math.random() * 3 + 2 + 's';
        flake.style.animationDelay = Math.random() * 2 + 's';
        flake.style.opacity = Math.random();
        snowflakes.appendChild(flake);
    }
});
