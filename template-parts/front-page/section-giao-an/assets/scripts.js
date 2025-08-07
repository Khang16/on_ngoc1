export function teachingHome() {
    class PureNumberCounter {
          constructor(element) {
            this.element = element;
            this.numberElement = element.querySelector('.number');
            this.suffixElement = element.querySelector('.suffix');
    
            // Get attributes with fallback values
            this.targetNumber = parseFloat(element.dataset.counterTarget) || 100;
            this.duration = parseInt(element.dataset.counterDuration) || 2000;
            this.suffix = element.dataset.counterSuffix || '';
            this.suffixClass = element.dataset.counterSuffixClass || '';
            this.delay = parseInt(element.dataset.counterDelay) || 0;
            this.decimal = parseInt(element.dataset.counterDecimal) || 0;
    
            this.currentNumber = 0;
            this.isAnimating = false;
            this.hasAnimated = false;
    
            // Apply suffix class if specified
            if (this.suffixClass && this.suffixElement) {
              this.suffixElement.className = `suffix ${this.suffixClass}`;
            }
    
            // Update suffix text if specified
            if (this.suffix && this.suffixElement) {
              this.suffixElement.textContent = this.suffix;
            }
          }
    
          // Linear easing for smooth counting
          linear(t) {
            return t;
          }
    
          animate() {
            if (this.isAnimating || this.hasAnimated) {
              return;
            }
    
            // Apply delay if specified
            setTimeout(() => {
              this.startAnimation();
            }, this.delay);
          }
    
          startAnimation() {
            this.isAnimating = true;
            this.hasAnimated = true;
    
            // NO entrance animation, NO class changes, NO transforms
    
            const startTime = performance.now();
            let lastDisplayedNumber = 0;
    
            const updateNumber = (currentTime) => {
              const elapsed = currentTime - startTime;
              const progress = Math.min(elapsed / this.duration, 1);
    
              // Use linear easing for smooth counting
              const easedProgress = this.linear(progress);
    
              let currentValue;
              if (this.decimal > 0) {
                currentValue = (this.targetNumber * easedProgress).toFixed(this.decimal);
              } else {
                // Improved calculation to avoid sticking
                if (progress < 0.95) {
                  currentValue = Math.floor(this.targetNumber * easedProgress);
                } else {
                  const remaining = this.targetNumber - lastDisplayedNumber;
                  if (remaining > 0) {
                    currentValue = Math.min(
                      lastDisplayedNumber + Math.ceil(remaining * (progress - 0.95) / 0.05),
                      this.targetNumber
                    );
                  }
                }
              }
    
              // Only update if the number actually changed
              if (currentValue !== lastDisplayedNumber) {
                this.numberElement.textContent = currentValue;
                lastDisplayedNumber = currentValue;
              }
    
              // Continue animation if not complete
              if (progress < 1) {
                requestAnimationFrame(updateNumber);
              } else {
                // Ensure we end with the exact target number
                if (this.decimal > 0) {
                  this.numberElement.textContent = this.targetNumber.toFixed(this.decimal);
                } else {
                  this.numberElement.textContent = this.targetNumber;
                }
                this.onComplete();
              }
            };
    
            // Start the animation
            requestAnimationFrame(updateNumber);
          }
    
          onComplete() {
            this.isAnimating = false;
    
            // NO completion effects, NO transforms, NO scale
            // Just dispatch event if needed
            this.element.dispatchEvent(new CustomEvent('counterComplete', {
              detail: {
                target: this.targetNumber,
                element: this.element
              }
            }));
          }
    
          reset() {
            this.isAnimating = false;
            this.hasAnimated = false;
            this.currentNumber = 0;
            this.numberElement.textContent = '0';
            // NO class removal, NO style changes
          }
    
          // Force start animation (for manual trigger)
          forceStart() {
            this.hasAnimated = false;
            this.animate();
          }
        }
    
        // Counter management system
        class CounterManager {
          constructor() {
            this.counters = new Map();
            this.observers = new Map();
            this.init();
          }
    
          init() {
            // Find all counter elements
            const counterElements = document.querySelectorAll('[data-counter-target]');
    
            counterElements.forEach(element => {
              const counter = new PureNumberCounter(element);
              this.counters.set(element, counter);
    
              // Set up intersection observer for each counter group
              this.setupObserver(element);
            });
          }
    
          setupObserver(element) {
            const group = element.closest('[data-counter-group]');
            if (!group || this.observers.has(group)) {
              return;
            }
    
            const observer = new IntersectionObserver((entries) => {
              entries.forEach(entry => {
                if (entry.isIntersecting) {
                  this.startGroupAnimation(entry.target);
                  observer.unobserve(entry.target);
                }
              });
            }, {
              threshold: 0.3,
              rootMargin: '0px 0px -100px 0px'
            });
    
            observer.observe(group);
            this.observers.set(group, observer);
          }
    
          startGroupAnimation(group) {
            const counters = group.querySelectorAll('[data-counter-target]');
            counters.forEach(counterElement => {
              const counter = this.counters.get(counterElement);
              if (counter) {
                counter.animate();
              }
            });
          }
    
          resetAllCounters() {
            this.counters.forEach(counter => {
              counter.reset();
            });
    
            // Reset observers
            this.observers.forEach((observer, group) => {
              observer.observe(group);
            });
          }
    
          startAllAnimations() {
            this.counters.forEach(counter => {
              counter.forceStart();
            });
          }
        }
    
        // Initialize the counter manager
        let counterManager;
    
        document.addEventListener('DOMContentLoaded', () => {
          counterManager = new CounterManager();
        });
    
        // Global functions for demo buttons
        function resetAllCounters() {
          try {
            if (counterManager) {
              counterManager.resetAllCounters();
            }
          } catch (error) {
            console.error('Error resetting counters:', error);
          }
        }
    
        function startAllAnimations() {
          try {
            if (counterManager) {
              counterManager.startAllAnimations();
            }
          } catch (error) {
            console.error('Error starting animations:', error);
          }
        }
    
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
          if (e.ctrlKey || e.metaKey) {
            switch (e.key) {
              case 'r':
                e.preventDefault();
                resetAllCounters();
                break;
              case 's':
                e.preventDefault();
                startAllAnimations();
                break;
            }
          }
        });
}

export function scrollEffect(){
    // use a script tag or an external JS file
    document.addEventListener("DOMContentLoaded", function () {
      if (window.innerWidth < 640) {
        gsap.registerPlugin(ScrollTrigger);
    
        // Tối ưu: lấy node list 1 lần
        var markers = document.querySelectorAll('.teachingProject__marker');
    
        // ScrollTrigger timeline gộp pin + các animation
        var timeline = gsap.timeline({
          scrollTrigger: {
            trigger: '#teaching',
            start: 'top top',
            end: '+=500',
            scrub: 1,
            pin: true,
            pinSpacing: false
          }
        });
    
        // Các animation chạy đồng thời (tại thời điểm 0 trong timeline)
        timeline.to('.teachingProject__people', { y: -425 }, 0);
        timeline.to('.teachingTeam', { marginTop: '-425px' }, 0);
    
        // ScrollTrigger riêng để làm blur cho markers
        ScrollTrigger.create({
          trigger: '.teachingProject__main',
          start: 'top top',
          end: '+=500',
          scrub: 1,
          onUpdate: function (self) {
            var blur = self.progress * 3; // giá trị từ 0 → 3
            markers.forEach(function (el) {
              el.style.filter = 'blur(' + blur + 'px)';
            });
          }
        });
      }
    });
}