/**
 * Article Management System - Clean JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-hide messages after 4 seconds
    const messages = document.querySelectorAll('.message');
    messages.forEach(function(message) {
        setTimeout(function() {
            message.style.transition = 'opacity 0.3s';
            message.style.opacity = '0';
            setTimeout(function() {
                message.remove();
            }, 300);
        }, 4000);
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required]');
            let isValid = true;

            inputs.forEach(function(input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#dc2626';
                } else {
                    input.style.borderColor = '#e5e7eb';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert(getLocalizedMessage('required_fields'));
            }
        });
    });

    // Input focus states
    const inputs = document.querySelectorAll('input[type="text"]');
    inputs.forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#3b82f6';
            } else {
                this.style.borderColor = '#e5e7eb';
            }
        });
    });

    // Helper function for localized messages
    function getLocalizedMessage(key) {
        const messages = {
            'required_fields': {
                'uz': 'Barcha maydonlarni to\'ldiring!',
                'ru': 'Заполните все поля!',
                'en': 'Please fill all fields!'
            }
        };

        const lang = document.documentElement.getAttribute('lang') || 'uz';
        return messages[key][lang] || messages[key]['en'];
    }
});
