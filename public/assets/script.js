/**
 * Article Management System - JavaScript
 * Maqolalar boshqaruv tizimi - JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-hide messages after 5 seconds
    const messages = document.querySelectorAll('.message');
    messages.forEach(function(message) {
        setTimeout(function() {
            message.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            message.style.opacity = '0';
            message.style.transform = 'translateY(-20px)';
            setTimeout(function() {
                message.remove();
            }, 500);
        }, 5000);
    });

    // Form validation
    const addForm = document.querySelector('.add-form');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const author = document.getElementById('author').value.trim();

            if (!title || !author) {
                e.preventDefault();
                alert(getLocalizedMessage('required_fields'));
                return false;
            }

            // Additional validation
            if (title.length < 3) {
                e.preventDefault();
                alert(getLocalizedMessage('title_too_short'));
                return false;
            }

            if (author.length < 2) {
                e.preventDefault();
                alert(getLocalizedMessage('author_too_short'));
                return false;
            }
        });
    }

    // Real-time input validation feedback
    const inputs = document.querySelectorAll('input[type="text"]');
    inputs.forEach(function(input) {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#e2e8f0';
            }
        });
    });

    // Search form enhancement
    const searchInput = document.querySelector('.search-form input[name="search"]');
    if (searchInput) {
        // Add live search indicator
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            
            if (this.value.length >= 2) {
                this.style.borderColor = '#2563eb';
            } else {
                this.style.borderColor = '#e2e8f0';
            }
        });
    }

    // Smooth scroll to sections
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Table row hover effect enhancement
    const tableRows = document.querySelectorAll('.articles-table tbody tr');
    tableRows.forEach(function(row) {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
            this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
        });
    });

    // Add loading animation to buttons
    const buttons = document.querySelectorAll('button[type="submit"]');
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            if (this.form && this.form.checkValidity()) {
                const icon = this.querySelector('i');
                if (icon && !this.classList.contains('btn-danger')) {
                    icon.className = 'fas fa-spinner loading';
                }
            }
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.querySelector('.search-form input[name="search"]');
            if (searchInput) {
                searchInput.focus();
            }
        }

        // Ctrl/Cmd + N to focus new article form
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            const titleInput = document.getElementById('title');
            if (titleInput) {
                titleInput.focus();
            }
        }
    });

    // Add confirmation for delete with custom styling
    const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const confirmMessage = this.getAttribute('onsubmit').match(/'([^']+)'/)[1];
            
            if (confirm(confirmMessage)) {
                this.submit();
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
            },
            'title_too_short': {
                'uz': 'Maqola nomi kamida 3 ta belgidan iborat bo\'lishi kerak!',
                'ru': 'Название должно быть не менее 3 символов!',
                'en': 'Title must be at least 3 characters!'
            },
            'author_too_short': {
                'uz': 'Muallif nomi kamida 2 ta belgidan iborat bo\'lishi kerak!',
                'ru': 'Имя автора должно быть не менее 2 символов!',
                'en': 'Author name must be at least 2 characters!'
            }
        };

        const lang = document.documentElement.getAttribute('lang') || 'uz';
        return messages[key][lang] || messages[key]['en'];
    }

    // Add copy-to-clipboard for article IDs
    const idCells = document.querySelectorAll('.articles-table tbody td:first-child');
    idCells.forEach(function(cell) {
        cell.style.cursor = 'pointer';
        cell.title = 'Click to copy ID';
        
        cell.addEventListener('click', function() {
            const id = this.textContent;
            navigator.clipboard.writeText(id).then(function() {
                const originalText = cell.textContent;
                cell.textContent = '✓ Copied!';
                setTimeout(function() {
                    cell.textContent = originalText;
                }, 1000);
            });
        });
    });

    // Performance: Lazy load if needed
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        });

        // Observe sections for animation
        document.querySelectorAll('section').forEach(function(section) {
            observer.observe(section);
        });
    }

    console.log('Article Management System initialized successfully!');
});
