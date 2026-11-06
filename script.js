// Документ толық жүктелген соң орындалады
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Форма жіберілген кезде клиенттік валидация (тексеру) жасау
    const form = document.querySelector('.appointment-form');
    
    if (form) {
        form.addEventListener('submit', function(event) {
            const userName = document.getElementById('user_name').value.trim();
            const userEmail = document.getElementById('user_email').value.trim();
            const doctorSelect = document.getElementById('doctor_select').value;
            const appointmentDate = document.getElementById('appointment_date').value;

            if (!userName || !userEmail || !doctorSelect || !appointmentDate) {
                event.preventDefault(); // Форманың жіберілуін тоқтату
                alert('Барлық өрістерді толтыруыңыз сұралады!');
            } else {
                // Қарапайым растау хабарламасы
                console.log('Форма сәтті тексерілді, серверге жіберілуде...');
            }
        });
    }

    // 2. Бүгінгі күннен бұрынғы күндерді таңдамау үшін қабылдау күніне шектеу қою
    const dateInput = document.getElementById('appointment_date');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }

    // 3. Дәрігерлер карточкаларына интерактивті эффект (тінтуыр басқанда түсі өзгеруі)
    const doctorCards = document.querySelectorAll('.doctor-card');
    doctorCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.transition = 'transform 0.3s ease';
            card.style.borderColor = '#6DA5C0';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.borderColor = '#0F969C';
        });
    });
});