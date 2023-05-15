import 'bootstrap';
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';




document.querySelectorAll('.stars input')
    .forEach(i => {
        i.addEventListener('change', _ => {
            const star = i.dataset.star;
            const isChecking = i.checked;
// jeigu zvaigzdute pazymeta
            if (isChecking) {
                i.closest('.stars').querySelectorAll('input')
                    .forEach(s => s.dataset.star <= star ? s.checked = true : s.checked = false);
            } else {
                i.closest('.stars').querySelectorAll('input')
                    .forEach(s => s.dataset.star >= star ? s.checked = false : s.checked = true);
            }
            i.closest('.stars').querySelectorAll('label')
                .forEach(l => l.classList.remove('half'));
            // i.closest('form').submit(); // old skool style
        });
    });