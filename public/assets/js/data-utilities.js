/**
 * Data Utilities for AJM Logistics Website
 * Handles mobile interactions, form validation, and responsive features
 */

class AJMLogistics {
    constructor() {
        this.init();
        this.bindEvents();
        this.setupMobileOptimizations();
    }

    init() {
        // Initialize mobile menu
        this.mobileMenuOpen = false;
        
        // Shipping rates data (simulated)
        this.shippingRates = {
            routes: {
                'jakarta-surabaya': { regular: 15000, express: 25000, distance: 685 },
                'jakarta-bandung': { regular: 8000, express: 15000, distance: 150 },
                'jakarta-medan': { regular: 35000, express: 55000, distance: 1420 },
                'surabaya-jakarta': { regular: 15000, express: 25000, distance: 685 },
                'surabaya-bandung': { regular: 20000, express: 35000, distance: 535 },
                'surabaya-medan': { regular: 45000, express: 75000, distance: 1735 },
                'bandung-jakarta': { regular: 8000, express: 15000, distance: 150 },
                'bandung-surabaya': { regular: 20000, express: 35000, distance: 535 },
                'bandung-medan': { regular: 40000, express: 65000, distance: 1570 },
                'medan-jakarta': { regular: 35000, express: 55000, distance: 1420 },
                'medan-surabaya': { regular: 45000, express: 75000, distance: 1735 },
                'medan-bandung': { regular: 40000, express: 65000, distance: 1570 }
            },
            additionalServices: {
                insurance: 5000,
                packing: 15000
            },
            weightMultiplier: 1000 // per kg
        };

        // Setup form validation
        this.setupFormValidation();
        
        // Setup smooth scrolling for navigation
        this.setupSmoothScrolling();
        
        // Setup responsive images if needed
        this.setupResponsiveImages();
    }

    bindEvents() {
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.toggleMobileMenu();
            });
        }

        // Shipping calculator form
        const shippingForm = document.getElementById('shippingCalculator');
        if (shippingForm) {
            shippingForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.calculateShipping();
            });

            // Real-time form updates for better UX
            const formInputs = shippingForm.querySelectorAll('input, select');
            formInputs.forEach(input => {
                input.addEventListener('change', () => {
                    this.validateForm();
                });
            });
        }

        // Contact form
        const contactForm = document.querySelector('.contact-form form');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleContactForm();
            });
        }

        // Window resize handler for responsive adjustments
        window.addEventListener('resize', this.debounce(() => {
            this.handleResize();
        }, 250));

        // Touch events for mobile optimization
        this.setupTouchEvents();
    }

    setupMobileOptimizations() {
        // Detect mobile device
        this.isMobile = this.detectMobileDevice();
        
        // Add mobile class to body if mobile
        if (this.isMobile) {
            document.body.classList.add('is-mobile');
        }

        // Optimize form elements for mobile
        if (this.isMobile) {
            this.optimizeFormsForMobile();
        }

        // Setup viewport height fix for mobile browsers
        this.setupViewportFix();

        // Improve scroll performance on mobile
        this.setupScrollOptimization();
    }

    detectMobileDevice() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) 
            || window.innerWidth < 768;
    }

    optimizeFormsForMobile() {
        // Add mobile-specific attributes to form elements
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            // Prevent zoom on iOS when focusing inputs
            if (input.type !== 'range' && input.type !== 'checkbox' && input.type !== 'radio') {
                input.style.fontSize = '16px';
            }

            // Add autocomplete attributes for better mobile experience
            if (input.type === 'email') {
                input.setAttribute('autocomplete', 'email');
                input.setAttribute('inputmode', 'email');
            }
            
            if (input.type === 'tel') {
                input.setAttribute('autocomplete', 'tel');
                input.setAttribute('inputmode', 'tel');
            }

            if (input.type === 'number') {
                input.setAttribute('inputmode', 'numeric');
            }
        });
    }

    setupViewportFix() {
        // Fix for mobile viewport height issues
        const setViewportHeight = () => {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        };

        setViewportHeight();
        window.addEventListener('resize', setViewportHeight);
        window.addEventListener('orientationchange', () => {
            setTimeout(setViewportHeight, 100);
        });
    }

    setupScrollOptimization() {
        // Add smooth scrolling support
        let isScrolling = false;
        
        const optimizeScroll = () => {
            if (!isScrolling) {
                window.requestAnimationFrame(() => {
                    // Perform scroll-related optimizations here
                    this.updateScrollProgress();
                    isScrolling = false;
                });
                isScrolling = true;
            }
        };

        window.addEventListener('scroll', optimizeScroll, { passive: true });
    }

    setupTouchEvents() {
        // Add touch feedback for buttons and interactive elements
        const interactiveElements = document.querySelectorAll(
            'button, .cta-button, .radio-option, .checkbox-option, .compare-card'
        );

        interactiveElements.forEach(element => {
            element.addEventListener('touchstart', () => {
                element.classList.add('touching');
            }, { passive: true });

            element.addEventListener('touchend', () => {
                setTimeout(() => {
                    element.classList.remove('touching');
                }, 150);
            }, { passive: true });
        });
    }

    toggleMobileMenu() {
        const navMenu = document.querySelector('.nav-menu');
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        
        if (!navMenu) return;

        this.mobileMenuOpen = !this.mobileMenuOpen;
        
        if (this.mobileMenuOpen) {
            navMenu.style.display = 'flex';
            navMenu.style.flexDirection = 'column';
            navMenu.style.position = 'absolute';
            navMenu.style.top = '100%';
            navMenu.style.left = '0';
            navMenu.style.right = '0';
            navMenu.style.background = 'white';
            navMenu.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
            navMenu.style.padding = '1rem';
            navMenu.style.zIndex = '1000';
            
            mobileMenuBtn.classList.add('active');
        } else {
            navMenu.style.display = 'none';
            mobileMenuBtn.classList.remove('active');
        }

        // Close menu when clicking outside
        if (this.mobileMenuOpen) {
            setTimeout(() => {
                document.addEventListener('click', this.closeMobileMenuOnOutsideClick.bind(this));
            }, 100);
        }
    }

    closeMobileMenuOnOutsideClick(event) {
        const navMenu = document.querySelector('.nav-menu');
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        
        if (!navMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
            this.mobileMenuOpen = false;
            navMenu.style.display = 'none';
            mobileMenuBtn.classList.remove('active');
            document.removeEventListener('click', this.closeMobileMenuOnOutsideClick);
        }
    }

    calculateShipping() {
        const form = document.getElementById('shippingCalculator');
        const formData = new FormData(form);
        
        const origin = formData.get('origin');
        const destination = formData.get('destination');
        const weight = parseFloat(formData.get('weight'));
        const service = formData.get('service');
        const insurance = formData.get('insurance');
        const packing = formData.get('packing');

        // Validation
        if (!origin || !destination || !weight || !service) {
            this.showError('Mohon lengkapi semua field yang diperlukan');
            return;
        }

        if (origin === destination) {
            this.showError('Kota asal dan tujuan tidak boleh sama');
            return;
        }

        // Calculate shipping cost
        const route = `${origin}-${destination}`;
        const routeData = this.shippingRates.routes[route];
        
        if (!routeData) {
            this.showError('Rute pengiriman tidak tersedia');
            return;
        }

        const baseCost = routeData[service];
        const weightCost = (weight - 1) * this.shippingRates.weightMultiplier;
        const insuranceCost = insurance ? this.shippingRates.additionalServices.insurance : 0;
        const packingCost = packing ? this.shippingRates.additionalServices.packing : 0;
        
        const totalCost = baseCost + Math.max(0, weightCost) + insuranceCost + packingCost;

        // Calculate both service types for comparison
        const regularCost = routeData.regular + Math.max(0, weightCost) + insuranceCost + packingCost;
        const expressCost = routeData.express + Math.max(0, weightCost) + insuranceCost + packingCost;

        // Display results
        this.displayResults({
            route: `${this.formatCityName(origin)} → ${this.formatCityName(destination)}`,
            weight: `${weight} kg`,
            service: service === 'regular' ? 'Regular (3-5 hari)' : 'Express (1-2 hari)',
            baseCost: this.formatCurrency(baseCost),
            additionalCost: this.formatCurrency(weightCost + insuranceCost + packingCost),
            totalCost: this.formatCurrency(totalCost),
            regularPrice: this.formatCurrency(regularCost),
            expressPrice: this.formatCurrency(expressCost)
        });

        // Smooth scroll to results on mobile
        if (this.isMobile) {
            this.smoothScrollToElement('.pricing-results');
        }
    }

    displayResults(data) {
        const resultsContainer = document.getElementById('results-container');
        const resultsContent = document.getElementById('results-content');
        const emptyState = resultsContainer.querySelector('.results-empty');
        
        // Hide empty state and show results
        if (emptyState) {
            emptyState.style.display = 'none';
        }
        resultsContent.style.display = 'block';

        // Update result values
        document.getElementById('route-result').textContent = data.route;
        document.getElementById('weight-result').textContent = data.weight;
        document.getElementById('service-result').textContent = data.service;
        document.getElementById('base-cost').textContent = data.baseCost;
        document.getElementById('additional-cost').textContent = data.additionalCost;
        document.getElementById('total-cost').textContent = data.totalCost;
        document.getElementById('regular-price').textContent = data.regularPrice;
        document.getElementById('express-price').textContent = data.expressPrice;

        // Add animation class
        resultsContent.classList.add('fade-in');
        
        // Success feedback
        this.showSuccess('Perhitungan ongkir berhasil!');
    }

    formatCityName(city) {
        const cityNames = {
            'jakarta': 'Jakarta',
            'surabaya': 'Surabaya',
            'bandung': 'Bandung',
            'medan': 'Medan'
        };
        return cityNames[city] || city;
    }

    formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    setupFormValidation() {
        // Custom validation messages
        const setCustomValidationMessages = () => {
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('invalid', (e) => {
                    e.preventDefault();
                    this.showFieldError(input, this.getValidationMessage(input));
                });
            });
        };

        setCustomValidationMessages();
    }

    getValidationMessage(input) {
        const messages = {
            valueMissing: 'Field ini harus diisi',
            typeMismatch: 'Format tidak sesuai',
            rangeUnderflow: `Minimum nilai adalah ${input.min}`,
            rangeOverflow: `Maximum nilai adalah ${input.max}`,
            stepMismatch: 'Nilai tidak valid'
        };

        const validity = input.validity;
        
        if (validity.valueMissing) return messages.valueMissing;
        if (validity.typeMismatch) return messages.typeMismatch;
        if (validity.rangeUnderflow) return messages.rangeUnderflow;
        if (validity.rangeOverflow) return messages.rangeOverflow;
        if (validity.stepMismatch) return messages.stepMismatch;
        
        return 'Input tidak valid';
    }

    validateForm() {
        const form = document.getElementById('shippingCalculator');
        const isValid = form.checkValidity();
        
        // Update button state
        const submitBtn = form.querySelector('.calculate-btn');
        if (submitBtn) {
            if (isValid) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
            }
        }
        
        return isValid;
    }

    handleContactForm() {
        const form = document.querySelector('.contact-form form');
        const formData = new FormData(form);
        
        const name = formData.get('name');
        const email = formData.get('email');
        const message = formData.get('message');

        if (!name || !email || !message) {
            this.showError('Mohon lengkapi semua field');
            return;
        }

        // Simulate form submission
        this.showLoading('Mengirim pesan...');
        
        setTimeout(() => {
            this.hideLoading();
            this.showSuccess('Pesan berhasil dikirim! Kami akan merespons dalam 24 jam.');
            form.reset();
        }, 2000);
    }

    setupSmoothScrolling() {
        // Smooth scroll for navigation links
        const navLinks = document.querySelectorAll('a[href^="#"]');
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    this.smoothScrollToElement(target);
                }
                
                // Close mobile menu if open
                if (this.mobileMenuOpen) {
                    this.toggleMobileMenu();
                }
            });
        });
    }

    smoothScrollToElement(elementOrSelector) {
        const element = typeof elementOrSelector === 'string' 
            ? document.querySelector(elementOrSelector) 
            : elementOrSelector;
            
        if (element) {
            const headerHeight = document.querySelector('.header').offsetHeight;
            const targetPosition = element.offsetTop - headerHeight - 20;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    setupResponsiveImages() {
        // Setup responsive image loading if needed
        const images = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        observer.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }
    }

    handleResize() {
        // Update mobile detection
        const wasMobile = this.isMobile;
        this.isMobile = this.detectMobileDevice();
        
        if (wasMobile !== this.isMobile) {
            if (this.isMobile) {
                document.body.classList.add('is-mobile');
                this.optimizeFormsForMobile();
            } else {
                document.body.classList.remove('is-mobile');
                // Close mobile menu if switching to desktop
                if (this.mobileMenuOpen) {
                    this.toggleMobileMenu();
                }
            }
        }

        // Update viewport height
        this.setupViewportFix();
    }

    updateScrollProgress() {
        // Update scroll progress indicator if exists
        const scrollProgress = document.querySelector('.scroll-progress');
        if (scrollProgress) {
            const scrollPercent = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
            scrollProgress.style.width = `${scrollPercent}%`;
        }
    }

    // Utility methods for user feedback
    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showError(message) {
        this.showNotification(message, 'error');
    }

    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existing = document.querySelector('.notification');
        if (existing) {
            existing.remove();
        }

        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">×</button>
            </div>
        `;

        // Add notification styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'error' ? '#ef4444' : type === 'success' ? '#10b981' : '#3b82f6'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            animation: slideIn 0.3s ease;
            max-width: 300px;
        `;

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }
        }, 5000);
    }

    showFieldError(field, message) {
        // Remove existing error
        const existingError = field.parentElement.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }

        // Add error message
        const errorElement = document.createElement('div');
        errorElement.className = 'field-error';
        errorElement.textContent = message;
        errorElement.style.cssText = `
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        `;

        field.parentElement.appendChild(errorElement);
        field.style.borderColor = '#ef4444';

        // Remove error on input
        field.addEventListener('input', () => {
            if (errorElement.parentElement) {
                errorElement.remove();
            }
            field.style.borderColor = '';
        }, { once: true });
    }

    showLoading(message = 'Loading...') {
        const loader = document.createElement('div');
        loader.className = 'loading-overlay';
        loader.innerHTML = `
            <div class="loading-content">
                <div class="loading-spinner"></div>
                <div class="loading-message">${message}</div>
            </div>
        `;

        loader.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        `;

        const content = loader.querySelector('.loading-content');
        content.style.cssText = `
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            text-align: center;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        `;

        const spinner = loader.querySelector('.loading-spinner');
        spinner.style.cssText = `
            width: 40px;
            height: 40px;
            border: 4px solid #f3f4f6;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        `;

        document.body.appendChild(loader);
    }

    hideLoading() {
        const loader = document.querySelector('.loading-overlay');
        if (loader) {
            loader.remove();
        }
    }

    // Utility function for debouncing
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Add required CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fade-in {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .touching {
        transform: scale(0.95);
        opacity: 0.8;
        transition: all 0.1s ease;
    }

    .notification-close {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        margin-left: 1rem;
    }

    .notification-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Mobile menu button animation */
    .mobile-menu-btn.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .mobile-menu-btn.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-menu-btn.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }

    /* Button disabled state */
    .calculate-btn.disabled,
    .submit-btn.disabled {
        background-color: #9ca3af;
        cursor: not-allowed;
        opacity: 0.6;
    }
`;

document.head.appendChild(style);

// Initialize the application when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AJMLogistics();
});

// Export for potential external use
window.AJMLogistics = AJMLogistics;