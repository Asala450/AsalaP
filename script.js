
// Сайт ашылған кезде хабарлама
console.log("MedBlue жүйесі іске қосылды!");

// Жазылу батырмаларын тексеру
document.querySelectorAll(".main-btn").forEach(button => {
    button.addEventListener("mouseenter", () => {
        button.style.transition = "0.3s";
    });
});
