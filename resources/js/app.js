import './bootstrap';
import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

document.addEventListener('DOMContentLoaded', () => {
    initLightbox();
    initBlogLikes();
    initTts();
});

function initLightbox() {
    const triggers = document.querySelectorAll('[data-lightbox]');

    if (triggers.length === 0) {
        return;
    }

    const lightbox = document.createElement('div');
    lightbox.className = 'lightbox';
    lightbox.setAttribute('role', 'dialog');
    lightbox.setAttribute('aria-modal', 'true');
    lightbox.setAttribute('aria-label', 'Image preview');
    lightbox.innerHTML = `
        <button type="button" class="lightbox-close" aria-label="Close image preview">&times;</button>
        <button type="button" class="lightbox-nav lightbox-prev" aria-label="Previous image">&#8249;</button>
        <img src="" alt="">
        <button type="button" class="lightbox-nav lightbox-next" aria-label="Next image">&#8250;</button>
    `;
    document.body.appendChild(lightbox);

    const image = lightbox.querySelector('img');
    const closeBtn = lightbox.querySelector('.lightbox-close');
    const prevBtn = lightbox.querySelector('.lightbox-prev');
    const nextBtn = lightbox.querySelector('.lightbox-next');

    let currentIndex = 0;

    const open = (index) => {
        if (index < 0) {
            index = triggers.length - 1;
        } else if (index >= triggers.length) {
            index = 0;
        }
        currentIndex = index;

        const trigger = triggers[currentIndex];
        image.src = trigger.getAttribute('href');
        image.alt = trigger.querySelector('img')?.alt ?? '';
        lightbox.classList.add('show');
        closeBtn.focus();
    };

    const close = () => {
        lightbox.classList.remove('show');
    };

    triggers.forEach((trigger, index) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            open(index);
        });
    });

    prevBtn.addEventListener('click', (event) => {
        event.stopPropagation();
        open(currentIndex - 1);
    });

    nextBtn.addEventListener('click', (event) => {
        event.stopPropagation();
        open(currentIndex + 1);
    });

    closeBtn.addEventListener('click', close);
    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (!lightbox.classList.contains('show')) {
            return;
        }
        if (event.key === 'Escape') {
            close();
        } else if (event.key === 'ArrowLeft') {
            open(currentIndex - 1);
        } else if (event.key === 'ArrowRight') {
            open(currentIndex + 1);
        }
    });
}

function initBlogLikes() {
    const likeBtn = document.getElementById('like-btn');

    if (!likeBtn || likeBtn.disabled) {
        return;
    }

    const postId = likeBtn.dataset.post;
    const likeCount = document.getElementById('like-count');
    const likeIcon = document.getElementById('like-icon');

    likeBtn.addEventListener('click', async () => {
        try {
            const response = await fetch(`/blog/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            likeBtn.classList.toggle('btn-liked', data.liked);
            likeIcon.className = `bi ${data.liked ? 'bi-heart-fill' : 'bi-heart'} me-1`;
            likeCount.textContent = data.count;
        } catch (e) {
            // ignore network errors
        }
    });
}

function initTts() {
    const ttsBtn = document.getElementById('tts-btn');

    if (!ttsBtn) {
        return;
    }

    if (!('speechSynthesis' in window)) {
        ttsBtn.disabled = true;
        ttsBtn.title = 'Text-to-speech not supported in this browser';
        return;
    }

    const ttsLabel = document.getElementById('tts-label');
    const ttsIcon = document.getElementById('tts-icon');
    const article = document.querySelector('article');
    let speaking = false;

    const stop = () => {
        window.speechSynthesis.cancel();
        speaking = false;
        ttsLabel.textContent = 'Listen';
        ttsIcon.className = 'bi bi-volume-up me-1';
    };

    const start = () => {
        if (!article) {
            return;
        }

        let text = article.innerText || article.textContent || '';
        text = text.trim().replace(/\s+/g, ' ').slice(0, 6000);

        if (!text) {
            return;
        }

        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'en-US';

        window.speechSynthesis.cancel();
        window.speechSynthesis.speak(utterance);
        speaking = true;
        ttsLabel.textContent = 'Stop';
        ttsIcon.className = 'bi bi-volume-mute me-1';

        utterance.onend = stop;
        utterance.onerror = stop;
    };

    ttsBtn.addEventListener('click', () => {
        if (speaking) {
            stop();
        } else {
            start();
        }
    });
}
